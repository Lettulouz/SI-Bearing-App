
<h1 class="text-muted headers-padding">Lista kategorii</h1>
    <hr class="divider mt-0">
    <div class="headers-padding" style="padding-right: 15px;">
    <div class="col-12 col-md-6 col-lg-4">
            <div class="input-group">
            <input type="text" class="form-control" id="searchBox" placeholder="Wyszukaj kategorię">
            <button type="button" class="btn bg-transparent clrBtn" style="margin-left: -40px; z-index: 100;">
                            <i class="bi bi-x"></i>
                            </button>
                <span class="input-group-text"><i class="bi bi-search"></i></span>
            </div>
        </div>

        <?php if($data['categoriesArray']) {?>
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
        $categories = $data['categoriesArray'];
        $rmPath=$data['rmpath'];
        $editPath = $data['editpath'];
        $i = 1;
        foreach($categories as $category) 
        {
            $id = $category['id'];
            $name = $category['name'];
            echo 
            "<tr class='tabrow'>
            <td>{$i}</td>   
            <td>{$category['name']}</td>
            <td class='px-0 mx-0'>
                <button type='button' data-toggle='collapse' class='btn btn-dark d-inline btn-sm mx-1 tabBtn' 
                data-bs-toggle='collapse' data-bs-target='#row".$i."' aria-expanded='false'>
                <i class='bi-gear-fill'> </i>
                </button>
                <a href='".$rmPath."/".$id."' type='button' data-toggle='collapse' class='btn btn-danger d-inline btn-sm mx-1 tabBtn'>
                <i class='bi bi-trash-fill'> </i>
                </a>
            </td>
            </tr>";
            echo "<tr>
                    <td colspan='12' class='p-0'>
                            <div class='hidTab collapse container' id='row".$i."'>
                            <form  method='POST' class='form-inline row p-1' action ='".$editPath."/".$id."'>
                            <div class='d-flex justify-content-end'>
                                <input type='submit' class='btn btn-primary  p-1' value='Edytuj' />
                            <div class='col-sm-2 col-5 mx-2'>
                                <input type='text' name='edit_categ' class='form-control ' value='{$category['name']}'/>
                            </div>
                            </div>
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
    document.getElementById('categ_list').setAttribute( 'style', 'color:white !important' );

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