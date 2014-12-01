<?php 

//Cierra la session y redirige  a index.html

session_start();

session_destroy();

echo '<script language="javascript">';
echo 'window.location.href = "http://localhost/meeze/index.html"';
echo '</script>';

?>