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
	$payment_result = 'キャンセル';
	$_PAYPAL{'result_body'} =~ s/<paypal_result>/$payment_result/ig;
	$_PAYPAL{"result_subject"} = "\[$form{'serial'}\]" . $_PAYPAL{"result_subject"} . " " . $payment_result;
	if($form{'email'} =~ /[^a-zA-Z0-9\.\@\-\_\+]/ || split(/\@/,$form{'email'}) != 2){
		$form{'email'} = $mailto[0];
	}
	for($cnt=0;$cnt<@mailto;$cnt++){
		&sendmail($mailto[$cnt],$form{'email'},$form{'email'},$_PAYPAL{"result_subject"},$_PAYPAL{'result_body'},@attached);
	}
	unlink $token;
	&refresh($_PAYPAL{'CANCELURL_REDIRECT'});
}
else {
	print "Content-type: text/html;charset=utf-8\n\n";
	print "Token Not Found\n";
}
exit;