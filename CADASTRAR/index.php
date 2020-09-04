<?php
session_start();
include_once ('verifica_loginadm.php');
require_once 'classe-php.php';
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

    if(isset($_GET['id_up']) && !empty($_GET['id_up']))
    {
     $id_upt = addslashes($_GET['id_up']); 
     $usuario = addslashes($_POST['usuario']); 
     $nome = addslashes($_POST['nome']);
     $senha = addslashes($_POST['senha']);
     $email = addslashes($_POST['email']);
     $tipo  = addslashes($_POST['tipo']);
    }

     if (!empty($usuario) && !empty($nome) && !empty($senha) && !empty($email) && !empty($tipo)) 
     {
       !$p->AtualizarDados($id_upt, $usuario, $nome, $senha, $email, $tipo);
     } 

    else
    {
     $usuario = addslashes($_POST['usuario']); 
     $nome = addslashes($_POST['nome']);
     $senha = addslashes($_POST['senha']);
     $email = addslashes($_POST['email']);
     $tipo  = addslashes($_POST['tipo']);

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

  }

?>


<?php 

if (isset($_GET['id_up'])) 
{
  $id_update = addslashes($_GET['id_up']);
  $res = $p->buscarDadosPessoa($id_update);	
}
?>


<section id="esquerda">
   <form method="POST">
	<h1>CADASTRAR PESSOA</h1>
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario" value="<?php if(isset($res)){echo $res['usuario'];}?>">
        <label for="nome" >Nome</label>
        <input type="text" name="nome" id="nome" value="<?php if(isset($res)){echo $res['nome'];}?>">
        <label for="nome">Senha</label>
        <input type="text" name="senha" id="senha" value="<?php if(isset($res)){echo $res['senha'];}?>">
        <label for="email">email</label>
        <input type="text" name="email" id="email" value="<?php if(isset($res)){echo $res['email'];}?>">
        <label for="tipo">Tipo</label>
        <input type="text" name="tipo" id="tipo" value="<?php if(isset($res)){echo $res['tipo'];}?>">
        <input type="submit" value="<?php if(isset($res)){echo "Atualizar"; } else {echo "Cadastrar";} ?>">
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

 if(isset($_GET['id']))
  {
    $id = addslashes($_GET['id']);
    $p->excluirPessoa($id);
    header("location: index.php");
 }

?>