#!/usr/bin/perl
&_GET;
print "Pragma: no-cache\n";
print "Cache-Control: no-cache\n";
print "Content-type: text/plain; charset=UTF-8\n\n";
if($_GET{'zip'} ne $null){
	$path = sprintf("%02d.cgi",substr($_GET{'zip'},0,2));
	if(-f $path){
		@zip = split(/\n/,&_LOAD($path));
		@zip = grep(/\"$_GET{'zip'}\"/,@zip);
		if(@zip > 0){
			$zip[0] =~ s/\"//ig;
			@zip = split(/\,/,$zip[0]);
			print "callbackMFPZip(true,\"$_GET{'f'}\",\"$_GET{'a1'}\",\"$_GET{'a2'}\",\"$_GET{'a3'}\",\"${zip[6]}\",\"${zip[7]}\",\"${zip[8]}\")\n";
		}
	}
}
else {
	print &_LOAD('./postcode.js');
}
exit;
sub _GET {
	$buffer = $ENV{'QUERY_STRING'};
	@pairs = split(/&/, $buffer);
	foreach $pair (@pairs) {
		($name, $value) = split(/=/, $pair);
		$name =~ tr/+/ /;
		$name =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
		$value =~ tr/+/ /;
		$value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
		$_GET{$name} = $value;
	}
}
sub _LOAD {
	my($path) = @_;
	flock(FH, LOCK_EX);
		open(FH,$path);
			@str = <FH>;
		close(FH);
	flock(FH, LOCK_NB);
	$str = join("",@str);
	return $str;
}
