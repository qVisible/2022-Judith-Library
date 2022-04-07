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
       <h1>Loans</h1>
   
       <table>
           <tr>
               <th>taken</th>
               <th>returned</th>
               <th>member</th>
               <th>book</th>
               <th>loan id</th>
               <th>copy id</th>
               <th>edit</th>
               <th>delete</th>
           </tr>
       <?php
        $sql="SELECT * FROM t_loans JOIN t_members ON member_fk=member_id JOIN t_copies ON copy_id=copy_fk 
        JOIN t_books ON book_id=book_fk ORDER BY date_returned, date_out DESC";

        $result=mysqli_query($con,$sql);

        while ($row=mysqli_fetch_array($result)){

            echo '<tr>';
            echo '<td>'.$row['date_out'].'</td>';
            echo '<td>';
            if(!empty($row['date_returned'])){
              echo $row['date_returned'];
            }
            else{
              echo '<span style="color:red">On loan</span>&nbsp;&nbsp;&nbsp;<button onclick="window.location=\'return-loan.php?loan_id='.$row['loan_id'].'\';">return</button>';
            }
            echo '</td>';
            echo '<td>'.$row['forename'].' '.$row['surname'].'</td>';
            echo '<td>'.$row['title'].'</td>';
            echo '<td>'.$row['loan_id'].'</td>';
            echo '<td>'.$row['copy_id'].'</td>';
            echo '<td><a href="update-loan.php?loan_id='.$row['loan_id'].'"><img src="edit.png"></a></td>';
            echo '<td><a href="delete-loan.php?loan_id='.$row['loan_id'].'"><img src="delete.png"></a></td>';
        }
        ?>
        
        </div>
      <div id="sub-nav">
        <a href="create-loan.php">Add loan +</a>
      </div>
        <?php mysqli_close($con); //close connection?>
       </main>
    </body>
</html>