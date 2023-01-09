<?php
include 'adm_nav.php';
?>
<script type="text/javascript" src="<?=APPPATH?>/scripts/usersAdm.js"></script>
<h1 class="text-muted headers-padding">Dodawanie managera</h1> 
    <hr class="divider mt-0">
<div class="container" style="max-width:720px;">
    
    <form autocomplete="off" action="" method="POST" id="registerForm" onsubmit="event.preventDefault(); registerButton();">
        <div class="row m-2">
            <div class="col-12 ">
                <div class="row m-2">

                    <div class="col-6">
                        <div class="forms-inputs"> 
                            <div class="form-floating "> 
                                <input type="text" class="form-control" id="name" name="name" placeholder="a"
                                style="border:<?php if($data['errorName']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>"
                                 value="<?=$data['name']?>" required>
                                <label for="name" id="nameSpan" 
                                style="color:<?php if($data['errorName']) echo "rgb(255, 0, 0)"; else echo""?>"
                                >Imię</label>
                            </div>
                            <label id="errorName"  class='errorLabel'><?=$data['errorName']?></label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="forms-inputs"> 
                            <div class="form-floating ">
                                <input type="text" class="form-control" id="surname" name="surname" placeholder="a" value="<?=$data['surname'] ?>"
                                style="border:<?php if($data['errorSurname']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>"
                                required>
                                <label for="surname" id="surnameSpan"
                                style="color:<?php if($data['errorSurname']) echo "rgb(255, 0, 0)"; else echo""?>"
                                >Nazwisko</label>
                            </div>
                            <label id="errorSurname"  class='errorLabel'><?=$data['errorSurname']?></label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="forms-inputs"> 
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" placeholder="a" name="mail" value="<?=$data['mail'] ?>"
                                style="border:<?php if($data['errorEmail']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>"
                                >
                                <label for="email" id="emailSpan"
                                style="color:<?php if($data['errorEmail']) echo "rgb(255, 0, 0)"; else echo""?>"
                                >Adres e-mail</label>
                            </div>
                            <label id="errorEmail"  class='errorLabel'><?=$data['errorEmail']?></label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="forms-inputs"> 
                            <div class="form-floating">
                                <input type="text" class="form-control" id="login" placeholder="a" name="login" value="<?=$data['login'] ?>"
                                style="border:<?php if($data['errorLogin']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>" 
                                required>
                                <label for="login" id="loginSpan"
                                style="color:<?php if($data['errorLogin']) echo "rgb(255, 0, 0)"; else echo""?>"
                                >Login</label>
                            </div>
                            <label id="errorLogin"  class='errorLabel'><?=$data['errorLogin']?></label>
                        </div>    
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="forms-inputs"> 
                            <div class="form-floating ">
                                <input type="text" class="form-control" id="password" placeholder="a" name="pass" 
                                style="border:<?php if($data['errorPassword']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>"
                                >
                                <label for="password" id="passwordSpan"
                                style="color:<?php if($data['errorPassword']) echo "grb(255, 0, 0)"; else echo""?>"
                                >Hasło</label> 
                            </div>
                            <label id="errorPassword"  class='errorLabel'><?=$data['errorPassword']?></label>
                        </div>    
                    </div>
                    <label style="color:darkgray; margin-top:3px">*W przypadku pozostawienia pola hasła pustego użytkownik dostanie losowe hasło na maila</label>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <label class="form-check-label" 
                            style="margin-top: 5px; margin-left: 10px; font-weight: bold; font-size:18px" 
                            for="userActivated">Aktywowany</label>
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
document.getElementById('addman').setAttribute('style', 'color:white !important');

</script>

<?php
include 'adm_feet.php';

?>