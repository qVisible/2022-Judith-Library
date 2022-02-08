<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       
       
       
       <?php
        if(!empty($_POST['title'])){
            $title=$_POST['title'];
            $isbn=$_POST['isbn'];
            $date_published=$_POST['date_published'];
            $author_fk=$_POST['author_fk'];
            $publisher_fk=$_POST['publisher_fk'];
            
            $sql='INSERT INTO t_books (title, isbn, date_published, author_fk, publisher_fk)
            VALUES ("'.$title.'", "'.$isbn.'", "'.$date_published.'", '.$author_fk.','.$publisher_fk.')';
            
            if(mysqli_query($con,$sql)){
                echo 'Book '.$book_id.' has been created';
            }
            else{
                echo "Error creating Book record: " . mysqli_error($con);
            }
        }
        
        ?>
       
       <h1>Add Book</h1>
       
       <form method="post" action="create-book.php">
           <label>title</label><input type="text" name="title">
           <label>isbn</label><input type="number" name="isbn">
           <label>date published</label><input type="date" name="date_published">
           
           
           <!--Create Authors Dropdown Menu-->
           <label>authors</label>
           <select name="author_fk">
           <?php
               //populate the drop down menu from the authors table
               $sql='SELECT * FROM t_authors';

               $result=mysqli_query($con,$sql);

               while ($row=mysqli_fetch_array($result)){
                    echo '<option value="'.$row['author_id'].'">'.$row['author_name'].'</option>';
               }
           ?>
           </select>
           <!--end of Authors Dropdown Menu-->
           
           <!--Create Publishers Dropdown Menu-->
           <label>publishers</label>
           <select  name="publisher_fk">
           <?php
               //populate the drop down menu from the publishers table
               $sql='SELECT * FROM t_publishers';

               $result=mysqli_query($con,$sql);

               while ($row=mysqli_fetch_array($result)){
                    echo '<option value="'.$row['publisher_id'].'">'.$row['publisher_name'].'</option>';
               }
           ?>
           </select>
           <!--end of Publishers Dropdown Menu-->
           
           
           
           <input type="submit" value="Add Book">
       </form>
       
       
       <?php mysqli_close($con); //close connection?>
        
    </body>
</html>