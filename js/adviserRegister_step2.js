$(document).ready(function() {
    $("#adviser-wizard-form").submit(function(e){
       var validflag = true;
       
       $("#RegisterAdviserForm_name").parent().find(".errorMessage").remove();
       if($("#RegisterAdviserForm_name").val() == ""){
            $("#RegisterAdviserForm_name").parent().find(".errorMessage").remove();
            $("#RegisterAdviserForm_name").parent().append('<div class="errorMessage">Full Name cannot be blank.</div>');
            validflag = false;
       }
       
       $("#RegisterAdviserForm_displayname").parent().find(".errorMessage").remove();
       if($("#RegisterAdviserForm_displayname").val() == ""){
            $("#RegisterAdviserForm_displayname").parent().find(".errorMessage").remove();
            $("#RegisterAdviserForm_displayname").parent().append('<div class="errorMessage">Display name cannot be blank.</div>');
            validflag = false;
       }
       
       if(validflag == false){
           e.stopPropagation();
           return false;
       }
    });
    $("#RegisterAdviserForm_file").change(function() {
        if($(this).val() == ""){
            $(".loading-container").addClass("hidden").hide();
            $(".member-avatar").css("background-image", '');
            $(".member-avatar").parent().append('<div class="errorMessage">Only images are allowed</div>');
            return true;
        }
        var e = "/site/imagepreview", f = new FormData($("form")[0]);
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
                $(".member-avatar").css("background-image", '');
                $(".loading-container").addClass("hidden").hide();
                $(".member-avatar").parent().find(".errorMessage").remove();
                if (data.status == "ok") {
                    $(".optional-overlay").hide();
                    $(".member-avatar").css("background-image", 'url("' + data.filename + '")')
                } else if(data.status == "error"){
                    $(".member-avatar").parent().append('<div class="errorMessage">Only images are allowed</div>');
                }
                return true;
            },
            error: function() {
                $(".loading-container").addClass("hidden").hide();
                $(".member-avatar").css("background-image", '');
                $(".member-avatar").parent().append('<div class="errorMessage">Error Occured</div>');
            }
        })
    });
});