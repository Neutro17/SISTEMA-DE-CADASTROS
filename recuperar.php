<?php
      
    include("conexao.php");
    session_start();

    $_SESSION["nome"] = "nome_do_usuario";



    if(isset($_POST[ok])){  

        $email = $mysqli->escape_string($_POST['usuario_id']);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erro[] = "E-mail inválido.";
        }

        $sql_code = "SELECT senha, usuario_id FROM usuarios WHERE email = '$email'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $dado = $sql_query->fetch_assoc($total);
        $total = $sql_query->num_rows;

        if($total == 0){
            $error[] = "O email informado não existe no banco de dados.";
        }

        if(count($erro) == 0 && total > 0){


        $novasenha = substrmd5(time(),0,6);
        $nscriptografada = md5(md5($novasenha));
        

        if(mail($email,"Sua nova senha","Sua nova senha:".$novasenha)){

        $sql_code = "UPDATE usuarios SET senha = '$nscriptografada' WHERE email = '$email'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

            if($sql_query)
                $error[] = "Senha Alterada com Sucesso!";


            }
        }
    }

?>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <?php if (count($error) > 0)
        foreach($error as $msg){ 
            echo "<p>$msg</p>";        
        }
    ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input value="<?php echo $_POST['email']; ?>" placeholder="Seu e-mail" name="email" type="text">
        <input name="ok" value="ok" type="submit">
</form>
</body>