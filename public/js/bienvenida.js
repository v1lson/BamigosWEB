if (!document.cookie.includes("visited=true")) {
    window.location.href = "/bienvenida";
    var date = new Date();
    date.setTime(date.getTime() + (100 * 365 * 24 * 60 * 60 * 1000)); // 100 años
    var expires = "expires=" + date.toUTCString();
    document.cookie = "visited=true; " + expires + "; path=/";
}
