<?php
include 'adm_nav.php';
?>

<script src="<?=MAINPATH?>/node_modules/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

<form method="post">
    <div class="container mt-4 mb-4">
        <!--Bootstrap classes arrange web page components into columns and rows in a grid -->
        <div class="row justify-content-center">
            <div class="col-11">
                <h1 class="h2 mb-4"><?=!empty($data['pageNames'][$data['editingId']]) ?
                $data['pageNames'][$data['editingId']]:'Strona '.$data['editingId']?></h1>
                <div class="form-group">
                    <textarea style="height:75vh" id="editor" name="editor"><?=$data['storedValue']?></textarea>
                </div>
                <button type="submit" name="submitButton" class="btn btn-primary">Edytuj</button>
            </div>
        </div>
    </div>
</form>
<input type="hidden" id="page" value="<?=$data['editingId']?>">
<script>
tinymce.init({
  selector: 'textarea#editor',
  plugins: 'lists, link, image, media',
  toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | alignleft aligncenter alignright alignjustify | link image media | removeformat',
  menubar: false,
  setup: (editor) => {
      // Apply the focus effect
      editor.on("init", () => {
      editor.getContainer().style.transition = "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out";
        });
      editor.on("focus", () => { (editor.getContainer().style.boxShadow = "0 0 0 .2rem rgba(0, 123, 255, .25)"),
      (editor.getContainer().style.borderColor = "#80bdff");
        });
      editor.on("blur", () => {
      (editor.getContainer().style.boxShadow = ""),
      (editor.getContainer().style.borderColor = "");
       });
     },
  });

    var pageNum=document.getElementById('page').value;
    document.getElementById('pages_collapse').classList.add('show');
    document.getElementById('pages_collapse_btn').setAttribute( 'aria-expanded', 'true' );
    document.getElementById('pages_collapse_btn').setAttribute( 'style', 'color:white !important' );
    document.getElementById('editpage'+pageNum).setAttribute( 'style', 'color:white !important' );
</script>

<?php 
include 'adm_feet.php';
?>