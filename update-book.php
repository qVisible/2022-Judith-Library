<html>
   <head>
        <title>Judith Library System</title>
        <link href="style1.css" rel="stylesheet" type="text/css">   
    </head>
    <body>
       <?php require_once('nav.php');?>
       <?php require_once('db-connect.php'); //connect to database?>
       
       

        
        <?php
        //recursive form handling
        if(!empty($_POST['title'])){
            $book_id=$_POST['book_id'];
			$title=$_POST['title'];
            $isbn=$_POST['isbn'];
            $date_published=$_POST['date_published'];
            $author_fk=$_POST['author_fk'];
            $publisher_fk=$_POST['publisher_fk'];
            
            $sql='UPDATE t_books SET title="'.$title.'", isbn="'.$isbn.'", date_published="'.$date_published.'", author_fk='.$author_fk.', publisher_fk='.$publisher_fk.' WHERE book_id='.$book_id;
            
            echo $sql.'<br>';

            
            if(mysqli_query($con,$sql)){
                echo 'Book '.$book_id.' has been updated';
            }
            else{
                echo "Error creating Book record: " . mysqli_error($con);
            }
        }
        
        ?>
       
		
		 <?php
		    //process book chosen by user to update
            $book_id=$_GET['book_id'];
        
            $sql='SELECT * FROM t_books WHERE book_id='.$book_id;

            $result=mysqli_query($con,$sql);     
        
            $rowBooks=mysqli_fetch_array($result);
        
        ?>

       
  
       <h1>Update Book</h1>
       
       <form method="post" action="update-book.php">
           <label>title</label><input type="text" name="title" value="<?php echo $rowBooks['title'] ?>">
           <label>isbn</label><input type="number" name="isbn"  value="<?php echo $rowBooks['isbn'] ?>">
           <label>date published</label><input type="date" name="date_published"  value="<?php echo $rowBooks['date_published'] ?>">
           
           
           <!--Create Authors Dropdown Menu-->
           <label>authors</label>
           <select name="author_fk">
           <?php
               //populate the drop down menu from the authors table
               $sql='SELECT * FROM t_authors';

               $result=mysqli_query($con,$sql);

               while ($rowAuthors=mysqli_fetch_array($result)){
                   
                   echo '<option value="'.$rowAuthors['author_id'].'"';
                   if($rowAuthors['author_id']==$rowBooks['author_fk']){
                       echo ' selected ';
                   }
                   echo '>';
                   echo $rowAuthors['author_name'].'</option>'.PHP_EOL;
                   
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

               while ($rowPublishers=mysqli_fetch_array($result)){
                   echo '<option value="'.$rowPublishers['publisher_id'].'"';
                   if($rowPublishers['publisher_id']==$rowBooks['publisher_fk']){
                       echo ' selected ';
                   }
                   echo '>';
                   echo $rowPublishers['publisher_name'].'</option>'.PHP_EOL;
               }
           ?>
           </select>
           <!--end of Publishers Dropdown Menu-->
		   
		   <!--pass book id chosen by user as hidden value - needed for record selection on recursive form processing-->
		   <input type="hidden" name="book_id" value="<?php echo $book_id?>">         
           
           
           <input type="submit" value="Update Book">
       </form>
       
       
       <?php mysqli_close($con); //close connection?>
        
    </body>
</html>