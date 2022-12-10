<h1 class="text-muted headers-padding">Lista katalogów</h1>
    <hr class="divider ">
    <div class="headers-padding" style="padding-right: 15px;">
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
        <tbody>
        <?php 
        $catalogs = $data['catalogsArray'];
        $itemsInCat = $data['catalogsItems'];
        $i = 1;
        foreach($catalogs as $catalog) 
        {
            echo 
            "<tr>
            <td>{$i}</td>
            <td>{$catalog['name']}</td>
            <td>{$catalog['amount']}</td>
            <td> <button type='button' data-toggle='collapse' class='btn btn-dark d-inline btn-sm tabBtn' 
            data-bs-toggle='collapse' data-bs-target='#row".$i."' aria-expanded='false'>
            <i class='bi bi-eye-fill'></i>
            </button>
            </td>
            </tr>

            <tr>
                <td colspan='12' class='p-0'>
					<div class=' collapse' id='row".$i."'>
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
                                                <td>
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

<script>
    document.getElementById('content_collapse').classList.add('show');
    document.getElementById('content_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('content_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('cat_list').setAttribute( 'style', 'color:white !important' );

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


</script>