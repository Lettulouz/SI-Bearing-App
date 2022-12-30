<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<h1 class="text-muted headers-padding">Lista produktów</h1>
    <hr class="divider ">


    <div class="headers-padding" style="padding-right: 15px;">

    <div class="col-12 col-md-6 col-lg-4">
            <div class="input-group">
            <input type="text" class="form-control" id="searchBox" placeholder="Wyszukaj produkt">
            <button type="button" class="btn bg-transparent clrBtn" style="margin-left: -40px; z-index: 100;">
                            <i class="bi bi-x"></i>
                            </button>
                <span class="input-group-text"><i class="bi bi-search"></i></span>
            </div>
        </div>

        <?php if($data['itemsArray']) {?>
        <table class="table text-center">
        <thead>
        <tr>
        <th>Lp.</th>
        <th>Nazwa produktu</th>
        <th>Nazwa firmy</th>
        <th>Kraj</th>
        <th>Ilość</th>
        <th>Cena</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $j = 0; // dodałwm j, po jak wyświetlało z i to miałem errory. Wojtek
        $items = $data['itemsArray'];
        //foreach($items as $i => $item) 
        foreach($items as $j => $item) 
        {
            $j++;
            echo 
            "<tr class='tabrow'>
            <td>".$j."</td>
            <td>{$item['itemName']}</td>
            <td>{$item['manufacturerName']}</td>
            <td>{$item['manufacturerCountry']}</td>
            <td>{$item['amount']}</td>
            <td>{$item['price']} zł</td>
            <td class='px-0 mx-0'>
            <button type='button' data-toggle='collapse' class='btn btn-dark d-inline btn-sm mx-1 tabBtn' 
            data-bs-toggle='collapse' data-bs-target='#row".$j."' aria-expanded='false'>
            <i class='eye bi bi-eye-fill'></i>
            </button>
            <button type='button' class='btn btn-dark d-inline btn-sm mx-1 editBtn' data-bs-toggle='modal' data-bs-target='#editModal' value='{$mnf['m_id']}'>
            <i class='bi bi-gear-fill'></i>
            </button>
            <a href='".$rmPath."/".$mnf['m_id']."' type='button' data-toggle='collapse' class='btn btn-danger d-inline btn-sm mx-1 tabBtn'>
            <i class='bi bi-trash-fill'></i>
            </a>
            </td>
            </tr>
            
            <tr>
                <td colspan='12' class='p-0'>
					          <div class='hidTab collapse' id='row".$j."'>
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
            
            /*
            echo 
            "<tr>
            <td>".$i+'1'."</td>
            <td>{$item['itemName']}</td>
            <td>{$item['manufacturerName']}</td>
            <td>{$item['amount']}</td>
            <td>{$item['price']}</td>
            </tr>";
            */
        }
        ?>
        </tbody>
        </table>
        <?php } else {echo "Brak dodanych przedmiotów.";}?>
    </div>

<script>
    document.getElementById('content_collapse').classList.add('show');
    document.getElementById('content_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('content_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('prd_list').setAttribute( 'style', 'color:white !important' );


    $(document).ready(function(){
  $("#searchBox").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".tabrow").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
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