<h1 class="text-muted">Dodawanie atrybutu</h1>
    <hr class="divider ">
<div class="container" style="max-width:720px;">
    
    <form>
        <div class="row m-2">
            <div class="col-12 ">
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="heightInput" name="height" placeholder="20">
                            <label for="heightInput" >Wysokość</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="lengthInput" name="length" placeholder="5">
                            <label for="lengthInput" >Długość</label>
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
document.getElementById('addattr').setAttribute('style', 'color:white !important');

</script>