<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'style.php'?>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
    <?php include_once 'navigation.php'?>
    <?php if('/'=== getCurrentUrl()){
         include_once 'slider.php';
    }?>
    {{content}}
    <?php include_once 'footer.php'?>
</body>
</html>
