$(document).ready(function()
{
	if(/Mobi|Android/i.test(navigator.userAgent))
    {
		$('.breadcrumb').css('padding', '0.25rem 1rem');
		$('.category-show').css('overflow', 'hidden');

		$('.flex-container').css("font-size", "0.8rem");
		$('.ile').css("display", "inline").children().css('margin', '0px');

		$('.row_id').hide();

		$('.miniaturka').css('width', '15vw');
		$('.card').removeAttr('style');
	} else {
		$('.dostawa > .card, .dostawa > .card').css('width', '20rem');
	}
});

