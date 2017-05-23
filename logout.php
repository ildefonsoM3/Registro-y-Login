<!--                 Nombre: Jesús Ildefonso Muro Esquivias - Código: 215235683         -->
<?php  
 //logout.php  
 session_start();  
 session_destroy();  
 header("location:index.php?action=login");  
 ?>  