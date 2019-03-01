$('#hinge').click(function() {
    hinge($('.animalIcon'));
  });

  function hinge(thing) {
	$(thing).addClass('animated hinge');
  $(thing).on('animationend mozanimationend webkitAnimationEnd oAnimationEnd msanimationend', function() {
		$(thing).remove();
    // add a new button to restore the images, which were just removed
    
	});
}