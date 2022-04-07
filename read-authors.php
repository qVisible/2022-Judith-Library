<html>
   <head>
        <title>Judith Library System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style1.css" rel="stylesheet" type="text/css">   
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       <main>
       <h1>Authors</h1>
   
       <div id="author-container">
       <?php
        $sql="SELECT * FROM t_authors";

        $result=mysqli_query($con,$sql);

        while ($row=mysqli_fetch_array($result)){
            echo '<div id="author">';
            echo '<h2>'.$row['author_name'].'</h2>';
            echo '<span id="author_id">id: '.$row['author_id'].'</span>';
            echo '<img src="';
            if($row['author_image']!=''){
                echo $row['author_image'];
            }
            else{
                echo 'author-images/no-image.png';
            }
            echo '">';
            echo '<footer><a href="update-author.php?author_id='.$row['author_id'].'"><img src="edit.png"></a>';
            echo '<a href="delete-author.php?author_id='.$row['author_id'].'"><img src="delete.png"></a></footer>';
            echo '</div>'.PHP_EOL;
        }
        ?>
        
        </div>
      <div id="sub-nav">
        <a href="create-author.php">Add Author +</a>
      </div>
        <?php mysqli_close($con); //close connection?>
       </main>
    </body>
</html>