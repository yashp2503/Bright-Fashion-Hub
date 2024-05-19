<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uplode File</title>
</head>

<body>
    <form action="#" method="post" enctype="multipart/form-data">
        <input type="file" name="uplodefile" id="">
        <br>
        <br>
        <input type="submit" name="submit" value="File Uplode">
    </form>
</body>

</html>
<?php

$filename = $_FILES["uplodefile"]["name"];
$tempname = $_FILES["uplodefile"]["tmp_name"]; 
$folder = "img/" . $filename;
echo $folder;
move_uploaded_file($tempname, $folder);

echo "<img src='$folder' height='100px'  width='100px'> ";
  
?>
