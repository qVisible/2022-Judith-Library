<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       <h1>Book Collection</h1>
       <table>
       <tr>
           <th>id</th>
           <th>title</th>
           <th>isbn</th>
           <th>published</th>
           <th>author</th>
           <th>publisher</th>
           <th>edit</th>
           <th>delete</th>
       </tr>
       <?php
        $sql="SELECT * FROM t_books JOIN t_authors ON author_fk=author_id JOIN t_publishers ON publisher_fk=publisher_id";

        $result=mysqli_query($con,$sql);

        while ($row=mysqli_fetch_array($result)){
            echo '<tr>';
            echo '<td>'.$row['book_id'].'</td>';
            echo '<td>'.$row['title'].'</td>';
            echo '<td>'.$row['isbn'].'</td>';
            echo '<td>'.$row['date_published'].'</td>';
            echo '<td>'.$row['author_name'].'</td>';
            echo '<td>'.$row['publisher_name'].'</td>';
            echo '<td><a href="update-book.php?book_id='.$row['book_id'].'"><img src="edit.png"></a></td>';
            echo '<td><a href="delete-book.php?book_id='.$row['book_id'].'"><img src="delete.png"></a></td>';
            echo '</tr>';
        }
        ?>
        </table>
        <a href="create-book.php">Add Book +</a>
        <?php mysqli_close($con); //close connection?>
        
    </body>
</html>