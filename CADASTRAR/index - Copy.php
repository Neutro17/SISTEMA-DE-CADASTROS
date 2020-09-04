<?php
require_once 'classe-php.php';
$usu_codigo = intval ($_gG['codigo']);

$p = new Pessoa("cadastro","127.0.0.1","root","");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastrar Usuario</title>
	<link rel="stylesheet" href="estilo.css" >
</head>
<body>
<?php
  if (isset($_POST['usuario'])) 
  {
     $usuario = addslashes($_POST['usuario']); 
     $nome = addslashes($_POST['nome']);
     $senha = addslashes($_POST['senha']);
     $email = addslashes($_POST['email']);
     $tipo 	= addslashes($_POST['tipo']);

     if (!empty($usuario) && !empty($nome) && !empty($senha) && !empty($email) && !empty($tipo)) 
     {
       if ($p->CadastrarPessoa($usuario, $nome, $senha, $email, $tipo)) 	
       {
             echo "email ja cadastrados ";
       }
     }  
     else
     {
      echo"Preencha todos os campos";
     }

  }



?>


<?php 

if (isset($_GET['id_up'])) 
{
  $id_update = addslashes($_GET['id_up']);
  $res = $p->buscarDadosPessoas($id_update);	
}
?>


<section id="esquerda">
   <form method="POST">
	<h1>CADASTRAR PESSOA</h1>
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome">
        <label for="nome">Senha</label>
        <input type="text" name="senha" id="senha">
        <label for="email">email</label>
        <input type="text" name="email" id="email">
        <label for="tipo">Tipo</label>
        <input type="text" name="tipo" id="tipo">
        <input type="submit" value="Cadastrar">
   </form>     
</section>

<section id="direita">
  <table>
		<tr id="titulo">
         <td>Usuario</td>
         <td>nome</td>
         <td>senha</td>
         <td>email</td>
         <td>tipo</td>
		</tr>
	<?php
	  $dados = $p->buscarDados();

	 if (count($dados)> 0)
      {
	  
	  
	     for ($i=0; $i < count($dados) ; $i++)
	      { 

          echo "<tr>";

	  		foreach ($dados[$i] as $k => $v)
	  		 {
	 
	  			if ($k != "usuario_id") 
	  		   {
	  			echo "<td>".$v."</td>";	
	  		   }
	  		 
	  	    }
	  	    ?>
	  	    	<td>
	  	    		<?php echo $dados[$i]['usuario_id'];?>
	  	    		<a href="index.php?id_up=<?php echo $dados[$i]['usuario_id'];?>">Editar</a>
	  	    		<a href="index.php?id=<?php echo $dados[$i]['usuario_id'];?>">Excluir</a>
	  	    	</td>
	  	    <?php	
	  	    echo "</tr>";
	  	   
	   	}
	}					

	else
	{
       echo "Ainda nao ha pessoas cadastradas";
	}
?>
		
	</table>
</section>

</body>
</html>

<?php 

 if(isset($_GET['usuario_id']))
  {

    $id_pessoa = addslashes($_GET['usuario_id']);
    $p->excluirPessoa($id_pessoa);
    header("location: index.php");

 }

 else{

   $sql_code = "SELECT * FROM usuario WHERE usuario_id = '$usu_codigo'";
   $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);
   $linha = $sql_query->db2_fetch_assoc();

   $_SESSION[usuario] = $linha['usuario'];
   $_SESSION[nome]= $linha['nome'];
   $_SESSION[senha]= $linha['senha'];
   $_SESSION[email]= $linha['email'];
   $_SESSION[tipo]= $linha['tipo'];
 }

?>