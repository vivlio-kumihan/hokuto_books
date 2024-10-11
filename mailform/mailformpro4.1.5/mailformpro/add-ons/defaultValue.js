mfp.extend.event('blur',
	function(obj){
		if(obj.value == obj.defaultValue || obj.value == "" && (obj.type == "text" || obj.type == "textarea")){
			obj.value = obj.defaultValue;
			obj.style.color = '#CCC';
		}
	}
);
mfp.extend.event('focus',
	function(obj){
		if(obj.value == obj.defaultValue && (obj.type == "text" || obj.type == "textarea")){
			obj.value = "";
			obj.style.color = '#000';
		}
	}
);
