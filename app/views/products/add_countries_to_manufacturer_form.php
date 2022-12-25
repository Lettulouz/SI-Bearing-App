<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />



<h1 class="text-muted headers-padding">Przypisywanie kraju do producenta</h1>
    <hr class="divider ">
<div class="container" style="max-width:720px;">
    
    <form method="POST" action ="" >
        <div class="row m-2">
            <div class="col-12 ">
                <div class="row m-2">
                    <div class="col-12">
                        <select class="select2 form-select-lg" id="manufacturerName" name="manufacturername" 
                        aria-label="example-xl">
                            <?php
                                foreach($data['manufacturers'] as $i => $result) {
                                    echo 
                                    "<option value=".$result['id'].">".$result['name']."</option>";
                                }
                            
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <select class="select2 form-select-lg" multiple id="countries" name="selCountries[]" 
                        aria-label="example-xl" aria-selected="<?=$data['selCountries']?>" aria-autocomplete="TRUE">
                            <?php
                                foreach($data['countries'] as $i => $result) {
                                    $temp = "";
                                    if(!empty($data['selCountries']))
                                        if(in_array($result['countryid'], $data['selCountries'])) $temp = "selected=selected";
                                    echo 
                                    "<option value=".$result['countryid']. " " . $temp .">".$result['countryname']."</option>";
                                }
                            
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="row m-2">
                    <div class="float-end">
                        <button type="submit" name="manufsubmit" class="btn btn-primary btn-lg float-end">Dodaj</button>
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
document.getElementById('addcounttomanuf').setAttribute('style', 'color:white !important');
$('#manufacturerName').select2({
    theme: 'bootstrap-5',
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: 'Wybierz producenta',
    
});
$('#countries').select2({
    theme: 'bootstrap-5',
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: 'Wybierz kraje',
    closeOnSelect: false,
});

</script>