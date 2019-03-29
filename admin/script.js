$(".option").click(function() {
    var option = $(this).text();

    $(".option").removeClass('active-option');
    $(this).addClass('active-option');

    $.post("page.php", {option: option})
        .done(function (data) {
            $(".main").html(data);
            console.log(data);
        });
})

$(".login-button").click(function() {
    var username = $('#username').val();
    var password = $('#password').val();

    $.post("login.php", {username: username, password: password})
        .done(function (data) {
            if (data != "error") {
                $(".img").css("display", "block");
                $(".login-container").css("margin-top", "-1050px");
                setTimeout(function () {
                    $(".login-container").css("display", "none");
                    $(".nav").css("box-shadow", "0px 20px 64px -27px rgba(0,0,0,1)");
                }, 1200)
                console.log("role: " + data);
            }
        });
});