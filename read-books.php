<html>
   <head>
        <title>Judith Library System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style1.css" rel="stylesheet" type="text/css"> 
    </head>
    <script>
        /*expand and collapse the copy-info area*/
        function expand(bookId){
            if(document.getElementById('copy'+bookId).style.display=='none'){
                document.getElementById('copy'+bookId).style.display="table-row";
                document.getElementById('expand'+bookId).src="collapse.png";
            }
            else{
                document.getElementById('copy'+bookId).style.display="none";
                document.getElementById('expand'+bookId).src="expand.png";
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
           <th></th>
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
       /*get the result set from the books table in the database*/
        $sql="SELECT * FROM t_books JOIN t_authors ON author_fk=author_id JOIN t_publishers ON publisher_fk=publisher_id";

        $resultBooks=mysqli_query($con,$sql);

        while ($rowBooks=mysqli_fetch_array($resultBooks)){
            /*show the normal book information*/
            echo '<tr>';
            echo '<td><a onclick="expand('.$rowBooks['book_id'].')"><img id="expand'.$rowBooks['book_id'].'" src="expand.png" style="width:12px;border:none;"></a></td>';
            echo '<td>'.$rowBooks['book_id'].'<a onclick="expand('.$rowBooks['book_id'].')"></a></td>';
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
            /*end of normal book information*/

            /*copy info - giving the librarian more information about the copies of each book title*/
            $sql='SELECT DISTINCT copy_id FROM t_copies LEFT JOIN t_loans ON copy_id=copy_fk WHERE book_fk='.$rowBooks['book_id'];

            $resultCopies=mysqli_query($con,$sql);
            echo '<tr  id="copy'.$rowBooks['book_id'].'" style="padding:0px;display:none;border-bottom:1px solid lightgrey;">';
            echo '<td colspan="10">';
            echo '<div id="copy-info" >';
            echo '<div id="copy-header">copies ('.mysqli_num_rows($resultCopies).'): '.'</div>';
            echo '<section>';
            if (mysqli_num_rows($resultCopies) == 0){
                echo '0 copies';
            }
            else{
                while ($rowCopies=mysqli_fetch_array($resultCopies)){
                echo '<div>id: '.$rowCopies['copy_id'];
                
                $sqlOnLoan='SELECT * FROM t_loans JOIN t_members ON member_fk=member_id WHERE copy_fk='.$rowCopies['copy_id'].' ORDER BY date_returned LIMIT 1';
                
                $resultOnLoan=mysqli_query($con,$sqlOnLoan);
                $rowOnLoan=mysqli_fetch_array($resultOnLoan);

                if (mysqli_num_rows($resultOnLoan) != 0 && is_null($rowOnLoan['date_returned'])){
                    echo '<span id="loan_status" style="color:red">On Loan</span> to '.$rowOnLoan['forename'].' '.$rowOnLoan['surname'];
                }
                else{
                    echo '<span id="loan_status">Check Shelf</span>';
                }
                echo '</div>';
            }
            
            }
         
            echo '</section>';

            echo '<a href="create-copy.php?book_id='.$rowBooks['book_id'].'">Add Copy +</a>';
            echo '</div>';
            echo '</td>';
            echo '</tr>'.PHP_EOL;
            /*end of copy-info section*/
            
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