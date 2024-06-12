<?php 
 // Menjalankan perintah dir
$hasil = shell_exec('dir');
//echo $hasil;
?> 

<?php
//$perintah = "C:\\Users\\dedyr\\AppData\\Local\\Programs\\Python\\Python312\\python.exe C:\\xampp\\htdocs\\machine_learning\\tes_python.py";
$perintah = "python C:\\xampp\\htdocs\\machine_learning\\tes_python.py";
$output = shell_exec($perintah); 
echo "hasil: <pre>$output</pre>"; 
?>