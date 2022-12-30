<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>

<h1 class="text-muted headers-padding">Lista produktów</h1>
    <hr class="divider mt-0">


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
        <th></th>
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
                    <div class='btn-group' role='group' aria-label='Basic example'>
                        <button type='button' data-toggle='collapse' class='btn btn-dark d-inline btn-sm tabBtn' 
                        data-bs-toggle='collapse' data-bs-target='#row".$j."' aria-expanded='false'>
                            <i class='bi bi-bar-chart-steps'></i>
                        </button>

                        <button type='button' data-toggle='collapse' class='btn btn-dark d-inline btn-sm  tabBtn' 
                        data-bs-toggle='collapse' data-bs-target='#row".$j."2' aria-expanded='false'>
                            <i class='bi bi-journals'></i>
                        </button>

                        <button type='button' data-toggle='collapse' class='btn btn-dark d-inline btn-sm  tabBtn' 
                        data-bs-toggle='collapse' data-bs-target='#row".$j."3' aria-expanded='false'>
                            <i class='bi bi-journal-richtext'></i>
                        </button>
                    </div>

                    <button type='button' class='btn btn-dark d-inline btn-sm mx-1 editBtn' data-bs-toggle='modal' data-bs-target='#editModal' value=''>
                        <i class='bi bi-gear-fill'></i>
                    </button>
                </td>
            </tr>
            
            <tr>
                <td colspan='12' class='p-0'>
					          <div class='hidTab collapse' id='row".$j."'>
                        <table class='table table-active coltab m-0'>
                            <thead>
                                <tr>
                                <th>Kategorie</th>
                                </tr>
                                </thead>	
                                <tbody>";
                                     foreach($data['categoriesArray'][$item['iid']] as $ctr){
                                        echo  "<tr>
                                                <td class='categName'>
                                                    {$ctr['categname']}
                                                </td>
                                            </tr>";
                                    }
                              echo  "</tbody>
                        </table>
                    </div>

                    <div class='hidTab collapse' id='row".$j."2'>
                        <table class='table table-active coltab m-0'>
                            <thead>
                                <tr>
                                <th>Atrybuty</th>
                                </tr>
                                </thead>	
                                <tbody>";
                                     foreach($data['catalogArray'][$item['iid']] as $cat){
                                        echo  "<tr>
                                                <td class='catalogName'>
                                                    {$cat['catname']}
                                                </td>
                                            </tr>";
                                    }
                              echo  "</tbody>
                        </table>
                    </div>

                    <div class='hidTab collapse' id='row".$j."3'>
                        <table class='table table-active coltab m-0'>
                            <thead>
                                <tr>
                                <th>Atrybut</th>
                                <th>Wartość</th>
                                </tr>
                                </thead>	
                                <tbody>";
                                     foreach($data['attrArray'][$item['iid']] as $attr){
                                        echo  "<tr>
                                                <td class='attrName'>
                                                    {$attr['attrname']}
                                                </td>
                                                <td >
                                                    {$attr['aval']}
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
      $('.hidTab').collapse('hide');
    });
  });
});

$('.tabBtn').click(function() {
      if($(this).attr('aria-expanded')=='true'){

      }
      else if($(this).attr('aria-expanded')=='false'){
      }   
     });

$('.clrBtn').click(function(){
        $('#searchBox').val('');
        $(".tabrow").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf('') > -1)
      $('.hidTab').collapse('hide');
    });
    })
</script>