<!--                 Nombre: Jesús Ildefonso Muro Esquivias - Código: 215235683         -->

<?php 

$host_db = "localhost";
$user_db = "poncho";
$pass_db = "1234";
$db_name = "basedatos";

 $conexion = mysqli_connect($host_db, $user_db, $pass_db, $db_name)or die("Error en la conexión");  
 session_start();  

 if(isset($_SESSION["username"])){  
      header("location:bienvenido.php");  
 }  


 if(isset($_POST["register"])){  
        $username = mysqli_real_escape_string($conexion, $_POST["username"]);
        $password = mysqli_real_escape_string($conexion, $_POST["password"]);  
      if(!empty($username) && !empty($password)){               
           $password = md5($password); 
           $query = "INSERT INTO usuarios(username, password) VALUES('$username', '$password')";  
           if(mysqli_query($conexion, $query)){  
                echo '<script>alert("Registro Completo")</script>';  
        }  
      }else{  
           echo '<script>alert("Ambos campos son obligatorios")</script>';  
      }
 }  
 if(isset($_POST["login"])){  
            
        $username = mysqli_real_escape_string($conexion, $_POST["username"]);
        $password = mysqli_real_escape_string($conexion, $_POST["password"]);  
      if(empty($_POST["username"]) && empty($_POST["password"])){  
           echo '<script>alert("Ambos campos son obligatorios")</script>';  
      }else{  
           $password = md5($password);  
           echo $username ." -> ".$password;
           $query = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";  
           $result = mysqli_query($conexion, $query);  
           if($row = mysqli_fetch_array($result)){  
                $_SESSION['username'] = $row['username'];  
                header("location:bienvenido.php");  
           }else{  
                echo '<script>alert("Username o Password son incorrectos")</script>';  
           }  
      }  
 }  
 ?>  
 <!DOCTYPE html>  
 <html lang="en">  
      <head> 
           <meta charset="UTF-8"> 
           <title>Proyecto</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:500px;">  
                <h3 align="center">Seguridad de Base de Datos</h3>  
                <br />  
                <?php  
                if(isset($_GET["action"]) == "login")  
                {  
                ?>  
                <h3 align="center">Login</h3>  
                <br />  
                <form method="post">  
                     <label>Username</label>  
                     <input type="text" name="username" class="form-control" maxlength="15" />  
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="password" class="form-control" maxlength="15" />  
                     <br />  
                     <input type="submit" name="login" value="Login" class="btn btn-info" />  
                     <br />  
                     <p align="center"><a href="index.php">Register</a></p>  
                </form>  
                <?php       
                }  
                else  
                {  
                ?>  
                <h3 align="center">Register</h3>  
                <br />  
                <form method="post">  
                     <label>Username</label>  
                     <input type="text" name="username" class="form-control" maxlength="15" />  
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="password" class="form-control" maxlength="15" />  
                     <br />  
                     <input type="submit" name="register" value="Register" class="btn btn-info" />  
                     <br />  
                     <p align="center"><a href="index.php?action=login">Login</a></p>  
                </form>  
                <?php  
                }  
                ?>  
           </div>  
      </body>  
 </html>  
