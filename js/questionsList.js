$(document).ready(function() {
    funcObj.initEvent();
    $(".adviser-photo-img").load(function() {
        $(this).parent().find('.avatar-photo').css('background-image', 'url(' + $(this).attr('src') + ')');
    });
});

var funcObj = {
    initEvent: function() {
        var searchStr = $(".search-nav .search-input").val();
        if (searchStr != "") {
            $(".search-nav .search-input").siblings('.search-x').show();
        }
        $(document).on('keyup', '.search-nav .search-input', function(e) {
            if ($(this).val() == '') {
                $(this).siblings('.search-x').hide();
            } else {
                $(this).siblings('.search-x').show();
            }
            if (e.keyCode == 13) {
                funcObj.loadData($(this).val());
            }
        });
        $(document).on('click', '.search-nav .search-x', function() {
            if (searchStr != "") {
                funcObj.loadData('');
            } else {
                $(this).hide().siblings('.search-input').val('').data('preval', '');
            }
        });

        $(document).on('search.in', '.filter-item', function() {
            var dataType = $(this).data('type');
            if ($(this).hasClass('clickable-input')) {
                $(this).hide();
                $(this).siblings('[data-type=' + dataType + ']').show();
                $(this).siblings('[data-type=' + dataType + ']').find('.filter-input').focus();
                $(this).data('value-set', true);
            }
            if ($(this).hasClass('clickable-select')) {
                $(this).siblings('[data-type=' + dataType + ']').slideDown();
            }
            $(this).data('in-edit', true);
        });

        $(document).on('search.out', '.filter-item', function() {
            var dataType = $(this).data('type');
            if ($(this).hasClass('clickable-input')) {
                $(this).show();
                $(this).siblings('[data-type=' + dataType + ']').hide();
            }
            if ($(this).hasClass('clickable-select')) {
                $(this).siblings('[data-type=' + dataType + ']').slideUp();
                $(this).find('.filter-label').show();
                $(this).find('.filter-value').hide();
                $(this).find('.remove-filter-x').hide();
            }
            $(this).data('in-edit', false)
                    .data('value-set', false);
        });

        $(document).on('search.select', '.filter-item.clickable-select', function(e, val, text) {
            $(this).find('.filter-label').hide();
            $(this).find('.filter-value').text(text).show();
            $(this).data('search-value', val);
            $(this).find('.remove-filter-x').show();
            $(this).siblings('[data-type=' + $(this).data('type') + ']').slideUp();
            $(this).data('in-edit', false)
                    .data('value-set', true);
        });
        $(document).on('click', '.show-more a', function() {
            var offset = $(this).data('offset');
            var totalCount = parseInt($('.total-count').text());
            var searchStr = $('.search-input').val();
            $.ajax({
                url: getQuestionsUrl,
                data: {
                    offset: offset,
                    ajax: 1,
                    totalCount: totalCount,
                    str: searchStr
                },
                success: function(data) {
                    var $questionHtml = $('.questions div.answer-item',$(data));
                    $('.show-more').remove();
                    $('.questions .answer-item:last').after($('<div />').html($questionHtml).html());
                }
            });
            return false;
        })
    },
    loadData: function(str) {
        var serchUrl = $(".search-nav .search-input").attr("search_url");
        window.open(serchUrl + "/?str=" + str, "_self");
    }
}