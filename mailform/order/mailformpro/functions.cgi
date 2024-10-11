## 2011-04-01 mailform pro Ver.3.0.0 functions file

$about = 'メールフォームの関数用ファイル';

##モード設定 (0:デバッグ / 1:通常)
$config{"mode"} = 1;

##エラーコードの初期設定
$error{"code"} = 0;

##送信者を固定 (0:無効 / 1:固定) ジオシティーズの場合など
$config{'sender_fixed'} = 0;

##連続送信時間制限
$config{'seek'} = 0;

##シンプルメールヘッダ
#$config{'simple_header'} = 1;

## boundary
$config{'boundary'} = "------------boundary_" . time . "_" . $$;

##以下、初期設定項目の自動設定
@mailformENV = ('date','serial','input_time','conversion_count','pv','unique','conversion_rate','http_referer','sitein_referrer','host_name','ip_add','user_agent','confirm_time','iplogs','errorlog');
@mailformENVname = ('POST DATE','SERIAL NUM','INPUT TIME','CONVERSION','PAGE VIEW','UNIQUE USERS','CONVERSION RATE','REFERRER','SITE IN REFERRER','HOST NAME','IP ADDRESS','USER AGENT','CONFIRM TIME','IP Page Traking','ERROR LOG');

($sec,$min,$hour,$day,$mon,$year) = localtime(time);$mon++;$year += 1900;
$form{"date"} = sprintf("%04d-%02d-%02d %02d:%02d:%02d",$year,$mon,$day,$hour,$min,$sec);
$download_file_name = sprintf("%04d-%02d-%02d.csv",$year,$mon,$day,$hour,$min,$sec);

#@construct_utf = ("\xef\xbc\x8d","\xE3\x80\x9C");
@construct_utf = ("－","～");
@construct_jis = ("\x1b\x24B\x21\x5d\x1b\x28J","\x1b\x24B\x21A\x1b\x28J");
@construct_sjis = ("\x81\x7c","\x81\x60");

$ENV{'TZ'} = "JST-9";

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
	return $loader;
}

sub mfp_LoadLine {
	my($path) = @_;
	chmod 0777, $path;
	flock(FH, LOCK_EX);
		open(FH,$path);
			$str = <FH>;
		close(FH);
	flock(FH, LOCK_NB);
	chmod 0600, $path;
	return $str;
}
sub mfp_SaveLine {
	my($path,$str) = @_;
	chmod 0777, "${path}";
	flock(FH, LOCK_EX);
		open(FH,">${path}");
			print FH $str;
		close(FH);
	flock(FH, LOCK_NB);
	chmod 0600, "${path}";
}
sub mfp_SaveAddLine {
	my($path,$str) = @_;
	chmod 0777, "${path}";
	flock(FH, LOCK_EX);
		open(FH,">>${path}");
			print FH $str . "\n";
		close(FH);
	flock(FH, LOCK_NB);
	chmod 0600, "${path}";
}
sub encodeJIS {
	my($str) = @_;
	for(my $cnt=0;$cnt<@construct_utf;$cnt++){
		$str =~ s/$construct_utf[$cnt]/<\_hotfix${cnt}\_>/g;
	}
	Jcode::convert(\$str,'jis');
	$str = &charhotfix_unescape_jis($str);
	return $str;
}
sub encodeSJIS {
	my($str) = @_;
	for(my $cnt=0;$cnt<@construct_utf;$cnt++){
		$str =~ s/$construct_utf[$cnt]/<\_hotfix${cnt}\_>/g;
	}
	Jcode::convert(\$str,'sjis');
	$str = &charhotfix_unescape_sjis($str);
	return $str;
}
sub charhotfix_unescape_jis {
	my($str) = @_;
	for(my $cnt=0;$cnt<@construct_utf;$cnt++){
		$str =~ s/<\_hotfix${cnt}\_>/$construct_jis[$cnt]/g;
	}
	return $str;
}
sub charhotfix_unescape_sjis {
	my($str) = @_;
	for(my $cnt=0;$cnt<@construct_utf;$cnt++){
		$str =~ s/<\_hotfix${cnt}\_>/$construct_sjis[$cnt]/g;
	}
	return $str;
}

sub envMailform {
	$form{'pv'} = $getCookieData{"pv"};
	$form{'unique'} = &mfp_LoadLine($config{"conversion_file"});
	&mfp_SaveLine($config{"input_time_file"},&mfp_LoadLine($config{"input_time_file"}) + $form{'input_time'});
	if($form{'unique'} eq $null || $form{'unique'} < 1){
		$form{'unique'} = 1;
	}
	$form{'conversion_rate'} = $form{'conversion_count'} / $form{'unique'} * 100;
	$form{'conversion_rate'} = round($form{'conversion_rate'}, 3) . '%';
	
	$form{'conversion_count'} = $form{'conversion_count'} . " conversions";
	$form{'unique'} = $form{'unique'} . " users";
	$form{'pv'} = $form{'pv'} . " pageviews";
	$form{'input_time'} = $form{'input_time'} . " sec";
	
	my($ip_address) = $ENV{'REMOTE_ADDR'};
	my(@addr) = split(/\./, $ip_address);
	my($packed_addr) = pack("C4", $addr[0], $addr[1], $addr[2], $addr[3]);
	my($name, $aliases, $addrtype, $length, @addrs);
	($name, $aliases, $addrtype, $length, @addrs) = gethostbyaddr($packed_addr, 2);
	
	$form{'host_name'} = $name;
	$form{'ip_add'} = $ENV{'REMOTE_ADDR'};
	$form{'user_agent'} = $ENV{'HTTP_USER_AGENT'};
	
	for($cnt=0;$cnt<@mailformENV;$cnt++){
		$envs .= "\[ " . $mailformENVname[$cnt] . " \] " . $form{$mailformENV[$cnt]} . "\n";
		push @field, $mailformENVname[$cnt];
		push @csv, $form{$mailformENV[$cnt]};
		$config{"return_body"} =~ s/<${mailformENV[$cnt]}>/$form{$mailformENV[$cnt]}/g;
		$config{"posted_body"} =~ s/<${mailformENV[$cnt]}>/$form{$mailformENV[$cnt]}/g;
		
		if($config{"HTMLMAIL"}){
			$_HTMLMAIL =~ s/<${mailformENV[$cnt]}>/$form{$mailformENV[$cnt]}/g;
		}
		##
		if($config{'SQLserver'}){
			## sanitizing
			$repch = $form{$mailformENV[$cnt]};
			$repch =~ s/\'//ig;
			$repch =~ s/\"//ig;
			$repch =~ s/\\//ig;
			## 
			$SQLexport =~ s/<${mailformENV[$cnt]}>/$repch/g;
		}
		if($config{'CSVexport'}){
			$repch = $form{$mailformENV[$cnt]};
			$repch =~ s/\'//ig;
			$repch =~ s/\"//ig;
			$repch =~ s/\\//ig;
			$CSVexport =~ s/<${mailformENV[$cnt]}>/$repch/g;
		}
	}
	if($config{"log_file"} ne $null && $config{"password"} ne $null){
		$envs .= "\n\n\[ LOG DOWNLOAD \] " . $config{"url"} . "?mode=download" . "\n";
		$envs .= "\[ LOG DELETE \] " . $config{"url"} . "?mode=delete" . "\n";
	}
}
sub expires_check {
	if($config{"error_url"} ne $null){
		if($config{"expires"} ne $null && $config{"expires_break"} ne $null && ($config{"expires_break"} ge $form{"date"} || $form{"date"} ge $config{"expires"})){
			$error_redirect = 1;
		}
		elsif($config{"expires"} ne $null && $form{"date"} ge $config{"expires"}){
			$error_redirect = 1;
		}
		elsif($config{"expires_break"} ne $null && $config{"expires_break"} ge $form{"date"}){
			$error_redirect = 1;
		}
	}
}
sub serials {
	if(-f $config{"serial_file"}){
		$serial = &mfp_LoadLine($config{"serial_file"});
		$form{'conversion_count'} = $serial;
		if($config{"return_subject_serial_date"}){
			($sec,$min,$hour,$day,$mon,$year) = localtime(time);$mon++;$year += 1900;
			$subject_date = sprintf("%04d%02d%02d",$year,$mon,$day);
			$serial_number = sprintf("${subject_date}%04d",$serial);
		}
		else {
			$serial_number = sprintf("%04d",$serial);
		}
		
		if($config{"error_url"} ne $null && $config{"limit"} ne $null && $serial > $config{"limit"}){
			$error_redirect = 1;
		}
		else {
			push @field, "SERIAL";
			push @csv, $serial_number;
			$form{"serial"} = $serial_number;
			$config{"subject"} = "\[" . $serial_number . "\] " . $config{"subject"};
			if($config{"return_subject_serial"} && $config{"return_subject"} ne $null){
				$config{"return_subject"} = "\[" . $serial_number . "\] " . $config{"return_subject"};
			}
			if($config{"thanks_serial"}){
				$config{"thanks_url"} .= "?${serial_number}";
			}
			$serial++;
			&mfp_SaveLine($config{"serial_file"},$serial);
		}
	}
}

sub domaincheck {
	if(index($ENV{'HTTP_REFERER'},$config{"domain"}) > -1 && $config{"domain"} != 0){
		$error{"code"} = 1;
		$error{"info"} .= "指定ドメイン以外から送信されようとしています。 $config{'domain'} / $ENV{'HTTP_REFERER'}<br>\n";
	}
}
sub confcheck {
	if(@mailto < 1){
		$error{"code"} = 2;
		$error{"info"} .= "メールアドレスが正しく設定されていません。<br>\n";
	}
	if($config{"thanks_url"} eq $null){
		$error{"code"} = 2;
		$error{"info"} .= "コンフィグが正しく設定されていません。<br>\n";
	}
}
sub javascript_check {
	if(!$form{"javascript_flag"}){
		$error{"code"} = 5;
		$error{"info"} .= "Javascriptが有効ではありません。<br>\n";
	}
}
sub spamcheck {
	if($config{"english_spam"}){
		$error{"code"} = 3;
		$error{"info"} .= "全ての入力内容が英文で記述されております。<br>\n";
	}
	if($config{"link_spam_count"} && !($config{"link_spam"})){
		$error{"code"} = 4;
		$error{"info"} .= "入力された内容に\[\/URL\]が含まれています。<br>\n";
	}
}
sub getpost {
	if ($ENV{'REQUEST_METHOD'} eq "POST") {
		read(STDIN, $buffer, $ENV{'CONTENT_LENGTH'});
	}
	else {
		$buffer = $ENV{'QUERY_STRING'};
	}
	#$charcode = getcode(\$buffer);
	## vcard
	if($config{"vCard"}){
		$vCard = &_LOAD('vcard.vcf.cgi');
	}
	## export sql
	if($config{'SQLserver'}){
		$SQLexport = &_LOAD('export.sql.cgi');
	}
	##
	
	## export csv
	if($config{'CSVexport'}){
		$CSVexport = &_LOAD($config{'CSVexport'});
	}
	##
	
	## v3.2.0 html mail
	if($config{"HTMLMAIL"}){
		$_HTMLMAIL = &_LOAD('./html.mail.cgi');
	}
	
	@pairs = split(/&/, $buffer);
	@elementsList = ();
	foreach $pair (@pairs) {
		($name, $value) = split(/=/, $pair);
		$name =~ tr/+/ /;
		$name =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
		$value =~ tr/+/ /;
		$value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
		$value =~ s/\\n/\n/g;
		@exception = ('Submit','confirm_email','x','y','must_id','input_time','javascript_flag','http_referer','mailform_confirm_mode','sitein_referrer','confirm_time','paypal_cart','errorlog');
		if($name ne $null && index($name,'[unjoin]') == -1 && (grep(/^${name}$/,@exception)) < 1){
			if($name ne $prevName){
				$crr = "";
				if(index($value,"\n") > -1){
					$crr = "\n";
				}
				if($value ne $null){
					$resbody .= "\n\[ ${name} \]${crr} ${value} ${crr}";
					$config{"body"} .= "\n\[ ${name} \]${crr}${value}${crr}";
				}
				#$config{"return_body"} =~ s/<${name}>/$value/g;
				#$config{"posted_body"} =~ s/<${name}>/$value/g;
				$value =~ s/\,//ig;
				push @field, $name;
				push @csv, $value;
				$repchar{$name} .= $value;
			}
			else{
				$repchar{$name} .= $value;
				$resbody .= " ${value} ";
				$config{"body"} .= " ${value} ";
				$csv[-1] .= " ${value}";
			}
			if(!($value !~ /[\x80-\xff]/)){
				$config{"english_spam"} = 0;
			}
			if($value =~ /\[\/url\]/si){
				$config{"link_spam_count"} = 1;
			}
			if($value =~ /\[\/link\]/si){
				$config{"link_spam_count"} = 1;
			}
			if(index($name,'(必須)') > -1){
				$config{"link_spam_count"} = 1;
			}
			$prevName = $name;
		}
		$form{$name} = $value;
	}
	## email
	$form{'email'} =~ s/ //ig;
	##
	foreach $key(keys(%repchar)){
		$config{"return_body"} =~ s/<${key}>/$repchar{$key}/g;
		$config{"posted_body"} =~ s/<${key}>/$repchar{$key}/g;
		if($config{"vCard"}){
			$vCard =~ s/<${key}>/$repchar{$key}/g;
		}
		## 3.1.3
		if($config{'iCal'}){
			$str = $repchar{$key};
			$str =~ s/\n/\\n/ig;
			$str =~ s/\://ig;
			$str =~ s/\;//ig;
			$config{'iCal.Summary'} =~ s/<${key}>/$str/g;
			$config{'iCal.Description'} =~ s/<${key}>/$str/g;
			$config{'iCal.Date'} =~ s/<${key}>/$str/g;
		}
		##
		if($config{'SQLserver'}){
			## sanitizing
			$repch = $repchar{$key};
			$repch =~ s/\n//ig;
			$repch =~ s/\r//ig;
			$repch =~ s/\'//ig;
			$repch =~ s/\"//ig;
			$repch =~ s/\\//ig;
			## 
			$SQLexport =~ s/<${key}>/$repch/g;
		}
		if($config{'CSVexport'}){
			$repch = $repchar{$key};
			$repch =~ s/\n//ig;
			$repch =~ s/\r//ig;
			$repch =~ s/\'//ig;
			$repch =~ s/\"//ig;
			$repch =~ s/\\//ig;
			$CSVexport =~ s/<${key}>/$repch/g;
		}
		if($config{"HTMLMAIL"}){
			$repch = &_SANITIZING($repchar{$key});
			$_HTMLMAIL =~ s/<${key}>/$repch/g;
		}
	}
	## [ v3.2.0 ] HTML MAIL
	if($config{"HTMLMAIL"}){
		$colorSp = 0;
		for($cnt=0;$cnt<@field;$cnt++){
			if($repchar{${field[$cnt]}} ne $null){
				$className = ' style="background-color: #FFF;"';
				if($colorSp % 2 == 0){
					$className = ' style="background-color: #EDF1F7;"';
				}
				$htmlTable .= "<tr${className}>\n";
				$htmlTable .= "<th valign=\"top\" NOWRAP style=\"padding: 5px 10px;border-top: solid 1px #CCC;text-align: right;\">" . &_SANITIZING(${field[$cnt]}) . "</th>\n";
				$htmlTable .= "<td valign=\"top\" style=\"padding: 5px 10px;border-top: solid 1px #CCC;text-align: left;\">" . &_SANITIZING($repchar{${field[$cnt]}}) . "</td>\n";
				$htmlTable .= "</tr>\n";
				$colorSp++;
			}
		}
		$_HTMLMAIL =~ s/<resbody>/$htmlTable/ig;
		$_HTMLMAIL = &encodeJIS($_HTMLMAIL);
	}
	## 
	
	## IP Traking
	if($config{'iplogs'}){
		@iplogs = split(/\n/,&_LOAD($config{'iplogs'}));
		@iplogs = grep(/\t$ENV{'REMOTE_ADDR'}\t/,@iplogs);
		$form{'iplogs'} = "\n";
		for($cnt=0;$cnt<@iplogs;$cnt++){
			($iptime,$ip,$pages) = split(/\t/,$iplogs[$cnt]);
			if(index($pages,"q=") > -1 || index($pages,"p=") > -1){
				$pages = &decodeURI($pages);
			}
			$form{'iplogs'} .= "${iptime} : ${pages}\n";
		}
		#$config{"return_body"} =~ s/<iplogs>/$iplogs/g;
		#$config{"posted_body"} =~ s/<iplogs>/$iplogs/g;
	}
}
sub _SANITIZING {
	my($str) = @_;
	$str =~ s/\&/&amp;/g;
	$str =~ s/\\/&yen;/g;
	$str =~ s/</&lt;/g;
	$str =~ s/>/&gt;/g;
	$str =~ s/\'/&rsquo;/g;
	$str =~ s/\"/&quot;/g;
	$str =~ s/\,/&#x2c;/g;
	$str =~ s/\t/&nbsp;&nbsp;/g;
	$str =~ s/\r\n/\n/g;
	$str =~ s/\n/<br \/>/g;
	return $str;
}
sub _ICAL {
	$config{'iCal.Date'} =~ s/\///g;
	$config{'iCal.Date'} =~ s/\-//g;
	$config{'iCal.Date'} =~ s/\://g;
	@cal = ($form{'serial'},$config{'iCal.Date'},$config{'iCal.Summary'},$config{'iCal.Description'});
	&mfp_SaveAddLine($config{'iCal.path'},join("\t",@cal));
	@cals = split(/\n/,&_LOAD($config{'iCal.path'}));
	
	$iCal = "BEGIN:VCALENDAR\n";
	$iCal .= "METHOD:PUBLISH\n";
	$iCal .= "VERSION:2.0\n";
	$iCal .= "X-WR-CALNAME:$config{'iCal.Name'}\n";
	$iCal .= "PRODID:-//SYNCKTECHNICA.//Mailformpro 3.1.3//EN\n";
	$iCal .= "X-APPLE-CALENDAR-COLOR:$config{'iCal.BgColor'}\n";
	$iCal .= "X-WR-TIMEZONE:$config{'iCal.TimeZone'}\n";
	$iCal .= "CALSCALE:GREGORIAN\n";
	for(my($cnt)=0;$cnt<@cals;$cnt++){
		($id,$DATE,$SUMMARY,$DESCRIPTION) = split(/\t/,$cals[$cnt]);
		$iCal .= "BEGIN:VEVENT\n";
		$iCal .= "UID:Mailformpro${id}\n";
		$iCal .= "DTSTART;TZID=$config{'iCal.TimeZone'}:${DATE}\n";
		$iCal .= "SUMMARY:${SUMMARY}\n";
		if($DESCRIPTION ne $null){
			$iCal .= "DESCRIPTION:${DESCRIPTION}\n";
		}
		$iCal .= "BEGIN:VALARM\n";
		$iCal .= "TRIGGER:-PT15M\n";
		$iCal .= "ATTACH;VALUE=URI:Basso\n";
		$iCal .= "ACTION:AUDIO\n";
		$iCal .= "END:VALARM\n";
		$iCal .= "END:VEVENT\n";
	}
	$iCal .= "BEGIN:VTIMEZONE\n";
	$iCal .= "TZID:$config{'iCal.TimeZone'}\n";
	$iCal .= "BEGIN:STANDARD\n";
	$iCal .= "DTSTART:19700101T000000\n";
	$iCal .= "TZOFFSETFROM:$config{'iCal.GMT'}\n";
	$iCal .= "TZOFFSETTO:$config{'iCal.GMT'}\n";
	$iCal .= "END:STANDARD\n";
	$iCal .= "END:VTIMEZONE\n";
	$iCal .= "END:VCALENDAR\n";
	chmod 0777, "$config{'iCal.ics.path'}";
	flock(FH, LOCK_EX);
		open(FH,">$config{'iCal.ics.path'}");
			print FH $iCal;
		close(FH);
	flock(FH, LOCK_NB);
	chmod 0644, "$config{'iCal.ics.path'}";

}
sub decodeURI {
	my($str) = @_;
	$str =~ tr/+/ /;
	$str =~ s/%([0-9A-Fa-f][0-9A-Fa-f])/pack('H2', $1)/eg;
	return $str;
}

sub encodeURI {
	my($str) = @_;
	$str =~ s/([^\w ])/'%' . unpack('H2', $1)/eg;
	$str =~ tr/ /+/;
	return $str;
}
sub _SQLexport {
	$db = DBI->connect($config{'SQLserver'}, $config{'SQLuser'}, $config{'SQLpasswd'});
	$db->do('set names utf8');
	$sth = $db->prepare($SQLexport);
	$sth->execute;
	$sth->finish;
	$db->disconnect;
}
sub logfileCreate {
	if($config{"log_file"} ne $null && $config{"password"} ne $null){
		$size = -s $config{"log_file"};
		if($config{'CSVexport'}){
			chmod 0777, $config{"log_file"};
			flock(FH, LOCK_EX);
				open(FH,">>".$config{"log_file"});
					print FH &encodeSJIS($CSVexport) . "\n";
				close(FH);
			flock(FH, LOCK_NB);
			chmod 0600, $config{"log_file"};
		}
		else {
			## double quot escape proccess
			$csv = join("_%%csv%%_",@csv);
			$csv =~ s/\"/\\\"/ig;
			@csv = split(/_%%csv%%_/,$csv);
			##
			if(-f $config{"log_file"} && $size > 0){
				chmod 0777, $config{"log_file"};
				my($put_field) = "\"" . join("\",\"",@csv) . "\"\n";
				$put_field = &encodeSJIS($put_field);
				flock(FH, LOCK_EX);
					open(FH,">>".$config{"log_file"});
						print FH $put_field;
					close(FH);
				flock(FH, LOCK_NB);
				chmod 0600, $config{"log_file"};
			}
			else{
				my($put_field) = "\"" . join("\",\"",@field) . "\"\n";
				$put_field .= "\"".  join("\",\"",@csv) . "\"\n";
				$put_field = &encodeSJIS($put_field);
				flock(FH, LOCK_EX);
					open(FH,">".$config{"log_file"});
						print FH $put_field;
					close(FH);
				flock(FH, LOCK_NB);
				chmod 0600, $config{"log_file"};
			}
		}
	}
}

sub downloadScreen {
	print "Content-type: text/html\n\n";
	print "<html>\n";
	print "\t<head>\n";
	print "\t\t<title>mode::logfile download</title>\n";
	print "\t\t<style type=\"text/css\">\n";
	print "\t\t<!--\n";
	print "\t\t* {\n";
	print "\t\t\tfont-family: \"Arial\", \"Helvetica\", \"sans-serif\";font-size: 12px;\n";
	print "\t\t}\n";
	print "\t\t-->\n";
	print "\t\t</style>\n";
	print "\t</head>\n";
	print "\t<body>\n";
	print "\t\t<h1 style=\"font-size: 21px;color: #232323;\">mode::logfile download</h1>\n";
	print "\t\t<form name=\"getLogs\" action=\"?mode=download\" method=\"POST\">\n";
	print "\t\t\tPASSWORD <input type=\"password\" name=\"password\" style=\"ime-mode: disabled;width: 300px;\"><input type=\"hidden\" name=\"mode\" value=\"download\"><input type=\"hidden\" name=\"config\" value=\"$form{'config'}\"><input type=\"submit\" value=\"GET LOG FILE\">\n";
	print "\t\t</form>$form{'password'}</body></html>\n";
}

sub deleteScreen {
	print "Content-type: text/html\n\n";
	print "<html>\n";
	print "\t<head>\n";
	print "\t\t<title>mode::logfile delete</title>\n";
	print "\t\t<style type=\"text/css\">\n";
	print "\t\t<!--\n";
	print "\t\t* {\n";
	print "\t\t\tfont-family: \"Arial\", \"Helvetica\", \"sans-serif\";font-size: 12px;\n";
	print "\t\t}\n";
	print "\t\t-->\n";
	print "\t\t</style>\n";
	print "\t</head>\n";
	print "\t<body>\n";
	print "\t\t<h1 style=\"font-size: 21px;color: #232323;\">mode::logfile delete</h1>\n";
	print "\t\t<form name=\"getLogs\" action=\"\" method=\"POST\">\n";
	print "\t\t\tPASSWORD <input type=\"password\" name=\"password\" style=\"ime-mode: disabled;width: 300px;\"><input type=\"hidden\" name=\"mode\" value=\"delete\"><input type=\"hidden\" name=\"config\" value=\"$form{'config'}\"><input type=\"submit\" value=\"DELETE LOG FILE\">\n";
	print "\t\t</form>$form{'password'}</body></html>\n";
}

sub deleteComplate {
	unlink $config{"log_file"};
	print "Content-type: text/html\n\n";
	print "<html>\n";
	print "\t<head>\n";
	print "\t\t<title>mode::logfile delete success</title>\n";
	print "\t\t<style type=\"text/css\">\n";
	print "\t\t<!--\n";
	print "\t\t* {\n";
	print "\t\t\tfont-family: \"Arial\", \"Helvetica\", \"sans-serif\";font-size: 12px;\n";
	print "\t\t}\n";
	print "\t\t-->\n";
	print "\t\t</style>\n";
	print "\t</head>\n";
	print "\t<body>\n";
	print "\t\t<h1 style=\"font-size: 21px;color: #232323;\">logfile delete success</h1>\n";
	print "\t\t</body></html>\n";
}

sub fileDownload {
	chmod 0777, $config{"log_file"};
	print "Content-type: application/octet-stream; name=\"${log_file}\"\n";
	print "Content-Disposition: attachment; filename=\"${download_file_name}\"\n\n";
	open(IN,$config{"log_file"});
	print <IN>;
	chmod 0600, $config{"log_file"};
}

sub refresh {
	my($refreshurl) = @_;
	if(index($refreshurl,'http') == -1){
		@uri = split(/\//,$ENV{'SCRIPT_NAME'});
		$uri[-1] = "";
		$uri = join("\/",@uri);
		if(index($ENV{'SERVER_PROTOCOL'},'HTTPS') > -1){
			$refreshurl = 'https://' . $ENV{'SERVER_NAME'} . $uri . $refreshurl;
		}
		else {
			$refreshurl = 'http://' . $ENV{'SERVER_NAME'} . $uri . $refreshurl;
		}
	}
	print "Location: ${refreshurl}\n\n";
}
sub attached_open {
	my(@attached) = @_;
	use MIME::Base64;
	$attached_data = "";
	for(my($cnt)=0;$cnt<@attached;$cnt++){
		$attached_data .= "--$config{'boundary'}\n";
		$attached_data .= "Content-Type: application/octet-stream; name=\"${attached_name[$cnt]}\"\n";
		$attached_data .= "Content-Transfer-Encoding: base64\n";
		$attached_data .= "Content-Disposition: attachment; filename=\"${attached_name[$cnt]}\"\n";
		$attached_data .= "\n";
		$attached_data .= encode_base64($attached[$cnt]) . "\n";
		$attached_data .= "\n";
	}
	if(@htmlmail > 0){
		$attached_data .= "--$config{'boundary'}\n";
		$attached_data .= "Content-Type: text/html; charset=ISO-2022-JP\n";
		$attached_data .= "Content-Transfer-Encoding: Base64\n";
		$attached_data .= "Content-Disposition: inline\n";
		$attached_data .= "\n";
		$attached_data .= encode_base64($_HTMLMAIL) . "\n";
		$attached_data .= "\n";
	}
	return $attached_data;
}
sub sendmail {
	my($mailto,$mailfrom,$fromname,$subject,$body,@attached) = @_;
	$body =~ s/ \n/\n/ig;
	$body =~ s/ \n/\n/ig;
	my($sendmail) = $config{"sendmail"};
	
	$returnmail = 0;
	if($form{'email'} eq $mailto && $config{"HTMLMAIL"}){
		$returnmail = 1;
	}
	
	if($config{'sender_fixed'}){
		$mailfrom = $config{"mailfrom"};
		$fromname = $config{"mailfrom"};
		sleep($config{'seek'});
	}
	
	if($config{'utf8'}){
		$subject = "=?$config{'charset'}?B?" . encode_base64($subject) . '?=';
		$subject =~ s/\n//ig;
		$fromname = "=?$config{'charset'}?B?" . encode_base64($fromname) . '?=' . "<${mailfrom}>";
		$fromname =~ s/\n//ig;
	}
	else {
		$fromname = &encodeJIS($fromname);
		$fromname = Jcode->new($fromname)->mime_encode;
		$fromname = "${fromname} <${mailfrom}>";
		$subject = &encodeJIS($subject);
		$subject = Jcode->new($subject)->mime_encode;
		$body = &encodeJIS($body);
	}
	
	if($config{"mode"}){
		if($config{'SMTPserver'}){
			use Net::SMTP;
			if($config{'POPserver'}){
				use Net::POP3;
				$POP = Net::POP3->new($config{'POPserver'});
				$POP->login($config{'POPuser'},$config{'POPpasswd'});
				$POP->quit;
			}
			($sec,$min,$hour,$mday,$mon,$year,$wday) = localtime(time);
			@week = ('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
			@month = ('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
			$smtpdate = sprintf("%s, %d %s %04d %02d:%02d:%02d +0900 (JST)",$week[$wday],$mday,$month[$mon],$year+1900,$hour,$min,$sec);
			$SMTP = Net::SMTP->new($config{'SMTPserver'}, Hello=>$config{'SMTPserver'});
			$SMTP->mail($mailfrom);
			$SMTP->to($mailto);
			$SMTP->data();
			$SMTP->datasend("Date:${smtpdate}\n");
			if(@attached > 0 || @htmlmail > 0){
				$SMTP->datasend("MIME-Version: 1.0\n");
				if(@htmlmail > 0){
					$SMTP->datasend("Content-Type: multipart/alternative; boundary=$config{'boundary'}\n");
				}
				else {
					$SMTP->datasend("Content-Type: Multipart/Mixed; boundary=\"$config{'boundary'}\"\n");
				}
				$SMTP->datasend("Content-Transfer-Encoding: Base64\n");
				$SMTP->datasend("From: $fromname\n");
				$SMTP->datasend("To: $mailto\n");
				if($config{'bcc'} ne $null && $config{'bcc'} ne $mailto){
					$SMTP->datasend("Bcc: $config{'bcc'}\n");
				}
				$SMTP->datasend("Errors-To: $mailto\n");
				$SMTP->datasend("Subject: $subject\n");
				$SMTP->datasend("--$config{'boundary'}\n");
				$SMTP->datasend("Content-type: text/plain; charset=\"$config{'charset'}\"\n");
				$SMTP->datasend("Content-Transfer-Encoding: 7bit\n");
				$SMTP->datasend("X-Mailer: SYNCK GRAPHICA MAILFORM\n\n");
				$SMTP->datasend("$body\n");
				$SMTP->datasend(&attached_open(@attached));
			}
			else {
				$SMTP->datasend("To: $mailto\n");
				if($config{'bcc'} ne $null && $config{'bcc'} ne $mailto){
					$SMTP->datasend("Bcc: $config{'bcc'}\n");
				}
				$SMTP->datasend("Errors-To: $mailto\n");
				$SMTP->datasend("From: $fromname\n");
				$SMTP->datasend("Subject: $subject\n");
				$SMTP->datasend("MIME-Version: 1.0\n");
				$SMTP->datasend("Content-type: text/plain; charset=\"$config{'charset'}\"\n");
				$SMTP->datasend("Content-Transfer-Encoding: 7bit\n");
				$SMTP->datasend("X-Mailer: SYNCK GRAPHICA MAILFORM\n\n");
				$SMTP->datasend("$body\n");
			}
			$SMTP->dataend();
			$SMTP->quit;
		}
		else {
			if(@attached > 0 || @htmlmail > 0){
				if($config{'simple_header'}){
					open(MAIL,"| $sendmail -t");
						print MAIL "Subject: $subject\n";
						print MAIL "From: $fromname\n";
						if(@htmlmail > 0){
							print MAIL "Content-Type: multipart/alternative; boundary=\"$config{'boundary'}\"\n";
						}
						else {
							print MAIL "Content-Type: Multipart/Mixed; boundary=\"$config{'boundary'}\"\n";
						}
						print MAIL "To: $mailto\n";
						if($config{'bcc'} ne $null && $config{'bcc'} ne $mailto){
							print MAIL "Bcc: $config{'bcc'}\n";
						}
						print MAIL "MIME-Version: 1.0\n";
						print MAIL "--$config{'boundary'}\n";
						print MAIL "Content-Transfer-Encoding: 7bit\n";
						print MAIL "Content-type: text/plain; charset=\"$config{'charset'}\"\n\n";
						print MAIL "$body\n";
						print MAIL &attached_open(@attached);
					close(MAIL);
				}
				else {
					open(MAIL,"| $sendmail -f $mailfrom -t");
						print MAIL "Subject: $subject\n";
						print MAIL "From: $fromname\n";
						if(@htmlmail > 0){
							print MAIL "Content-Type: multipart/alternative; boundary=\"$config{'boundary'}\"\n";
						}
						else {
							print MAIL "Content-Type: Multipart/Mixed; boundary=\"$config{'boundary'}\"\n";
						}
						print MAIL "To: $mailto\n";
						if($config{'bcc'} ne $null && $config{'bcc'} ne $mailto){
							print MAIL "Bcc: $config{'bcc'}\n";
						}
						print MAIL "Errors-To: $mailto\n";
						print MAIL "Content-Transfer-Encoding: 7bit\n\n";
						print MAIL "MIME-Version: 1.0\n";
						print MAIL "--$config{'boundary'}\n";
						print MAIL "Content-Transfer-Encoding: 7bit\n";
						print MAIL "Content-type: text/plain; charset=\"$config{'charset'}\"\n\n";
						print MAIL "$body\n";
						print MAIL &attached_open(@attached);
					close(MAIL);
				}
			}
			else {
				if($config{'simple_header'}){
					open(MAIL,"| $sendmail -t");
						print MAIL "To: $mailto\n";
						if($config{'bcc'} ne $null && $config{'bcc'} ne $mailto){
							print MAIL "Bcc: $config{'bcc'}\n";
						}
						print MAIL "From: $fromname\n";
						print MAIL "Subject: $subject\n";
						print MAIL "Content-Transfer-Encoding: 7bit\n";
						print MAIL "Content-type: text/plain; charset=\"$config{'charset'}\"\n\n";
						print MAIL "$body\n";
					close(MAIL);
				}
				else {
					open(MAIL,"| $sendmail -f $mailfrom -t");
						print MAIL "Subject: $subject\n";
						print MAIL "From: $fromname\n";
						print MAIL "Content-type:text/plain; charset=\"$config{'charset'}\"\n";
						print MAIL "To: $mailto\n";
						if($config{'bcc'} ne $null && $config{'bcc'} ne $mailto){
							print MAIL "Bcc: $config{'bcc'}\n";
						}
						print MAIL "Errors-To: $mailto\n";
						print MAIL "Content-Transfer-Encoding: 7bit\n";
						print MAIL "MIME-Version: 1.0\n\n";
						print MAIL "$body\n";
					close(MAIL);
				}
			}
		}
	}
	else{
		flock(FH, LOCK_EX);
			open(FH,">${mailto}\.eml");
				print FH "To: $mailto\n";
				if($config{'bcc'} ne $null && $config{'bcc'} ne $mailto){
					print FH "Bcc: $config{'bcc'}\n";
				}
				print FH "Errors-To: $mailto\n";
				print FH "From: $fromname\n";
				print FH "Subject: $subject\n";
				print FH "MIME-Version: 1.0\n";
				print FH "Content-type: text/plain; charset=\"$config{'charset'}\"\n";
				print FH "Content-Transfer-Encoding: 7bit\n";
				print FH "X-Mailer: SYNCK GRAPHICA MAILFORM\n\n";
				print FH "$body\n";
			close(FH);
		flock(FH, LOCK_NB);
	}
}
sub GetCookie {
	my($cookie) = $ENV{'HTTP_COOKIE'};
	my(@cookie) = split(/\&/,$cookie);
	my(@cookies) = ();
	for(my($cnt)=0;$cnt<@cookie;$cnt++){
		my($name, $value) = split(/=/,$cookie[$cnt]);
		$cookies{$name} = $value;
	}
	return *cookies;
}
sub round {
	my ($num, $decimals) = @_;
	my ($format, $magic);
	$format = '%.' . $decimals . 'f';
	$magic = ($num > 0) ? 0.5 : -0.5;
	sprintf($format, int(($num * (10 ** $decimals)) + $magic) / (10 ** $decimals));
}
sub debuglog {
	my ($print) = @_;
	flock(FH, LOCK_EX);
		open(FH,">>debug.txt");
			print FH $print;
		close(FH);
	flock(FH, LOCK_NB);
}
sub _PAYPAL_RESPONSE {
	my($buffer) = @_;
	@pairs = split(/&/, $buffer);
	foreach $pair (@pairs) {
		($name, $value) = split(/=/, $pair);
		$name =~ tr/+/ /;
		$name =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
		$value =~ tr/+/ /;
		$value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
		$_PAYPAL_RESPONSE_VALUE{$name} = $value;
		$_PAYPAL_RESPONSE_VAL .= $name . " : " . $value . "\n";
	}
}
