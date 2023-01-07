<h1 class="text-muted headers-padding">Dodawanie atrybutu</h1>
    <hr class="divider mt-0">
<div class="container" style="max-width:720px;">
    
    <form method="POST" action ="" autocomplete="off">
        <div class="row m-2">
            <div class="col-12 ">
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="heightAttributeName" name="attributeName" placeholder="25" value=<?=$data['attributeName']?>>
                            <label class="form-control-lg lg-custom" for="heightAttributeName">Nazwa</label>
                        </div>
                    </div>
                </div>

                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="heightAttributeUnit" name="attributeUnit" placeholder="25" value=<?=$data['attributeUnit']?>>
                            <label class="form-control-lg lg-custom" for="heightAttributeUnit">Jednostka</label>
                        </div>
                    </div>
                </div>
             
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <label class="form-check-label" 
                            style="margin-top: 5px; margin-left: 10px; font-weight: bold; font-size:18px" 
                            for="attributeRange">Zakres</label>
                            <input class="form-check-input" style="height:30px; width:60px;" type="checkbox" 
                            id="attributeRange" name="attributeRange" value=<?=$data['attributeRange']?>>
                        </div>
                    </div>
                </div>

                <div class="row m-2">
                    <div class="float-end">
                        <button type="submit" name="attrEditSub" class="btn btn-primary btn-lg float-end">Dodaj</button>
                    </div>
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