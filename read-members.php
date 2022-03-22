<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       <main>
       <h1>Members</h1>
   
       <div id="member-container">
       <?php
        $sql="SELECT * FROM t_members ORDER BY surname";

        $result=mysqli_query($con,$sql);

        while ($row=mysqli_fetch_array($result)){
            echo '<div id="member">';
            echo '<img src="';
            if($row['member_image']!=''){
                echo $row['member_image'];
            }
            else{
                echo 'member-images/no-image.png';
            }
            echo '">';
            echo '<h2>'.$row['forename'].' '.$row['surname'].'</h2>';
            echo '<span id="member_id">id: '.$row['member_id'].'</span>';
            echo '<span>dob: '.$row['dob'].'</span>';
            echo '<span>'.$row['address'].'</span>';
            echo '<span>email: '.$row['email'].'</span>';
            
            echo '<footer><a href="update-member.php?member_id='.$row['member_id'].'"><img src="edit.png"></a>';
            echo '<a href="delete-member.php?member_id='.$row['member_id'].'"><img src="delete.png"></a></footer>';
            
            
            
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