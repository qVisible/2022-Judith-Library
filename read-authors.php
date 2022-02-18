<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       <h1>Authors</h1>
       <table>
       <tr>
           <th>id</th>
           <th>author</th>
           <th>edit</th>
           <th>delete</th>
       </tr>
       <?php
        $sql="SELECT * FROM t_authors";

        $result=mysqli_query($con,$sql);

        while ($row=mysqli_fetch_array($result)){
            echo '<tr>';
            echo '<td>'.$row['author_id'].'</td>';
            echo '<td>'.$row['author_name'].'</td>';
            echo '<td><img src="';
            if($row['author_image']!=''){
                echo $row['author_image'];
            }
            else{
                echo 'author-images/no-image.png';
            }
            echo '"></td>';
            echo '<td><a href="update-author.php?author_id='.$row['author_id'].'"><img src="edit.png"></a></td>';
            echo '<td><a href="delete-author.php?author_id='.$row['author_id'].'"><img src="delete.png"></a></td>';
            echo '</tr>';
        }
        ?>
        </table>
        <a href="create-author.php">Add Author +</a>
        <?php mysqli_close($con); //close connection?>
        
    </body>
</html>