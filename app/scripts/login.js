function setNewPassword(){
    var password = document.getElementById('password').value;
    var repeatPassword = document.getElementById('repeatPassword').value;
    var error = false;

    if(!verifyPassword(password)){
        error = true;
    }

    if(!error) error = comparePasswords(password, repeatPassword);
    console.log(error);
    
    if(!error) document.getElementById("newPasswordForm").submit();
}

/** Function that is being called by button
 * @brief This functions checks if email/login and password are proper
 *
 * @author Dominik
 */
function loginButton() {
    var emailOrLogin = document.getElementById('emailOrLogin').value;
    let result = emailOrLogin.includes("@");
    var loginMethod = "";

    var error = false;
    if(result){
        loginMethod = "email";
        if(!verifyEmail(emailOrLogin)){
            error = true;
        }
    }
    else{
        loginMethod = "login";
        if(!verifyLogin(emailOrLogin)){
            error = true;
        }
    }
    var password = document.getElementById('password').value;

    if(!verifyPassword(password)){
        error = true;
    }

    if(!error){
        document.getElementById("loginForm").submit();
    }
    
}

function comparePasswords(password, repeatPassword){
    if(password==repeatPassword){
        document.getElementById('errorPassword').innerText = ""; 
        document.getElementById('password').style.border = "2px solid rgb(238, 238, 238)";
        document.getElementById('blinkingPassword').style = "display: none";
        document.getElementById('passwordSpan').style.color = "rgb(0, 0, 0)";
        document.getElementById('repeatPassword').style.border = "2px solid rgb(238, 238, 238)";
        document.getElementById('blinkingRepeatPassword').style = "display: none";
        document.getElementById('repeatPasswordSpan').style.color = "rgb(0, 0, 0)";
        return false;
    }else{
        document.getElementById('errorPassword').innerText = "*Hasła nie są identyczne";  
        document.getElementById('password').style.border = "2px solid rgb(255, 0, 0)";
        document.getElementById('blinkingPassword').style = "display: default; color:#de1f1f";
        document.getElementById('passwordSpan').style.color = "rgb(255, 0, 0)";
        document.getElementById('repeatPassword').style.border = "2px solid rgb(255, 0, 0)";
        document.getElementById('blinkingRepeatPassword').style = "display: default; color:#de1f1f";
        document.getElementById('repeatPasswordSpan').style.color = "rgb(255, 0, 0)";
        return true;
    }
}

function setLoginError(){
    document.getElementById('errorEmailOrLogin').innerText = "*Podano błędny login";  
    document.getElementById('emailOrLogin').style.border = "2px solid rgb(255, 0, 0)";
    document.getElementById('blinkingEmailOrLogin').style = "display: default; color:#de1f1f";
    document.getElementById('emailOrLoginSpan').style.color = "rgb(255, 0, 0)";
}

/** Function that validates given login
 * @param {String} login Email to check
 *
 * @brief cond1 checks if domain of email is .pl
 * @brief cond2 checks if domain of email is .com
 * @brief Second if sets values to defaulty if everything is fine
 * s
 * @return Returns boolean, login is fine - true, else - false
 * 
 * @author Dominik
 */
function verifyLogin(login){
    let result = login.toLowerCase();
    document.getElementById('emailOrLogin').value = result;
    login = result;
    
    if(login == "") {  
        document.getElementById('errorEmailOrLogin').innerText = "*Należy uzupelnić email lub login";  
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(255, 0, 0)";
        document.getElementById('blinkingEmailOrLogin').style = "display: default; color:#de1f1f";
        document.getElementById('emailOrLoginSpan').style.color = "rgb(255, 0, 0)";
        return false;  
    }  

    if(login.length < 8) {  
        document.getElementById('errorEmailOrLogin').innerText = "*Login musi mieć długość conajmniej 8 znaków";  
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(255, 0, 0)";
        document.getElementById('blinkingEmailOrLogin').style = "display: default; color:#de1f1f";
        document.getElementById('emailOrLoginSpan').style.color = "rgb(255, 0, 0)";
        return false;  
    }  

    if(login.length > 25) {  
        document.getElementById('errorEmailOrLogin').innerText = "*Login nie może być dłuższy niż 25 znaków";  
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(255, 0, 0)";
        document.getElementById('blinkingEmailOrLogin').style = "display: default; color:#de1f1f";
        document.getElementById('emailOrLoginSpan').style.color = "rgb(255, 0, 0)";
        return false;  
    }  

    let cond1 = checkIfOnlyAcceptedChars(login, 1);
    let cond2 = containsAnyLetters(login);

    if(!cond1){
        document.getElementById('errorEmailOrLogin').innerText = "*Podano znaki różne od liter i cyfr"; 
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(255, 0, 0)";
        document.getElementById('blinkingEmailOrLogin').style = "display: default; color:#de1f1f";
        document.getElementById('emailOrLoginSpan').style.color = "rgb(255, 0, 0)";
        return false;
    }

    if(!cond2){
        document.getElementById('errorEmailOrLogin').innerText = "*Brak liter w loginie"; 
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(255, 0, 0)";
        document.getElementById('blinkingEmailOrLogin').style = "display: default; color:#de1f1f";
        document.getElementById('emailOrLoginSpan').style.color = "rgb(255, 0, 0)";
        return false;
    }

    document.getElementById('errorEmailOrLogin').innerText = ""; 
    document.getElementById('emailOrLogin').style.border = "2px solid rgb(238, 238, 238)";
    document.getElementById('blinkingEmailOrLogin').style = "display: none;";
    document.getElementById('emailOrLoginSpan').style.color = "rgb(0, 0, 0)";
    return true;
    
}

/** Function that validates given email
 * @param {String} email Email to check
 * 
 * @return Returns boolean, email is fine - true, else - false
 * 
 * @author Dominik
 */
function verifyEmail(email){
    let result = email.toLowerCase();
    document.getElementById('emailOrLogin').value = result;
    email = result;
    var regex = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
    if(email.match(regex)){
        document.getElementById('errorEmailOrLogin').innerText = ""; 
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(238, 238, 238)";
        document.getElementById('blinkingEmailOrLogin').style = "display: none";
        document.getElementById('emailOrLoginSpan').style.color = "rgb(0, 0, 0)";
        return true;
    }else{
        document.getElementById('errorEmailOrLogin').innerText = "*Podano błędny email"; 
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(255, 0, 0)";
        document.getElementById('blinkingEmailOrLogin').style = "display: default; color:#de1f1f";
        document.getElementById('emailOrLoginSpan').style.color = "rgb(255, 0, 0)";
        return false;
    }   
}


/** Function that validates given password
 * @param {String} password Password to check
 *
 * @brief First if checks if field is not empty
 * @brief Second if checks if amount of chars is greater or equal to 8
 * @brief Third if checks if amount of chars is not greater than 15
 * @brief Last if sets values to defaulty if everything is fine
 * 
 * @return Returns boolean, password is fine - true, else - false
 * 
 * @author Dominik
 */
function verifyPassword(password) {
    password = password.replace(/\s/g, '');  
    document.getElementById('password').value = password;
    //check empty password field  
    if(password == "") {  
        document.getElementById('errorPassword').innerText = "*Należy uzupelnić hasło";  
        document.getElementById('password').style.border = "2px solid rgb(255, 0, 0)";
        document.getElementById('blinkingPassword').style = "display: default; color:#de1f1f";
        document.getElementById('passwordSpan').style.color = "rgb(255, 0, 0)";
        return false;  
    }  
     
   //minimum password length validation  
    if(password.length < 8) {  
        document.getElementById('errorPassword').innerText = "*Hasło musi mieć długość conajmniej 8 znaków";  
        document.getElementById('password').style.border = "2px solid rgb(255, 0, 0)";
        document.getElementById('blinkingPassword').style = "display: default; color:#de1f1f";
        document.getElementById('passwordSpan').style.color = "rgb(255, 0, 0)";
        return false;  
    }  
    
  //maximum length of password validation  
    if(password.length > 25) {  
        document.getElementById('errorPassword').innerText = "*Hasło nie może być dłuższe niż 25 znaków"; 
        document.getElementById('password').style.border = "2px solid rgb(255, 0, 0)";
        document.getElementById('blinkingPassword').style = "display: default; color:#de1f1f";
        document.getElementById('passwordSpan').style.color = "rgb(255, 0, 0)";
        return false;  
    } 
    document.getElementById('errorPassword').innerText = ""; 
    document.getElementById('password').style.border = "2px solid rgb(238, 238, 238)";
    document.getElementById('blinkingPassword').style = "display: none";
    document.getElementById('passwordSpan').style.color = "rgb(0, 0, 0)";
    return true;
  }  

/** Function that moves to register page
 * @author Dominik
 */
function moveToRegister(){
    var url = window.location.pathname;
    var to = url.indexOf("/public")+6;
    to = to == -1 ? url.length : to + 1;
    var pathName = url.substring(0, to);
    var path = window.location.protocol + "//" + window.location.hostname + pathName + "/register";
    window.location.href = path;
}

/** Function that moves to login page
 * @author Dominik
 */
function moveToLogin(){
    var url = window.location.pathname;
    var to = url.indexOf("/public")+6;
    to = to == -1 ? url.length : to + 1;
    var pathName = url.substring(0, to);
    var path = window.location.protocol + "//" + window.location.hostname + pathName + "/login";
    window.location.href = path;
}

/** Function that moves to forgotten password page
 * @author Dominik
 */
function moveToForgottenPassword(){
    var url = window.location.pathname;
    var to = url.indexOf("/public")+6;
    to = to == -1 ? url.length : to + 1;
    var pathName = url.substring(0, to);
    var path = window.location.protocol + "//" + window.location.hostname + pathName + "/login/forgotten_password";
    window.location.href = path;
}

/** Function that checks if string is build only from some chars
 * @param {String} string String to check
 * @param {int} custom Number used by switch, can filter different chars
 *
 * @brief custom=default -> Lowercase and uppercase letters
 * @brief custom=1 -> Lowercase, uppercase letters and digits 
 * @brief custom=2 -> Lowercase, uppercase letters, digits, '.' and '@' (used for email)
 * 
 * @return Returns boolean, only accepted chars - true, else - false
 * 
 * @author Dominik
 */
function checkIfOnlyAcceptedChars(string, custom){
    switch(custom){
        case 1:
            return /^[A-Za-z0-9]*$/.test(string);
        case 2:
            return /^[A-Za-z0-9@.]*$/.test(string);
        default:
            return /^[A-Za-z]*$/.test(string);
    }  
}

/** Function that count occurrences of a substring in a string
 * @param {String} string               The string
 * @param {String} subString            The sub string to search for
 * @param {Boolean} [allowOverlapping]  Optional. (Default:false)
 *
 * @return Returns number of ocurrences
 * 
 * @author Vitim.us https://gist.github.com/victornpb/7736865
 * @see Unit Test https://jsfiddle.net/Victornpb/5axuh96u/
 * @see https://stackoverflow.com/a/7924240/938822
 */
function occurrences(string, subString, allowOverlapping) {

    string += "";
    subString += "";
    if (subString.length <= 0) return (string.length + 1);

    var n = 0,
        pos = 0,
        step = allowOverlapping ? 1 : subString.length;

    while (true) {
        pos = string.indexOf(subString, pos);
        if (pos >= 0) {
            ++n;
            pos += step;
        } else break;
    }
    return n;
}


/** Function that checks if string contains any letters
 * @param {String} string String to check
 *
 * @return Returns boolean, contains letters - true, else - false
 * 
 * @author Dominik
 */
function containsAnyLetters(string) {
    return /[a-zA-Z]/.test(string);
  }

/*
function remake(e){
    var val = e.value;
    var id = e.id;
    e.outerHTML = e.outerHTML;
    document.getElementById(id).value = val;
    
    return true;
}
*/