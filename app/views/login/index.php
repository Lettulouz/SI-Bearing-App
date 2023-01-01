<?php include "loginHeader.php"; ?>

<div class="container mt-5 mb-1">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 mb-5">
            <div class="card px-5 py-5 h-100" id="form1">
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
                                onblur="remake(this)" 
                                value="<?=$data['emailOrLoginInput']?>"> 
                            <i 
                                id="blinkingEmailOrLogin" 
                                class='bx bxs-error-circle bx-flip-horizontal bx-burst' 
                                style='color:#de1f1f; <?php if($data['serverError']) echo "display: default;"; else echo "display: none;"?>'>
                            </i>
                            <label id="errorEmailOrLogin"></label>
                        </div>
                        <div class="forms-inputs mb-4"> 
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

             
                        <div class="mb-3"> <button name="loginButtonSubmit" id="loginButtonSubmit" type="submit" class="btn btn-dark w-100">Login</button> </div>
                        <div class="mb-3"> <button class="btn btn-light w-100" onclick="moveToRegister()">Załóż konto</button> </div>
                    </div>
                </form>
                <div style="display: none;" id="successLogin">
                    <div class="text-center d-flex flex-column" > <i class='bx bxs-badge-check'></i> <span class="text-center fs-1">Zalogowano <br> pomyślnie!</span> </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include dirname(__FILE__,2) . "/footer.php"; ?>