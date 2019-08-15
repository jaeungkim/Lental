// form eventlistener
$('#loginForm').on("submit", function(e) {
    e.preventDefault();
    $("#loginError").addClass("d-none");
    var email = $('[name=email]').val();
    var password = $("[name=password]").val();
    $.post("script/processLogin.php", {
            email: email,
            password: password
        },
        function(result) {
            if (result == 0) {
                $("#loginError").removeClass("d-none");
            }
            else {
                location.reload();
            }
        });
});
