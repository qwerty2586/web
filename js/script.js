let router = {
    index: "news.php",
    news: "news.php",
    login: "login.php",

};

function log_in() {
    let login = $("#login-username").val();
    let pass = $("#login-password").val();
    let action = "login";
    $.post(router.login, {login: login, pass: pass, action: action},
        function (result) {
            if (result == "OK") {
                location.href = router.index;
            }
        });
}

function register() {
    $("#register-password2-label").html("");
    $("#register").modal("show");
    $("#register-send").unbind("click");
    $("#register-send").click(function () {
        // validations
        if ($("#register-pass1").val()!=$("#register-pass2").val()) {
            $("#register-password2-label").html("<font color=\"red\">Dont match</font>");
            setTimeout(function() {$("#register").modal("show");},500);
            return;
        }
        let username = $("#register-username").val();
        let pass = $("#register-pass1").val();
        let login = $("#register-login").val();
        let action = "register";
        $.post(router.login, {username: username, login: login, pass: pass, action: action},
            function (result) {
                if (result == "OK") {
                    $("#login-username").val(login);
                    $("#login-password").val(pass);
                }
            });
    });
}