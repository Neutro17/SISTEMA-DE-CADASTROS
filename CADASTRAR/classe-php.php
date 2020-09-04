<?php

class Pessoa{

    private $pdo;

	public function __construct($dbname, $host, $user, $senha)
	{
       try {
       	      $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
           }  
      catch (PDOException $e) 
      {
       	
        echo "Erro com banco de dados: ".$e->getMessage();
        exit();

       }

       catch (Exception $e) {
       	echo "Erro generico : ".$e->getMessage();
        exit();
       	
       }
		
	}

	public function buscarDados()
	{
        $res = array();
		$cmd = $this->pdo->query("SELECT * FROM usuarios ORDER BY usuario_id ");
		$res = $cmd->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	public function cadastrarPessoa($usuario, $nome, $senha, $email, $tipo)
	{
     $cmd = $this->pdo->prepare("SELECT usuario_id FROM usuarios WHERE email = :e");
     $cmd->bindValue(":e", $email);
     $cmd->execute();

     if($cmd->rowCount() > 0){

     	return false;

     }
     else{
     	$cmd = $this->pdo->prepare("INSERT INTO usuarios(usuario, nome,senha, email, tipo) VALUES (:u, :n, :s, :e, :t)");

     	$cmd ->bindValue(":u",$usuario);
     	$cmd ->bindValue(":n",$nome);
     	$cmd ->bindValue(":s",$senha);
     	$cmd ->bindValue(":e",$email);
     	$cmd ->bindValue(":t",$tipo);
        $cmd ->execute();
        return true;
     }
	}

   public function excluirPessoa($id)
   {
   	$cmd = $this->pdo->prepare("DELETE FROM cadastro.usuarios WHERE usuario_id = :id");
   	$cmd ->bindValue (":id", $id);
   	$cmd ->execute();
   }


   public function buscarDadosPessoa($id)
   {
    $res = array(); 	
    $cmd = $this->pdo->prepare("SELECT * FROM cadastro.usuarios WHERE usuario_id = :id");
    $cmd ->bindValue(":id", $id);
    $cmd ->execute(); 
    $res = $cmd->fetch(PDO::FETCH_ASSOC);
    return $res;
    }

     public function AtualizarDados($id, $usuario, $nome, $senha, $email, $tipo)
     {

     	 $cmd = $this->pdo->prepare("UPDATE cadastro.usuarios SET usuario = '$usuario', nome = '$nome', senha = '$senha', email = '$email', tipo = '$tipo' WHERE usuario_id = $id");
        
       $cmd->bindValue("$usuario", $usuario);
       $cmd->bindValue("$nome", $nome);
       $cmd->bindValue("$senha", $senha);
       $cmd->bindValue("$email", $email);
       $cmd->bindValue("$tipo", $tipo);
       $cmd->bindValue("$id", $id);
       $cmd->execute();
       return true;
              
     } 
  }  

?>