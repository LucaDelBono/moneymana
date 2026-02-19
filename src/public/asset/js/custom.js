
addEventListener("DOMContentLoaded", (event) => { 

    //timeout flash message
    setTimeout(function() {
        const msg = document.getElementById("flashMessage");
        if(msg) {
            msg.style.transition = "opacity 0.5s ease";
            msg.style.opacity = "0";
            setTimeout(() => msg.remove(), 500);
        }
    }, 3000);

    //registration
    $("#registerForm #submit_btn").prop("disabled", true);

    let passwordConfirmTimeout;
    let passwordValidate = false;
    $("#registerForm #password, #registerForm #password_confirm").on("keyup", function(){
        clearTimeout(passwordConfirmTimeout);

        passwordConfirmTimeout = setTimeout(() => {
            let password = $("#registerForm #password").val();
            let confirm = $("#registerForm #password_confirm").val(); 
            if(password === "" || confirm === ""){
                passwordValidate = false;
                $("#registerForm #password_error").text("");
            }else if(password !== confirm){
                $("#registerForm #password_error").text("La password e la conferma non coincidono!");
                passwordValidate = false;
            }else{
                passwordValidate = true;
                $("#registerForm #password_error").text("");
            }
            validateRegister();
        },350)
    });

    let emailTimeout;
    let emailValidate = false;
    $("#registerForm #email").on("keyup", function () {
        clearTimeout(emailTimeout);

        emailTimeout = setTimeout(function () {
            const email = $("#registerForm #email").val();
            if(email !== ""){
                $.ajax({
                    url: "checkExistEmail",
                    type: "POST",
                    data: { email: email },
                    dataType: "json",
                    success: function (response){
                        if(response === true) {
                        $("#registerForm #email_error").text("Email già presente nel sistema!");
                        emailValidate = false;
                        }else{
                        $("#registerForm #email_error").text("");
                        emailValidate = true;
                        }
                        validateRegister();
                    }
                });
            }else{
                $("#registerForm #email_error").text("");
            }
        }, 350);
    });

    let usernameTimeout;
    let usernameValidate = false;
    $("#registerForm #username").on("keyup", function() {
        clearTimeout(usernameTimeout);

        usernameTimeout = setTimeout(() => {
        const username = $("#registerForm #username").val();
        if(username !== ""){
            $.ajax({
            url: "checkExistUsername",
            type: "POST",
            data: { username:username },
            dataType: "json",
            success: function (response){
                if(response === true){
                $("#registerForm #username_error").text("Nome utente già presente nel sistema!");
                usernameValidate = false;
                }else{
                $("#registerForm #username_error").text("");
                usernameValidate = true;
                }
                validateRegister();
            }
            });
        }else{
            $("#registerForm #username_error").text("");
        }
        }, 350);
    });

    function validateRegister(){
        if(emailValidate && usernameValidate && passwordValidate){
            $("#registerForm #submit_btn").prop("disabled", false);
        } else {
            $("#registerForm #submit_btn").prop("disabled", true);
        }
    }

    //settings
    $("#changePasswordForm #submit_btn").prop("disabled", true);
    let passwordValidateSettings = false;
    $("#changePasswordForm #password, #changePasswordForm #password_confirm, #changePasswordForm #old_password").on("keyup", function(){
        clearTimeout(passwordConfirmTimeout);

        passwordConfirmTimeout = setTimeout(() => {
            let oldPassword = $("#changePasswordForm #old_password").val();
            let password = $("#changePasswordForm #password").val();
            let confirm = $("#changePasswordForm #password_confirm").val(); 
            if(password === "" || confirm === ""){
                passwordValidateSettings = false;
                $("#changePasswordForm #password_error").text("");
            }else if(password !== confirm){
                $("#changePasswordForm #password_error").text("La password e la conferma non coincidono!");
                passwordValidateSettings = false;
            }else{
                passwordValidateSettings = true;
                $("#changePasswordForm #password_error").text("");
            }
            if(passwordValidateSettings && oldPassword != ""){
                $("#changePasswordForm #submit_btn").prop("disabled", false);
            }else{
                $("#changePasswordForm #submit_btn").prop("disabled", true);
            }
        },350)
    });
})
