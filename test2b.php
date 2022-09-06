<?php 

$output = shell_exec('python servercamera.py');
  
// Display the list of all file
// and directory
echo "<pre>$output</pre>";
?>