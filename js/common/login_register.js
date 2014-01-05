// JavaScript Document


function inputPromptHide(prompt) {
//	alert('focus');
	var input_id = prompt.id.substring(0,prompt.id.indexOf("prompt")-1);
	var input = document.getElementById(input_id);
	
	prompt.style.display = "none";
	input.style.display = "inline";
	input.focus();
}

function inputPromptShow(input) {
//	alert('blur');
	var prompt_id = input.id + "_prompt";
	var prompt = document.getElementById(prompt_id);
	
	if("" == input.value) {
		input.style.display = "none";
		prompt.style.display = "inline";
	}
}