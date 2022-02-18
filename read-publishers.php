<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       <h1>Publishers</h1>
       <table>
       <tr>
           <th>id</th>
           <th>publisher</th>
           <th>edit</th>
           <th>delete</th>
       </tr>
       <?php
        $sql="SELECT * FROM t_publishers";

        $result=mysqli_query($con,$sql);

        while ($row=mysqli_fetch_array($result)){
            echo '<tr>';
            echo '<td>'.$row['publisher_id'].'</td>';
            echo '<td>'.$row['publisher_name'].'</td>';
            echo '<td><a href="update-publisher.php?publisher_id='.$row['publisher_id'].'"><img src="edit.png"></a></td>';
            echo '<td><a href="delete-publisher.php?publisher_id='.$row['publisher_id'].'"><img src="delete.png"></a></td>';
            echo '</tr>';
        }
        ?>
        </table>
        <a href="create-publisher.php">Add Publisher +</a>
        <?php mysqli_close($con); //close connection?>
        
    </body>
</html>