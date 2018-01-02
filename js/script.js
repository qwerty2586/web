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
            } else {
                showMessage(result);
            }
        });
}

function showMessage(result, where = $("#message-container")) {
    let messages = result.split("\n");
    messages.forEach(function (line) {
        let parts = line.split("|");
        if (parts.length > 1) {
            let level = parts[0];
            let message = parts[1];
            var element = '<div class="alert alert-';
            element = element.concat(level.toLowerCase());
            element = element.concat(' alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
            element = element.concat(message);
            element = element.concat('</div>');
            where.append(element);
        }
    });
}

function register() {
    $("#register-password2-label").html("");
    $("#register").modal("show");
    $("#register-send").unbind("click");
    $("#register-send").click(function () {
        // validations
        if ($("#register-pass1").val() != $("#register-pass2").val()) {
            $("#register-password2-label").html("<font color=\"red\">Dont match</font>");
            setTimeout(function () {
                $("#register").modal("show");
            }, 500);
            return;
        }
        let username = $("#register-username").val();
        let pass = $("#register-pass1").val();
        let login = $("#register-login").val();
        let mail = $("#register-mail").val();
        let action = "register";
        $.post(router.login, {username: username, login: login, pass: pass, mail:mail, action: action},
            function (result) {
                if (result == "OK") {
                    showMessage("SUCCESS|Registration was sucessfull");
                    $("#login-username").val(login);
                    $("#login-password").val(pass);
                } else {
                    setTimeout(function () {
                        $("#register").modal("show");
                    }, 500);
                    showMessage(result,$("#register-message-container"));
                }
            });
    });
}