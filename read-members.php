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
       <h1>Members</h1>
   
       <div id="member-container">
       <?php
        $sqlMembers="SELECT * FROM t_members ORDER BY surname";

        $resultMembers=mysqli_query($con,$sqlMembers);

        while ($rowMembers=mysqli_fetch_array($resultMembers)){
            echo '<div id="member">';
            echo '<img src="';
            if($rowMembers['member_image']!=''){
                echo $rowMembers['member_image'];
            }
            else{
                echo 'member-images/no-image.png';
            }
            echo '">';
            echo '<h2>'.$rowMembers['forename'].' '.$rowMembers['surname'].'</h2>';
            echo '<span id="member_id">id: '.$rowMembers['member_id'].'</span>';
            echo '<span>dob: '.$rowMembers['dob'].'</span>';
            echo '<span>'.$rowMembers['address'].'</span>';
            echo '<span>email: '.$rowMembers['email'].'</span>';
            
            echo '<footer><a href="update-member.php?member_id='.$rowMembers['member_id'].'"><img src="edit.png"></a>';
            echo '<a href="delete-member.php?member_id='.$rowMembers['member_id'].'"><img src="delete.png"></a></footer>';
            
            $sqlLoans='SELECT * FROM t_members JOIN t_loans ON member_id=member_fk JOIN t_copies ON copy_id=copy_fk JOIN t_books ON book_fk=book_id WHERE member_id='.$rowMembers['member_id'].'  ORDER BY date_returned DESC LIMIT 5';
           
            $resultLoans=mysqli_query($con,$sqlLoans);
            
            if(mysqli_num_rows($resultLoans)!=0){
              echo '<h3>Recent Loans &#8594</h3>';
              echo '<div id="member-loans">';
              echo '<ul>';
              while ($rowLoans=mysqli_fetch_array($resultLoans)){
                  echo '<li>';
                  echo $rowLoans['title'];
                  echo ' ('.$rowLoans['date_out']. ')';
                  echo '</li>';

              }
              echo '</ul>';
              echo '</div>';

            }
            
            echo '</div>'.PHP_EOL;
        }
        ?>
        
        </div>
      <div id="sub-nav">
        <a href="create-member.php">Add Member +</a>
      </div>
        <?php mysqli_close($con); //close connection?>
       </main>
    </body>
</html>