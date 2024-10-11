#!/usr/bin/perl

use CGI::Carp qw(fatalsToBrowser);
use Jcode;
require 'functions.cgi';
require 'config.cgi';

#POSTされたデータを取得
&getpost();

#Cookieの取得
*getCookieData = GetCookie();

if($form{'mode'} ne $null){
	if($form{'mode'} eq 'download' && $config{"password"} ne $form{'password'}){
		&downloadScreen();
	}
	elsif($form{'mode'} eq 'download' && $config{"password"} eq $form{'password'} && $config{"password"} ne $null && (-f $config{"log_file"})){
		&fileDownload();
	}
	elsif($form{'mode'} eq 'delete' && $config{"password"} ne $form{'password'}){
		&deleteScreen();
	}
	elsif($form{'mode'} eq 'delete' && $config{"password"} eq $form{'password'} && $config{"password"} ne $null && (-f $config{"log_file"})){
		&deleteComplate();
	}
	else {
		print "Content-type: text/html;charset=utf-8\n\n";
		print "ERROR CODE" . $error{"code"} . "<br>\n";
	}
}
else{
	#送信元ドメインのチェック
	&domaincheck();
	&confcheck();
	&spamcheck();
	&javascript_check();
	#mailform 用環境変数の定義
	if($error{"code"} == 0){
		&serials();
		&expires_check;
		if($error_redirect){
			&refresh($config{"error_url"});
		}
		else {
			&envMailform();
			&logfileCreate();
			if($config{"posted_body"} ne $null){
				$config{"body"} = $config{"posted_body"};
			}
			$config{"body"} .= $envs;
			$config{"body"} =~ s/<resbody>/$resbody/g;
			$config{"body"} =~ s/<date>/$form{'date'}/g;
			$config{"body"} =~ s/<serial>/$form{'serial'}/g;
			if($config{'SQLserver'}){
				use DBI;
				$SQLexport =~ s/<date>/$form{'date'}/g;
				$SQLexport =~ s/<serial>/$form{'serial'}/g;
				$SQLexport =~ s/<.*?>//ig;
				&_SQLexport;
			}
			
			if($config{"vCard"}){
				if($config{"vCard_sjis"}){
					$vCard = &encodeSJIS($vCard);
				}
				push @attached,$vCard;
				push @attached_name,"vCard.vcf";
			}
			
			if($form{'email'} =~ /[^a-zA-Z0-9\.\@\-\_\+]/ || split(/\@/,$form{'email'}) != 2){
				$form{'email'} = $mailto[0];
			}
			
			for($cnt=0;$cnt<@mailto;$cnt++){
				&sendmail($mailto[$cnt],$form{'email'},$form{'email'},$config{"subject"},$config{"body"},@attached);
			}
			if($config{"return_subject"} ne $null && $config{"return_body"} ne $null && $form{'email'} ne $mailto[0]){
				@attached = ();
				@htmlmail = ();
				if($config{"HTMLMAIL"}){
					push @htmlmail,$_HTMLMAIL;
				}
				$config{"return_body"} =~ s/<resbody>/$resbody/g;
				$config{"return_body"} =~ s/<date>/$form{'date'}/g;
				$config{"return_body"} =~ s/<serial>/$form{'serial'}/g;
				&sendmail($form{'email'},$config{"mailfrom"},$config{"fromname"},$config{"return_subject"},$config{"return_body"},@null);
			}
			
			## iCal / mfp3.1.3 l
			if($config{'iCal'}){
				&_ICAL;
			}
			## /iCal
			
			## paypal flow
			if($form{'paypal_cart'} ne $null && $_PAYPAL{'API_USER'} ne $null && $_PAYPAL{'API_PWD'} ne $null){
				use LWP::UserAgent;
				use HTTP::Request::Common qw(POST);
				@items = split(/<->/,$form{'paypal_cart'});
				$product_count = 0;
				$amt_total = 0;
				$formdata{'USER'} = $_PAYPAL{'API_USER'};
				$formdata{'PWD'} = $_PAYPAL{'API_PWD'};
				$formdata{'SIGNATURE'} = $_PAYPAL{'API_SIGNATURE'};
				$formdata{'VERSION'} = '63.0';
				$formdata{'PAYMENTACTION'} = 'Sale';
				$formdata{'HDRIMG'} = $_PAYPAL{'HDRIMG'};
				$formdata{'BRANDNAME'} = $_PAYPAL{'BRANDNAME'};
				
				if($_PAYPAL{'SECURE'}){
					@sec_items = split(/\n/,&_LOAD('./paypal.items.cgi'));
				}
				
				for($cnt=0;$cnt<@items;$cnt++){
					($product_name,$product_id,$product_amt,$product_qty) = split(/<>/,$items[$cnt]);
					if($_PAYPAL{'SECURE'}){
						($sec_id,$sec_amt,$sec_name) = split(/\t/,(grep(/^${product_id}\t/,@sec_items))[0]);
					}
					if($product_qty > 0 && ((!$_PAYPAL{'SECURE'}) || (($_PAYPAL{'SECURE'}) && $sec_amt eq $product_amt))){
						$hash = "L_PAYMENTREQUEST_0_NAME" . $product_count;
						$formdata{$hash} = $product_name;
						$hash = "L_PAYMENTREQUEST_0_NUMBER" . $product_count;
						$formdata{$hash} = $product_id;
						$hash = "L_PAYMENTREQUEST_0_AMT" . $product_count;
						$formdata{$hash} = $product_amt;
						$hash = "L_PAYMENTREQUEST_0_QTY" . $product_count;
						$formdata{$hash} = $product_qty;
						$amt_total += ($product_amt * $product_qty);
						$product_count++;
					}
				}
				$formdata{'PAYMENTREQUEST_0_AMT'} = $amt_total;
				$formdata{'PAYMENTREQUEST_0_CURRENCYCODE'} = 'JPY';
				$formdata{'RETURNURL'} = $_PAYPAL{'RETURNURL'};
				$formdata{'CANCELURL'} = $_PAYPAL{'CANCELURL'};
				$formdata{'METHOD'} = 'SetExpressCheckout';
				if($amt_total > 0){
					$req  = POST($_PAYPAL{'HOST'}, [%formdata]);
					$ua = LWP::UserAgent->new;
					$ua->agent('Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)');
					$req->referer($url);
					$res = $ua->request($req);
					$doc = $res->content;
					&_PAYPAL_RESPONSE($doc);
					$config{"thanks_url"} = $_PAYPAL{'REDIRECTURI'} . $_PAYPAL_RESPONSE_VALUE{'TOKEN'};
					flock(FH, LOCK_EX);
						open(FH,">./paypal_token/$_PAYPAL_RESPONSE_VALUE{'TOKEN'}\.cgi");
							foreach $key ( keys %form ) {
								print FH "${key}\t$form{$key}\n";
							}
						close(FH);
					flock(FH, LOCK_NB);
				}
			}
			&refresh($config{"thanks_url"});
		}
	}
	else{
		print "Content-type: text/html;charset=utf-8\n\n";
		print "ERROR CODE" . $error{"code"} . "<br>\n";
		print $error{"info"};
	}
}
exit;