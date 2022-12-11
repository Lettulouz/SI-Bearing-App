<h1 class="text-muted headers-padding">Lista produktów</h1>
    <hr class="divider ">
    <div class="headers-padding" style="padding-right: 15px;">
        <?php if($data['itemsArray']) {?>
        <table class="table text-center">
        <thead>
        <tr>
        <th>Lp.</th>
        <th>Nazwa</th>
        <th>Nazwa firmy</th>
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
            "<tr>
            <td>".$j."</td>
            <td>{$item['itemName']}</td>
            <td>{$item['manufacturerName']}</td>
            <td>{$item['amount']}</td>
            <td>{$item['price']} zł</td>
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
</script>