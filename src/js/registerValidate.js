$('#registerForm').on("submit", function(e) {
    var valid = true;
    e.preventDefault();

    // check that passwords are the same
    var pass1 = $('#regPass');
    var pass2 = $('#regPassConfirm');
    if (pass1.val().length < 8 || pass1.val() != pass2.val()) {
        valid = false;
    }

    // check the phone field is not empty
    if ($('#regInputPhone').val().length == 0) {
        valid = false;
    }

    // check that email is unique and has been filled
    var email = $('#regInputEmail').val();
    if (email.length == 0) {
        valid = false;
    }
    if (valid) {
        $.post("script/checkEmailUsed.php", {
                email: email
            },
            function(result) {
                if (result) {
                    valid = false;
                } else if (valid) {
                    $.post("script/processRegister.php", $('#registerForm').serialize(), function(error) {
                        // if error occurred
                        if (error == 0) {
                            window.alert('An error has occured.' + error);
                        } else {
                            window.location.href = "frontPage.php";
                        }
                    });
                }
            });
    }

});
