<?php include "registerHeader.php"; ?>

<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 mb-12">
            <div class="card px-5 py-5 mb-12 h-100" id="form1">
                <div class="form-data" id="registerFields">
                <label id="mainName"> Rejestracja </label>

                    <div class="forms-inputs mb-4"> 
                        <span id="nameSpan">Imię</span> 
                        <input type="text" name="name" id="name"> 
                        <i id="blinkingName" class='bx bxs-error-circle bx-flip-horizontal bx-burst' style='color:#de1f1f; display: none;' ></i>
                        <label id="errorName"></label>
                    </div>

                    <div class="forms-inputs mb-4"> 
                        <span id="surrnameSpan">Nazwisko</span> 
                        <input type="text" name="surrname" id="surrname"> 
                        <i id="blinkingSurrname" class='bx bxs-error-circle bx-flip-horizontal bx-burst' style='color:#de1f1f; display: none;' ></i>
                        <label id="errorSurrname"></label>
                    </div>

                    <div class="forms-inputs mb-4"> 
                        <span id="loginSpan">Login</span> 
                        <input type="text" name="login" id="login"> 
                        <i id="blinkingLogin" class='bx bxs-error-circle bx-flip-horizontal bx-burst' style='color:#de1f1f; display: none;' ></i>
                        <label id="errorLogin"></label>
                    </div>

                    <div class="forms-inputs mb-4"> 
                        <span id="passwordSpan">Hasło</span> 
                        <input type="password" name="password" id="password">
                        <i id="blinkingPassword" class='bx bxs-error-circle bx-flip-horizontal bx-burst' style='color:#de1f1f; display: none;' ></i>
                        <label id="errorPassword"></label>
                    </div>

                    <div class="forms-inputs mb-4"> 
                        <span id="emailSpan">Email</span> 
                        <input type="text" name="email" id="email"> 
                        <i id="blinkingEmail" class='bx bxs-error-circle bx-flip-horizontal bx-burst' style='color:#de1f1f; display: none;' ></i>
                        <label id="errorEmail"></labsel>
                    </div>
                    
                    <div class="mb-3"> <button class="btn btn-dark w-100" onclick="registerButton()">Rejestracja</button> </div>

                </div>
                <div style="display: none;" id="successRegister">
                    <div class="text-center d-flex flex-column" > <i class='bx bxs-badge-check'></i> <span class="text-center fs-1">Zarejestrowano <br> pomyślnie!</span> </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include dirname(__FILE__,2) . "/footer.php"; ?>