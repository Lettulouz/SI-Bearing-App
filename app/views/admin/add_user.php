<?php
include 'adm_nav.php';
?>
<h1 class="text-muted headers-padding">Dodawanie użytkownika</h1>
    <hr class="divider mt-0">
<div class="container" style="max-width:720px;">
    
    <form autocomplete="off" action="" method="POST">
        <div class="row m-2">
            <div class="col-12 ">
                <div class="row m-2">
                    <div class="col-6">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="nameInput" name="name" value="<?=$data['name'] ?>">
                            <label for="nameInput">Imię</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="surnameInput" name="surname" value="<?=$data['surname'] ?>">
                            <label for="surnameInput">Nazwisko</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="mailInput" name="mail" value="<?=$data['mail'] ?>">
                            <label for="mailInput" >Adres e-mail</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="loginInput" name="login" value="<?=$data['login'] ?>">
                            <label for="loginInput" >Login</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="passInput" name="pass" value="<?=$data['pass'] ?>">
                            <label for="passInput" >Hasło</label> 
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <label class="form-check-label" 
                            style="margin-top: 5px; margin-left: 10px; font-weight: bold; font-size:18px" 
                            for="userActivated">Aktywowany?</label>
                            <input class="form-check-input" style="height:30px; width:60px;" type="checkbox" 
                            id="userActivated" name="userActivated">
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="float-end">
                        <button type="submit" class="btn btn-primary btn-lg float-end" name="senduser">Dodaj</button>
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

</script>

<?php
include 'adm_feet.php';

?>