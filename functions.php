<?php

function verifica_dados($con)
{

	if(isset($_POST['env']) && $_POST['env'] == "form"){
     
    $sql = $con->prepare ("SELECT email FROM usuarios WHERE email = ?"); 
    $sql->bind_param("s", $_POST['email']);
    $sql->execute();
    $get = $sql->get_result();
    $total = $get->num_rows; 
    
    if ($total > 0) {
    	

    }
  else 
    {
      
    }
 } 
}


function enviar_email($con){



}

 ?>