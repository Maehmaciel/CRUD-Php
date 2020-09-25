<?php
// Include config file
require_once "connection.php";
 
$nome = $idade ="";
$nome_err = $idade_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_err = "Please enter a nome.";
    } else{
        $nome = $input_nome;
    }

    
    $input_idade = trim($_POST["idade"]);
    if(empty($input_idade)){
        $idade_err = "Please enter the idade amount.";     
    } elseif(!ctype_digit($input_idade)){
        $idade_err = "Please enter a positive integer value.";
    } else{
        $idade = $input_idade;
    }
    
    if(empty($nome_err) && empty($idade_err)){
        if(isset($_POST["id"]) && !empty($_POST["id"])){
        $id = $_POST["id"];
        $sql = "UPDATE pessoas SET nome=?, idade=? WHERE id=?";
         echo $id;
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sii", $param_nome, $param_idade, $param_id);
            
            $param_nome = $nome;
            $param_idade = $idade;
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        mysqli_stmt_close($stmt);
        }else{ $sql = "INSERT INTO pessoas (nome, idade) VALUES (?, ?)";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "si", $param_nome, $param_idade);
            $param_nome = $nome;
            $param_idade = $idade;
            
        }
        if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
             echo $stmt->error;
        mysqli_stmt_close($stmt);

        }
       
    }
    mysqli_close($link);
}


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulário</title>
    <link rel="stylesheet" href="estilo.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div >
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="<?php echo (!empty($nome_err)) ? 'has-error' : ''; ?>">
                            <input type="text" name="nome" placeholder="Nome" value="<?php echo $nome; ?>">
                            <span ><?php echo $nome_err;?></span>
                        </div>
                        <div class="<?php echo (!empty($idade_err)) ? 'has-error' : ''; ?>">
                            <input type="text" placeholder="Idade" name="idade" value="<?php echo $idade; ?>">
                            <span ><?php echo $idade_err;?></span>
                        </div>
                      
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
                        <input type="submit"  value="Submit" class="btn-positive">
                        <a href="index.php" >Cancel</a>
                    </form>
</div> 
</body>
</html>