<?php
include("conect.php");
 
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT RM, email, senha FROM cadastro_aluno WHERE email = '$email'";
//echo $sql;
$result = mysqli_query($mysqli, $sql);
$num_rows = mysqli_num_rows($result);

//echo $num_rows;
//var_dump($result);
//echo $num_rows;
if ($num_rows == 0)
{
    echo "Usuário ou senha incorretos";
}else{  
    session_start();
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC); 
    $bd_email = $row['email'];
    $bd_senha = $row['senha'];
    $_SESSION['RM'] = $row['RM'];
    header('Location: pagina_do_usuario.php');

    if ($senha == $bd_senha) {
             session_start();
             $_SESSION['email']=$email;
             }else{
              echo "Usuário ou senha inválidos";
              exit;
           }
           mysqli_free_result($result);
       }



?>



