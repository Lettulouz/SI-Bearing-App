
<h1 class="text-muted headers-padding">Lista atrybutów</h1>
    <hr class="divider ">
    <div class="headers-padding" style="padding-right: 15px;">
        <?php if($data['attributesArray']) {?>
        <table class="table text-center">
        <thead>
        <tr>
        <th>Lp.</th>
        <th>Nazwa</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $attribut = $data['attributesArray'];
        $i = 1;
        foreach($attribut as $attribut) 
        {
            echo 
            "<tr>
            <td>{$i}</td>
            <td>{$attribut['name']}</td>
            </tr>";
            $i++;
        }
        ?>
        </tbody>
        </table>
        <?php } else {echo "Brak dodanych atrybutów.";}?>
    </div>

<script>
    document.getElementById('content_collapse').classList.add('show');
    document.getElementById('content_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('content_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('attr_list').setAttribute( 'style', 'color:white !important' );
</script>