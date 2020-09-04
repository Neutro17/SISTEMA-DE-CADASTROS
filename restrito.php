<?php
// Verificador de sessão
require "verifica.php";

// Conexão com o banco de dados
require "comum.php";



// Imprime mensagem de boas vindas
echo "<font face=\"Verdana\" size=2>Bem-Vindo " . $_SESSION["nome_usuario"] . "!<BR>\n";

// Verifica e imprime quantidade de notícias no nome do usuário
$SQL = "SELECT id
FROM aut_noticias
WHERE autor_id = " . $_SESSION["id_usuario"];
$result_id = mysql_query($SQL) or die(mysql_error());
$total = mysql_num_rows($result_id);

if($total)
{
    echo "Há um total de " . $total . " notícia(s) de sua autoria!\n";
}
else
{
    echo "Não há nenhuma notícia de sua autoria!\n";
}

/**
* Verifica se usuário tem permissão para postar novas notícias.
* Caso positivo, imprime link para postagem de notícias
*/
if($_SESSION["permissao"] == "S")
{
    echo " | <a href=\"nova.php\">Postar nova notícia</a>\n";
}

// Imprime link de logout
echo " | <a href=\"sair.php\">Sair do Sistema</a>";

echo "<br><br>\n";

/**
* Imprime as notícias
*/
$SQL = "SELECT id, titulo, data
FROM aut_noticias
ORDER BY data DESC";
$result_id = mysql_query($SQL) or die(mysql_error());
$total = mysql_num_rows($result_id);

if($total)
{
// Abre tabela HTML
    echo "<table border=1 cellpadding=3 cellspacing=0>\n";
    echo "<tr><th>Id</th><th>Título</th><th>Data</th></tr>\n";

    // Efetua o loop no banco de dados
    while($dados = mysql_fetch_array($result_id))
    {
        echo "<tr><td>" . $dados["id"] . "</td><td>";
        echo " <a href=\"ver_noticia.php?id=" . $dados["id"] . "\">"
        . stripslashes($dados["titulo"]) . ";
        echo "</a></td>";
        echo "<td>" . date("d/m/Y à\s H:i:s", $dados["data"]).
         "</td></tr>\n";
    }

    // Fecha tabela
    echo "</table>\n";
}
else
{
    echo "<B>Nenhuma notícia cadastrada!</B>\n";
}
