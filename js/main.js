$(document).ready(function() {
  setUpReveal();
});

// Handle spacebar and the letter 'k'/'K'
document.onkeypress = function(e) {
	var e = window.event || e;
	var char = e.charCode ? e.charCode : e.keyCode;
	if (char == '32') {  // space
		document.fancyform.submit();
	}
	else if (char == '75' || char == '107') {  // k or K
		reveal();
	}
}

// Show the meaning of the word or phrase
function setUpReveal() {
  var 
    answerContainer = $('.answer-container'),
    starting = $('#XXXX'),
    meaning = $('#meaning');

  answerContainer.on('mouseenter', function() {
    starting.stop(true, true).fadeOut(function() {
      meaning.fadeIn();
    });
  });

  answerContainer.on('mouseleave', function() {
    meaning.stop(true, true).fadeOut(function() {
      starting.fadeIn();
    });
  });
}
