$(document).ready(function() {
    AL.bindEvents();
    AL.loadData();

    $('.open-filter-btn').click(function(){
        $('.page_wrapper .doctor-filter').slideToggle();
    });
});

function registerAvatarLoader(){
  $('.doctor-result img.avatar-loader').load(function() {
        $(this).closest('.doctor-result').find('.avatar').css('background-image', 'url(' + $(this).attr('src') + ')');
  });
}

var AL = {
    options: {
        limit: 10,
        offset: 0,
        category: 'suggest'
    },
    bindEvents: function() {
        var _self = this;
        var __stimer;
        $(document).on('keyup', '.search-nav .search-input', function() {
            if ($(this).val() == '') {
                $(this).siblings('.search-x').hide();
            } else {
                $(this).siblings('.search-x').show();
            }
            if ($(this).data('preval') != $(this).val()) {
                clearTimeout(__stimer);
                var th = this;
                __stimer = setTimeout(function() {
                    _self.loadData(true);
                    $(th).data('preval', $(th).val());
                }, 300);
            }
        });
        $(document).on('click', '.search-nav .search-x', function() {
            $(this).siblings('.search-x').val('').data('preval', '');
            clearTimeout(__stimer);
            _self.loadData(true);
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

        $(document).on('click', '.doctor-filter .select-results[data-type] .select-item', function(e) {
            $('.filter-item[data-type=' + $(this).closest('.select-results').data('type') + ']')
                    .trigger('search.select', [$(this).data('value') || $(this).text(), $(this).text()]);
        });

        $(document).on('click', '.filter-item a', function() {
            var filterItem = $(this).closest('.filter-item');
            if (filterItem.hasClass('clickable-select') && filterItem.data('in-edit')) {
                filterItem.trigger('search.out');
            } else {
                filterItem.trigger('search.in');
            }
        });

        $(document).on('click', '.filter-x', function() {
            var filterForm = $(this).closest('[class*="filter-form"]');
            filterForm.siblings('.filter-item[data-type=' + filterForm.data('type') + ']').trigger('search.out');
        });

        $(document).on('click', '.clickable-select .remove-filter-x', function() {
            var filterItem = $(this).closest('.filter-item');
            filterItem.trigger('search.out');
        });

        $(document).on('click', '.doctor-results .more-results', function() {
            $(this).find('.down-arrow').removeClass('down-arrow').addClass('fg-spinner');
            _self.loadData();
        });

        $(document).on('click', '.doctor-filter .filter-btn', function() {
            _self.options.category = 'search';
            $('.doctor-results.suggest-doctors').hide();
            $('.doctor-results.search-results').show();
            _self.fetchQueries(true);
            _self.loadData(true);
        });
    },
    loadData: function(clearAll) {
        var wrapper = this.options.category == 'suggest' ? $('.doctor-results.suggest-doctors') : $('.doctor-results.search-results');
        this.options.offset = clearAll ? 0 : wrapper.find('.doctor-result').length;

        this.fetchQueries();

        $.ajax({
            url: 'getadvisers',
            type: 'get',
            dataType: 'text',
            data: this.options,
            success: function(responseHTML) {
                wrapper.find('.more-results').remove();
                if (clearAll) {
                    wrapper.find('.doctor-result').remove();
                }
            wrapper.append(responseHTML);
            registerAvatarLoader();

            }
        });
    },
    fetchQueries: function(resetFilter) {
        var _self = this;

        this.options.searchword = $('.search-nav .search-input').val();

        if (resetFilter) {
            $('.doctor-filter .filter-item').each(function() {
                var dataType = $(this).data('type');
                delete _self.options[dataType];
                if ($(this).data('value-set')) {
                    if ($(this).hasClass('clickable-input')) {
                        _self.options[dataType] = $(this).siblings('[data-type=' + dataType + ']').find('.filter-input').val();
                    }
                    if ($(this).hasClass('clickable-select')) {
                        _self.options[dataType] = $(this).data('search-value');
                    }
                }
                if ($(this).hasClass('clickable-radio-group') && $(this).find('.fg-radio:checked').length > 0) {
                    _self.options[dataType] = $(this).find('.fg-radio:checked').val();
                }
                if ($(this).hasClass('clickable-checkbox') && $(this).find('.fg-checkbox:checked').length > 0) {
                    _self.options[dataType] = 1;
                }
            });
        }
    }
};
