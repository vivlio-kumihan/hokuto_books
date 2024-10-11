#!/usr/bin/perl

require 'iplogs.init.cgi';

($sec,$min,$hour,$day,$mon,$year) = localtime(time);
$year += 1900;$mon++;
$stmp = sprintf("%04d-%02d-%02d %02d:%02d:%02d",$year,$mon,$day,$hour,$min,$sec);
$today = sprintf("%04d-%02d-%02d",$year,$mon,$day);

$yesterday = time - (60*60*24);
($sec,$min,$hour,$day,$mon,$year) = localtime($yesterday);
$yesterday = sprintf("%04d-%02d-%02d",$year += 1900,$mon+1,$day);


if($ENV{'QUERY_STRING'} && index($ENV{'HTTP_REFERER'},$domain) > -1){
	@log = ($stmp,$ENV{'REMOTE_ADDR'},$ENV{'QUERY_STRING'});
	if((-s $logfile) > $maxfilesize && ($maxfilesize)){
		@iplogs = &_LOAD($logfile);
		@today = grep(/^${today}/,@iplogs);
		@yesterday = grep(/^${yesterday}/,@iplogs);
		@iplogs = (@yesterday,@today);
		push @iplogs,join("\t",@log);
		&_SAVE($logfile,join("\n",@iplogs));
	}
	else {
		&_ADDSAVE($logfile,join("\t",@log));
	}
}
else {
$js = <<"__javascript_code__";
	var iplogsObj = new Object();
	iplogsObj.stat = false;
	iplogsObj.post = "${uri}?"+document.referrer;
	function iplogsPost(){
		iplogsAjaxObj = createXMLHttpRequest();
		iplogsAjaxObj.onreadystatechange = iplogsGet;
		iplogsAjaxObj.open("GET",iplogsObj.post);
		iplogsAjaxObj.send(null);
		return false;
	}
	function iplogsGet(){
		if ((iplogsAjaxObj.readyState == 4) && (iplogsAjaxObj.status == 200))
			iplogsObj.stat = true;
	}
	function createXMLHttp() {
		try {
			return new ActiveXObject ("Microsoft.XMLHTTP");
		}catch(e){
			try {
				return new XMLHttpRequest();
			}catch(e) {
				return null;
			}
		}
		return null;
	}
	function createXMLHttpRequest(){
		var XMLhttpObject = null;
		try{
			XMLhttpObject = new XMLHttpRequest();
		}
		catch(e){
			try{
				XMLhttpObject = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e){
				try{
					XMLhttpObject = new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch(e){
					return null;
				}
			}
		}
		return XMLhttpObject;
	}
	iplogsPost();
__javascript_code__
}

print "Pragma: no-cache\n";
print "Cache-Control: no-cache\n";
print "Content-type: text/plain; charset=UTF-8\n\n";
print $js;
exit;
sub _ADDSAVE {
	my($path,$str) = @_;
	chmod 0777,$path;
	flock(FH, LOCK_EX);
		open(FH,">>${path}");
			print FH $str . "\n";
		close(FH);
	flock(FH, LOCK_NB);
	chmod 0600,$path;
}
sub _LOAD {
	my($path) = @_;
	my(@loader) = ();
	flock(FH, LOCK_EX);
		open(FH,$path);
			@loader = <FH>;
		close(FH);
	flock(FH, LOCK_NB);
	$loader = join('',@loader);
	$loader =~ s/\r//ig;
	@loader = split(/\n/,$loader);
	return @loader;
}
sub _SAVE {
	my($path,$str) = @_;
	chmod 0777,$path;
	flock(FH, LOCK_EX);
		open(FH,">${path}");
			print FH $str;
		close(FH);
	flock(FH, LOCK_NB);
	chmod 0600,$path;
}
