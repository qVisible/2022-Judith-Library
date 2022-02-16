<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!--Get the filename and format it for the title of the page-->
    <title>Code From Judith Library System
    </title>
    <link href="style1.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <?php require_once('nav.php'); ?>
    <div id="wrapper">
        <?php
$filename = $_GET['filename'] ;


if($filename!='db-connect.php'){
?>

        <h2>Show Code:
            <?php echo $filename  ?>
        </h2>
        <?php
highlight_file($filename );

}
else{
    echo '<h2>Sorry: Cant show code for file - too sensitive!</h2>';
}
?>


        <!--end wrapper div-->
    </div>
</body>

</html>
