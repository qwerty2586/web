let router = {
    index: "news.php",
    news: "news.php",
    login: "login.php",
    articles: "articles.php",

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

    // if we get xdebug message
    if (result.includes("<br />")) {
        where.html(result);
        return;
    }
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
        $.post(router.login, {username: username, login: login, pass: pass, mail: mail, action: action},
            function (result) {
                if (result === "OK") {
                    showMessage("SUCCESS|Registration was sucessfull");
                    $("#login-username").val(login);
                    $("#login-password").val(pass);
                } else {
                    setTimeout(function () {
                        $("#register").modal("show");
                    }, 500);
                    $("#register-message-container").html("");
                    showMessage(result, $("#register-message-container"));
                }
            });
    });
}

function logout() {
    let action = "logout";
    $.post(router.login, {action: action},
        function (result) {
            if (result === "OK") {
                location.href = router.login;
            } else {
                showMessage(result);
            }
        });
}

function deleteArticle(index) {
    let action = "delete";
    let idarticle = articles[index].idarticle;
    $.post(router.articles, {action: action, idarticle: idarticle},
        function (result) {
            if (result === "OK") {
                location.reload();
            } else {
                showMessage(result);
            }
        });
}

function newArticle() {
    $("#article-modal").modal("show");
    $("#article-save").unbind("click");
    $("#article-save").click(function () {

        let name = $("#article-name").val();
        let action = "upload";
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('name', name);
        fd.append('action', action);
        fd.append('file', files);

        $.ajax({
            url: router.articles,
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result === "OK") {
                    location.reload();
                } else {
                    showMessage(result);
                }
            }
        });
    });
}

function selectReviewersArticle(index) {
    let action = "reviewers";
    let idarticle = articles[index].idarticle;
    let article_name = articles[index].name;
    $("#reviewers-name").val(article_name);
    $("#user1").val('');
    $("#user2").val('');
    $("#user3").val('');
    refresh_reviewers();

    $("#user1").unbind("click");
    $("#user2").unbind("click");
    $("#user3").unbind("click");

    $("#user1").on('click' ,function(){refresh_reviewers()} );
    $("#user2").on('click' ,function(){refresh_reviewers()} );
    $("#user3").on('click' ,function(){refresh_reviewers()} );

    $("#reviewers-modal").modal("show");
    $("#reviewers-save").unbind("click");
    $("#reviewers-save").click(function () {
        let user1 = $("#user1").val();
        let user2 = $("#user2").val();
        let user3 = $("#user3").val();

        $.post(router.articles, {action: action, idarticle: idarticle, user1: user1, user2: user2, user3: user3},
            function (result) {
                if (result === "OK") {
                    location.reload();
                } else {
                    showMessage(result);
                }
            });


    });
    $("#reviewers-save").prop('disabled', true);

}

function refresh_reviewers() {
    // copy array
    let _reviewers = reviewers.slice(0);

    let _backup = $("#user1").val();
    $("#user1").empty();
    _reviewers.forEach( item => {
        $("#user1").append("<option>" + item.trim() + "</option>");
    });
    $("#user1").val(_backup);

    if (_backup && _backup.length > 0) {
        let index = _reviewers.indexOf(_backup);
        if (_backup !== -1 ) _reviewers.splice(index,1)
    }

    _backup = $("#user2").val();
    $("#user2").empty();
    _reviewers.forEach( item => {
        $("#user2").append("<option>" + item.trim() + "</option>");
    });
    $("#user2").val(_backup);

    if (_backup && _backup.length > 0) {
        let index = _reviewers.indexOf(_backup);
        if (_backup !== -1 ) _reviewers.splice(index,1)
    }

    _backup = $("#user3").val();
    $("#user3").empty();
    _reviewers.forEach( item => {
        $("#user3").append("<option>" + item.trim() + "</option>");
    });
    $("#user3").val(_backup);

    if (_backup && _backup.length > 0) {
        let index = _reviewers.indexOf(_backup);
        if (_backup !== -1 ) _reviewers.splice(index,1)
    }

    if ($("#user1").val() && $("#user2").val() && $("#user3").val()) {
        if ($("#user1").val().length > 0 &&
            $("#user2").val().length > 0 &&
            $("#user3").val().length > 0) {
            $("#reviewers-save").prop('disabled', false);
            return
        }
    }
    $("#reviewers-save").prop('disabled', true);

}

function writeReview(idrating) {
    let action = "review";
    $("#review-quality").val(1);
    $("#review-length").val(1);
    $("#review-interesting").val(1);
    $("#review-review").val('');
    $("#review-modal").modal("show");
    $("#review-save").unbind("click");
    $("#review-save").click(function () {
        let quality =  $("#review-quality").val();
        let length =  $("#review-length").val();
        let interesting =  $("#review-interesting").val();
        let review =  $("#review-review").val();

        $.post(router.articles, {action: action, idrating:idrating, quality:quality,length:length,interesting:interesting,review:review},
            function (result) {
                if (result === "OK") {
                    location.reload();
                } else {
                    showMessage(result);
                }
            });


    });
}