<h1 class="text-muted headers-padding">Lista zamówień</h1>
    <hr class="divider mt-0">
    <div class="headers-padding container-fluid" style="padding-right: 15px;">

    <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="input-group">
            <input type="text" class="form-control" id="searchBox" placeholder="Wyszukaj zamówienie">
            <button type="button" class="btn bg-transparent clrBtn" style="margin-left: -40px; z-index: 100;">
                            <i class="bi bi-x"></i>
                            </button>
                <span class="input-group-text"><i class="bi bi-search"></i></span>
            </div>
        </div>
        <?php if(!empty($data['orders'])){
                $ordersArray = $data['orders'];
                $itemsInOrder = $data['orderItems'];
                $i=1;
                foreach ($ordersArray as $order){
                    echo "
                        <div class='m-0 p-0 order_row'>
                        <div class='row'>
                            <a class='text-decoration-none text-dark' href=' " . ROOT . $data['orderpath']."orderview/". $order['id'] ."'>
                            <div class='col-12 col-xl-1 text-center align-self-center d-block'><i class='bi bi-basket2 img-thumbnail' style='font-size:75px;'></i>
                            </a>
                            </div>
                            <div class='col-12 col-xl-10 ms-1 ms-md-2'>
                                <div class='row'>
                
                                        <div class='col-md-4'>
                                          <a class='text-decoration-none text-dark'  href=' " . ROOT . $data['orderpath']."orderview/". $order['id'] ."'>
                                            <span><strong>Stan zamówienia: " . $order['orderstate'] . "</strong></span> <br />
                                            Kwota: " . $order['price'] . " zł<br />
                                            Forma dostawy: " . $order['smName'] . " <br />
                                            Numer paczki: " . $order['trackingnumber'] . " <br />
                                            <input type='hidden' id='idd".$i."' value='".$order['id']."'>
                                            <input type='hidden' id='state".$i."' value='".$order['orderstate']."'>
                                            <input type='hidden' id='tracking".$i."' value='".$order['trackingnumber']."'>
                                          </a>
                                        </div>
                                
                                    <div class='col-md-6'>
                                      <a class='text-decoration-none text-dark' href=' " . ROOT . $data['orderpath']."orderview/". $order['id'] ."'>
                                        Dane: " . $order['ordername']  . " " . $order['orderlastname'] . " <br/>
                                        Adres email: " . $order['email'] . " <br />
                                        Numer telefonu: " . $order['orderphonenumber'] . " <br />
                                        Kupujący: " . $order['user'] . " <br/>
                                        <div class='col-md-12'>Adres dostawy: " . $order['ordercountry'] . ", woj. " . $order['ordervoivodeship'] . ", 
                                        " . $order['orderpostcode'] . ", " . $order['ordercity'] . " ul. " . $order['orderstreet'] . " " . $order['orderhomenumber'] ."
                                        <br/> Data złożenia zamówienia: " . $order['orderdate'] . "
                                        </div>
                                      </a>
                                    </div>
                                    <div class='col-md-2 align-self-center d-block'>
                                    <button type='button' class='btn btn-dark editBtn'
                                    data-bs-toggle='modal' order='".$i."'  data-bs-target='#orderModal'><i class='bi bi-pencil'></i></button>

                                    <button type='button' class='btn btn-dark tabBtn'
                                    data-bs-toggle='collapse' href='#orderItems".$i."' aria-expanded='false'><i class='bi bi-eye-fill eye'></i></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class='collapse mt-3 hidTab' id='orderItems".$i."'>
                            <table class='table table-active coltab m-0'>
                            <thead>
                                <tr>
                                <th>Produkt</th>
                                <th>Producent</th>
                                <th>Kraj</th>
                                <th>Cena</th>		
                                <th>Ilość</th>	
                                </tr>
                                </thead>	
                                <tbody>";
                                    foreach($itemsInOrder[$order['id']] as $item){
                                        echo  "<tr>
                                                <td>
                                                    {$item['item']}
                                                </td>
                                                <td>
                                                    {$item['mnf']}
                                                </td>
                                                <td>
                                                    {$item['country']}
                                                </td>
                                                <td>
                                                    {$item['price']}
                                                </td>
                                                <td>
                                                    {$item['amount']}
                                                </td>
                                            </tr>";
                                    }
                              echo  "</tbody>
                        </table>
                          </div>
                        </div><hr class='divider mt-3'>
                        </div>";
                        $i++;
                }}else{echo "Brak zamówień.";}?>
    </div>

    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Status zamówienia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
            <input type="hidden" class="form-control" id="orderid" name="orderid">

            <div class="form-floating mb-2" >
                <input type="text" class="form-control" id="ordertracking" name="trackingnumber" placeholder="nr">
                <label for="ordertracking">Numer przesyłki</label>
            </div>

            <div class="form-floating">
                <select class="form-select" id="orderstate" name="orderstate">
                    <option value="Do akceptacji"> Do akceptacji</option>
                    <option value="W realizacji"> W realizacji</option>
                    <option value="Spakowany"> Spakowany</option>
                    <option value="Wysłany"> Wysłany</option>
                    <option value="Dostarczony"> Dostarczony</option>
                    <option value="Anulowany"> Anulowany</option>
                </select>
                <label >Status zamówienia</label>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
        <button type="submit" class="btn btn-primary" name="stateSubmit">Zapisz</button>
      </div>
    </div>
    </form>
  </div>
</div>


<script>
    document.getElementById('store_collapse').classList.add('show');
    document.getElementById('store_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('store_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('ord_list').setAttribute( 'style', 'color:white !important' );

    $(".editBtn").click(function(){
        var order=$(this).attr('order');
        var idd=$('#idd'+order).val();
        $('#orderid').val(idd);

        var tracking=$('#tracking'+order).val();
        $('#ordertracking').val(tracking);

        var state=$('#state'+order).val();
        $('#orderstate').val(state).change();

    })

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

    $(document).ready(function(){
  $("#searchBox").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".order_row").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      $('.hidTab').collapse('hide');
      $(this).find('.eye').removeClass('bi-eye-slash-fill');
      $(this).find('.eye').addClass('bi-eye-fill');
    });
  });
});

$('.clrBtn').click(function(){
        $('#searchBox').val('');
        $(".order_row").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf('') > -1)
      $('.hidTab').collapse('hide');
      $(this).find('.eye').removeClass('bi-eye-slash-fill');
      $(this).find('.eye').addClass('bi-eye-fill');
    });
    })

</script>