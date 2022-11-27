<?php
include 'adm_nav.php';
?>

<div class="container-fluid">
    <h1 class="text-muted">Dodawanie użytkownika</h1>
    <hr class="divider ">
    <form>
        <div class="row">
            <div class="col-12 col-md-6">
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
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="passInput" name="pass" placeholder="name@example.com">
                            <label for="passInput" >Hasło</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row m-2">
                    <div class="col-6">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="cityInput" name="city" placeholder="Gliwice">
                            <label for="nameInput">Miejscowość</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="streetInput" name="street" placeholder="Kraszewskiego">
                            <label for="streetInput">Ulica</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-3">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="stnmInput" name="streetNum" placeholder="16A">
                            <label for="stnmInput">Nr Ulicy</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="lmInput" name="street" placeholder="Nie">
                            <label for="lmInput">Nr Lokalu</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="zipInput" name="zip" placeholder="44-100">
                            <label for="zipInput">Kod pocztowy</label>
                        </div>
                    </div>
                    <div>  
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
</script>

<?php include dirname(__FILE__,2) . "/footer.php"; ?>