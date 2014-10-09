$(function() {
    var temp_rating = 0;
    $('.star_wrap.active .star-half').on({
        mouseenter: function() {
            if (!($(this).parents('.star_wrap').hasClass('active'))) {
                return false;
            }
            if ($(this).hasClass('first')) {
                $(this).parent().attr('class', 'star half-star');
            } else {
                $(this).parent().attr('class', 'star filled-star');
            }
            $(this).parent().prevAll().attr('class', 'star filled-star');
            $(this).parent().nextAll().attr('class', 'star empty-star');
        },
    });
    $('.star_wrap').mouseleave(function() {
        setRating($(this));
    });
    $('.star_wrap.active .star-half').click(function() {
        if (!($(this).parents('.star_wrap').hasClass('active'))) {
            return false;
        }
        var rating = 0;
        if ($(this).hasClass('first')) {
            $(this).parent().attr('class', 'star half-star');
            rating = .5;
        } else {
            $(this).parent().attr('class', 'star filled-star');
            rating = 1;
        }
        rating += $(this).parent().prevAll().length;
        $(this).parent().prevAll().attr('class', 'star filled-star');
        $(this).parent().nextAll().attr('class', 'star empty-star');
        $(this).parent().parent().data('rating', rating);

        $(this).parents(2).next().slideDown();
        $('#notificationBox').hide();
    });

    $('.cancel-btn').click(function() {
        $(this).parents('.feedback-div').prev().data('rating', temp_rating)
        setRating($(this).parents('.feedback-div').prev());
        $(this).parent().parent().slideUp();
    });
    $('.rate-btn').click(function() {
        var rating = $(this).parent().parent().prev().data('rating');
        var responseId = $(this).parent().parent().prev().data('responseid');
        var feedback = $(this).parent().prev().find('.adviser-feedback').val();
        $.ajax({
            url: rateAdviserUrl,
            method: 'POST',
            data: {rating: rating, responseId: responseId, feedback: feedback}
        });

        $(this).parent().parent().slideUp();
        $(this).parent().parent().prev().removeClass('active');
    });

    $('.star_wrap').each(function() {
        setRating($(this));
    });
    $('.star_wrap_large').each(function() {
        setRating($(this));
    });
    function setRating($el) {
        var rating = $el.data('rating');
        var reminder = rating % 1;
        var index = Math.floor(rating);
        $('.star:gt(' + index + ')', $el).attr('class', 'star empty-star');
        $('.star:lt(' + index + ')', $el).attr('class', 'star filled-star');
        $('.star:eq(' + index + ')', $el).attr('class', 'star ' + (reminder ? 'half' : 'empty') + '-star');
    }
});