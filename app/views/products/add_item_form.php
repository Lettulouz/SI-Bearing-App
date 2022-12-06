<h1 class="text-muted headers-padding">Dodawanie produktu</h1>
    <hr class="divider ">
<div class="container" style="max-width:720px;">
    
    <form>
        <div class="row m-2">
            <div class="col-12 ">
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="nameInput" name="name" placeholder="Grontomat">
                            <label for="nameInput">Nazwa</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="quantityInput" name="quantity" placeholder="23">
                            <label for="quantityInput">Ilość</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="manufacturerInput" name="manufacturer" placeholder="Grontex">
                            <label for="manufacturerInput" >Producent</label>
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
document.getElementById('additem').setAttribute('style', 'color:white !important');

</script>