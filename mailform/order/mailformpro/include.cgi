#!/usr/bin/perl

use Jcode;
require 'functions.cgi';
require 'config.cgi';

*getCookieData = GetCookie();
$pv = $getCookieData{'pv'} + 1;

if($pv == 1){
	&mfp_SaveLine($config{"conversion_file"},&mfp_LoadLine($config{"conversion_file"}) + 1);
}
$total_post_count = &mfp_LoadLine($config{"serial_file"});
$total_input_time = &mfp_LoadLine($config{"input_time_file"});
if($total_input_time < 1 || $total_post_count < 1){
	$total_input_time = 1;
	$total_post_count = 1;
}
$sec = int($total_input_time / $total_post_count);
$min = int($sec / 60);
if($min > 0){
	$avg .= "${min}分";
	$sec = $sec - ($min * 60);
}
if($sec > 0) {
	$avg .= "${sec}秒";
}
$config{'input_time_format'} =~ s/<avg>/$avg/g;
$script .= "mfp_disp('input_time_disp','$config{'input_time_format'}');\n";

if($config{"error_url"} ne $null && $config{"expires"} ne $null && $form{"date"} ge $config{"expires"}){
	$config{"expires_time_timeout"} =~ s/<expires>/$config{'expires'}/g;
	$script .= "mfp_disp('expires_time_disp','" . $config{"expires_time_timeout"} . "');\nmfp_hide();\n";
}
elsif($config{"error_url"} ne $null && $config{"expires_break"} ne $null && $config{"expires_break"} ge $form{"date"}){
	$config{"expires_time_break"} =~ s/<expires>/$config{'expires_break'}/g;
	$script .= "mfp_disp('expires_time_disp','" . $config{"expires_time_break"} . "');\nmfp_hide();\n";
}
elsif($config{"expires_break"} ne $null || $config{"expires"} ne $null) {
	$config{"expires_time_format"} =~ s/<expires>/$config{'expires'}/g;
	$script .= "mfp_disp('expires_time_disp','" . $config{"expires_time_format"} . "');\n";
}

if($config{"error_url"} ne $null && $config{"limit"} ne $null && $total_post_count >= $config{"limit"}){
	$script .= "mfp_disp('limit_disp','" . $config{"limit_over"} . "');\nmfp_hide();\n";
}
else {
	$config{"limit"} = $config{"limit"} - $total_post_count;
	$config{"limit_format"} =~ s/<limit>/$config{'limit'}/g;
	$script .= "mfp_disp('limit_disp','" . $config{"limit_format"} . "');\n";
}

if(index($ENV{'HTTP_USER_AGENT'},'jig browser') > -1){
	$warning = 'document.write("<p>ご利用のブラウザでは正常に動作しない可能性があります。</p>");';
}

#
print "Pragma: no-cache\n";
print "Cache-Control: no-cache\n";
print "Content-type: text/plain; charset=UTF-8\n";
print "Set-Cookie: scriptType=perl&pv=${pv}&application=mailform;\n\n";
print <<"__script_body__";
${warning}
document.write(unescape("%3Cinput type='hidden' name='javascript_flag' value='1' /%3E"));
document.write(unescape("%3Cinput type='hidden' name='http_referer' value='"+encodeURI(document.referrer)+"' /%3E"));
__script_body__
print $script;
exit;