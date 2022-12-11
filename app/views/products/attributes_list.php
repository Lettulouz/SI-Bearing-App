
<h1 class="text-muted headers-padding">Lista atrybutów</h1>
    <hr class="divider ">
    <div class="headers-padding" style="padding-right: 15px;">
        <?php if($data['attributesArray']) {?>
        <table class="table text-center">
        <thead>
        <tr>
        <th>Lp.</th>
        <th>Nazwa</th>
        <th></th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $attribut = $data['attributesArray'];
        $rmPath=$data['rmpath'];
        $i = 1;
        foreach($attribut as $attribut) 
        {
            $id = $attribut['id'];
            $name = $attribut['name'];
            echo 
            "<tr>
            <td>{$i}</td>   
            <td>{$attribut['name']}</td>
            <td class='px-0 mx-0'>
                <button type='button' data-toggle='collapse' class='btn btn-dark d-inline btn-sm mx-1 tabBtn' 
                data-bs-toggle='collapse' data-bs-target='#row".$i."' aria-expanded='false'>
                <i class='bi-gear-fill'> Edytuj</i>
                </button>
                <a href='".$rmPath."/".$id ."' type='button' data-toggle='collapse' class='btn btn-danger d-inline btn-sm mx-1 tabBtn'>
                <i class='bi bi-trash-fill'> Usuń</i>
                </a>
            </td>
            </tr>";
            echo "<tr>
                    <td colspan='12' class='p-0'>
                    <div class=' collapse' id='row".$i."'>
                    <br/>
                    <form  method='post'>
                    <input type='submit' value='Edytuj' />
                    <input type='text' value='{$attribut['name']}'/>
                    </form >
                    </div>
                    </td>
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