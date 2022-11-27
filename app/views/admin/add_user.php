<?php
include 'adm_nav.php';
?>
<h1 class="text-muted">Dodawanie użytkownika</h1>
    <hr class="divider ">
<div class="container" style="max-width:720px;">
    
    <form>
        <div class="row m-2">
            <div class="col-12 ">
                <div class="row m-2">
                    <div class="col-6">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="nameInput" name="name" placeholder="Jan">
                            <label for="nameInput">Imię</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="surnameInput" name="surname" placeholder="Jan">
                            <label for="surnameInput">Nazwisko</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="mailInput" name="mail" placeholder="name@example.com">
                            <label for="mailInput" >Adres E-mail</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="loginInput" name="login" placeholder="marik1234">
                            <label for="loginInput" >Login</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-10">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="passInput" name="pass" placeholder="1234">
                            <label for="passInput" >Hasło</label> 
                        </div>
                    </div>
                    <div class="col-auto">
                             <button type="button" class="btn btn-primary btn-lg d-inline " onclick="genPass()"><i class="bi bi-arrow-repeat"></i></button>
                        </div>
                </div>
                <div class="row m-2">
                    <div class="float-end">
                        <button type="submit" class="btn btn-primary btn-lg float-end">Dodaj</button>
                    </div>

            </div>
            </div>
          
    </form>
</div>

<script>
document.getElementById('users_collapse').classList.add('show');
document.getElementById('users_collapse_btn').setAttribute('aria-expanded', 'true');
document.getElementById('users_collapse_btn').setAttribute('style', 'color:white !important');
document.getElementById('addus').setAttribute('style', 'color:white !important');

function genPass(){
    var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var passLength = Math.floor(Math.random() * (14 - 8) ) + 8;
    var pass = "";

    for (var i = 0, n = chars.length; i < passLength; ++i) {
        pass += chars.charAt(Math.floor(Math.random() * n));
    }

    document.getElementById('passInput').setAttribute('value', pass);
}

</script>

<?php include dirname(__FILE__,2) . "/footer.php"; ?>