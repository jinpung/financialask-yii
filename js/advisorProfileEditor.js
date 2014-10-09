(function($) {
    $.fn.loading = function() {
        if (this.find('.waitor-membrane').length > 0) {
            return this;
        }
        this.data('preposition', this.css('position'));
        if (this.css('position') == 'static') {
            this.css('position', 'relative');
        }
        this.append('<div class="waitor-membrane"><div class="opacity-bg"></div></div>');
        this.find('.waitor-membrane').fadeIn(200);
        return this;
    }
    $.fn.endloading = function() {
        var container = this;
        this.find('.waitor-membrane').fadeOut(300, function() {
            container.find('.waitor-membrane').remove();
            if (container.data('preposition')) {
                container.css('position', container.data('preposition'));
            }
        });
        return this;
    }
})(jQuery);
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
    
    $(".feed-container").on("reloadLayout", function() {
        $(this).isotope();
    }).isotope({
            itemSelector: '.feed-item',
            layoutMode: 'masonry'
        });
        
    profileeditObj.init();
});

var profileeditObj = {
    init: function() {
        this.initPhptoUPloader();
        this.initBioEvent();
        this.initSpecialize();
        this.initSuburbEvent();
        this.initYearStartPracticeEvent();
        this.initLocatedEvent();
        this.initGenderEvent();
    },
    initPhptoUPloader: function() {
        $("#update_phpto").change(function() {
            if ($(this).val() == "") {
                $(".loading-container").addClass("hidden").hide();
                $("main-avatar").css("background-image", '');
                $("main-avatar").parent().append('<div class="errorMessage">Only images are allowed</div>');
                return true;
            }
            var e = "/profile/changephoto", f = new FormData($("form")[0]);
            $.ajax({
                url: e,
                type: "POST",
                dataType: "JSON",
                data: f,
                mimeType: "multipart/form-data",
                contentType: !1,
                cache: !1,
                processData: !1,
                beforeSend: function() {
                    $(".loading-container").removeClass("hidden").show();
                },
                success: function(data) {
                    $(".main-avatarr").css("background-image", '');
                    $(".loading-container").addClass("hidden").hide();
                    $(".main-avatar").parent().find(".errorMessage").remove();
                    if (data.status == "ok") {
                        $(".optional-overlay").hide();
                        $(".main-avatar").css("background-image", 'url("' + data.filename + '")')
                        //$('.main-avatar').css('background-image', 'url(' + $(this).attr('src') + ')');
                    } else if (data.status == "error") {
                        //$(".main-avatar").parent().append('<div class="errorMessage">Only images are allowed</div>');
                    }
                    return true;
                },
                error: function() {
                    $(".loading-container").addClass("hidden").hide();
                    $(".main-avatar").css("background-image", '');
                    //$(".main-avatar").parent().append('<div class="errorMessage">Error Occured</div>');
                }
            })
        });
    },
    initBioEvent: function() {
        $("#bio_edit_link").click(function() {
            if ($("#bio_edit").hasClass("collapsed")) {
                profileeditObj.initBioEdit();
            }
        });

        $("#bio_cancel").click(function() {
            if ($("#bio_editbox").is(":visible")) {
                profileeditObj.cancelBioEdit();
            }
        });
        $("#bio_text").blur(function(e) {
            if (e.relatedTarget && ($(e.relatedTarget).attr("id") == "bio_cancel" || $(e.relatedTarget).attr("id") == "bio_save")) {
                return true;
            }
            profileeditObj.finishBioEdit();
        })
        $("#bio_save").click(function() {
            profileeditObj.finishBioEdit();
        })

    },
    initBioEdit: function() {
        var text = $("#bio_content").html();
        var text = text.replace(/<br(\/)?>/gi, "\n").trim();
        $("#bio_text").val(text);

        //hide contetn box
        $("#bio_contentbox").hide();
        //show edit box
        $("#bio_editbox").removeClass("hidden");
        $("#bio_editbox").show();
        $("#bio_edit_link").hide();
        $("#bio_text").focus();

    },
    finishBioEdit: function() {
        var text = $("#bio_text").val();
        $("#bio_content").html(text.replace(/\n/ig, "<br/>"));
        //hide edit box
        $("#bio_editbox").addClass("hidden");
        $("#bio_editbox").hide();
        //show contetn box
        $("#bio_contentbox").show();
        $("#bio_edit_link").show();
        this.saveContent([{name: "bio", value: text}]);
    },
    cancelBioEdit: function() {
        //hide edit box
        $("#bio_editbox").addClass("hidden");
        $("#bio_editbox").hide();
        //show contetn box
        $("#bio_contentbox").show();
        $("#bio_edit_link").show();
    },
    saveContent: function(data) {
        
        $.ajax({
            url: "/profile/updateprofile",
            type: "POST",
            dataType: "text",
            data: data,
            beforeSend: function() {
                $(".profile-wrapper").loading();
            },
            success: function(data) {                
                $(".profile-wrapper").endloading();
                return true;
            },
            error: function() {
                
            }
        })
    },
    initSpecialize: function() {
        $.getScript("/components/bootstrap-select-master/js/bootstrap-select.js", function() {
            $('.selectpicker').selectpicker();
        });

        function saveSpecializitem() {
            var data = [];
            $(".specializitem-area").find("[data-type=specializitem]").each(function() {
                data.push($(this).attr("data-id"))
            });
            profileeditObj.saveContent([{name: "specializelist", value: data}]);
        }
        if ($(".specializitem-area .specializitem").length > 0) {
            $(".specializitem-area .no-specialize").hide();
        }
        $(".specializitem-area").on("click", "[data-type='specializitem']", function() {
            $(this).parent().remove();
            if ($(".specializitem-area .specializitem").length == 0) {
                $(".specializitem-area .no-specialize").show();
            }
            saveSpecializitem();
        })

        $("#add-specialism").click(function() {
            var ids = $("#specialist").val();
            $.each(ids, function(key, id) {
                if ($(".specializitem-area [data-id=" + id + "]").length > 0) {
                    return true;
                }
                var text = $("#specialist").children("*[value=" + id + "]").text();
                var html = '<div class="item-list-el specializitem">' + text + '<div class="filter-x" data-type="specializitem" data-id="' + id + '"></div></div>';
                $(".specializitem-area .no-specialize").before(html);
                $(".specializitem-area .no-specialize").hide();
            })
            $("#specialist").val('');
            $('#specialist').selectpicker("render");
            saveSpecializitem();
        });
    },
    initSuburbEvent: function() {
        $("#suburb_edit_link").click(function() {
            profileeditObj.initSuburbEdit();
        });

        $("#suburb_cancel").click(function() {
            if ($("#suburb_editbox").is(":visible")) {
                profileeditObj.cancelSuburbEdit();
            }
        });
        $("#suburb_text").blur(function(e) {
            if (e.relatedTarget && ($(e.relatedTarget).attr("id") == "suburb_cancel" || $(e.relatedTarget).attr("id") == "suburb_save")) {
                return true;
            }
            profileeditObj.finishSuburbEdit();
        });
        $("#suburb_save").click(function() {
            profileeditObj.finishSuburbEdit();
        })
    },
    initSuburbEdit: function() {
        var text = $("#suburb_contentbox").html().trim();
        $("#suburb_text").val(text);
        //hide contetn box
        $("#suburb_contentbox").hide();
        //show edit box
        $("#suburb_editbox").removeClass("hidden");
        $("#suburb_editbox").show();
        $("#suburb_edit_link").hide();
        $("#suburb_text").focus();
    },
    finishSuburbEdit: function() {
        var text = $("#suburb_text").val();
        $("#suburb_contentbox").html(text);
        $("#suburb_editbox").hide();
        $("#suburb_contentbox").show();
        $("#suburb_edit_link").show();
        this.saveContent([{name: "suburb", value: text}]);
    },
    cancelSuburbEdit: function() {
        $("#suburb_editbox").hide();
        $("#suburb_contentbox").show();
        $("#suburb_edit_link").show();
    },
    initYearStartPracticeEvent: function() {
        $("#yearstartpractice_edit_link").click(function() {
            profileeditObj.initYearStartPracticeEdit();
        });

        $("#yearstartpractice_cancel").click(function() {
            if ($("#yearstartpractice_editbox").is(":visible")) {
                profileeditObj.cancelYearStartPracticeEdit();
            }
        });
        $("#yearstartpractice_text").blur(function(e) {
            if (e.relatedTarget && ($(e.relatedTarget).attr("id") == "yearstartpractice_cancel" || $(e.relatedTarget).attr("id") == "yearstartpractice_save")) {
                return true;
            }
            profileeditObj.finishYearStartPracticeEdit();
        });
        $("#yearstartpractice_save").click(function() {
            profileeditObj.finishYearStartPracticeEdit();
        })
    },
    initYearStartPracticeEdit: function() {
        var text = $("#yearstartpractice_contentbox").html().trim();
        $("#yearstartpractice_text").val(text);
        //hide contetn box
        $("#yearstartpractice_contentbox").hide();
        //show edit box
        $("#yearstartpractice_editbox").removeClass("hidden");
        $("#yearstartpractice_editbox").show();
        $("#yearstartpractice_edit_link").hide();
        $("#yearstartpractice_text").focus();
    },
    finishYearStartPracticeEdit: function() {
        var text = $("#yearstartpractice_text").val();
        $("#yearstartpractice_contentbox").html(text);
        $("#yearstartpractice_editbox").hide();
        $("#yearstartpractice_contentbox").show();
        $("#yearstartpractice_edit_link").show();
        this.saveContent([{name: "yearStartPractice", value: text}]);
    },
    cancelYearStartPracticeEdit: function() {
        $("#yearstartpractice_editbox").hide();
        $("#yearstartpractice_contentbox").show();
        $("#yearstartpractice_edit_link").show();
    },
    initLocatedEvent: function() {
        $("#located_edit_link").click(function() {
            profileeditObj.initLocatedEdit();
        });

        $("#located_cancel").click(function() {
            if ($("#located_editbox").is(":visible")) {
                profileeditObj.cancelLocatedEdit();
            }
        });
//        $("#located_text").blur(function(e) {
//            if (e.relatedTarget && ($(e.relatedTarget).attr("id") == "located_cancel" || $(e.relatedTarget).attr("id") == "located_save")) {
//                return true;
//            }
//            profileeditObj.finishLocatedEdit();
//        });
        $("#located_save").click(function() {
            profileeditObj.finishLocatedEdit();
        })
    },
    initLocatedEdit: function() {
        var text = $("#location_address").html().trim();
        $("#location_address_text").val(text);

        var text = $("#postcode").html().trim();
        $("#postcode_text").val(text);

        var text = $("#phonenumber").html().trim();
        $("#phonenumber_text").val(text);
        //hide contetn box
        $("#located_contentbox").hide();
        //show edit box
        $("#located_editbox").removeClass("hidden");
        $("#located_editbox").show();
        $("#located_edit_link").hide();
        $("#located_text").focus();
    },
    finishLocatedEdit: function() {
        var text1 = $("#location_address_text").val();
        $("#location_address").html(text1);

        var text2 = $("#postcode_text").val();
        $("#postcode").html(text2);

        var text3 = $("#phonenumber_text").val();
        $("#phonenumber").html(text3);

        $("#located_editbox").hide();
        $("#located_contentbox").show();
        $("#located_edit_link").show();
        this.saveContent([{name: "address", value: text1}, {name: "postcode", value: text2}, {name: "phone", value: text3}]);
    },
    cancelLocatedEdit: function() {
        $("#located_editbox").hide();
        $("#located_contentbox").show();
        $("#located_edit_link").show();
    },
    initGenderEvent: function() {
        $("[name=gender]").click(function() {
            profileeditObj.saveContent([{name: "gender", value: $(this).val()}]);
        })
    }
}