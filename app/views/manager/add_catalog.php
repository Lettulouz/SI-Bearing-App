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
                        <select class="form-select py-3" id="item1" name="item1" aria-label="py-3 example">
                            <option selected>Wybierz produkt</option>
                            <option value="1">produkt1</option>
                            <option value="2">produkt2</option>
                            <option value="3">produkt3</option> 
                        </select>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <select class="form-select py-3" id="item2" name="item2" aria-label="py-3 example">
                            <option selected>Wybierz produkt</option>
                            <option value="1">produkt1</option>
                            <option value="2">produkt2</option>
                            <option value="3">produkt3</option> 
                        </select>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <select class="form-select py-3" id="item3" name="item3" aria-label="py-3 example">
                            <option selected>Wybierz produkt</option>
                            <option value="1">produkt1</option>
                            <option value="2">produkt2</option>
                            <option value="3">produkt3</option> 
                        </select>
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