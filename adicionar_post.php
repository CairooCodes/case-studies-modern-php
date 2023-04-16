<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Exemplo TinyMCE</title>
  <script src="https://cdn.tiny.cloud/1/4ui2d0fpugbkf5frqxp3bg458ubxg10wgyw7wzn86t8z1ojl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#mytextarea',
      plugins: 'image',
      toolbar: 'image',
      images_upload_handler: function(blobInfo, success, failure) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'upload.php');

        xhr.onload = function() {
          var json;

          if (xhr.status != 200) {
            failure('HTTP Error: ' + xhr.status);
            return;
          }

          json = JSON.parse(xhr.responseText);

          if (!json || typeof json.location != 'string') {
            failure('Invalid JSON: ' + xhr.responseText);
            return;
          }

          success(json.location);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
      }
    });
  </script>
</head>

<body>
  <form method="post" action="save.php">
    <textarea id="mytextarea" name="content"></textarea>
    <br>
    <input type="submit" value="Salvar">
  </form>
</body>

</html>