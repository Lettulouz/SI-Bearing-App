<?php
include 'adm_nav.php';
$adminId = $data['adminId'];
$id = $data['id'];
?>
<script type="text/javascript" src="<?=APPPATH?>/scripts/editUser.js"></script>
<h1 class="text-muted headers-padding">Edycja użytkownika</h1>
    <hr class="divider mt-0">
<div class="container" style="max-width:720px;">    
    <form autocomplete="off" action="" method="POST" id="registerForm">
        <div class="row m-2">
            <div class="col-12 ">
                <div class="row m-2">
                    <div class="col-6">
                    <div class="forms-inputs"> 
                        <div class="form-floating ">
                            <input type="text" class="form-control"  id="name" name="name" value="<?=$data['name'] ?>"
                            style="border:<?php if($data['errorName']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>" required>
                            <label for="name"  id="nameSpan"
                            style="color:<?php if($data['errorName']) echo "rgb(255, 0, 0)"; else echo""?>">Imię</label>
                        </div>
                        <label id="errorName"  class='errorLabel'><?=$data['errorName']?></label>
                    </div>
                    </div>
                    <div class="col-6">
                        <div class="forms-inputs"> 
                            <div class="form-floating ">
                                <input type="text" class="form-control" id="surname" name="surname" value="<?=$data['surname'] ?>"
                                style="border:<?php if($data['errorSurname']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>" required>
                                <label for="surname" id="surnameSpan"
                                style="color:<?php if($data['errorSurname']) echo "rgb(255, 0, 0)"; else echo""?>">Nazwisko</label>
                            </div>
                            <label id="errorSurname"  class='errorLabel'><?=$data['errorSurname']?></label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="forms-inputs"> 
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="mail" value="<?=$data['mail'] ?>"
                                style="border:<?php if($data['errorEmail']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>"
                                required>
                                <label for="mail" id="emailSpan"
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
                            <input type="text" class="form-control" id="login" name="login" value="<?=$data['login'] ?>" 
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
                            <input type="text" class="form-control" id="password" name="pass" value=""
                            style="border:<?php if($data['errorPassword']) echo "2px solid rgb(255, 0, 0)"; else echo ""?>"
                            >
                            <label for="password" id="passwordSpan"
                            style="color:<?php if($data['errorPassword']) echo "grb(255, 0, 0)"; else echo""?>"
                            >Hasło</label> 
                        </div>
                        <label id="errorPassword"  class='errorLabel'><?=$data['errorPassword']?></label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating ">
                            <select class="form-select" id="roleInput" name="role" <?php if ($id==$adminId) echo "disabled";?> required>                             
                                <option hidden></option>
                                <option <?php if ($data['role']=="user") echo "selected " ?>value="user">Użytkownik</option>
                                <option <?php if ($data['role']=="shopservice") echo "selected " ?>value="shopservice">Obsługa sklepu</option>
                                <option <?php if ($data['role']=="contentmanager") echo "selected " ?>value="contentmanager">Menedżer</option>
                                <option <?php if ($data['role']=="admin") echo "selected " ?>value="admin">Administrator</option>
                            </select>
                            <label for="roleInput" >Uprawnienia</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                <input class="form-check-input" style="display:none" type="checkbox" 
                            id="userActivated" name="userActivated">
                        </div>
                    <div class="float-end">
                        <button type="button" class="btn btn-primary btn-lg float-end" onclick="registerButton()">Zapisz zmiany</button>
                        <button type="submit" id="senduser" class="btn btn-primary btn-lg float-end" name="senduser" style="display:none"></button>
                    </div>
                </div>
            </div> 
        </div>       
    </form>
</div>

<script>
document.getElementById('users_collapse').classList.add('show');
document.getElementById('users_collapse_btn').setAttribute('aria-expanded', 'true');
document.getElementById('users_collapse_btn').setAttribute('style', 'color:white !important');


</script>

<?php
include 'adm_feet.php';
?>