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
        </tr>
        </thead>
        <tbody>
        <?php 
        $catalogs = $data['catalogsArray'];
        $i = 1;
        foreach($catalogs as $catalog) 
        {
            echo 
            "<tr>
            <td>{$i}</td>
            <td>{$catalog['name']}</td>
            <td>{$catalog['amount']}</td>
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
</script>