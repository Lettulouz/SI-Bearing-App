<?php
include 'adm_nav.php';

?>

<div class="row mx-0">
        <div class="col-6">
            <h1 class="text-muted headers-padding ">Edycja informacji</h1>
        </div>
        <div class="col-6 align-self-center">
            <button type="submit" id="informationsSubmitRemote" name="informationsSubmitRemote" class="btn btn-primary btn-lg float-end me-3" >Edytuj</button>
        </div>
    </div>
</div>
    <hr class="divider mt-0">
<div class="container" style="max-width:720px;">
    <form action="" id="addItemForm" method="POST" autocomplete="off" enctype="multipart/form-data"> 
        <div class="row m-2">
            <div class="col itemField1">
                <div class="row m-2">
                    <div class="col">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="nameInput" name="siteName" placeholder="Nazwa" 
                            value="<?=$data['result']['sitename']?>" required>
                            <label class="form-control-lg lg-custom" for="nameInput">Nazwa strony</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-sm-9 me-sm-0">
                                <input class="form-control" type="file" name="formFile" id="formFile" accept="image/png" onchange="preview()">
                            </div>
                            <div class="col-12 col-sm-3 mt-3 mt-sm-0 ms-sm-0">
                                <button id="deleteImageBtn" onclick="clearImage()" class="btn btn-danger col-12">-</button>
                            </div>
                        </div>
                        <div class="text-center">
                            <img id="output" class="img-thumbnail mt-3" src="<?=$data['imagePath']?>" style="display:default; object-fit:cover"/>
                        </div>
                        <label style="color:darkgray">*Dodawany obraz musi mieć proporcje 1:1, aby wyświetlał się poprawnie</label>
                    </div>
                </div>
            </div>   
        </div>  
        <button type="submit" id="informationsEditSubmit" name="informationsEditSubmit" class="btn btn-primary btn-lg float-end" style="display:none"></button>
    </form> 
</div>

<script>
    document.getElementById('settings_collapse').classList.add('show');
    document.getElementById('settings_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('settings_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('infoedit').setAttribute( 'style', 'color:white !important' );

    $("#informationsSubmitRemote").click(function(e){ 
        $("#informationsEditSubmit").click();
    });
</script>


<script>
    function preview() {
        var frame = document.getElementById('output');
        document.getElementById('output').setAttribute('style', 'display:default');
        document.getElementById('deleteImageBtn').setAttribute('style', 'display:default');
        frame.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage() {
        document.getElementById('formFile').value = null;
        document.getElementById('output').setAttribute('style', 'display:none');
        document.getElementById('deleteImageBtn').setAttribute('style', 'display:none');
        frame.src = "";
    }
</script>
<?php
include 'adm_feet.php';

?>