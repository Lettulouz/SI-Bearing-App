<?php
include 'adm_nav.php';
?>

<script src="<?=MAINPATH?>/node_modules/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

<form method="post">
    <div class="container mt-4 mb-4">
        <!--Bootstrap classes arrange web page components into columns and rows in a grid -->
        <div class="row justify-content-md-center">
            <div class="col-md-12 col-lg-8">
                <h1 class="h2 mb-4">Treść strony <?=$data['editingId']?></h1>
                <div class="form-group">
                    <textarea id="editor" name="editor"><?=$data['storedValue']?></textarea>
                </div>
                <button type="submit" name="submitButton" class="btn btn-primary">Edytuj</button>
            </div>
        </div>
    </div>
</form>

<script>
tinymce.init({
  selector: 'textarea#editor',
  plugins: 'lists, link, image, media',
  toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | alignleft aligncenter alignright alignjustify | link image media | removeformat help',
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

</script>

<?php 
include 'adm_feet.php';
?>