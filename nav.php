<nav>
<a href="read-books.php">books</a>
<a href="read-authors.php">authors</a>
    | 
<a href="get-code.php?filename=<?php
$currentFile = $_SERVER['PHP_SELF'];
$parts = Explode('/', $currentFile);
echo $parts[count($parts) - 1]; //Get the current filename and pass it to the Get Code Page
?>">code</a>
</nav>
<hr>