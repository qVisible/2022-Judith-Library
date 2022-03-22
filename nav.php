<nav>
<a href="read-books.php">books</a>
<a href="read-authors.php">authors</a>
<a href="read-publishers.php">publishers</a>
<a href="read-members.php">members</a>
    | 
<a href="get-code.php?filename=<?php
$currentFile = $_SERVER['PHP_SELF'];
$parts = Explode('/', $currentFile);
echo $parts[count($parts) - 1]; //Get the current filename and pass it to the Get Code Page
?>">code</a>
<img src="Judith-logos_transparent.png">
</nav>
