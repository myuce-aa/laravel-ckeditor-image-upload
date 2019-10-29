<!DOCTYPE html>
<html>
<head>
    <title>Laravel Ckeditor Image Upload Example</title>
    <script src="assets/ckeditor.js"></script>
</head>
<body>
<h1>Laravel Ckeditor Image Upload Example</h1>
<textarea name="editor1"></textarea>
   
<script type="text/javascript">
    CKEDITOR.replace('editor1', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
   
</body>
</html>