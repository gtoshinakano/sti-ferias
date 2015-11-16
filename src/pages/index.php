<?php
    
$tpl->addFile('CONTEUDO', 'html_libs/views/index.html');

/*
 * Buscar usuários com admissao <> "" para preencher array
 */
$func_sql   = "SELECT u.pront, u.nome, u.rg2, u.admissao, f.aquisicao_ini, f.aquisicao_fin, f.ferias_ini, f.ferias_fin FROM usuario u, ferias f ";
$func_sql  .= "WHERE u.admissao <> '' AND u.pront = f.pront ORDER BY u.nome ASC, f.aquisicao_ini DESC limit 1";
$func_query = mysql_query($func_sql);


$today_date = Date('Y-m-d');
$tpl->TODAY = setDateDiaMesAno($today_date, true);
if(mysql_num_rows($func_query) > 0){
    
    // Colocando resultado da consulta em array $funcionarios e buscando seus períodos de férias
    while($linha = mysql_fetch_array($func_query, MYSQL_ASSOC)){
        $tpl->PRONT = $linha['pront'];
        $tpl->NAME  = $linha['nome'];
        $tpl->RG    = $linha['rg2'];
        $tpl->ADMISS= setDateDiaMesAno($linha['admissao']);
        $tpl->FERIAS= setDateDiaMesAno($linha['ferias_ini']) . " a " . setDateDiaMesAno($linha['ferias_fin']);
        $tpl->PERIODO=setDateDiaMesAno($linha['aquisicao_ini']) . " a " . setDateDiaMesAno($linha['aquisicao_fin']);
        if($today_date > $linha['aquisicao_fin']) 
            $tpl->PERIODO .= ' <span class="glyphicon glyphicon-asterisk" style="color:red"></span>';
        $tpl->block('EACH_FUNC');
        
    }
    
}


//$fin = date('Y-m-d', strtotime("+1 year -1 day",strtotime($linha['aquisicao_ini'])));
?>
