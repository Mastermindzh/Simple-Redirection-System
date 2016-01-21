function validateField(fieldId, fieldType, required){
	fieldObj = document.getElementById(fieldId);
	if(fieldType == 'text'){
		if(required == 1 && fieldObj.value == ''){
			fieldObj.setAttribute("class","mainFormError");
			fieldObj.setAttribute("className","mainFormError");
			fieldObj.focus();
			return false;
		}
	}
}
