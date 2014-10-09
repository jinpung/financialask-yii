$(document).ready(function() {
    $(document).on('click', '.profile-wrapper .action-tab', function() {
        $('.profile-wrapper .action-tab').removeClass('active');
        $(this).addClass('active');
        $('.profile-wrapper .tab-content').hide();
        $('.profile-wrapper .tab-content.' + $(this).data('content')).show();
        $(".feed-container").trigger("reloadLayout");
    });

    $('img.avatar-loader').load(function() {
        $('.main-avatar').css('background-image', 'url(' + $(this).attr('src') + ')');
    });
    $(".profile-wrapper .recommend-doc-btn").click(adviserRecommendBtnClick);

    //----fix layout of feedback tab
    $(".feed-container").on("reloadLayout", function() {
        $(this).isotope();
    }).isotope({
            itemSelector: '.feed-item',
            layoutMode: 'masonry'
        });
});
function adviserRecommendBtnClick() {
    $(".recommend-btn").click();
}
