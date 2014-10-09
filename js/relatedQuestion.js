$(document).ready(function() {
    $(".more").hover(function(e) {
            $(this).parent().find("[name=long-content]").show();
            $(this).parent().find("[name=short-content]").hide();
            $(this).parent().find(".more").hide();
            //$(this).parent().find("[name=long-content]").show();
            e.stopPropagation();
            return false;
        });
        $(".question-item-li").bind("mouseleave", function() {
            $(this).parent().find("[name=short-content]").show();
            $(this).parent().find(".more").show();
            $(this).parent().find("[name=long-content]").hide();
        });
});