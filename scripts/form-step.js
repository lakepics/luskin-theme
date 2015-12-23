// JavaScript Document

var formStep = document.getElementsByClassName('gf_step_number');
var stepWord = ['Step One:', 'Step Two:', 'Step Three:'];

if (formStep.length >= 1) {
	for (var i=0; i<formStep.length; i++) {
		formStep[i].textContent = stepWord[i];
	}
}