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
            <div class="col-12 col-sm-6 col-xl-4  border-end border-2">
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
                            <input type="number" class="form-control" id="quantityInput" min="0" name="price" placeholder="23" step="any">
                            <label for="quantityInput">Cena</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col">
                        <div class="form-floating ">
                            <input type="number" class="form-control" id="quantityInput" min="0" name="quantity" placeholder="23">
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
            <div class="col-12 col-sm-6 col-xl-4 border-end border-2 px-4">
                <h4>Dodawanie atrybutów</h4>
                <div id="show_attr">
                </div>
                <div>
                    <button class="btn btn-success" id="add_attr_btn">Dodaj atrybut</button>
                </div>
                <input type="text" style="display:none" id="attributes" name="attributes" data-attr='<?php echo json_encode($data['attributes']); ?>'>
            </div>    
            <div class="col-12 col-sm-12 col-xl-4 border-end border-2 px-4">
                <h4>Dodawanie opisów</h4>
                <div id="show_desc">
                </div>
                <div>
                    <button class="btn btn-success" id="add_description_btn">Dodaj opis</button>
                </div>
                <input type="text" style="display:none" id="descriptions" name="descriptions" data-attr='<?php echo json_encode($data['descriptions']); ?>'>
            </div>        
        </div>  
        <button type="submit" id="itemSubmit" name="itemSubmit" class="btn btn-primary btn-lg float-end" style="display:none"></button>
    </form>
</div>

<script>
    var jsArr = JSON.parse($('#attributes').attr('data-attr'));
    var possibleOptions = [];
    var selectedAtPos = [];
    jsArr.forEach((id) => {
        possibleOptions.push(id.name);
    });
    possibleOptions.sort();
    var alreadyUsed = [];
    var attrNum=0;
    var descNum=0;
	$(document).ready(function(){



        







        
	    $("#add_attr_btn").click(function(e){
            e.preventDefault();
            tempPossibleOptions = possibleOptions;
            attrNum++;
            var html = '';
            html+='<div class="row">';
            html+='<div class="col-12 col-md-5 mb-3">';
            html+='<select class="select2 form-control" id="attribute_name' + attrNum + '" placeholder="Atrybut" aria-label="example-xl" onchange="updateAttributesList();">';
            html+='<option>';
            html+='</option>';
            tempPossibleOptions.forEach((id) => {
                    html+='<option value="' + id +  '">';
                    html+=id;
                    html+='</option>';
            });
            html+='</select>';
            html+='</div>';
            html+='<div class="col-8 col-md-5 mb-3">';
            html+='<input type="text" id="attribute_value' + attrNum + '" class="form-control required" placeholder="Wartość atrybutu" required onkeyup="enableAttributesSubmit()" autocomplete="off">';
            html+='</div>';
            html+='<div class="col-4 col-md-2 mb-3 d-grid">';
            html+='<button class="btn btn-danger remove_attr_btn">-</button>';
            html+='</div></div>';
            
            $("#show_attr").append(html)
            if(attrNum>=jsArr.length){
                $("#add_attr_btn").prop('disabled', true);
            }
            else{
                enableAttributesSubmit();
            }
            updateAttributesList();
        });
        
        $(document).on('click', '.remove_attr_btn', function(e){ 
            e.preventDefault();
            let row_item = $(this).parent().parent();
            let tempRMV = $(this).parent().parent().find('select').attr('id');
            console.log(tempRMV);
            var getValue = "#";
                getValue += tempRMV;
                getValue +=' :selected';
            var attribute_name = $(getValue).text();
            $(row_item).remove();
            i--;
            if(i==0){
                $("#add_attr_btn").prop('disabled', false);
            }else{
                enableAttributesSubmit();
            }
            alreadyUsed = alreadyUsed.filter(e => e !== attribute_name);
            selectedAtPos = selectedAtPos.filter(e => e !== attribute_name);
            console.log(alreadyUsed);
            updateAttributesList();
  
        });

        $("#itemSubmitRemote").click(function(e){
            for(var j=1; j<=attrNum; j++){
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

        $("#add_description_btn").click(function(e){
            e.preventDefault();
            descNum++;
            var html = '';
            html+='<div class="row">';
            html+='<textarea class="form-control " style="overflow:hidden;" id="description' + descNum + '" name="text" maxlength="1000" placeholder="Type in your message" rows="2" cols="5" onkeyup="test()" onkeydown="test1()" onclick="test1()"></textarea>';
            html+='<span class="pull-right label label-default" id="count_message' + descNum + '">TESTs</span><br><br>';
            html+='</div>';
            
            $("#show_desc").append(html)
            if(descNum>=jsArr.length){
                $("#add_desc_btn").prop('disabled', true);
            }
            else{
               // enableDescriptionsSubmit();
            }

            var text_max = 1000;

            $('#count_message1').text('0 / ' + text_max );

            var sch = $('#description1').prop('scrollHeight');
            sch = sch+10;
            $('#description1').attr('style', `resize:none; font-size: 18px; height:${sch}px; overflow:hidden;`);
            


            
        });
             
            

    });


   
        
        

    function updateAttributesList(){
        let tempRMV = $("#show_attr").find("select");
        for(var i=1; i<=tempRMV.length; i++){
            var input = "";
            input += "#attribute_name";
            input += i;
            for(var j=0;j<alreadyUsed.length;j++){
                $(input + ' option[value="' + alreadyUsed[j] + '"]').toggle();
            }

            var selection=$(input).find(":selected").val();

            if(selection && !alreadyUsed.includes(selection))  alreadyUsed.push(selection);
        }
    }
    

    function enableAttributesSubmit(){
        let inputs = document.getElementsByClassName('required'); // Enter your class name for a required field, this should also be reflected within your form fields.
        let btn = $('#add_attr_btn');
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
                $("#add_attr_btn").prop('disabled', true);
            }
    }

    function test(){
        var text_max = 1000;
        var text_length = $('#description1').val().length;
        var text_remaining = text_max - text_length;

        $('#count_message1').html(text_length + ' / ' + text_max);

        $('#description1').attr('style', 'height:auto; resize:none; font-size: 18px; overflow:hidden;');
        var sch = $('#description1').prop('scrollHeight');
        sch = sch+10;
        $('#description1').attr('style', `height:${sch}px; resize:none; font-size: 18px; overflow:hidden;`);
    }

    function test1(){
        $('#description1').attr('style', 'height:auto; resize:none; font-size: 18px; overflow:hidden;');
        var sch = $('#description1').prop('scrollHeight');
        sch = sch+10;
        $('#description1').attr('style', `height:${sch}px; resize:none; font-size: 18px; overflow:hidden;`);
    }

    $(window).resize(function() {
        test1();
});
  
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