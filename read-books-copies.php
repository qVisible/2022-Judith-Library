<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css"> 
    </head>
    <script>
        function expand(bookId){
            if(document.getElementById('copy'+bookId).style.display=='none'){
                document.getElementById('copy'+bookId).style.display="table-row";
            }
            else{
                document.getElementById('copy'+bookId).style.display="none";
            }
        }
    </script>
    <body>
        
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       <main>
       <h1>Book Collection</h1>
       <table>
       <tr>
           <th>id</th>
           <th>title</th>
           <th>cover</th>
           <th>isbn</th>
           <th>published</th>
           <th>author</th>
           <th>publisher</th>
           <th>edit</th>
           <th>delete</th>
       </tr>
       <?php
        $sql="SELECT * FROM t_books JOIN t_authors ON author_fk=author_id JOIN t_publishers ON publisher_fk=publisher_id";

        $resultBooks=mysqli_query($con,$sql);

        while ($rowBooks=mysqli_fetch_array($resultBooks)){
            echo '<tr>';
            echo '<td>'.$rowBooks['book_id'].'<a onclick="expand('.$rowBooks['book_id'].')">+</a></td>';
            echo '<td>'.$rowBooks['title'].'</td>';
            echo '<td><img src="';
                if($rowBooks['book_image']!=''){
                    echo $rowBooks['book_image'];
                }
                else{
                    echo 'book-images/no-image.png';
                }
            echo '"></td>';
            echo '<td>'.$rowBooks['isbn'].'</td>';
            echo '<td>'.$rowBooks['date_published'].'</td>';
            echo '<td>'.$rowBooks['author_name'].'</td>';
            echo '<td>'.$rowBooks['publisher_name'].'</td>';
            echo '<td><a href="update-book.php?book_id='.$rowBooks['book_id'].'"><img src="edit.png"></a></td>';
            echo '<td><a href="delete-book.php?book_id='.$rowBooks['book_id'].'"><img src="delete.png"></a></td>';
            echo '</tr>'.PHP_EOL;

            /*copy info*/
            $sql='SELECT * FROM t_copies WHERE book_fk='.$rowBooks['book_id'];

            $resultCopies=mysqli_query($con,$sql);
            echo '<tr  id="copy'.$rowBooks['book_id'].'" style="padding:0px;display:none;background-color:#eeeeee;border-bottom:4px solid grey;border-radius:50px;">';
            echo '<td colspan="9" style="border:1px solid black">';
            echo '<div id="copy-info" >';
            echo '<div id="copy-header">copy info: '.'</div>';
            echo '<section>';
            if (mysqli_num_rows($resultCopies) == 0){
                echo '0 copies';
            }
            else{
                while ($rowCopies=mysqli_fetch_array($resultCopies)){
                echo '<div>copy id: '.$rowCopies['copy_id'].'</div>';
            }
            
            }
            echo '</section>';
            echo '<a href="create-copy.php?book_id='.$rowBooks['book_id'].'">Add Copy +</a>';
            echo '</div>';
            echo '</td>';
            echo '</tr>'.PHP_EOL;
            
        }
        ?>
        </table>
        <div id="sub-nav">
        <a href="create-book.php">Add Book +</a>
        </div>
        <?php mysqli_close($con); //close connection?>
        </main>
    </body>
</html>