<?php include "loginHeader.php"; ?>
<?php include dirname(__FILE__,2) . "/navbar_top.php"; ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-12 col-md-6">
            <div class="card p-4" style="height:355px">
                <div class="card-body">
                    <form method="post" id="newPasswordForm" action="<?php echo ROOT . "/login/set_new_password";?>" onsubmit="event.preventDefault(); setNewPassword();">
                        <div class="form-data" id="loginFields">
                            <label id="mainName"> Nowe hasło </label>
                            <div class="forms-inputs mb-4"> 
                                <span style="color:<?php if($data['serverError']) echo "rgb(255, 0, 0)"; else echo ""?>" id="passwordSpan">Hasło</span> 
                                <input style="border:<?php if($data['serverError']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>" 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    autocomplete="on"> 
                                <i 
                                    id="blinkingPassword" 
                                    class='bx bxs-error-circle bx-flip-horizontal bx-burst' 
                                    style='color:#de1f1f; <?php if($data['serverError']) echo "display: default;"; else echo "display: none;"?>'>
                                </i>
                            </div>
                            <div class="forms-inputs mb-4"> 
                                <span style="color:<?php if($data['serverError']) echo "rgb(255, 0, 0)"; else echo ""?>" id="repeatPasswordSpan">Potwiedź hasło</span> 
                                <input 
                                    style="border:<?php if($data['serverError']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>" 
                                    type="password" 
                                    name="repeatPassword"     
                                    id="repeatPassword">
                                <i 
                                    id="blinkingRepeatPassword" 
                                    class='bx bxs-error-circle bx-flip-horizontal bx-burst'
                                    style='color:#de1f1f; <?php if($data['serverError']) echo "display: default;"; else echo "display: none;"?>' >
                                </i>
                                <label id="errorPassword"><?=$data['errorPassword']?></label>
                            </div>          
                
                            <div class="mb-2"> <button name="loginButtonSubmit" id="loginButtonSubmit" type="submit" class="btn btn-dark w-100">Zmień hasło</button> </div>
                        </div>
                    </form> 
                    <div> <button class="btn btn-light w-100" onclick="moveToLogin()">Powrót do logowania</button> </div>
                </div> 
            </div>     
        </div>
    </div>
</div>
<?php include dirname(__FILE__,2) . "/footer.php"; ?>