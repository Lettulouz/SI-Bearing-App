<h1 class="text-muted headers-padding">Dodawanie metody płatności</h1> 
    <hr class="divider mt-0">
<div class="container" style="max-width:720px;">
    
<form autocomplete="off" action="" method="POST">
        <div class="row m-2">
            <div class="col-12 ">
                <div class="row m-2">
                    <div class="col-12">
                        <div class="forms-inputs"> 
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nameInput" placeholder="a" name="nameInput" value="">
                                <label class="form-control-lg lg-custom" for="nameInput">Nazwa</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="forms-inputs"> 
                            <div class="form-floating">
                                <input type="number" min="0" step="0.01" class="form-control" id="feeInput" placeholder="a"
                                name="feeInput" value="">
                                <label class="form-control-lg lg-custom" for="feeInput">Prowizja</label>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <label class="form-check-label" 
                            style="margin-top: 5px; margin-left: 10px; font-weight: bold; font-size:18px" 
                            for="methodActivated">Aktywna</label>
                            <input class="form-check-input" style="height:30px; width:60px;" type="checkbox" 
                            id="methodActivated" name="methodActivated" checked>
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
document.getElementById('store_collapse').classList.add('show');
document.getElementById('store_collapse_btn').setAttribute('aria-expanded', 'true');
document.getElementById('store_collapse_btn').setAttribute('style', 'color:white !important');
document.getElementById('addpmmt').setAttribute('style', 'color:white !important');

</script>