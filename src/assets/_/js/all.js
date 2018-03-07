
//  placeholder
/*
$('select').select2({
    minimumResultsForSearch: -1,
    placeholder: function () {
        $(this).data('placeholder');
    }
});*/


// get getCookie
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

// get language
function getlang() {
    var dil_value =getCookie("dil");
    var dil_id;
    if(dil_value === "tr"){
         dil_id = "430";
    } else if(dil_value === "ar") {
         dil_id = "17";
    } else if(dil_value === "it") {
         dil_id = "178";
    } else if(dil_value === "de") {
         dil_id = "137";
    } else if(dil_value === "fa") {
         dil_id = "437";
    } else if(dil_value === "ru") {
         dil_id = "354";
    } else {
         dil_id = "112";
    }
    return dil_id;
}

/// other think will come under here
