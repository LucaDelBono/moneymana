let passwordConfirmTimeout;

addEventListener("DOMContentLoaded", (event) => { 
    document.getElementById("password_confirm").addEventListener("keyup", function(){
        clearTimeout(passwordConfirmTimeout);

        passwordConfirmTimeout = setTimeout(() => {
            if(document.getElementById("password").value !== document.getElementById("password_confirm").value){
            document.getElementById("password_error").innerText = "La password e la conferma non coincidono!"
            document.getElementById("submit_button").disabled = true;
            }else{
            document.getElementById("password_error").innerText = ""
            document.getElementById("submit_button").disabled = false;
            }
        },350)
    });
})
