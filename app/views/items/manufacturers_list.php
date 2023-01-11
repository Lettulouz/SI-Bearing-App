<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
<div class="row m-0">
<h1 class="text-muted headers-padding col-6">Lista producentów</h1>
    <hr class="divider "> 
    <div class="headers-padding container-fluid" style="padding-right: 15px;">
    
    <div class="col-12 col-md-6 col-lg-4">
            <div class="input-group">
            <input type="text" class="form-control" id="searchBox" placeholder="Wyszukaj producenta">
            <button type="button" class="btn bg-transparent clrBtn" style="margin-left: -40px; z-index: 100;">
                            <i class="bi bi-x"></i>
                            </button>
                <span class="input-group-text"><i class="bi bi-search"></i></span>
            </div>

            <form method="post" action="">
                <div class="row d-flex">
                    <div class="col-8">
                        <div class="form-check">
                            <label class="form-check-label" 
                            style="margin-top: 9px; margin-left: 10px; font-weight: bold; font-size:18px" 
                            for="onlyActive">Aktywne</label>
                            <input type="checkbox" class="form-check-input mt-2" id="onlyActive" name="onlyActive" 
                            style="height:30px; width:30px;" <?php if($data['manufacturersOnlyActive']==1) echo "checked"?>>          
                        </div>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                        <input type="submit" class="btn btn-primary mt-2 d-block" id="onlyActiveSubmit" 
                        name="onlyActiveSubmit" value="Potwierdź">
                    </div>
                </div>   
            </form>
        </div>

        <?php if($data['mnfArray']) {?>
        <table class="table text-center">
        <thead>
        <tr>
        <th>Lp.</th>
        <th>Nazwa</th>
        <th>Ilość rekordów</th>
        <th></th>
        </tr>
        </thead>
        <tbody class="tab">
        <?php 
        $manufacturers = $data['mnfArray'];
        $mnfCts = $data['mnfCts'];
        $rmPath=$data['rmpath'];
        $i = 1;
        foreach($manufacturers as $mnf)
        {
            echo 
            "<tr class='tabRow'>
            <td>{$i}</td>
            <td>{$mnf['mnf']}</td>
            <td>{$mnf['mnfctsam']}</td>
            <td class='px-0 mx-0'>
            <button type='button' data-toggle='collapse' class='btn btn-dark d-inline btn-sm mx-1 tabBtn' 
            data-bs-toggle='collapse' data-bs-target='#row".$i."' aria-expanded='false'>
            <i class='eye bi bi-eye-fill'></i>
            </button>
            <button type='button' class='btn btn-dark d-inline btn-sm mx-1 editBtn' sampleAttr='" . $i . "' data-bs-toggle='modal' data-bs-target='#editModal' value='{$mnf['m_id']}'>
            <i class='bi bi-gear-fill'></i>
            </button>
            <a href='".$rmPath."/".$mnf['m_id']."' type='button' data-toggle='collapse' class='btn btn-danger d-inline btn-sm mx-1 tabBtn'>
            <i class='bi bi-trash-fill'></i>
            </a>
            <input type='hidden' id='mnfActive" . $i . "' value='{$mnf['active']}' >
            </td>
            </tr>

            <tr>
                <td colspan='12' class='p-0'>
					<div class='hidTab collapse' id='row".$i."'>
                        <table class='table table-active coltab m-0'>
                            <thead>
                                <tr>
                                <th>Kraj</th>
                                </tr>
                                </thead>	
                                <tbody>";
                                     foreach($mnfCts[$mnf['m_id']] as $ctr){
                                        echo  "<tr>
                                                <td class='countryName".$mnf['m_id']." ".$ctr['c_id']."'>
                                                    {$ctr['cname']}
                                                </td>
                                            </tr>";
                                    }
                              echo  "</tbody>
                        </table>
                    </div>
                </td> 
            </tr>";
            $i++;
        }
        ?>
        </tbody>
        </table>
        <?php } else {echo "Brak dodanych katalogów.";}?>
    </div>


        <!--Edit manufacturer window-->

        <div class="modal fade" id="editModal"  aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edytuj producenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                <input type='hidden' id="mnfid" name="mnfid" class="form-control"> 
                    <div class="row">
                            <div class="col-9 form-floating my-2">
                                <input type="text" class="form-control" id="manufacturerName" name="mnfname">
                                <label style="margin-left:7px;" for="manufacturerNameInput">Producent</label>
                            </div>
                            <div class="col-3 align-self-center">
                                <label class='form-check-label d-none d-sm-inline-block' 
                                style='margin-top: 5px; margin-right: 5px;  font-weight: bold; font-size:18px' 
                                for='isActive'>Aktywny</label>
                                <input class='form-check-input' style='height:30px; width:60px;' type='checkbox' 
                                id='isActive' name='isActive' >
                            </div>
                    </div>
                            <hr>
                                <select class="select2 form-select-lg my-2"  multiple="multiple" id="country" name="countrymnf[]" aria-label="example-xl"  aria-autocomplete="TRUE">
                                        <?php
                                            foreach($data['countries'] as $i => $country) {
                                                echo "<option class='countryList' value=".$country['id'].">".$country['name']."</option>";
                                            }
                                        ?>
                                </select>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                    <button type="submit" name="mnfEditSub" class="btn btn-primary">Edytuj</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.getElementById('content_collapse').classList.add('show');
    document.getElementById('content_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('content_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('manuf_list').setAttribute( 'style', 'color:white !important' );

     //change collapse button icon during collapsing
     $('.tabBtn').click(function() {
      if($(this).attr('aria-expanded')=='true'){
         $(this).find('i').removeClass('bi-eye-fill');
         $(this).find('i').addClass('bi-eye-slash-fill');
      }
      else if($(this).attr('aria-expanded')=='false'){
         $(this).find('i').removeClass('bi-eye-slash-fill');
         $(this).find('i').addClass('bi-eye-fill');
      }   
     });

//     //pass manufacturer data to edit modal
    $('.editBtn').click(function(){
        var mnfName=$(this).parent().parent().children('td').eq(1).text();
        var mnfcountries=$('.countryName'+$(this).attr('value')).map(function() {
            return this.className.split(' ')[1];
            }).get();
        var isActive1 = $(this).attr('sampleAttr');
        var isActive2 = $('#mnfActive'+isActive1).val();
        if(isActive2==0){
            $('#isActive').attr('checked');
        }else{
            $('#isActive').attr('checked', 'false');
        }
        $('#country').val(mnfcountries);
        $('#country').trigger('change');
        $('#mnfid').val($(this).attr('value'));
        $('#manufacturerName').val(mnfName);
        
    })

    //remove countrys from select after hide modal
    $('#editModal').on('hidden.bs.modal', function () {

        $('#country').val(null).trigger('change');
    })

//     //select properties
    $('#country').select2({
    width: 'auto',
    theme: 'bootstrap-5',
    placeholder: 'Wybierz kraje',
    dropdownParent: $("#editModal")

     });

    $(document).ready(function(){
        $("#searchBox").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".tab .tabRow").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            $('.hidTab').collapse('hide');
            $(this).find('.eye').removeClass('bi-eye-slash-fill');
            $(this).find('.eye').addClass('bi-eye-fill');
            });
        });
    });

    $('.clrBtn').click(function(){
        $('#searchBox').val('');
        $(".tab .tabRow").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf('') > -1)
      $('.hidTab').collapse('hide');
      $(this).find('.eye').removeClass('bi-eye-slash-fill');
      $(this).find('.eye').addClass('bi-eye-fill');
    });
    })
</script>