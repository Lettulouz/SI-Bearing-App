<?php include "header.php"; ?>
<?php include "navbar_top.php"; ?>

<div class="container-fluid">

<div class="container">
  <!-- Title -->
  <div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Zamówienie </h2>
  </div>

  <!-- Main content -->
  <div class="row">
    <div class="col-lg-8">
      <!-- Details -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="mb-3 d-flex justify-content-between">
            <div>
              <span class="me-3"><?php echo date('d/m/Y');?></span>
            </div>
          </div>
          <table class="table table-borderless">
            <tbody>
              <tr>
                <?php
                  $items = $data['itemsArray'];
                  foreach($items as $j => $item) 
                  {
                      $imagePath = APPPATH . "/resources/itemsPhotos/[" . $item['itemID'] . "].png";
                      $imagePathCheck = RESOURCEPATH . "/[" . $item['itemID'] . "].png";
                      if(!file_exists($imagePathCheck)){
                          $imagePath = APPPATH . "/resources/itemsPhotos/brak_zdjecia.png";
                      }
                      echo "
                      <tr>
                          <td>
                              <figure class='itemside align-items-center'>
                                  <div class='aside'><img src='$imagePath' class='img-sm'></div>
                                  <figcaption class='info'> <a href='#' class='title text-dark' data-abc='true'>{$item['name']}</a>
                                      <p class='text-muted small'> Firma: {$item['name2']} </p>
                                  </figcaption>
                              </figure>
                          </td>
                          <td> 
                              <div class='price-wrap'> {$_SESSION['numberOfItems'][$j]} szt</div>
                          <td>
                              <div class='price-wrap'> <var class='price' id='{$item['itemID']}'> {$_SESSION['totalItemPrice'][$j]} zł </var> 
                              <br><small class='text-muted'>{$item['itemPrice']} zł każdy </small> </div>
                          </td>
                      </tr>";
                  }
                ?>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2" >Kwota zamówienia <strong id='totalItemPrice'> <?php echo $_SESSION['totalOrderPrice'] ?> zł</strong></td>
                <td class="text-end"></td>
              </tr>
              <tr>
                <td colspan="2">Prowyizja formy platności <strong id='paymentFee'></strong></td>
                <td class="text-end"></td>
              </tr>
              <tr>
                <td colspan="2">Wysyłka <strong id='shippingPrice'></strong></td>
                <td class="text-end"></td>
              </tr>
              <tr class="fw-bold">
                <td colspan="2">Razem <strong id='totalOrderPrice'> <?php echo $_SESSION['totalOrderPrice'] ?> zł</strong></td>
                <td class="text-end"></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- Payment -->
      <form class='m-0 p-0' action='' method='POST' id='formOrderSubmit' onsubmit="event.preventDefault(); clearStorage();">
        <div class="card mb-4">
          <div class="card-body"> 
            <div class="row">
              <div class="col-lg-6">

              <fieldset id="cardPayment"></fieldset>
                
              <input type='hidden' id='totalOrderPriceH' value ='<?php echo $_SESSION['totalOrderPrice'] ?>'>
              <input type='hidden' id='paymentPriceH' value ='0'>

                
                <fieldset id="paymentMethod"></fieldset>

                  <div class='row'>
                          <div class="col-12 p-1">
                            <select class="form-select form-select-sm payment" name="payment">
                              <option selected disabled>Rodzaj płatności</option>
                              <?php foreach($data['paymentmethods'] as $paymentmethod) {
                                echo "<option value='{$paymentmethod['methodId']}'>{$paymentmethod['methodName']}</option>";
                              }
                              ?>
                            </select>
                          </div>
                  </div>
              
              </div>
              <div class="col-lg-6">
                <fieldset id="payment"></fieldset>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

      
    </div>
  </div>
</div>
  </div>
  <?php include dirname(__FILE__,2) . "/footer.php"; ?>

  <script>


    $( ".payment" ).change(function() {
      var html;
      var options = '';
      $("#paymentMethod > div").remove();
      $("#paymentMethod  h3").remove();
      $("#payment div").remove();
      $("#payment h3").remove();
      var paymentMethods = <?php echo json_encode($data['paymentmethods']); ?>;
      var shippingMethods = <?php echo json_encode($data['shippingmethods']); ?>;
      for(var shippingMethod of shippingMethods){
        options += "<option value=\""+shippingMethod['id']+"\" > "+shippingMethod['name']+" </option>"
      }
      for(var paymentMethod of paymentMethods){
        if($(this).val() == paymentMethod['methodId'] && paymentMethod['typeName'] == 'cash'){
          html = $(`<div class=\"row\" >
                    <div class=\"col-12 p-1\" >
                      <select class=\"form-select form-select-sm delivery\" name=\"delivery\" >
                        <option> Dostawa </option>
                        ${options}
                      </select>
                    </div>
                  </div>`);

          $("#paymentPriceH").val(Math.trunc(paymentMethod['fee']*100)/100);
          $('#paymentFee').html(Math.trunc(paymentMethod['fee']*100)/100+' zł');
          $('#totalOrderPrice').html(Math.trunc((parseFloat(paymentMethod['fee'])+parseFloat($("#totalOrderPriceH").val()))*100)/100+' zł');

          $("#paymentMethod").append(html);
        }
        else if($(this).val() == paymentMethod['methodId'] && paymentMethod['typeName'] == 'card'){
          html = $(`<h3 class="h6">Płatność i dostawa</h3>
                  <div class='row'>
                      <div class="col-12 p-1">
                        <input class="form-control form-control-sm" type="text" name="cardname" placeholder="Właściciel karty" required>
                      </div>
                  </div>

                  <div class='row'>
                      <div class="col-12 p-1">
                        <input class="form-control form-control-sm py-0" type="number" name="cardnumber" pattern="[0-9]{12}" placeholder="Numer karty" required>
                      </div>
                  </div>

                  <div class='row'>
                          <div class="col-12 col-md-6 p-1">
                            <input class="form-control form-control-sm" type="text" name="expires" pattern="(0[1-9]|1[0-2])\/?([0-9]{2})" placeholder="Data wygaśnięcia" required>
                          </div>
                          <div class="col-12 col-md-6 p-1">
                            <input class="form-control form-control-sm" type="text" name="cvv" pattern='[0-9]{3, 4}' placeholder="CVV" required>
                          </div>
                  </div>
                  <div class=\"row\" >
                    <div class=\"col-12 p-1\" >
                      <select class=\"form-select form-select-sm delivery\" name=\"delivery\" >
                        <option value=\"1\" > Dostawa </option>
                        ${options}
                      </select>
                    </div>
                  </div>`
                );

          $("#paymentPriceH").val(Math.trunc(paymentMethod['fee']*100)/100);
          $('#paymentFee').html(Math.trunc(paymentMethod['fee']*100)/100+' zł');
          $('#totalOrderPrice').html(Math.trunc((parseFloat(paymentMethod['fee'])+parseFloat($("#totalOrderPriceH").val()))*100)/100+' zł');

          $("#paymentMethod").append(html);
        }
        else if($(this).val() == paymentMethod['methodId'] && paymentMethod['typeName'] == 'external'){
          html = $(`<div class=\"row\" >
                    <div class=\"col-12 p-1\" >
                      <select class=\"form-select form-select-sm delivery\" name=\"delivery\" >
                        <option> Dostawa </option>
                        ${options}
                      </select>
                    </div>
                  </div>`);
  
          $("#paymentPriceH").val(Math.trunc(paymentMethod['fee']*100)/100);
          $('#paymentFee').html(Math.trunc(paymentMethod['fee']*100)/100+' zł');
          $('#totalOrderPrice').html(Math.trunc((parseFloat(paymentMethod['fee'])+parseFloat($("#totalOrderPriceH").val()))*100)/100+' zł');
          
          $("#paymentMethod").append(html);
        }
      }
    });

    $("#paymentMethod").on("change", ".delivery", function() {
      $("#payment div").remove();
      $("#payment h3").remove();
      var shippingMethods = <?php echo json_encode($data['shippingmethods']); ?>;
      var html;
      var options = '';
      for(var shippingMethod of shippingMethods){
        if($(this).val() == shippingMethod['id'] && !shippingMethod['needaddress']){
          html = $(`<div class="col-3 p-1 ">
              <input name='orderSubmit' type="submit" id="orderSubmit"  class="btn btn-primary btn-sm w-100">
            </div>`
          )
          
          $('#shippingPrice').html(Math.trunc(parseFloat(shippingMethod['price'])* 100)/100+' zł');
          $('#totalOrderPrice').html(Math.trunc((parseFloat($("#paymentPriceH").val())+parseFloat($("#totalOrderPriceH").val())
          +parseFloat(shippingMethod['price']))*100)/100+' zł');

          $("#payment").append(html);
        }
        else if($(this).val() == shippingMethod['id'] && shippingMethod['needaddress']){
          html = $(`<h3 class="h6 mt-2">Dane dostawy</h3>
                <div class='row'>
                  <div class="col-12 col-md-6 p-1">
                    <input class="form-control form-control-sm" type="text" name="name" placeholder="Imię" required>
                  </div>
                  <div class="col-12 col-md-6 p-1">
                    <input class="form-control form-control-sm" type="text" name="surname" placeholder="Nazwisko" required>
                  </div>
                </div>
                <div class='row'>
                  <div class="col-12 col-md-6 p-1">
                    <input class="form-control form-control-sm" type="text" name="city" placeholder="Miasto" required>
                  </div>
                  <div class="col-12 col-md-6 p-1">
                    <input class="form-control form-control-sm" type="text" name="postcode" placeholder="Kod pocztowy" required>
                  </div>
                </div>
                <div class='row'>
                  <div class="col-12 col-md-6 p-1">
                    <input class="form-control form-control-sm" type="text" name="street" placeholder="Ulica" required>
                  </div>
                  <div class="col-12 col-md-6 p-1">
                    <input class="form-control form-control-sm" type="number" name="housenumber" placeholder="Numer" required>
                  </div>
                </div>
                <div class='row'>
                  <div class="col-12 col-md-6 p-1">
                    <input class="form-control form-control-sm" type="text" name="country" placeholder="Kraj" required>
                  </div>
                  <div class="col-12 col-md-6 p-1">
                    <input class="form-control form-control-sm" type="text" name="voivoden" placeholder="Województwo" required>
                  </div>
                </div>
                <div class='row'>
                  <div class="col-9 p-1">
                    <input class="form-control form-control-sm" type="tel" name="phonenumber" placeholder="Numer telefonu" required>
                  </div>
                  
                  <div class="col-3 p-1 ">
                    <input name='orderSubmit' type="submit" id="orderSubmit" class="btn btn-primary btn-sm w-100">
                  </div>
                </div>`
            )
              
          $('#shippingPrice').html(Math.trunc(parseFloat(shippingMethod['price'])* 100)/100+' zł');
          $('#totalOrderPrice').html(Math.trunc((parseFloat($("#paymentPriceH").val())+parseFloat($("#totalOrderPriceH").val())
          +parseFloat(shippingMethod['price']))*100)/100+' zł');

          $("#payment").append(html);
        }
      }
    });

    function clearStorage(){
      var newCookie = '';
        Object.keys(sessionStorage).forEach(function(key, value) {
            if (!Number.isNaN(Number.parseInt(key)))
              sessionStorage.removeItem(key);
        });
        var today = new Date();
        var expire = new Date();
        expire.setTime(today.getTime() + 3600000 * 24 * 7);
        document.cookie = 'itemsInCart =;3600, expires=' + expire.toGMTString() + '; path=/';
        
        document.getElementById("formOrderSubmit").submit();
    }
</script>