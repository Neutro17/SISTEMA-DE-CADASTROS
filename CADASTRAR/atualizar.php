<?php

 include 'conexao.php';
 require 'index.php'

 if(isset($_POST['edit'])){

 $id = $_GET['usuario_id'];
 $usuario = $_POST['username'];
 $nome = $_POST['nome'];
 $senha = $_POST['senha'];
 $email= $_POST['email'];
 $tipo = $_POST['tipo'];
 $mysqqli->query( "UPDATE usuarios SET usuario='$usuario', nome='$nome' senha='$senha', email='$email', tipo='$tipo' WHERE usuario_id = $id  ");

 header('location: index.php');
 }

?>

<!DOCTYPE html>
<html>
<head>
 <title></title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

 <div class="col-lg-6 m-auto">
 
 <form method="post">
 
 <br><br><div class="card" action="conexao.php">
 
 <div class="card-header bg-dark">
 <h1 class="text-white text-center">  Update Operation </h1>
 </div><br>

 <label> usuario: </label>
 <input type="text" name="usuario" class="form-control"> <br>

 <label> nome: </label>
 <input type="text" name="nome" class="form-control"> <br>

 <label> senha: </label>.
 <input type="text" name="senha" class="form-control"> <br>

 <label> email: </label>
 <input type="text" name="email" class="form-control"> <br>

 <label> Tipo: </label>
 <input type="text" name="tipo" class="form-control"> <br>

 <button class="btn btn-success" type="submit" name="done"> Atualizar Cadastro </button><br>

 </div>
 </form>
 </div>
</body>
</html>