<?php 
require_once "conect.php"; 
$email = $senha = "";
$email_err = $senha_err = "";

if(isset($_POST["email"]) && !empty($_POST["email"])){
    // Get hidden input value
    $email = $_POST["email"];


$input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter an email.";     
    } else{
        $email = $input_email;
    }
    
    // Validate password
    $input_senha = trim(md5($_POST["senha"]));
    if(empty($input_senha)){
        $senha_err = "Please enter the password amount.";     
    } else{
        $senha = $input_senha;
    }

     // Check input errors before inserting in database
    if(empty($email_err) && empty($senha_err)){
        // Prepare an update statement
        $sql = "UPDATE cadastro_aluno SET email=?, senha=? WHERE email=?";
         
        if($stmt = mysqli_prepare($mysqli, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_email, $param_senha, $param_email);
            
            // Set parameters
            $param_email = $email;
            $param_senha = $senha;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: cadastro_aluno3.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
       
           }
           // Close statement
        mysqli_stmt_close($stmt);
        }

         
        
    }
    
    // Close connection
    mysqli_close($mysqli);

 } else{
    // Check existence of id parameter before processing further
    if(isset($_POST["email"]) && !empty(trim($_POST["email"]))){
        // Get URL parameter
        $email =  trim($_POST["email"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM cadastro_aluno WHERE email = ?";
        if($stmt = mysqli_prepare($mysqli, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $email = $row["email"];
                    $senha = $row["senha"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($mysqli);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Atualizar Registro</h2>
                    </div>
                    <p>Por favor atualize os dados abaixo.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="POST">
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>E-mail</label>
                            <textarea name="email" class="form-control"><?php echo $email; ?></textarea>
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($senha_err)) ? 'has-error' : ''; ?>">
                            <label>Senha</label>
                            <input type="text" name="senha" class="form-control" value="<?php echo $senha; ?>">
                            <span class="help-block"><?php echo $senha_err;?></span>
                        </div>
                        <input type="hidden" name="email" value="<?php echo $email; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="recuperar_senha.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
-->