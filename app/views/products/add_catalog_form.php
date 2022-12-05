<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link href="https://rawgit.com/select2/select2/master/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://rawgit.com/select2/select2/master/dist/js/select2.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />


<h1 class="text-muted">Dodawanie katalogu</h1>
    <hr class="divider ">
<div class="container" style="max-width:720px;">
    <!-- nie działa dla menedżera contentu jak coś-->
    <form method="post"  action="">
        <div class="row m-2">
            <div class="col-12 ">
                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nameInput" name="catname" placeholder="Grontex">
                            <label for="nameInput" >Nazwa katalogu</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <select class="select2 form-select " multiple="multiple" id="item" name="itemcat[]" aria-label="example">
                                <?php
                                    foreach($data['items'] as $i => $result) {
                                        echo "<option value=".$result['item_id'].">".$result['mnf']." - ".$result['item']."</option>";

                                    }
                                
                                ?>
                        </select>

                    </div>
                    <span style="color:<?php if(isset($_POST['catsubmit'])) echo $data['msg_color']; ?>">
                    <?php if(isset($_POST['catsubmit'])) echo $data['return_msg']; ?></span>
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
    theme: 'bootstrap-5',
    placeholder: 'Wybierz produkty'
});

</script>