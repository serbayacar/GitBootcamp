jQuery(window).load(function () {

    "use strict";
    // Page Preloader
    window.setTimeout(function () {
        App.unblockUI();
    }, 100);
});

//-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/ NOTİFİCATİON
function SuccessAlert(message,id) {
    var id_tag = "#"+id+","+"#"+id;
    $(id_tag).show();
    $(id_tag).removeClass("alert alert-info");
    $(id_tag).removeClass("alert alert-danger");
    $(id_tag).removeClass("alert alert-warning");
    $(id_tag).addClass("alert alert-success");
    $(id_tag).html("<strong>Successfull !</strong> " + message);
    $(id_tag).delay(5000).fadeOut(400);
}
function WarningAlert(message,id) {
    var id_tag = "#"+id+","+"#"+id;
    $(id_tag).show();
    $(id_tag).removeClass("alert alert-info");
    $(id_tag).removeClass("alert alert-danger");
    $(id_tag).removeClass("alert alert-success");
    $(id_tag).addClass("alert alert-warning");
    $(id_tag).html("<strong>Be carefully !</strong> " + message);
    $(id_tag).delay(5000).fadeOut(400);
}
function DangerAlert(message,id) {
    var id_tag = "#"+id+","+"#"+id;
    $(id_tag).show();
    $(id_tag).removeClass("alert alert-info");
    $(id_tag).removeClass("alert alert-warning");
    $(id_tag).removeClass("alert alert-success");
    $(id_tag).addClass("alert alert-danger");
    $(id_tag).html("<strong>Error !</strong> " + message);
    $(id_tag).delay(5000).fadeOut(400);
}
function InfoAlert(message,id) {
    var id_tag = "#"+id+","+"#"+id;
    $(id_tag).show();
    $(id_tag).removeClass("alert alert-danger");
    $(id_tag).removeClass("alert alert-warning");
    $(id_tag).removeClass("alert alert-success");
    $(id_tag).addClass("alert alert-info");
    $(id_tag).html("<strong>Info !</strong> " + message);
}

function AlertMessage(message){
    var id_tag = "#"+id+","+"#"+id;
	
    $("#dialog-confirm p").html(message);
    $("#dialog-confirm").dialog({
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: [{
            text: "Tamam",
            click: function () {
                $(this).dialog("close");
            }
        }]
    });
}
