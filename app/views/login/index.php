<?php include "loginHeader.php"; ?>

<?php include dirname(__FILE__,2) . "/navbar_top.php"; ?>


<div class="container mt-5 mb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-12 col-md-6">
            <div class="card p-4" style="height:385px">
                <div class="card-body">
                    <form method="post" id="loginForm" action="<?php echo ROOT . "/login/validate";?>" onsubmit="event.preventDefault(); loginButton();">
                        <div class="form-data" id="loginFields">
                            <label id="mainName"> Logowanie </label>
                            <div class="forms-inputs mb-4"> 
                                <span style="color:<?php if($data['serverError']) echo "rgb(255, 0, 0)"; else echo ""?>" id="emailOrLoginSpan">Email lub login</span> 
                                <input style="border:<?php if($data['serverError']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>" 
                                    type="text" 
                                    name="emailOrLogin" 
                                    id="emailOrLogin" 
                                    autocomplete="on"  
                                    value="<?=$data['emailOrLoginInput']?>"> 
                                <i 
                                    id="blinkingEmailOrLogin" 
                                    class='bx bxs-error-circle bx-flip-horizontal bx-burst' 
                                    style='color:#de1f1f; <?php if($data['serverError']) echo "display: default;"; else echo "display: none;"?>'>
                                </i>
                                <label id="errorEmailOrLogin"></label>
                            </div>
                            <div class="forms-inputs mb-2"> 
                                <span style="color:<?php if($data['serverError']) echo "rgb(255, 0, 0)"; else echo ""?>" id="passwordSpan">Hasło</span> 
                                <input 
                                    style="border:<?php if($data['serverError']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>" 
                                    type="password" 
                                    name="password"     
                                    id="password">
                                <i 
                                    id="blinkingPassword" 
                                    class='bx bxs-error-circle bx-flip-horizontal bx-burst'
                                    style='color:#de1f1f; <?php if($data['serverError']) echo "display: default;"; else echo "display: none;"?>' >
                                </i>
                                <label id="errorPassword"><?=$data['errorPassword']?></label>
                            </div>          
                            <div class="mb-4" style="text-align:right"> <a href="javascript:moveToForgottenPassword()" style="color:black;">Zapomniałem hasła</a> </div>
                
                            <div class="mb-2"> <button name="loginButtonSubmit" id="loginButtonSubmit" type="submit" class="btn btn-dark w-100">Login</button> </div>
                        </div>
                    </form> 
                    <div> <button class="btn btn-light w-100" onclick="moveToRegister()">Załóż konto</button> </div>
                </div> 
            </div>     
        </div>
    </div>
</div>
<?php include dirname(__FILE__,2) . "/footer.php"; ?>