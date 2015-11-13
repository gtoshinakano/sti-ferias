<?php
    
$tpl->addFile('CONTEUDO', 'html_libs/views/index.html');

/*
 * Buscar usuários com admissao <> "" para preencher array
 */
$func_sql   = "SELECT pront, nome, rg2, admissao FROM usuario WHERE admissao <> '' ORDER BY nome ASC";
$func_query = mysql_query($func_sql);
$funcionarios;

if(mysql_num_rows($func_query) > 0){
    
    // Colocando resultado da consulta em array $funcionarios e buscando seus períodos de férias
    $it_func = 0;
    while($linha = mysql_fetch_array($func_query, MYSQL_ASSOC)){
        
        $funcionarios[$it_func] = $linha;
        
        $it_func++;
        
    }
    
}

?>
