function calculateAmount() {
    /*display the result*/
    
    var emailOrLogin = document.getElementById('emailOrLogin').value;
    let result = emailOrLogin.includes("@");
    

    
    var loginMethod;

    if(result){
        loginMethod = "email";
        verifyEmail(emailOrLogin);
    }
    else{
        loginMethod = "login";
    }
    

    var password = document.getElementById('password').value;
    if(verifyPassword(password)){
        document.getElementById('loginFields').style = "display: none;";
        document.getElementById('form1').style.border = "none";
        document.getElementById('successLogin').style = "display: default;";
    }
}



function verifyEmail(email){
    $error = 0;
    let result = email.toLowerCase();
;
    document.getElementById('emailOrLogin').value = result;
    email = result;

    let cond1 = email.includes(".pl");
    let cond2 = email.includes(".com");
    let cond3 = email.charAt(0).includes("@");
    if((!cond1 && !cond2) || cond3){
        $error = 1;
        document.getElementById('errorEmailOrLogin').innerText = "*Nie podano poprawnego maila!"; 
        document.getElementById('emailOrOogin').style.border = "2px solid rgb(255, 0, 0)";
    }
    if($error == 0){
        document.getElementById('errorEmailOrLogin').innerText = ""; 
        document.getElementById('emailOrLogin').style.border = "2px solid rgb(238, 238, 238)";
        return true;
    }

}

function verifyPassword(password) {  
    $error = 0;
    //check empty password field  
    if(password == "") {  
        document.getElementById('errorPassword').innerText = "*Należy uzupelnić hasło!";  
        document.getElementById('password').style.border = "2px solid rgb(255, 0, 0)";
        $error = 1;
        return false;  
    }  
     
   //minimum password length validation  
    if(password.length < 8) {  
        document.getElementById('errorPassword').innerText = "*Hasło musi mieć długość conajmniej 8 znaków!";  
        document.getElementById('password').style.border = "2px solid rgb(255, 0, 0)";
        $error = 1;
        return false;  
    }  
    
  //maximum length of password validation  
    if(password.length > 15) {  
        document.getElementById('errorPassword').innerText = "*Hasło nie może być dłuższe niż 14 znaków!"; 
        document.getElementById('password').style.border = "2px solid rgb(255, 0, 0)";
        $error = 1;
        return false;  
    } 
    if($error == 0){
        document.getElementById('errorPassword').innerText = ""; 
        document.getElementById('password').style.border = "2px solid rgb(238, 238, 238)";
        return true;
    }
  }  