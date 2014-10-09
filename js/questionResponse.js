const RESPONSE_INPUT = ".responseInput";
const BRIEF_INPUT = ".briefInput";
const BUTTON_SUBMIT = ".submitBtn";
const MIN_LENGTH = 20;
function changedInput() {
    var len = $(RESPONSE_INPUT).val().length;
    if (len >= MIN_LENGTH)
        $(BUTTON_SUBMIT).removeAttr('disabled');
    else
        $(BUTTON_SUBMIT).attr('disabled', 'disabled');

}
function onLoad() {
    $(RESPONSE_INPUT).keyup(changedInput);
    changedInput();

    var inputOptions = {
        'maxCharacterSize': 2560,
        'originalStyle': 'textCounter',
        'warningStyle': 'textCounterWarning',
        'warningNumber': 20,
        'displayFormat': '#input/#max'
    };
    $(RESPONSE_INPUT).textareaCount(inputOptions);
    var inputOptionsBrief = {
        'maxCharacterSize': 25,
        'originalStyle': 'textCounter',
        'warningStyle': 'textCounterWarning',
        'warningNumber': 3,
        'displayFormat': '#input/#max'
    };
    $(BRIEF_INPUT).textareaCount(inputOptionsBrief);
    
    
    /*-------------------------*/     

    var slideCount = $('#slider ul li').length;
    var slideWidth = $('#slider ul li').width();
    var slideHeight = $('#slider ul li').height();
    var sliderUlWidth = slideCount * slideWidth;

    $('#slider').css({width: slideWidth, height: slideHeight});

    $('#slider ul').css({width: sliderUlWidth, marginLeft: -slideWidth});

    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: +slideWidth
        }, 200, function() {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    }
    ;

    function moveRight() {
        $('#slider ul').animate({
            left: -slideWidth
        }, 200, function() {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    }
    ;

    $('a.control_prev').click(function() {
        moveLeft();
    });

    $('a.control_next').click(function() {
        moveRight();
    });
//    setInterval(function () {
//        moveRight();
//    }, 3000);
    
    
    $("#add-stock-image").click(function(){
        $('.select-image').hide();
        $("#slider").fadeIn(500);
        $("#contorl-image").hide();        
    })
    $("#change-stock-image").click(function(){
        $('.select-image').hide();
        $("#slider").fadeIn(500);        
        $("#contorl-image").hide();
    });
    $("#cancel-stock-image").click(function(){        
        $("#slider").hide();
        $("#contorl-image").hide();
        $('.select-image').fadeOut(500);        
        $("#QuestionResponse_imgUrl").val();        
        $("#add-stock-image").show();
    });
    $('#slider ul li').click(function(){
        var imagePath = $(this).attr("data");       
        $('.select-image').css('background-image', 'url(' + imagePath + ')');
        $("#QuestionResponse_imgUrl").val(imagePath);
        $("#add-stock-image").hide();
        $("#slider").hide();
        $('.select-image').fadeIn(500);
        $("#contorl-image").show();
    })
    
    /*------------------------------------*/

}


function successResponse(data) {
    $("#response-form").fadeOut(250, function() {
        var newItem = $(data.toInsert);
        newItem.css("display", "none");
        $("#answers").append(newItem);
        if($(".no-answer-item").length>0) $(".no-answer-item").fadeOut(400, function(){newItem.show(400);});
        else newItem.show(400);
    });
}

function successAgree(data, tag) {
    tag.hide(400, function() {
        tag.html(data.toInsert);
        tag.show(400);
    });
}

$(document).ready(onLoad);
