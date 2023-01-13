
<h1 class="text-muted headers-padding">Lista metod dostawy</h1>
    <hr class="divider mt-0 ">
    <div class="headers-padding" style="padding-right: 15px;">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="input-group">
                <input type="text" class="form-control" id="searchBox" placeholder="Wyszukaj metodę">
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
                            style="height:30px; width:30px;" <?php if($data['shippingOnlyActive']==1) echo "checked"?>>          
                        </div>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                        <input type="submit" class="btn btn-primary mt-2 d-block" id="onlyActiveSubmit" 
                        name="onlyActiveSubmit" value="Potwierdź">
                    </div>
                </div>   
            </form>
        </div>

        <?php if(!empty($data['shippingArray'])) {?>
        <table class="table text-center">
        <thead>
        <tr>
        <th>Lp.</th>
        <th>Nazwa</th>
        <th>Opłata</th>
        <th></th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $methods = $data['shippingArray'];
        $editPath = $data['editpath'];
        $i = 1;
        foreach($methods as $method) 
        {
            $id = $method['id'];
            $name = $method['name'];
            echo 
            "<tr class='tabrow'>
            <td>{$i}</td>   
            <td>{$method['name']}</td>
            <td>{$method['price']} zł</td>
            <td class='px-0 mx-0'>
                <button type='button' data-toggle='collapse' class='btn btn-dark d-inline btn-sm mx-1 tabBtn' 
                data-bs-toggle='collapse' data-bs-target='#row".$i."' aria-expanded='false'>
                <i class='bi-gear-fill'> </i>
                </button>
            </td>
            </tr>";
            echo "<tr>
                    <td colspan='12' class='p-0 border-0'>
                            <div class='hidTab collapse container' id='row".$i."'>
                            <form  method='POST' class='form-inline row p-1' action ='".$editPath."/".$id."'>
                            <div class='d-flex justify-content-end'>

                            <div class='form-check form-switch me-3'>
                            <label class='form-check-label d-none d-sm-inline-block' 
                            style='margin-top: 5px; margin-left: 5px; margin-right: 10px; font-weight: bold; font-size:18px' 
                            for='methActive'>Aktywne</label>
                            <input class='form-check-input methActive' style='height:30px; width:60px;' type='checkbox' 
                            id='methActive' name='methActive' ";
                            if($method['active']==1){
                              echo 'checked';
                            }
                            echo">
                            </div>
                            <div class='form-check form-switch me-3'>
                            <label class='form-check-label d-none d-sm-inline-block' 
                            style='margin-top: 5px; margin-left: 5px; margin-right: 10px; font-weight: bold; font-size:18px' 
                            for='needAddress'>Adres</label>
                            <input class='form-check-input needAddress' style='height:30px; width:60px;' type='checkbox' 
                            id='needAddress' name='needAddress' ";
                            if($method['needaddress']==1){
                              echo 'checked';
                            }
                            echo">
                            </div>
                        <input type='submit' class='btn btn-primary  p-1' value='Edytuj' />
                            </div>
                            </div>
                            </form>
                    </td>
                    </tr>";

            $i++;
        }
        ?>
        </tbody>
        </table>
        <?php } else {echo "Brak dodanych metod wysyłki.";}?>
        
    </div>

<script>
    document.getElementById('store_collapse').classList.add('show');
    document.getElementById('store_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('store_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('listspmt').setAttribute( 'style', 'color:white !important' );

    $(document).ready(function(){
  $("#searchBox").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".tabrow").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      $('.hidTab').collapse('hide');
    });
  });



});


$('.clrBtn').click(function(){
        $('#searchBox').val('');
        $(".tabrow").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf('') > -1)
    });
    })
</script>