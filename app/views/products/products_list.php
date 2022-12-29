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
        <th>Nazwa</th>
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