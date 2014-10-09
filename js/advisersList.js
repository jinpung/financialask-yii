$(document).ready(function() {
    $('.avatar-loader').load(function() {
        console.log('loaded');
        $(this).closest('.doctor-result').find('.avatar').css('background-image', 'url(' + $(this).attr('src') + ')');
    });
});
