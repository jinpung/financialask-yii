$(document).ready(function() {
    $(".avatar-loader").load(function() {
        $(this).parent().find(".avatar").css('background-image', 'url(' + $(this).attr('src') + ')');
    });

    $("#talkwithadviser").click(function() {
        window.open("/adviser/talk", "_self");
    });
});