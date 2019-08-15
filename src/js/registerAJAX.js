// checks if email is available
// form eventlistener
$('#regInputEmail').on("change", function(e) {
    $("#emailAvailable").addClass("d-none");
    $("#emailAlert").addClass("d-none");
    if ($("#regInputEmail").val().length == 0) {
        return;
    }
    var email = $('#regInputEmail').val();
    $.post("script/checkEmailUsed.php", {
            email: email
        },
        function(result) {
            if (result) {
                $("#emailAlert").removeClass("d-none");
            } else {
                $("#emailAvailable").removeClass("d-none");
            }
        });
});

// checks that passwords are the same
$('#regPass, #regPassConfirm').on("change keyup", function(e) {
    var pass1 = $('#regPass');
    var pass2 = $('#regPassConfirm');
    $('#passAlert').addClass("d-none");

    if (pass1.val() != pass2.val()) {
        $('#passAlert').removeClass("d-none");
    }
    if (pass1.val().length < 8 && pass1.val().length > 0) {
        $('#passAlert').removeClass("d-none");
    }
});
