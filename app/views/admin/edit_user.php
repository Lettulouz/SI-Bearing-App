<?php
include 'adm_nav.php';
?>
<h1 class="text-muted headers-padding">Edycja użytkownika</h1>
    <hr class="divider mt-0">
<div class="container" style="max-width:720px;">    
    <form autocomplete="off" action="" method="POST">
        <div class="row m-2">
            <div class="col-12 ">
                <div class="row m-2">
                    <div class="col-6">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="nameInput" name="name" value="<?=$data['name'] ?>" required>
                            <label for="nameInput">Imię</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="surnameInput" name="surname" value="<?=$data['surname'] ?>" required>
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
                            <input type="text" class="form-control" id="loginInput" name="login" value="<?=$data['login'] ?>" required>
                            <label for="loginInput" >Login</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="passInput" name="pass" value="">
                            <label for="passInput" >Hasło</label> 
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating ">
                            <select class="form-select" id="roleInput" name="role" required>                             
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
                    <div class="float-end">
                        <button type="submit" class="btn btn-primary btn-lg float-end" name="senduser">Zapisz zmiany</button>
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