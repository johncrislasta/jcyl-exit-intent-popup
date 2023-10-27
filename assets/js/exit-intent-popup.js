const $exitIntentPopup = jQuery("#exit_intent_popup");


jQuery(document).mouseleave(function (e) {
    if (e.clientY < 0) {
        // User's mouse is outside the viewport, indicating exit intent
        var hasCookie = getCookie("exit_intent_shown");
        console.log('mouse is leaving! hasCookie?: ', hasCookie);
        if (!hasCookie) {
            $exitIntentPopup.show();
            setCookie("exit_intent_shown", "1", jcyl_eip.cacheClearanceDays);
        }
    }
});


$exitIntentPopup.hide();

jQuery(function($){
    $('.exit_intent_popup__close').click( () => $exitIntentPopup.hide() );
})


// Function to set a cookie
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

// Function to get a cookie
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === " ") {
            c = c.substring(1, c.length);
        }
        if (c.indexOf(nameEQ) === 0) {
            return c.substring(nameEQ.length, c.length);
        }
    }
    return null;
}