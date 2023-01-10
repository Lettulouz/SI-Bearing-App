<?php
include 'adm_nav.php';
?>

<div class="row mx-0">
        <div class="col-6">
            <h1 class="text-muted headers-padding ">Edycja strony głównej</h1>
        </div>
        <div class="col-6 align-self-center">
            <button type="submit" id="homeSubmitRemote" name="homeSubmitRemote" class="btn btn-primary btn-lg float-end me-3" >Edytuj</button>
        </div>
    </div>
</div>
<hr class="divider mt-0 ">

<div class="container" style="padding-right: 15px;">
<form action="" id="addItemForm" method="POST" autocomplete="off" enctype="multipart/form-data">
    <div class="row m-2 mb-4  px-3">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-sm-10 me-sm-0">
                    <input class="form-control" type="file" name="formFile" id="formFile" accept="image/png" onchange="preview()">
                </div>
                <div class="col-12 col-sm-2 mt-3 mt-sm-0 ms-sm-0">
                    <button id="deleteImageBtn" onclick="clearImage()" class="btn btn-danger col-12">-</button>
                </div>
            </div>
            <div class="text-center">
                <img id="output" class="img-thumbnail mt-3" style="display:none; object-fit:cover"/>
            </div>
        </div>
    </div>

    <div class="row m-2 mb-4">
        <div class="col-12 col-lg-4">
            <label class="text-muted ps-3"><h5>Kolumna 1</h5></label>

            <div class="row m-1">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="ico1" name="ico1" max="75" placeholder="icon 1"
                        value="<?=$data['result']['icon1']?>">
                        <label for="ico1" style="color:darkgray">Ikona</label>
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="title1" name="title1" max="100" placeholder="icon 1"
                        value="<?=$data['result']['title1']?>">
                        <label for="title1" style="color:darkgray">Tytuł</label>
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="form-floating">
                        <textarea id="brief" name="brief1" class="form-control" style="overflow:hidden;resize:none; height:244px" maxlength="250"><?=$data['result']['desc1']?></textarea>
                        <label class="form-control-lg lg-custom" for="brief">Opis</label>
                    </div>
                </div>
            </div>

        </div>



        <div class="col-12 col-lg-4">
            <label class="text-muted  ps-3"><h5>Kolumna 2</h5></label>

            <div class="row m-1">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="ico2" name="ico2"  max="75" placeholder="icon 1"
                        value="<?=$data['result']['icon2']?>">
                        <label for="ico2" style="color:darkgray">Ikona</label>
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="title2" name="title2"  max="100" placeholder="icon 1"
                        value="<?=$data['result']['title2']?>">
                        <label for="title2" style="color:darkgray">Tytuł</label>
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="form-floating">
                        <textarea id="brief" name="brief2" class="form-control" style="overflow:hidden;resize:none; height:244px" maxlength="250"><?=$data['result']['desc2']?></textarea>
                        <label class="form-control-lg lg-custom" for="brief">Opis</label>
                    </div>
                </div>
            </div>

        </div>


        <div class="col-12 col-lg-4">
            <label class="text-muted  ps-3"><h5>Kolumna 3</h5></label>

            <div class="row m-1">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="ico3" name="ico3" max="75" placeholder="icon 1"
                        value="<?=$data['result']['icon3']?>">
                        <label for="ico3" style="color:darkgray">Ikona</label>
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="title3" name="title3"  max="100" placeholder="icon 1"
                        value="<?=$data['result']['title3']?>">
                        <label for="title3" style="color:darkgray">Tytuł</label>
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="form-floating">
                        <textarea id="brief3" name="brief3" class="form-control" style="overflow:hidden;resize:none; height:244px" maxlength="250"> <?=$data['result']['desc3']?></textarea>
                        <label class="form-control-lg lg-custom" for="brief">Opis</label>
                    </div>
                </div>
            </div>

        </div>
        <label style="color:darkgray" class=" ps-4">*W polu ikona należy podać odpowiednią klasę z katalogu ikon
        <a href="https://icons.getbootstrap.com/" target="_blank" style="color:darkgray">bootstrapa</a></label>
    </div>

    <div class="row m-2">
        <div class="col px-4">
            <div class="form-floating">
                <input type="text" class="form-control" id="video" name="video" max="300" placeholder="yt"
                value="<?=$data['result']['youtubeUrl']?>">
                <label for="video" style="color:darkgray">video</label>
            </div>
        </div>
    </div>
    <input type="submit" id="homeEditSubmit" name="homeEditSubmit" style="display:none">
</form>
</div>

<script>
    document.getElementById('settings_collapse').classList.add('show');
    document.getElementById('settings_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('settings_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('homeedit').setAttribute( 'style', 'color:white !important' );

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

    $("#homeSubmitRemote").click(function(e){ 
        $("#homeEditSubmit").click();
    });
</script>