<?php include "loginHeader.php"; ?>
<?php include dirname(__FILE__,2) . "/navbar_top.php"; ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card p-4" style="height:280px">
                <div class="card-body">
                    <form method="post" id="loginForm" action="<?php echo ROOT . "/login/forgotten_password";?>">
                        <div class="form-data" id="loginFields">
                            <label id="mainName"> Resetowanie hasła </label>
                            <div class="forms-inputs mb-4"> 
                                <span id="emailSpan">Email</span> 
                                <input 
                                    type="text" 
                                    name="email" 
                                    id="email" 
                                    autocomplete="on"> 
                                <label id="errorEmailOrLogin"></label>
                            </div>         
                
                            <div class="mb-2"> <button name="forgottenPasswordSubmit" id="forgottenPasswordSubmit" type="submit" class="btn btn-dark w-100">Przypomnij hasło</button> </div>
                        </div>
                    </form> 
                    <div> <button class="btn btn-light w-100" onclick="moveToLogin()">Powrót</button> </div>
                </div> 
            </div>     
        </div>
    </div>
</div>
<?php include dirname(__FILE__,2) . "/footer.php"; ?>