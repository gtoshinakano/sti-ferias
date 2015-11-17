<?php
    
$tpl->addFile('CONTEUDO', 'html_libs/views/index.html');

/*
 * Buscar usuários com admissao <> "" para preencher array
 */
$func_sql   = "SELECT pront,nome,rg2,admissao FROM usuario WHERE admissao <> '' ORDER BY nome";
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
        //Buscar férias de funcionario
        $fer_sql    = "SELECT aquisicao_ini, aquisicao_fin, ferias_ini, ferias_fin FROM ferias WHERE pront = '" . $linha['pront'] . "' ORDER BY aquisicao_ini DESC limit 1";
        $fer_query  = mysql_query($fer_sql);
        if( mysql_num_rows($fer_query) ==  1 ){
            
            $ferias = mysql_fetch_assoc($fer_query);            
            $tpl->FERIAS= setDateDiaMesAno($ferias['ferias_ini']) . " a " . setDateDiaMesAno($ferias['ferias_fin']);
            $tpl->PERIODO=setDateDiaMesAno($ferias['aquisicao_ini']) . " a " . setDateDiaMesAno($ferias['aquisicao_fin']);
            if($today_date > $ferias['aquisicao_fin']) 
                $tpl->PERIODO .= ' <span class="glyphicon glyphicon-asterisk" style="color:red"></span>';
            
        }else{
            
            // Para não mostrar férias nem períodos
            $tpl->FERIAS = "sem dados";
            $tpl->PERIODO= "sem dados";
                    
        }
            
        
        $tpl->block('EACH_FUNC');
        
    }
    
}


//$fin = date('Y-m-d', strtotime("+1 year -1 day",strtotime($linha['aquisicao_ini'])));
?>
