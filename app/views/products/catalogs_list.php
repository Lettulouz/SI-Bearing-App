<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
<div class="row m-0">
<h1 class="text-muted headers-padding col-6">Lista katalogów</h1>
    <hr class="divider "> 
    <div class="headers-padding container-fluid" style="padding-right: 15px;">
    
        <div class="col-12 col-md-6 col-lg-4">
            <div class="input-group">
            <input type="text" class="form-control" id="searchBox" placeholder="Wyszukaj katalog">
            <div class="input-group-append">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
            </div>
            </div>
        </div>

        <?php if($data['catalogsArray']) {?>
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
        $catalogs = $data['catalogsArray'];
        $itemsInCat = $data['catalogsItems'];
        $rmPath=$data['rmpath'];
        $i = 1;
        foreach($catalogs as $catalog) 
        {
            echo 
            "<tr class='tabRow'>
            <td>{$i}</td>
            <td>{$catalog['name']}</td>
            <td>{$catalog['amount']}</td>
            <td class='px-0 mx-0'>
            <button type='button' data-toggle='collapse' class='btn btn-dark d-inline btn-sm mx-1 tabBtn' 
            data-bs-toggle='collapse' data-bs-target='#row".$i."' aria-expanded='false'>
            <i class='eye bi bi-eye-fill'></i>
            </button>
            <button type='button' class='btn btn-dark d-inline btn-sm mx-1 editBtn' data-bs-toggle='modal' data-bs-target='#editModal' value='{$catalog['id']}'>
            <i class='bi bi-gear-fill'></i>
            </button>
            <a href='".$rmPath."remove_catalog/".$catalog['id']."' type='button' data-toggle='collapse' class='btn btn-danger d-inline btn-sm mx-1 tabBtn'>
            <i class='bi bi-trash-fill'></i>
            </a>
            </td>
            </tr>

            <tr>
                <td colspan='12' class='p-0'>
					<div class='hidTab collapse' id='row".$i."'>
                        <table class='table table-active coltab m-0'>
                            <thead>
                                <tr>
                                <th>Producent</th>
                                <th>Produkt</th>
                                <th>Stan magazynowy</th>		
                                <th>Cena</th>	
                                </tr>
                                </thead>	
                                <tbody>";
                                    foreach($itemsInCat[$catalog['id']] as $item){
                                        echo  "<tr>
                                                <td>
                                                    {$item['mn_name']}
                                                </td>
                                                <td class='itemName".$catalog['id']." ".$item['id_item']."'>
                                                    {$item['name_item']}
                                                </td>
                                                <td>
                                                    {$item['amount']}
                                                </td>
                                                <td>
                                                    {$item['price']}
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


        <!--Edit catalog window-->

        <div class="modal fade" id="editModal"  aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edytuj Katalog</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST">
            <div class="modal-body">
            <input type='hidden' id="catid" name="catid" class="form-control"> 
                    <div class="form-floating my-2">
                            <input type="text" class="form-control" id="catalogName" name="catname" placeholder="Grontex">
                            <label for="catalogNameInput">Nazwa katalogu</label>
                        </div>
                        <hr>
                            <select class="select2 form-select-lg my-2"  multiple="multiple" id="item" name="itemcat[]" aria-label="example-xl"  aria-autocomplete="TRUE">
                                    <?php
                                           foreach($data['items'] as $i => $result) {
                                            echo "<option class='itemList' value=".$result['item_id'].">".$result['mnf']." - ".$result['item']."</option>";
                                        }
                                    ?>
                            </select>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                <button type="submit" name="catEditSub" class="btn btn-primary">Edytuj</button>
            </div>
        </form>
        </div>
    </div>
    </div>


<script>
    document.getElementById('content_collapse').classList.add('show');
    document.getElementById('content_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('content_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('cat_list').setAttribute( 'style', 'color:white !important' );

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

    //pass catalog data to edit modal
    $('.editBtn').click(function(){
        var catName=$(this).parent().parent().children('td').eq(1).text();
        var catItems=$('.itemName'+$(this).attr('value')).map(function() {
            return this.className.split(' ')[1];
            }).get();
        $('#item').val(catItems);
        $('#item').trigger('change');
        $('#catid').val($(this).attr('value'));
        $('#catalogName').val(catName);
        
    })

    //remove items from select after hide modal
    $('#editModal').on('hidden.bs.modal', function () {

        $('#item').val(null).trigger('change');
    })

    //select properties
    $('#item').select2({
    width: 'auto',
    theme: 'bootstrap-5',
    placeholder: 'Wybierz produkty',
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

</script>