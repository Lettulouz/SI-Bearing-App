<?php
include 'adm_nav.php';

?>

<form>
 <div class="form-group row">
    <label for="inputLogin" class="col-sm-2 mb-3 col-form-label">Nazwa użytkownika</label>
    <div class="col-sm-10 mb-3">
      <input type="text" class="form-control" id="inputLogin" placeholder="Login">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 mb-3  col-form-label">Email</label>
    <div class="col-sm-10 mb-3">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 mb-3  col-form-label">Hasło</label>
    <div class="col-sm-10 mb-3">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Języki</legend>
      <div class="col-sm-10 mb-3">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
          <label class="form-check-label" for="gridRadios1">
            PHP
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
          <label class="form-check-label" for="gridRadios2">
            C#
          </label>
        </div>
        <div class="form-check disabled">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
          <label class="form-check-label" for="gridRadios3">
            Python
          </label>
        </div>
      </div>
    </div>
  </fieldset>
  <div class="form-group row">
    <div class="col-sm-2 mb-3">Checkbox</div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck1">
        <label class="form-check-label" for="gridCheck1">
          Ma ponad 18 lat
        </label>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Dodaj użytkownika</button>
    </div>
  </div>
</form>

<script>
    document.getElementById('users_collapse').classList.add('show');
    document.getElementById('users_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('users_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('add_user').setAttribute( 'style', 'color:white !important' );
</script>

<?php include dirname(__FILE__,2) . "/footer.php"; ?>