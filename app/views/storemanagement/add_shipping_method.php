<h1 class="text-muted headers-padding">Dodawanie metody dostawy</h1> 
    <hr class="divider mt-0">
<div class="container" style="max-width:720px;">
    
<form autocomplete="off" action="" method="POST">
        <div class="row m-2">
            <div class="col-12 ">
                <div class="row m-2">
                    <div class="col-12">
                        <div class="forms-inputs"> 
                            <div class="form-floating">
                                <input type="text" class="form-control" id="methodName" placeholder="a" name="methodName" value="">
                                <label class="form-control-lg lg-custom" for="methodName" required>Nazwa</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="forms-inputs"> 
                            <div class="form-floating">
                                <input type="number" min="0" step="0.01" class="form-control" id="methodPrice" placeholder="a"
                                name="methodPrice" value="" required>
                                <label class="form-control-lg lg-custom" for="methodPrice">Cena</label>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <label class="form-check-label" 
                            style="margin-top: 5px; margin-left: 10px; font-weight: bold; font-size:18px" 
                            for="methActive">Aktywna</label>
                            <input class="form-check-input" style="height:30px; width:60px;" type="checkbox" 
                            id="methActive" name="methActive" checked>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="float-end">
                        <button type="submit" class="btn btn-primary btn-lg float-end" name="addshipmeth">Zapisz zmiany</button>
                    </div>
                </div>
            </div> 
        </div>       
    </form>
</div>

<script>
document.getElementById('store_collapse').classList.add('show');
document.getElementById('store_collapse_btn').setAttribute('aria-expanded', 'true');
document.getElementById('store_collapse_btn').setAttribute('style', 'color:white !important');
document.getElementById('addspmt').setAttribute('style', 'color:white !important');

</script>
