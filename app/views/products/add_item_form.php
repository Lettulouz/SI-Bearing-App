<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<div class="container-fluid justify-content-between align-items-center">
    <div class="row m-2">
        <div class="col-6">
            <h1 class="text-muted headers-padding">Dodawanie produktu</h1>
        </div>
        <div class="col-6 align-self-center">
            <button type="submit" id="itemSubmitRemote" name="itemSubmit" class="btn btn-primary btn-lg float-end" >Dodaj</button>
        </div>
    </div>
</div>

    <hr class="divider">
<div class="container-fluid justify-content-between">
    <form action="" id="addItemForm" method="POST">

        <div class="row m-2">
            <div class="col-4 border-end border-2">
                <div class="row m-2">
                    <div class="col">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="nameInput" name="name" placeholder="Grontomat">
                            <label for="nameInput">Nazwa</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col">
                        <div class="form-floating ">
                            <input type="number" class="form-control" id="quantityInput" name="price" placeholder="23" step="any">
                            <label for="quantityInput">Cena</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col">
                        <div class="form-floating ">
                            <input type="number" class="form-control" id="quantityInput" name="quantity" placeholder="23">
                            <label for="quantityInput">Ilość</label>
                        </div>
                    </div>
                </div>


                <div class="row m-2">
                    <div class="col-12">
                            <select class="select2 form-control" id="manufacturer" name="manufacturer" aria-label="example-xl" >
                                    <?php
                                        echo "<option></option>";
                                        foreach($data['items'] as $i => $result) {
                                            echo "<option value=".$result['id'].">".$result['name']."</option>";
                                        }
                                    ?>
                            </select>
                    </div>



                    <span style="color:<?php if(isset($_GET['color'])) echo $_GET['color']; ?>">
                    <?php if(isset($_GET['msg'])) echo base64_decode($_GET['msg']); ?></span>
                </div>
            </div>   
            <div class="col-4 border-end border-2">
                <h4>Dodawanie atrybutów</h4>
                <div id="show_item">
                </div>
                <div>
                    <button class="btn btn-success" id="add_item_btn">Dodaj atrybut</button>
                </div>
                <input type="text" style="display:none" id="attributes" name="attributes" data-attr='<?php echo json_encode($data['attributes']); ?>'>
            </div>          
        </div>  
        <button type="submit" id="itemSubmit" name="itemSubmit" class="btn btn-primary btn-lg float-end" style="display:none"></button>
    </form>
</div>

<script>
    var jsArr = JSON.parse($('#attributes').attr('data-attr'));
    var possibleOptions = [];
    jsArr.forEach((id) => {
        possibleOptions.push(id.name);
    });
    possibleOptions.sort();
    var alreadyUsed = [];
    var i=0;
	$(document).ready(function(){
	    $("#add_item_btn").click(function(e){
            e.preventDefault();
            updateList();
            tempPossibleOptions = possibleOptions.filter(ar => !alreadyUsed.find(rm => (rm === ar)));
            i++;
            var html = '';
            html+='<div class="row">';
            html+='<div class="col-5 mb-3">';
            html+='<select class="select2 form-control" id="attribute_name' + i +  '" aria-label="example-xl" onchange="updateList();"';
            html+='<option>';
            html+='test';
            html+='</option>';
            tempPossibleOptions.forEach((id) => {
                    html+='<option>';
                    html+=id;
                    html+='</option>';
            });
            html+='</select>';
            html+='</div>';
            html+='<div class="col-5 mb-3">';
            html+='<input type="text" id="attribute_value' + i + '" class="form-control required" placeholder="Wartość atrybutu" required onkeyup="enableSubmit()" autocomplete="off">';
            html+='</div>';
            html+='<div class="col-2 mb-3 d-grid">';
            html+='<button class="btn btn-danger remove_item_btn">-</button>';
            html+='</div></div>';
            $("#show_item").append(html)
            if(i>=jsArr.length){
                $("#add_item_btn").prop('disabled', true);
            }
            else{
                enableSubmit();
            }
        });
        
        $(document).on('click', '.remove_item_btn', function(e){ 
            e.preventDefault();
            let row_item = $(this).parent().parent();
            let tempRMV = $(this).parent().parent().find('select').attr('id');
            var getValue = "#";
                getValue += tempRMV;
                getValue +=' :selected';
            var attribute_name = $(getValue).text();
            $(row_item).remove();
            i--;
            if(i==0){
                $("#add_item_btn").prop('disabled', false);
            }else{
                enableSubmit();
            }
            alreadyUsed = alreadyUsed.filter(e => e !== attribute_name);
  
        });

        $("#itemSubmitRemote").click(function(e){
            for(var j=1; j<=i; j++){
                var getValue = "";
                getValue += '#attribute_name';
                getValue +=  j;
                getValue +=' :selected';
                var attribute_name = $(getValue).text();
                getValue = "";
                getValue += '#attribute_value';
                getValue +=  j;
                var attribute_value = $(getValue).val();

                const person = {attribute_name:attribute_name, attribute_value:attribute_value};
                alreadyUsed.push(person);
            }
            document.getElementById('attributes').value = JSON.stringify(alreadyUsed);
            $("#itemSubmit").click();
            
        });
	});

    function updateList(){
        let tempRMV = $("#show_item").find("select");
        console.log(tempRMV);
        tempPossibleOptions = possibleOptions.filter(ar => !alreadyUsed.find(rm => (rm === ar)));
        for(var j=1;j<=i;j++){
            var getValue = "";
            getValue += '#attribute_name';
            getValue +=  j;
            getValue +=' :selected';
            var attribute_name = $(getValue).text();
            if(!alreadyUsed.includes(attribute_name))
                alreadyUsed.push(attribute_name);
        }
    }

    function enableSubmit(){
        let inputs = document.getElementsByClassName('required'); // Enter your class name for a required field, this should also be reflected within your form fields.
        let btn = $('#add_item_btn');
        for (var i = 0; i < inputs.length; i++){
            let changedInput = inputs[i];
            if (changedInput.value.trim() == "" || changedInput.value == null){
                isValid = false;
                break;
            }
            else{
                isValid = true;
            }
        }
        btn.prop('disabled', !isValid);
        if(i>=jsArr.length){
                $("#add_item_btn").prop('disabled', true);
            }
    }
</script>


<script>
document.getElementById('content_collapse').classList.add('show');
document.getElementById('content_collapse_btn').setAttribute('aria-expanded', 'true');
document.getElementById('content_collapse_btn').setAttribute('style', 'color:white !important');
document.getElementById('additem').setAttribute('style', 'color:white !important');

$('#manufacturer').select2({
    width: '100%',
    placeholder: 'Wybierz producenta'
});

</script>