//mailform pro extension javascript ver3.1.0
function MFP_EX_ONLOAD(obj){
	
}
function MFP_EX_ELEMENT_CHECK(obj){
	
}
function MFP_EX_SUBMIT(obj){
	
}
function MFP_CHECK_EXTENSION(){
	
}

// 3.1.0 update add
var mfp_emendObj = new Object();
mfp_emendObj["digit"] = new Object();
mfp_emendObj["alphabet"] = new Object();
mfp_emendObj["digit_and_alphabet"] = new Object();
mfp_emendObj["email"] = new Object();
mfp_emendObj["telephone"] = new Object();
mfp_emendObj["chars"] = new Object();
//

// text check
// mfp_emendObj["digit"] [ 数字のみ ]
// mfp_emendObj["alphabet"] [ 英語のみ ]
// mfp_emendObj["digit_and_alphabet"] [ 英語と数字のみ(記号含まず) ]
// mfp_emendObj["email"] [ メールアドレスっぽいの ]
// mfp_emendObj["telephone"] [ 電話番号 ]
// mfp_emendObj["chars"] [ 文字数 ]

// 例
mfp_emendObj["digit"]["郵便番号"] = true;
mfp_emendObj["telephone"]["電話番号"] = true;

// 郵便番号の文字数が5文字以上～7文字以下の場合
mfp_emendObj["chars"]["郵便番号"] = /^.{5,7}$/;

// 電話番号の文字数がハイフンを含めて11文字以上～13文字以下の場合
mfp_emendObj["chars"]["電話番号"] = /^.{11,13}$/;
