<html>
    <body>


<?php
//$con=mysqli_connect("localhost", "root", "root", "DB_LIBRARY");
$con = mysqli_connect("localhost", "joe", "Consolid&&10", "DB_LIBRARY_2020");
		
		

if (!$con) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
    }
    ?>



    </body>
</html>