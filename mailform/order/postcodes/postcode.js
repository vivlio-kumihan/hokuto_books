// mfp2zip 2.0.0 : 2012-05-31
// 仕様が変わったのでサポート掲示板に記載されてる情報は見ないでネ☆
// 基本的に変更しなくても動きます。
function callbackMFPZip(stat,f,a1,a2,a3,b1,b2,b3){
	var d = window.document;
	var obj = document.forms[f];
	if(stat){
		if(a1 == a2 && a2 == a3)
			obj.elements[a1].value = b1 + b2 + b3
		else if(a1 == a2){
			obj.elements[a1].value = b1 + b2;
			obj.elements[a2].value = b3;
		}
		else if(a2 == a3){
			obj.elements[a1].value = b1;
			obj.elements[a2].value = b2 + b3;
		}
		else {
			obj.elements[a1].value = b1; //都道府県 b1;
			obj.elements[a2].value = b2; //市区町村 b2;
			obj.elements[a3].value = b3; //丁目番地 b3;
		}
		mfpb(obj.elements[a1]);
		mfpb(obj.elements[a2]);
		mfpb(obj.elements[a3]);
	}
}
function mfpc(formId,postcodeELM,a1,a2,a3){
	var d = window.document;
	var obj = document.forms[formId];
	obj.elements[postcodeELM].value = obj.elements[postcodeELM].value.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
		return String.fromCharCode(s.charCodeAt(0) - 65248);
	});
	var border = new Array("-", "－", "ー", "―", "ｰ", "‐");
	for(var i = 0; i < border.length; i++)
		obj.elements[postcodeELM].value = obj.elements[postcodeELM].value.replace(border[i], "");
	if(obj.elements[postcodeELM].value != "" && !(obj.elements[postcodeELM].value.match(/[^0-9]+/))){
		var s = d.createElement("script");
		s.src = d.getElementById('mfp2zip').src + '?zip=' + obj.elements[postcodeELM].value
												+ '&f=' + formId
												+ '&a1=' + encodeURI(a1)
												+ '&a2=' + encodeURI(a2)
												+ '&a3=' + encodeURI(a3);
		d.getElementsByTagName("head")[0].appendChild(s);
	}
	return false;
}