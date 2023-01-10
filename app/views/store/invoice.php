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
                              <div class='price-wrap'> {$data['numberOfItems'][$j]} szt</div>
                          <td>
                              <div class='price-wrap'> <var class='price' id='{$item['itemID']}'> {$data['totalItemPrice'][$j]} zł </var> 
                              <br><small class='text-muted'>{$item['itemPrice']} zł każdy </small> </div>
                          </td>
                      </tr>";
                  }
                ?>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2" >Kwota zamówienia <strong id='totalItemPrice'> <?php echo $data['totalOrderPrice'] ?> zł</strong></td>
                <td class="text-end"></td>
              </tr>
              <tr>
                <td colspan="2">Wysyłka <strong id='orderPrice'></strong></td>
                <td class="text-end"></td>
              </tr>
              <tr class="fw-bold">
                <input type='hidden' id='totalOrderPriceH' value ='<?php echo $data['totalOrderPrice'] ?>'>
                <td colspan="2">Razem <strong id='totalOrderPrice'> <?php echo $data['totalOrderPrice'] ?>zł</strong></td>
                <td class="text-end"></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- Payment -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <h3 class="h6">Płatność i dostawa</h3>
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

                <div class='row'>
                        <div class="col-12 p-1">
                        <select class="form-select form-select-sm delivery" name="shipping">
                          <option selected disabled>Dostawa</option>
                          <option value="1">Odbiór osobisty</option>
                          <option value="2">Kurier</option>
                        </select>
                        </div>
                </div>

            </div>
            <div class="col-lg-6">
              <h3 class="h6">Dane dostawy</h3>
              <div class='row'>
                <div class="col-12 col-md-6 col-lg-4 p-1">
                  <input class="form-control form-control-sm" type="text" name="name" placeholder="Imię" required>
                </div>
                <div class="col-12 col-md-6 col-lg-4 p-1">
                  <input class="form-control form-control-sm" type="text" name="surname" placeholder="Nazwisko" required>
                </div>
              </div>
              <div class='row'>
                <div class="col-12 col-md-6 col-lg-4 p-1">
                  <input class="form-control form-control-sm" type="text" name="city" placeholder="Miasto" required>
                </div>
                <div class="col-12 col-md-6 col-lg-4 p-1">
                  <input class="form-control form-control-sm" type="text" name="postcode" placeholder="Kod pocztowy" required>
                </div>
              </div>
              <div class='row'>
                <div class="col-12 col-md-6 col-lg-4 p-1">
                  <input class="form-control form-control-sm" type="text" name="city" placeholder="Ulica" required>
                </div>
                <div class="col-6 col-md-3 col-lg-3 p-1">
                  <input class="form-control form-control-sm" type="number" name="postcode" placeholder="Nr budynku" required>
                </div>
                <div class="col-6 col-md-3 col-lg-3 p-1">
                  <input class="form-control form-control-sm" type="number" name="postcode" placeholder="Nr mieszkania" >
                </div>
              </div>
              <div class='row'>
                <div class="col-12 col-md-6 col-lg-4 p-1">
                  <input class="form-control form-control-sm" type="text" name="Country" placeholder="Kraj" required>
                </div>
                <div class="col-12 col-md-6 col-lg-4 p-1">
                  <input class="form-control form-control-sm" type="text" name="voivoden" placeholder="Województwo" required>
                </div>
              </div>
              <div class='row'>
                <div class=" col-9 col-md-6 p-1">
                  <input class="form-control form-control-sm" type="tel" name="Country" placeholder="numer telefonu" required>
                </div>

                <div class=" col-auto p-1 float-end">
                  <input type="submit"  class="btn btn-primary btn-sm">
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

      
    </div>
  </div>
</div>
  </div>
  <?php include dirname(__FILE__,2) . "/footer.php"; ?>

  <script>
    $( ".delivery" ).change(function() {
      if($(this).val() == 1){
        document.getElementById('orderPrice').innerHTML = '10 zł';
        document.getElementById('totalOrderPrice').innerHTML = parseFloat(document.getElementById('totalOrderPriceH').value) + 10 + " zł";
      }
      else if($(this).val() == 2){
        document.getElementById('orderPrice').innerHTML = '5 zł';
        document.getElementById('totalOrderPrice').innerHTML = parseFloat(document.getElementById('totalOrderPriceH').value) + 5 + " zł";
      }
    });
</script>