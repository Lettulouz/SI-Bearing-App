/** Function that is being called by button
 * @brief This functions checks if email/login and password are proper
 *
 * @author Dominik
 */
function loginButton() {
    const emailOrLogin = document.getElementById('emailOrLogin').value;
    let result = emailOrLogin.includes("@");
    
    const loginMethod = "";

    if(result){
        loginMethod = "email";
        verifyEmail(emailOrLogin);
    }
    else{
        loginMethod = "login";
        verifyLogin(emailOrLogin);
    }
    const password = document.getElementById('password').value;
    if(verifyPassword(password)){
        document.getElementById('loginFields').style = "display: none;";
        document.getElementById('form1').style.border = "none";
        document.getElementById('successLogin').style = "display: default;";
    }
    
}


/** Function that validates given login;
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
    const error = 0;
    let result = login.toLowerCase();
    document.getElementById('emailOrLogin').value = result;
    login = result;
    
    if(login == "") {  
        document.getElementById('errorEmailOrLogin').innerText = "*Należy uzupelnić email lub login";  
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(255, 0, 0)";
        error = 1;
        return false;  
    }  

    let cond1 = checkIfOnlyAcceptedChars(login, 1);
    let cond2 = containsAnyLetters(login);

    if(!cond1){
        error = 1;
        document.getElementById('errorEmailOrLogin').innerText = "*Podano znaki różne od liter i cyfr"; 
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(255, 0, 0)";
        return false;
    }

    if(!cond2){
        error = 1;
        document.getElementById('errorEmailOrLogin').innerText = "*Brak liter w loginie"; 
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(255, 0, 0)";
        return false;
    }

    if(error == 0){
        document.getElementById('errorEmailOrLogin').innerText = ""; 
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(238, 238, 238)";
        return true;
    }
}

/** Function that validates given email;
 * @param {String} email Email to check
 *
 * @brief cond1 checks if domain of email is .pl
 * @brief cond2 checks if domain of email is .com
 * @brief cond3 checks if @ is not first letter
 * @brief cond4 checks if there is only one @ in given email
 * @brief cond5 checks if there are any letter between @ and . of domain
 * @brief cond6 checks if only allowed chars are used
 * @brief Last if sets values to defaulty if everything is fine
 * 
 * @return Returns boolean, email is fine - true, else - false
 * 
 * @author Dominik
 */
function verifyEmail(email){
    const error = 0;
    let result = email.toLowerCase();
    document.getElementById('emailOrLogin').value = result;
    email = result;
    let cond1 = email.includes(".pl"); true
    let cond2 = email.includes(".com"); false
    let cond3 = email.charAt(0).includes("@");
    var cond4 = occurrences(email, "@");
    var cond5 = email.charAt(email.indexOf("@")+1).includes(".");
    var cond6 = checkIfOnlyAcceptedChars(email,2); false
    if((!cond1 && !cond2)){
        error = 1;
        document.getElementById('errorEmailOrLogin').innerText = "*Nie podano prawidłowej domeny"; 
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(255, 0, 0)";
        return false;
    }
    if(cond3){
        error = 1;
        document.getElementById('errorEmailOrLogin').innerText = "*Mail nie może zaczynać się od @"; 
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(255, 0, 0)";
        return false;
    }
    if(cond4>1){
        error = 1;
        document.getElementById('errorEmailOrLogin').innerText = "*Mail nie może składać się z więcej niż jednej  @"; 
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(255, 0, 0)";
        return false;
    }
    if(cond5){
        error = 1;
        document.getElementById('errorEmailOrLogin').innerText = "*Podany mail nie posiada żadnych znaków między @ a ."; 
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(255, 0, 0)";
        return false;
    }
    if(!cond6){
        error = 1;
        document.getElementById('errorEmailOrLogin').innerText = "*Podano znaki różne od liter i cyfr"; 
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(255, 0, 0)";
        return false;
    }
    if(error == 0){
        document.getElementById('errorEmailOrLogin').innerText = ""; 
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(238, 238, 238)";
        return true;
    }

}


/** Function that validates given password;
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
    const error = 0;
    //check empty password field  
    if(password == "") {  
        document.getElementById('errorPassword').innerText = "*Należy uzupelnić hasło";  
        document.getElementById('password').style.border = "2px solid rgb(255, 0, 0)";
        error = 1;
        return false;  
    }  
     
   //minimum password length validation  
    if(password.length < 8) {  
        document.getElementById('errorPassword').innerText = "*Hasło musi mieć długość conajmniej 8 znaków";  
        document.getElementById('password').style.border = "2px solid rgb(255, 0, 0)";
        error = 1;
        return false;  
    }  
    
  //maximum length of password validation  
    if(password.length > 15) {  
        document.getElementById('errorPassword').innerText = "*Hasło nie może być dłuższe niż 14 znaków"; 
        document.getElementById('password').style.border = "2px solid rgb(255, 0, 0)";
        error = 1;
        return false;  
    } 
    if(error == 0){
        document.getElementById('errorPassword').innerText = ""; 
        document.getElementById('password').style.border = "2px solid rgb(238, 238, 238)";
        return true;
    }
  }  

/** Function that checks if string is build only from some chars;
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

/** Function that count occurrences of a substring in a string;
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

    const n = 0,
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