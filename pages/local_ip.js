// Set a cookie
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Get a cookie
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// Check if the cookie exists and set it if not
$(document).ready(function () {
    var userCookie = getCookie('user_session');
    if (!userCookie) {
        var newCookieValue = Math.random().toString(36).substring(2);
        setCookie('user_session', newCookieValue, 1); // Cookie expires in 1 day
    }
    $('#deviceIp').val(getCookie('user_session'));
});