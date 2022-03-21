<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       <main>
       <h1>Publishers</h1>
   
       <div id="publisher-container">
       <?php
        $sql="SELECT * FROM t_publishers";

        $result=mysqli_query($con,$sql);

        while ($row=mysqli_fetch_array($result)){
            echo '<div id="publisher">';
            echo '<h2>'.$row['publisher_name'].'</h2>';
            echo '<span id="publisher_id">id: '.$row['publisher_id'].'</span>';
            echo '<img src="';
            if($row['publisher_image']!=''){
                echo $row['publisher_image'];
            }
            else{
                echo 'publisher-images/no-image.png';
            }
            echo '">';
            echo '<footer><a href="update-publisher.php?publisher_id='.$row['publisher_id'].'"><img src="edit.png"></a>';
            echo '<a href="delete-publisher.php?publisher_id='.$row['publisher_id'].'"><img src="delete.png"></a></footer>';
            echo '</div>'.PHP_EOL;
        }
        ?>
        
        </div>
      <div id="sub-nav">
        <a href="create-publisher.php">Add Publisher +</a>
      </div>
        <?php mysqli_close($con); //close connection?>
       </main>
    </body>
</html>