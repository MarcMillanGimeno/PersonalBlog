/**
 * Created by Marc on 13/03/2017.
 */

$(document).ready(function() {
    $("#btnSignUp").click(function(event) {

        var passW = $('#inputPassW').val();
        var passWRepit = $('#inputPasswordRepit').val();
        var nameUser = $('#nameUser').val();
        var eMail = $('#email').val();


        var message = "Password correct";
        var registerState = true;

        if(NomOK(nameUser) == false){
            message = "The name is too short o too long, max. 20characters"
            registerState = false;
        }else {
            if (MailOK(eMail) == false) {
                message = "The email is not valid"
                registerState = false;
            }else{
                if (passW != passWRepit){
                    message = "Passwords not equals";
                    registerState = false;

                } else {
                    /*Password entre 6 y 12 caracteres*/
                    if (passW.length > 12) {
                        registerState = false;
                        message = "The password is too long, it must have maximum 12 characters";
                    } else if (passW.length < 6) {
                        registerState = false;
                        message = "The password is too short, it must have minimum 12 characters (max: 6)";
                    } else {
                        var index = 0;
                        registerState = false;
                        while (index < passW.length){
                            var letter = passW[index];
                            if (isFinite(letter) && !isNaN(parseFloat(letter))) {
                                registerState = true;
                                break;
                            }
                            index++;
                        }

                        if (registerState == false) {
                            message = "The password must have 1 number minimum";
                        } else {
                            var patronMayu = /[A-Z]/g;
                            var numMayu = passW.match(patronMayu);
                            if (numMayu == null) {
                                message = "The password must have one uppercase letter minimum";
                                console.log("passwordds not Mayus");
                                registerState = false;
                            } else {
                                patronMinus = /[a-z]/g;
                                var numMinus = passW.match(patronMinus);
                                if (numMinus == null) {
                                    message = "The password must contain at least one lowercase letter";
                                    registerState = false;
                                }
                            }
                        }
                    }
                }
            }
        }
        if (registerState == false) {
            var check = document.getElementById("insertAlert");

            console.log(check);
            if (check != null) {
                check.remove();
            }

            var container = document.createElement("div");
            container.className = "alert alert-danger";
            container.role = "alert";
            container.id = "insertAlert";


            var textnode = document.createTextNode(message);
            var icon = document.createElement("span");
            icon.className = "glyphicon glyphicon-exclamation-sign";
            var icon2 = document.createElement("span");
            icon2.className = "sr-only";

            container.appendChild(icon);
            container.appendChild(icon2);
            container.appendChild(textnode);

            document.getElementById("messageAlert").appendChild(container);
            event.preventDefault();
        }
    });
});


function NomOK( username){
    if(username.length > 0  && username.length <= 20 ){
        return true;
    }else{
        return false;
    }
}
function MailOK( email ) {
    if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(email)){
        return true;
    } else {
        return false;
    }
}