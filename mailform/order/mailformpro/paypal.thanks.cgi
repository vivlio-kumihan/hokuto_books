#!/usr/bin/perl

use CGI::Carp qw(fatalsToBrowser);
use Jcode;
require 'functions.cgi';
require 'config.cgi';

&getpost();

$token = './paypal_token/' . $form{'token'} . '.cgi';

if(-f $token){
	@token = split(/\n/,&_LOAD($token));
	for($cnt=0;$cnt<@token;$cnt++){
		($name,$value) = split(/\t/,$token[$cnt]);
		$_PAYPAL{'result_body'} =~ s/<${name}>/$value/ig;
		$form{$name} = $value;
	}
	## GetExpressCheckoutDetails API
	use LWP::UserAgent;
	use HTTP::Request::Common qw(POST);
	$formdata{'USER'} = $_PAYPAL{'API_USER'};
	$formdata{'PWD'} = $_PAYPAL{'API_PWD'};
	$formdata{'SIGNATURE'} = $_PAYPAL{'API_SIGNATURE'};
	$formdata{'VERSION'} = '63.0';
	$formdata{'TOKEN'} = $form{'token'};
	$formdata{'METHOD'} = 'GetExpressCheckoutDetails';
	$req  = POST($_PAYPAL{'HOST'}, [%formdata]);
	$ua = LWP::UserAgent->new;
	$ua->agent('Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)');
	$req->referer($url);
	$res = $ua->request($req);
	$doc = $res->content;
	&_PAYPAL_RESPONSE($doc);
	
	%formdata = ();
	$formdata{'USER'} = $_PAYPAL{'API_USER'};
	$formdata{'PWD'} = $_PAYPAL{'API_PWD'};
	$formdata{'SIGNATURE'} = $_PAYPAL{'API_SIGNATURE'};
	$formdata{'VERSION'} = '63.0';
	$formdata{'PAYMENTACTION'} = 'Sale';
	@items = split(/<->/,$form{'paypal_cart'});
	$product_count = 0;
	$amt_total = 0;
	for($cnt=0;$cnt<@items;$cnt++){
		($product_name,$product_id,$product_amt,$product_qty) = split(/<>/,$items[$cnt]);
		if($product_qty > 0){
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
	$formdata{'PAYERID'} = $_PAYPAL_RESPONSE_VALUE{'PAYERID'};
	$formdata{'TOKEN'} = $form{'token'};
	$formdata{'AMT'} = $amt_total;
	$formdata{'PAYMENTREQUEST_0_AMT'} = $amt_total;
	$formdata{'PAYMENTREQUEST_0_CURRENCYCODE'} = 'JPY';
	$formdata{'METHOD'} = 'DoExpressCheckoutPayment';
	$req  = POST($_PAYPAL{'HOST'}, [%formdata]);
	$ua = LWP::UserAgent->new;
	$ua->agent('Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)');
	$req->referer($url);
	$res = $ua->request($req);
	$doc = $res->content;
	&_PAYPAL_RESPONSE($doc);
	
	$_PAYPAL{'result_body'} =~ s/<paypal_response>/$_PAYPAL_RESPONSE_VAL/ig;
	$payment_result = '決済完了';
	$_PAYPAL{'result_body'} =~ s/<paypal_result>/$payment_result/ig;
	$_PAYPAL{"result_subject"} = "\[$form{'serial'}\]" . $_PAYPAL{"result_subject"} . " " . $payment_result;
	if($config{"thanks_serial"}){
		$config{"thanks_url"} .= "?$form{'serial'}";
	}
	if($form{'email'} =~ /[^a-zA-Z0-9\.\@\-\_\+]/ || split(/\@/,$form{'email'}) != 2){
		$form{'email'} = $mailto[0];
	}
	for($cnt=0;$cnt<@mailto;$cnt++){
		&sendmail($mailto[$cnt],$form{'email'},$form{'email'},$_PAYPAL{"result_subject"},$_PAYPAL{'result_body'},@attached);
	}
	
	unlink $token;
	&refresh($config{"thanks_url"});
}
else {
	print "Content-type: text/html;charset=utf-8\n\n";
	print "Token Not Found\n";
}
exit;