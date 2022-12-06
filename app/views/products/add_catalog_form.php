<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />


<h1 class="text-muted headers-padding">Dodawanie katalogu</h1>
    <hr class="divider ">
<div class="container" style="max-width:720px;">
    <!-- nie działa dla menedżera contentu jak coś-->
    <form method="post"  action="">
        <div class="row m-2">
            <div class="col-12 ">
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="catalogNameInput" name="catname" placeholder="Grontex">
                            <label for="catalogNameInput" >Nazwa katalogu</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                            <select class="select2 form-select-lg" multiple="multiple" id="item" name="itemcat[]" aria-label="example-xl">
                                    <?php
                                        foreach($data['items'] as $i => $result) {
                                            echo "<option value=".$result['item_id'].">".$result['mnf']." - ".$result['item']."</option>";
                                        }
                                    
                                    ?>
                            </select>
                    </div>
                    <span style="color:<?php if(isset($_GET['color'])) echo $_GET['color']; ?>">
                    <?php if(isset($_GET['msg'])) echo base64_decode($_GET['msg']); ?></span>
                </div>
                           
                <div class="row m-2">
                    <div class="float-end">
                        <button type="submit" name="catsubmit" class="btn btn-primary btn-lg float-end">Dodaj</button>
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
$('#item').select2({
    width: 'auto',
    theme: 'bootstrap-5',
    placeholder: 'Wybierz produkty'
});

</script>