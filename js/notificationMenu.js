var NOTIFICATION_PING_INTERVAL = 5000;
var NOTIFICARION_CHECK_URL = "/notification/events";
var NOTIFICATION_CONFIRM_URL = "/notification/eventUpdate";

/* To be replaced by Web sockets at a later date */

function notifDismissComplete() {
    $("#notificationBox .eventList").css("bottom", "20px");
    $("#notificationBox .eventList").css("display", "none");
}
function notifClicked() {
    this.clicked = !this.clicked;
    this.TRANS_TIME = 200;
    var CharInitTrans = {
        bottom: "50px",
        opacity: "1"
    };
    var CharInitTransOpts = {
        duration: this.TRANS_TIME,
        ease: "easeOut",
    };
    var CharOutTrans = {
        bottom: "+100px",
        opacity: "0"
    };
    var CharOutTransOpts = {
        duration: this.TRANS_TIME,
        ease: "easeIn",
        complete: notifDismissComplete
    };
    if (this.clicked) {
        $("#notificationBox .eventList").css("display", "block");
        $("#notificationBox .eventList").animate(CharInitTrans, CharInitTransOpts);
    } else
        $("#notificationBox .eventList").animate(CharOutTrans, CharOutTransOpts);

    sendNotificationsRead();
}
function sendNotificationsRead() {
    var eventDivs = $("#notificationBox .eventList .event");
    var eventIDs = [];
    eventDivs.each(function(index) {
        eventIDs.push($(this).attr("evID"))
    });
    if (eventIDs.length > 0)
        $.post(NOTIFICATION_CONFIRM_URL, {'eIDs': eventIDs}, null, 'json').error(function(){return false});
}
function pingServerForEvents() {
    $.post(NOTIFICARION_CHECK_URL, null, pingReceived, 'json');
}
function pingReceived(response) {
    setTimeout('pingServerForEvents()', NOTIFICATION_PING_INTERVAL);
    if ($("#notificationBox .eventList").css("display") == "none")
        $("#notificationBox .eventList .list").html(response.notViews);
    var newIcon = $("#notificationBox .new");
    if (response.notCount != 0) {
        $("#notificationBox").fadeIn();
        newIcon.html(response.notCount);
        newIcon.fadeIn(300);
        $(document).click(function(e){
            if($(e.target).parents("#notificationBox").length == 0 && $(e.target).attr("id") != "notificationBox" && $("#notificationBox .eventList").is(":visible")){                
                $("#notificationBox .eventList").hide();
                $("#notificationBox").fadeOut(300);                
            }
        });
    } else
        newIcon.fadeOut(300);

}

function pageLoadNotification() {
    $("#notificationBox").click(notifClicked);
    pingServerForEvents();
}
$(document).ready(pageLoadNotification);
