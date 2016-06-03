(function ($) {

    $(window).load(function () {

	    var formStep = document.getElementsByClassName('gf_step_number');
	    var stepWord = ['Step One:', 'Step Two:', 'Step Three:'];

	    if (formStep.length >= 1) {
	        for (var i = 0; i < formStep.length; i++) {
	            formStep[i].textContent = stepWord[i];
	        }
	    }

    });  

})();

$(document).ready(function() {

	//if the submit button is clicked
	$('#submit').click(function(event){

		/*
		if user selects Not Listed then refreshes page, I want to make sure
		submit button is disabled and message shows.
		*/
		if($('#NotListed').is(':checked')) {
			$('#note').show(300);
			$('input[type=submit]').hide();
			event.preventDefault();
		};

		//if radio is checked, but user didn't fill out group code.
		if($('#groupRes').is(':checked')) {

			if($('input[name=groupCode]').val() == '') {
				$('input[name=groupCode]').addClass('highlight')
				return false;
		 	}

			if($('input[name=groupCode]').val().toUpperCase() == 'AUA12' || $('input[name=groupCode]').val().toUpperCase() == 'AMG2A' || $('input[name=groupCode]').val().toUpperCase() == 'OIT2A' || $('input[name=groupCode]').val().toUpperCase() == 'ctp2b' || $('input[name=groupCode]').val().toUpperCase() == 'AND12' || $('input[name=groupCode]').val().toUpperCase() == 'YLU2A' || $('input[name=groupCode]').val().toUpperCase() == 'CTA2P' || $('input[name=groupCode]').val().toUpperCase() == 'LEF2A' || $('input[name=groupCode]').val().toUpperCase() == 'MIM2A' || $('input[name=groupCode]').val().toUpperCase() == 'CUC2A' || $('input[name=groupCode]').val().toUpperCase() == 'GSA3B' || $('input[name=groupCode]').val().toUpperCase() == 'ISR1A' || $('input[name=groupCode]').val().toUpperCase() == 'NIH3X' || $('input[name=groupCode]').val().toUpperCase() == 'SBA3V' || $('input[name=groupCode]').val().toUpperCase() == 'TSA4A' || $('input[name=groupCode]').val().toUpperCase() == 'EBS14'

			|| $('input[name=groupCode]').val().toUpperCase() == 'AIS16'
			|| $('input[name=groupCode]').val().toUpperCase() == 'CGP16'
			|| $('input[name=groupCode]').val().toUpperCase() == 'LEP16'
			|| $('input[name=groupCode]').val().toUpperCase() == 'LIB6A') {
			}
			else{
				$('input[name=groupCode]').addClass('highlight')
				return false;
			}
		 }
	});

	//if the user clicks inside text box, I remove the highlight class
	$('input[name=groupCode]').focus( function() {
  		$(this).removeClass('highlight');
	});

	// hides affiliation note on page load
	$('#note').hide();

	$('.myRadio').click(function(){
		$('#note').hide(300);
		$('#submit').show();
		$('input[name=groupCode]').removeClass('highlight')
	});

	// show affiliation note on click; hide for others
	$('#NotListed').click(function(){
		$('#note').show(300);
		$('input[type=submit]').hide();
		$('input[name=GroupCode]').removeClass('highlight')
		});
});



