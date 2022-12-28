<?php include "registerHeader.php"; ?>

<div class="container mt-5 mb-1">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 mb-5">
            <div class="card px-5 py-5 mb-12 h-100" id="form1">
                <form method="post" id="registerForm" action="<?php echo ROOT . "/register/validate";?>" onsubmit="event.preventDefault(); registerButton();">
                    <div class="form-data" id="registerFields">
                    <label id="mainName"> Rejestracja </label>

                    <div class="forms-inputs mb-4"> 
                        <span style="color:<?php if($data['errorName']) echo "grb(255, 0, 0)"; else echo""?>" id="nameSpan">Imię</span> 
                        <input style="border:<?php if($data['errorName']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>" 
                        type="text" 
                        name="name" 
                        id="name" 
                        autocomplete="on" 
                        value="<?=$data['nameInput']?>">
                        <i id="blinkingName" class='bx bxs-error-circle bx-flip-horizontal bx-burst' style='color:#de1f1f; <?php if($data['serverError']) echo "display: default;"; else echo "display:none;"?>'></i>
                        <label id="errorName"><?=$data['errorName']?></label>
                    </div>

                    <div class="forms-inputs mb-4"> 
                        <span style="color:<?php if($data['errorSurname']) echo "grb(255, 0, 0)"; else echo""?>" id="surnameSpan">Nazwisko</span> 
                        <input style="border:<?php if($data['errorSurname']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>" type="text" name="surname" id="surname" value="<?=$data['surnameInput']?>"> 
                        <i id="blinkingSurname" class='bx bxs-error-circle bx-flip-horizontal bx-burst' style='color:#de1f1f; <?php if($data['serverError']) echo "display: default;"; else echo "display:none;"?>'></i>
                        <label id="errorSurname"><?=$data['errorSurname']?></label>
                    </div>

                    <div class="forms-inputs mb-4"> 
                        <span style="color:<?php if($data['errorLogin']) echo "grb(255, 0, 0)"; else echo""?>" id="loginSpan">Login</span> 
                        <input style="border:<?php if($data['errorLogin']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>" type="text" name="login" id="login" value="<?=$data['loginInput']?>"> 
                        <i id="blinkingLogin" class='bx bxs-error-circle bx-flip-horizontal bx-burst' style='color:#de1f1f; <?php if($data['serverError']) echo "display: default;"; else echo "display:none;"?>'></i>
                        <label id="errorLogin"><?=$data['errorLogin']?></label>
                    </div>

                    <div class="forms-inputs mb-4"> 
                        <span style="color:<?php if($data['errorPassword']) echo "grb(255, 0, 0)"; else echo""?>" id="passwordSpan">Hasło</span> 
                        <input style="border:<?php if($data['errorPassword']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>" type="password" name="password" id="password" value="<?=$data['passwordInput']?>">
                        <i id="blinkingPassword" class='bx bxs-error-circle bx-flip-horizontal bx-burst' style='color:#de1f1f; <?php if($data['serverError']) echo "display: default;"; else echo "display:none;"?>'></i>
                        <label id="errorPassword"><?=$data['errorPassword']?></label>
                    </div>

                    <div class="forms-inputs mb-4"> 
                        <span style="color:<?php if($data['errorEmail']) echo "grb(255, 0, 0)"; else echo""?>" id="emailSpan">Email</span> 
                        <input style="border:<?php if($data['errorEmail']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>" type="text" name="email" id="email" value="<?=$data['emailInput']?>"> 
                        <i id="blinkingEmail" class='bx bxs-error-circle bx-flip-horizontal bx-burst' style='color:#de1f1f; <?php if($data['serverError']) echo "display: default;"; else echo "display:none;"?>'></i>
                        <label id="errorEmail"><?=$data['errorEmail']?></label>
                    </div>

                    <div class="mb-3"> <button class="btn btn-dark w-100" name="registerSubmit" type="submit">Rejestracja</button> </div>
                    <div class="mb-3"> <button class="btn btn-light w-100" onclick="moveToLogin()">Mam już konto</button> </div>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include dirname(__FILE__,2) . "/footer.php"; ?>