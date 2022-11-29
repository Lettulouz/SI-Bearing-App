<?php
include 'mng_nav.php';

?>

<h1 class="text-muted">Dodawanie katalogu</h1>
    <hr class="divider ">
<div class="container" style="max-width:720px;">
    
    <form>
        <div class="row m-2">
            <div class="col-12 ">
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nameInput" name="name" placeholder="Grontex">
                            <label for="nameInput" >Nazwa firmy</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating">
                            <select class="custom-select custom-select-lg" id="select1">
                            <label for="select1" >Produkty</label>
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option> <!-- Do dokończenia -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="widthInput" name="width" placeholder="10">
                            <label for="widthInput" >Szerokość</label>
                        </div>
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
document.getElementById('content_collapse').classList.add('show');
document.getElementById('content_collapse_btn').setAttribute('aria-expanded', 'true');
document.getElementById('content_collapse_btn').setAttribute('style', 'color:white !important');
document.getElementById('addcat').setAttribute('style', 'color:white !important');

</script>

<?php
include 'mng_feet.php';

?>