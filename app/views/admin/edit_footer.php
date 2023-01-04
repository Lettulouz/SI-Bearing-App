<?php
include 'adm_nav.php';
?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>

<div class="modal fade" id="exampleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dodawanie linku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="target">
                <div class="form-floating">
                    <input type="text" class="form-control" id="linkInModal" name="linkInModal" maxlength="500" placeholder="a">
                    <label class="form-control-lg lg-custom" for="linkInModal">Link</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                <button type="button" class="btn btn-primary saveLink" data-bs-dismiss="modal">Zapisz</button>
            </div>
        </div>
    </div>
</div>


<div class="row mx-2">
        <div class="col-6">
            <h1 class="text-muted headers-padding ">Edycja stopki</h1>
        </div>
        <div class="col-6 align-self-center">
            <button type="submit" id="footerSubmitRemote" name="footerSubmitRemote" class="btn btn-primary btn-lg float-end me-3" >Edytuj</button>
        </div>
    </div>
</div>
<hr class="divider mt-0 ">
<div class="headers-padding" style="padding-right: 15px;">
<form action="" id="addItemForm" method="POST" autocomplete="off">
    <div class="row m-2">

        <!-- Basic page info -->

        <div class="col-12 col-xl-3">
            <div class="row m-1">
                <div class="col">
                    <div class="form-floating ">
                        <input type="text" class="form-control" id="companyName" name="companyName" style="font-weight:bold" value="<?=$data['result']['name']?>" maxlength="40">
                        <label class="form-control-lg lg-custom" for="companyName"><b>Nazwa</b></label>
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="form-floating">
                        <textarea id="brief" name="brief" class="form-control" style="overflow:hidden;resize:none; height:244px" maxlength="250"><?=$data['result']['brief']?></textarea>
                        <label class="form-control-lg lg-custom" for="brief">Opis</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Column 1 -->

        <div class="col-12 col-xl-3 mt-4 mt-xl-0">
            <div class="row m-1">
                <div class="col">
                    <div class="form-floating ">
                        <input type="text" class="form-control" id="c1name" name="c1name" style="font-weight:bold" value="<?=$data['result']['c1name']?>" maxlength="40">
                        <label class="form-control-lg lg-custom" for="c1name"><b>Kolumna 1</b></label>
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="input-group">
                        <input type="text" class="form-control" id="c1r1" name="c1r1" value="<?=$data['result']['c1r1']?>" maxlength="40">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary linkBtn" type="button" id="button-addon2" style="height:55px" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            target="c1r1path">Link</button>
                            <input type="hidden" id="c1r1path" name="c1r1path" value="<?=$data['result']['c1r1path']?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="input-group">
                        <input type="text" class="form-control" id="c1r2" name="c1r2" value="<?=$data['result']['c1r2']?>" maxlength="40">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary linkBtn" type="button" id="button-addon2" style="height:55px" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            target="c1r2path">Link</button>
                            <input type="hidden" id="c1r2path" name="c1r2path" value="<?=$data['result']['c1r2path']?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="input-group">
                        <input type="text" class="form-control" id="c1r3" name="c1r3" value="<?=$data['result']['c1r3']?>" maxlength="40">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary linkBtn" type="button" id="button-addon2" style="height:55px" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            target="c1r3path">Link</button>
                            <input type="hidden" id="c1r3path" name="c1r3path" value="<?=$data['result']['c1r3path']?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="input-group">
                        <input type="text" class="form-control" id="c1r4" name="c1r4" value="<?=$data['result']['c1r4']?>" maxlength="40">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary linkBtn" type="button" id="button-addon2" style="height:55px" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            target="c1r4path">Link</button>
                            <input type="hidden" id="c1r4path" name="c1r4path" value="<?=$data['result']['c1r4path']?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Column 2 -->

        <div class="col-12 col-xl-3 mt-4 mt-xl-0">
            <div class="row m-1">
                <div class="col">
                    <div class="form-floating ">
                        <input type="text" class="form-control" id="c2name" name="c2name" style="font-weight:bold" value="<?=$data['result']['c2name']?>" maxlength="40">
                        <label class="form-control-lg lg-custom" for="c2name"><b>Kolumna 2</b></label>
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="input-group">
                        <input type="text" class="form-control" id="c2r1" name="c2r1" value="<?=$data['result']['c2r1']?>" maxlength="40">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary linkBtn" type="button" id="button-addon2" style="height:55px" data-bs-toggle="modal" data-bs-target="#exampleModal"
                             target="c2r1path">
                            Link</button>
                            <input type="hidden" id="c2r1path" name="c2r1path" value="<?=$data['result']['c2r1path']?>">
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="input-group">
                        <input type="text" class="form-control" id="c2r2" name="c2r2" value="<?=$data['result']['c2r2']?>" maxlength="40">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary linkBtn" type="button" id="button-addon2" style="height:55px" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            target="c2r2path">Link</button>
                            <input type="hidden" id="c2r2path" name="c2r2path" value="<?=$data['result']['c2r2path']?>">
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="input-group">
                        <input type="text" class="form-control" id="c2r3" name="c2r3" value="<?=$data['result']['c2r3']?>" maxlength="40">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary linkBtn" type="button" id="button-addon2" style="height:55px" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            target="c2r3path">Link</button>
                            <input type="hidden" id="c2r3path" name="c2r3path" value="<?=$data['result']['c2r3path']?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="input-group">
                        <input type="text" class="form-control" id="c2r4" name="c2r4" value="<?=$data['result']['c2r4']?>" maxlength="40">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary linkBtn" type="button" id="button-addon2" style="height:55px" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            target="c2r4path">Link</button>
                            <input type="hidden" id="c2r4path" name="c2r4path" value="<?=$data['result']['c2r4path']?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Column 3 -->

        <div class="col-12 col-xl-3 mt-4 mt-xl-0">
            <div class="row m-1">
                <div class="col">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="c3name" name="c3name" style="font-weight:bold" value="<?=$data['result']['c3name']?>" maxlength="40">
                        <label class="form-control-lg lg-custom" for="c3name"><b>Kolumna 3</b></label>
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="form-group">
                        <input type="text" class="form-control" id="c3r1" name="c3r1" value="<?=$data['result']['c3r1']?>" maxlength="40">
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="form-group">
                        <input type="text" class="form-control" id="c3r2" name="c3r2" value="<?=$data['result']['c3r2']?>" maxlength="40"> 
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="form-group">
                        <input type="text" class="form-control" id="c3r3" name="c3r3" value="<?=$data['result']['c3r3']?>" maxlength="40">
                    </div>
                </div>
            </div>

            <div class="row m-1">
                <div class="col">
                    <div class="form-group">
                        <input type="text" class="form-control" id="c3r4" name="c3r4" value="<?=$data['result']['c3r4']?>" maxlength="40">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom text -->
    
    <div class="row m-4">
        <div class="col-12">
            <div class="form-floating">
                <input type="text" class="form-control" id="bottomtext" name="bottomtext" style="font-weight:bold" value="<?=$data['result']['bottomtext']?>" maxlength="50">
                <label class="form-control-lg lg-custom" for="bottomtext"><b>Dolny tekst</b></label>
            </div>
        </div>
    </div>

    

    <input type="submit" id="footerEditSubmit" name="footerEditSubmit" style="display:none">
</form>


<script>
    document.getElementById('settings_collapse').classList.add('show');
    document.getElementById('settings_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('settings_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('footedit').setAttribute( 'style', 'color:white !important' );

    $("#footerSubmitRemote").click(function(e){ 
        $("#footerEditSubmit").click();
    });

    $(".linkBtn").click(function(){
        var link=$(this).parent().children("input[type=hidden]").eq(0).val()
        var target=$(this).attr('target');
        $('#target').val(target);
        $('#linkInModal').val(link);

    })

    $(".saveLink").click(function(){
       var targetId="#"+$('#target').val();
       $(targetId).val($('#linkInModal').val())
    })

</script>

<?php
include 'adm_feet.php';
?>