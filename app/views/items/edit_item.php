<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<div class="row mx-2">
        <div class="col-6">
            <h1 class="text-muted headers-padding ">Edycja produktu</h1>
        </div>
        <div class="col-6 align-self-center">
            <button type="submit" id="itemSubmitRemote" name="itemSubmit" class="btn btn-primary btn-lg float-end me-3">Edytuj</button>
        </div>
    </div>
</div>

<hr class="divider mt-0">

<div class="container-fluid justify-content-between align-items-center">

<div class="container-fluid justify-content-between">
    <form action="" id="addItemForm" method="POST" autocomplete="off" enctype="multipart/form-data"> 
        <div class="row m-2">
            <div class="col-12 col-sm-6 col-xl-4 itemField1 border-end border-2">
                <div class="row m-2">
                    <div class="col">
                        <div class="form-floating ">
                            <input type="text" class="form-control" id="nameInput" name="name" value="<?=$data['prevItems']['prevName']?>" placeholder="Nazwa" required maxlength="150">
                            <label class="form-control-lg lg-custom" for="nameInput">Nazwa</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col">
                        <div class="form-floating ">
                            <input type="number" class="form-control" id="quantityInput" min="0.01 " step="0.01" name="price" value="<?=$data['prevItems']['prevPrice']?>" placeholder="1" required>
                            <label class="form-control-lg lg-custom" for="quantityInput">Cena</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col">
                        <div class="form-floating ">
                            <input type="number" class="form-control" id="quantityInput" min="0" name="quantity" value="<?=$data['prevItems']['prevAmount']?>" placeholder="1" required>
                            <label class="form-control-lg lg-custom" for="quantityInput">Ilo????</label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <select class="select2 form-control form-select-lg" id="manufacturer" name="manufacturer" aria-label="example-xl" required>
                                <?php
                                    echo "<option></option>";
                                    foreach($data['items'] as $i => $result) {
                                        echo "<option value=".$result['id'].">".$result['mname']." - ".$result['cname']."</option>";
                                    }
                                ?>
                        </select>
                        <input id="prevMnfCnt" type="hidden" value="<?=$data['prevItems']['prevMnfCnt']?>">
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <select class="select2 form-select-lg" multiple id="categories" name="selCategories[]" 
                        aria-label="example-xl" aria-selected="<?=$data['selCategories']?>" aria-autocomplete="TRUE" required>
                            <?php
                                foreach($data['categories'] as $i => $result) {
                                    $temp = "";
                                    if(!empty($data['selCategories']))
                                        if(in_array($result['categoryid'], $data['prevCtg'])) $temp = "selected=selected";
                                    echo 
                                    "<option value=".$result['categoryid']. " " . $temp .">".$result['categoryname']."</option>";
                                }
                            
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-sm-9 me-sm-0">
                                <input class="form-control" type="file" name="formFile" id="formFile" accept="image/png" onchange="preview()">
                            </div>
                            <div class="col-12 col-sm-3 mt-3 mt-sm-0 ms-sm-0">
                                <button id="deleteImageBtn" onclick="clearImage()" class="btn btn-danger col-12">-</button>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <img id="output" class="img-thumbnail mt-3" src="<?=$data['imagePath']?>" style="object-fit: cover;"/>
                        </div>
                        <label style="color:darkgray">*Dodawany obraz musi mie?? proporcje 1:1, aby wy??wietla?? si?? poprawnie</label>
                    </div>
                </div>
            </div>   
            <div class="col-12 col-sm-6 col-xl-4 border-end border-2 itemField2 px-4 mt-5 mt-sm-0">
                <h4>Edycja atrybut??w</h4>
                <div id="show_attr">
                    <?php
                        $attrNum = 1;
                        foreach($data['prevAttr'] as $i => $result) {
                            $tempPossibleOptions = $data['attributes'];
                            $input = '#attribute_name' . $attrNum;
                            $html = '';
                            $html .='<div class="row">';
                            $html.='<input type="hidden" name="attrId' . $attrNum . '" value="' . $result['aiId'] . '">';
                            $html .='<div class="col-12 col-md-5 mb-3">';
                            $html .='<select class="select2 form-control selectattr requiredattr form-select-lg" id="attribute_name' . $attrNum .  '" aria-label="example-xl" onchange="updateAttrList();" required>';
                            $html .='<option>';
                            $html .='</option>';
                            foreach($tempPossibleOptions as $option){
                                if($option['name'] == $data['prevAttr'][$attrNum-1]['attrname']){
                                    $html .='<option value="' . $option['id'] . '" selected="selected">';
                                }
                                else
                                {
                                    $html .='<option value="' . $option['id'] . '">';
                                }
                                $html .=$option['name'];
                                $html .='</option>';
                            }
                            $html .='</select>';
                            $html .='<input type="hidden" name="attribute_name' . $attrNum .  '">';
                            $html .='</div>';
                            $html .='<div class="col-8 col-md-5 mb-3">';
                            $html .='<div class="form-floating">';
                            $html .='<input type="text" name="attribute_value' . $attrNum . '" id="attribute_value' . $attrNum . '" class="form-control requiredattr" required onkeyup="enableAttrSubmit()" autocomplete="off" value="' . $data['prevAttr'][$attrNum-1]['aval'] . '">';
                            $html .='<label class="form-control-lg lg-custom" for="attribute_value' . $attrNum .'">Warto????...</label>';
                            $html .='</div>';
                            $html .='</div>';
                            $html .='<div class="col-4 col-md-2 mb-3 d-grid">';
                            $html .='<button class="btn btn-danger remove_attr_btn">-</button>';
                            $html .='</div></div>';
                            echo $html;
                            $attrNum++;
                        }                           
                    ?>
                </div>
                <div>
                    <button class="btn btn-success" id="add_attr_btn">Dodaj atrybut</button>
                </div>
                <input type="text" style="display:none" id="attributes" name="attributes" data-attr='<?php echo json_encode($data['attributes']); ?>'>
            </div>   
            <div class="col-12 col-sm-12 col-xl-4 px-4 mt-5 mt-sm-0">
                <h4>Edycja opis??w</h4>
                <div id="show_desc">
                    <?php
                        $descNum = 1;
                        foreach($data['prevDesc'] as $i) {
                            $html = '';
                            $html.='<div class="row mx-2">';
                            $html.='<input type="hidden" name="descriptionId' . $descNum . '" value="' . $i['descriptionId'] . '">';
                            $html.='<label class="fw-bold">Tytu??</label>';
                            $html.='<textarea class="form-control mt-1 desctitle requireddesc" style="overflow:hidden;"'; 
                            $html.='id="descriptionTitle' . $descNum . '" name="descriptionTitle' . $descNum . '" maxlength="100" placeholder="Tytu??..." rows="1" cols="5" required>' . $data['prevDesc'][$descNum-1]['desctitle'] . '</textarea>';
                            $html.='<span class="pull-right mt-1 label label-default spanTitle" id="titleCount_message' . $descNum . '"></span>';
                            $html.='<label class="fw-bold mt-1">Opis</label>';
                            $html.='<textarea class="form-control mt-1 desc requireddesc" style="overflow:hidden;" id="description' . $descNum . '" name="description' . $descNum . '" maxlength="1000" placeholder="Opis..." rows="2"  required>' . $data['prevDesc'][$descNum-1]['descval'] . '</textarea>';
                            $html.='<span class="pull-right mt-1 label label-default spanDesc" id="count_message' . $descNum . '"></span>';
                            $html.='<button class="btn btn-danger mt-3 remove_desc_btn">-</button>';
                            $html.='<hr class="divider mt-3">';
                            $html.='</div>';
                            $descNum++;
                            echo $html;
                        }
                    ?>
                </div>
                <div>
                    <button class="btn btn-success" id="add_description_btn">Dodaj opis</button>
                </div>
                <input type="hidden" id="idOfLastDesc" name="idOfLastDesc">
                <input type="hidden" id="idOfLastAttr" name="idOfLastAttr">
                <input type="text" style="display:none" id="descriptions" name="descriptions" data-attr='<?php echo json_encode($data['descriptions']); ?>'>
            </div>  
        </div>  
        <button type="submit" id="itemSubmit" name="itemSubmit" class="btn btn-primary btn-lg float-end" style="display:none"></button>
    </form> 
</div>

<script>
    var jsArr = JSON.parse($('#attributes').attr('data-attr'));
    var possibleOptions = [];
    var possibleIds = [];
    jsArr.forEach((id) => {
        possibleOptions.push(id.name);
        possibleIds.push(id.id);
    });
    possibleOptions.sort();
    possibleIds.sort();
    var alreadyUsed = [];
    var filled = $(".selectattr");
    var lengthOfFilled = filled.length;
    var attrNum=lengthOfFilled;
    var attrNum2=lengthOfFilled;
    enableAttrSubmit();
    filled = $(".desctitle");
    lengthOfFilled = filled.length
    var descNum=lengthOfFilled;
    enableDescSubmit();
	$(document).ready(function(){
        var mnfcnt=$("#prevMnfCnt").attr('value');
        $('#manufacturer').val(mnfcnt);
        $('#manufacturer').trigger('change');
        $('#idOfLastAttr').val(attrNum2);
        $('#idOfLastDesc').val(descNum);
        updateAttrList();

        for(var i=1; i<=attrNum2; i++){  
            inputName = '#attribute_name' + i;  
            $(inputName).select2({
                theme: 'bootstrap-5',
                placeholder: 'Atrybut...',
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            });
        }

        // --Attributes-- //


	    $("#add_attr_btn").click(function(e){
            e.preventDefault();
            alreadyUsed.push("");
            tempPossibleOptions = possibleOptions;
            tempPossibleIds = possibleIds;
            attrNum++;
            attrNum2++;
            var input = '#attribute_name' + attrNum;
            var html = '';
            html+='<div class="row">';
            html+='<input type="hidden" name="attrId'+attrNum+'" value="0">';
            html+='<div class="col-12 col-md-5 mb-3">';
            html+='<select class="select2 form-control selectattr requiredattr form-select-lg" id="attribute_name' + attrNum +  '" aria-label="example-xl" onchange="updateAttrList();" required>';
            html+='<option>';
            html+='</option>';
            tempPossibleOptions.forEach((name,index) => {
                    const id=tempPossibleIds[index];
                    html+='<option value="' + id + '">';
                    html+=name;
                    html+='</option>';
            });
            html+='</select>';
            html+='<input type="hidden" name="attribute_name' + attrNum +  '">';
            html+='</div>';
            html+='<div class="col-8 col-md-5 mb-3">';
            html+='<div class="form-floating">';
            html+='<input type="text" name="attribute_value' + attrNum + '" id="attribute_value' + attrNum + '" class="form-control requiredattr" placeholder="Warto????" required onkeyup="enableAttrSubmit()" autocomplete="off">';
            html+='<label class="form-control-lg lg-custom" for="attribute_value'+ attrNum +'">Warto????...</label>';
            html+='</div>';
            html+='</div>';
            html+='<div class="col-4 col-md-2 mb-3 d-grid">';
            html+='<button class="btn btn-danger remove_attr_btn">-</button>';
            html+='</div></div>';
            $("#show_attr").append(html)

            var input = '#attribute_name' + attrNum;

            $(input).select2({
                theme: 'bootstrap-5',
                placeholder: 'Atrybut...',
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            });

            if(attrNum>=jsArr.length){
                $("#add_attr_btn").prop('disabled', true);
            }
            else{
                enableAttrSubmit();
            }
            updateAttrList();
            $('#idOfLastAttr').val(attrNum2);
        });

        $(document).on('click', '.remove_attr_btn', function(e){ 
            e.preventDefault();
            let row_attr = $(this).parent().parent();
            let tempRMV = $(this).parent().parent().find('select').attr('id');
            var getValue = "#";
                getValue += tempRMV;
                getValue +=' :selected';
            var attribute_name = $(getValue).text();

            $(row_attr).remove();
            attrNum2--;
            if(attrNum2==0){
                $("#add_attr_btn").prop('disabled', false);
            }else{
                enableAttrSubmit();
            }
            alreadyUsed = alreadyUsed.filter(e => e !== attribute_name);
            updateAttrList()
            $('#idOfLastAttr').val(attrNum2);
        });


        // --Descriptions-- //


        $("#add_description_btn").click(function(e){
            e.preventDefault();
            descNum++;
            var html = '';
            html+='<div class="row mx-2">';
            html+='<input type="hidden" name="descriptionId' + descNum + '" value="0">';
            html+='<label class="fw-bold">Tytu??</label>';
            html+='<textarea class="form-control mt-1 desctitle requireddesc" style="overflow:hidden; resize:none;" required'; 
            html+='id="descriptionTitle' + descNum + '" name="descriptionTitle' + descNum + '" maxlength="100" placeholder="Tytu??..." rows="1" cols="5"></textarea>';
            html+='<span class="pull-right mt-1 label label-default spanTitle" id="titleCount_message' + descNum + '"></span>';
            html+='<label class="fw-bold mt-1">Opis</label>';
            html+='<textarea class="form-control mt-1 desc requireddesc" required style="overflow:hidden; resize:none;" id="description' + descNum + '" name="description' + descNum + '" maxlength="1000" placeholder="Opis..." rows="2" cols="5"></textarea>';
            html+='<span class="pull-right mt-1 label label-default spanDesc" id="count_message' + descNum + '"></span>';
            html+='<button class="btn btn-danger mt-3 remove_desc_btn">-</button>';
            html+='<hr class="divider mt-3">';
            html+='</div>';

            $("#show_desc").append(html)
   
            var textTitle_max = 100;
            var text_max = 1000;

            inputcm = '#count_message' + descNum; 
            $(inputcm).text('0 / ' + text_max );

            inputdesc = '#description' + descNum;
            var sch = $(inputdesc).prop('scrollHeight');
            //sch = sch+10;
            $(inputdesc).attr('style', `resize:none; font-size: 18px; height:${sch}px; overflow:hidden;`);

            inputcmtitle = '#titleCount_message' + descNum; 
            $(inputcmtitle).text('0 / ' + textTitle_max );

            inputdesctitle = '#descriptionTitle' + descNum;
            $(inputdesctitle).attr('style', 'height:auto; resize:none; font-size: 18px; overflow:hidden;');
            var schtitle = $(inputdesctitle).prop('scrollHeight');
            //schtitle = schtitle+10;
            $(inputdesctitle).attr('style', `resize:none; font-size: 18px; height:${schtitle}px; overflow:hidden;`);

            $('#idOfLastDesc').val(descNum);
            enableDescSubmit();
        });

        $(document).on('keydown', '.desc', function(e){ 
            $(this).attr('style', 'height:auto; resize:none; font-size: 18px; overflow:hidden;');
            var sch = $(this).prop('scrollHeight');
            sch = sch+10;
            $(this).attr('style', `height:${sch}px; resize:none; font-size: 18px; overflow:hidden;`);
        });

        $(document).on('keyup', '.desc', function(e){ 
            var text_max = 1000;
            var text_length = $(this).val().length;
            var text_remaining = text_max - text_length;

            var test = $(this).parent().find('.spanDesc');

            $(test).html(text_length + ' / ' + text_max);
            enableDescSubmit();
        });

        $(document).on('keyup', '.desctitle', function(e){ 
            enableDescSubmit();
        });

        $(document).on('click', '.remove_desc_btn', function(e){ 
            e.preventDefault();
            let row_desc = $(this).parent();

            $(row_desc).remove();
            enableDescSubmit();
        });


        $(document).on('keydown', '.desc', function(e){ 
            $(this).attr('style', 'height:auto; resize:none; font-size: 18px; overflow:hidden;');
            var sch = $(this).prop('scrollHeight');
            $(this).attr('style', `height:${sch}px; resize:none; font-size: 18px; overflow:hidden;`);
        });

        $(document).on('keyup', '.desc', function(e){ 
            var text_max = 1000;
            var text_length = $(this).val().length;
            var text_remaining = text_max - text_length;

            var test = $(this).parent().find('.spanDesc');

            $(test).html(text_length + ' / ' + text_max);
            enableDescSubmit();
        });

        $(document).on('keydown', '.desctitle', function(e){ 
            $(this).attr('style', 'height:auto; resize:none; font-size: 18px; overflow:hidden;');
            var sch = $(this).prop('scrollHeight');
            $(this).attr('style', `height:${sch}px; resize:none; font-size: 18px; overflow:hidden;`);
        });

        $(document).on('keyup', '.desctitle', function(e){ 
            var text_max = 100;
            var text_length = $(this).val().length;
            var text_remaining = text_max - text_length;

            var test = $(this).parent().find('.spanTitle');

            $(test).html(text_length + ' / ' + text_max);
            enableDescSubmit();
        });

        $(document).on('keyup', '.desctitle', function(e){ 
            enableDescSubmit();
        });

        $(document).on('change mouseenter mouseleave paste', '.desctitle', function(e){ 
            $(this).attr('style', 'height:auto; resize:none; font-size: 18px; overflow:hidden;');
            var sch = $(this).prop('scrollHeight');
            $(this).attr('style', `height:${sch}px; resize:none; font-size: 18px; overflow:hidden;`);
            enableDescSubmit();
        });
        $(document).on('change mouseenter mouseleave paste', '.desc', function(e){ 
            $(this).attr('style', 'height:auto; resize:none; font-size: 18px; overflow:hidden;');
            var sch = $(this).prop('scrollHeight');
            $(this).attr('style', `height:${sch}px; resize:none; font-size: 18px; overflow:hidden;`);
            enableDescSubmit();
        });

        $(document).on('click', '.remove_desc_btn', function(e){ 
            e.preventDefault();
            let row_desc = $(this).parent();
            

            $(row_desc).remove();
            enableDescSubmit();
        });


        // --Submit form-- //


        $("#itemSubmitRemote").click(function(e){
            var input = $('[id ^= "attribute_name"]');
            var inputSel = input.find(':selected');
            for(var i=1;i<=inputSel.length;i++){
               var name = input[i-1].getAttribute('id');
               $('[name="' + name + '"]').attr('value', inputSel[i-1].value);
            }
            $("#itemSubmit").click();
        });


        countDesc();
        
	});



    function updateAttrList(){
        let tempRMV = $("#show_attr").find("select");  
        for(var i=1;i<=tempRMV.length;i++){
            var input = '#' + $(tempRMV[i-1]).attr('id');
            for(var j=0;j<possibleOptions.length;j++){
                // sprawdzi?? czy value znajduje si?? w already used
                $(input + ' option').attr('disabled',false);
            }
        }

        for(var i=1;i<=tempRMV.length;i++){
            var input = '#' + $(tempRMV[i-1]).attr('id');
            
            var selection = $(input).find(":selected").val();
            if(selection && !alreadyUsed.includes(selection)) {
                alreadyUsed[i-1] = selection;
            }
        }
  
        for(var i=1;i<=tempRMV.length;i++){
            var input = '#' + $(tempRMV[i-1]).attr('id');
           
            for(var j=0;j<alreadyUsed.length;j++){
                // sprawdzi?? czy value znajduje si?? w already used
                $(input + ' option[value="' + alreadyUsed[j] + '"]').attr('disabled','disabled');
            }

        }
        enableAttrSubmit();     
    }

    function enableAttrSubmit(){
        let inputs = document.getElementsByClassName('requiredattr'); // Enter your class name for a required field, this should also be reflected within your form fields.
        let btn = $('#add_attr_btn');
        var isValid;
        if(inputs.length!=0){
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
        }else{
            isValid = true;
        }
        btn.prop('disabled', !isValid);
        if((inputs.length/2)>=jsArr.length){
            $("#add_attr_btn").prop('disabled', true);
        }
    }

    function enableDescSubmit(){
        let inputs = document.getElementsByClassName('requireddesc');
        let btn = $('#add_description_btn');
        var isValid;
        if(inputs.length!=0){
            for (var i = 0; i < inputs.length; i++){
                let changedInput = inputs[i];
                if (changedInput.value.trim() == "" || changedInput.value == null){
                    isValid = false;
                    break;
                }else{
                    isValid = true;
                }
            }
        }else{
            isValid = true;
        }
        btn.prop('disabled', !isValid);
    }

    function countDesc() {
    let inputs = document.getElementsByClassName('desc');
    var text_max = 1000;
    var textTitle_max = 100;
    for(var i=0;i<inputs.length;i++){
        var temp = i+1;
        var text_length = $('#description' + temp).val().length;

        var text_remaining = text_max - text_length;

        $('#count_message' + temp).html(text_length + ' / ' + text_max);

        $('#description' + temp).attr('style', 'height:auto; resize:none; font-size: 18px; overflow:hidden;');
        var sch = $('#description' + temp).prop('scrollHeight');
        $('#description' + temp).attr('style', `height:${sch}px; resize:none; font-size: 18px; overflow:hidden;`);

        text_length = $('#descriptionTitle' + temp).val().length;
        text_remaining = textTitle_max - text_length;

        $('#titleCount_message' + temp).html(text_length + ' / ' + textTitle_max);

        $('#descriptionTitle' + temp).attr('style', 'height:auto; resize:none; font-size: 18px; overflow:hidden;');
        var sch = $('#descriptionTitle' + temp).prop('scrollHeight');
        $('#descriptionTitle' + temp).attr('style', `height:${sch}px; resize:none; font-size: 18px; overflow:hidden;`);
    }
    }

    $(window).resize(countDesc())
</script>


<script>
    function preview() {
        var frame = document.getElementById('output');
        document.getElementById('output').setAttribute('style', 'display:default');
        document.getElementById('deleteImageBtn').setAttribute('style', 'display:default');
        frame.src = URL.createObjectURL(event.target.files[0]);
    }
    function clearImage() {
        document.getElementById('formFile').value = null;
        document.getElementById('output').setAttribute('style', 'display:none');
        document.getElementById('deleteImageBtn').setAttribute('style', 'display:none');
        frame.src = "";
    }
</script>

<script>
document.getElementById('content_collapse').classList.add('show');
document.getElementById('content_collapse_btn').setAttribute('aria-expanded', 'true');
document.getElementById('content_collapse_btn').setAttribute('style', 'color:white !important');
$('#manufacturer').select2({
    theme: 'bootstrap-5',
    placeholder: 'Wybierz producenta',
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
});
$('#categories').select2({
    theme: 'bootstrap-5',
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: 'Wybierz kategorie',
    //closeOnSelect: false,
});

</script>