<?php include "registerHeader.php"; ?>

<div class="container mt-5 mb-1 h-75">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 mb-12">
            <div class="card px-5 py-5 mb-12 h-100" id="form1">
                <form method="post" id="loginForm" action="<?php echo ROOT . "/register/validate";?>" onsubmit="event.preventDefault(); registerButton();">
                    <div class="form-data" id="registerFields">
                    <label id="mainName"> Rejestracja </label>

                    <div class="forms-inputs mb-4"> 
                        <span id="nameSpan">Imię</span> 
                        <input type="text" name="name" id="name" value="<?=$data['nameInput']?>"> 
                        <i id="blinkingName" class='bx bxs-error-circle bx-flip-horizontal bx-burst' style='color:#de1f1f; display: none;' ></i>
                        <label id="errorName"></label>
                    </div>

                    <div class="forms-inputs mb-4"> 
                        <span id="surnameSpan">Nazwisko</span> 
                        <input type="text" name="surname" id="surname" value="<?=$data['surnameInput']?>"> 
                        <i id="blinkingSurname" class='bx bxs-error-circle bx-flip-horizontal bx-burst' style='color:#de1f1f; display: none;' ></i>
                        <label id="errorSurname"></label>
                    </div>

                    <div class="forms-inputs mb-4"> 
                        <span id="loginSpan">Login</span> 
                        <input type="text" name="login" id="login" value="<?=$data['loginInput']?>"> 
                        <i id="blinkingLogin" class='bx bxs-error-circle bx-flip-horizontal bx-burst' style='color:#de1f1f; display: none;' ></i>
                        <label id="errorLogin"><?=$data['errorLogin']?></label>
                    </div>

                    <div class="forms-inputs mb-4"> 
                        <span id="passwordSpan">Hasło</span> 
                        <input type="password" name="password" id="password" value="<?=$data['passwordInput']?>">
                        <i id="blinkingPassword" class='bx bxs-error-circle bx-flip-horizontal bx-burst' style='color:#de1f1f; display: none;' ></i>
                        <label id="errorPassword"><?=$data['errorPassword']?></label>
                    </div>

                    <div class="forms-inputs mb-4"> 
                        <span id="emailSpan">Email</span> 
                        <input type="text" name="email" id="email" value="<?=$data['emailInput']?>"> 
                        <i id="blinkingEmail" class='bx bxs-error-circle bx-flip-horizontal bx-burst' style='color:#de1f1f; display: none;' ></i>
                        <label id="errorEmail"><?=$data['errorEmail']?></label>
                    </div>
                    
                    <div class="mb-3"> <button class="btn btn-dark w-100" type="submit" onclick="registerButton()">Rejestracja</button> </div>
                    <div class="mb-3"> <button class="btn btn-light w-100" onclick="moveToLogin()">Mam już konto</button> </div>

                </div>
                </form>
                <div style="display: none;" id="successRegister">
                    <div class="text-center d-flex flex-column" > <i class='bx bxs-badge-check'></i> <span class="text-center fs-1">Zarejestrowano <br> pomyślnie!</span> </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include dirname(__FILE__,2) . "/footer.php"; ?>