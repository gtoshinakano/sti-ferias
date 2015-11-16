<?php

/*
 * Arquivo chamado em root/index.php para visualizar informações de funcionarios.
 * Verifica logo se possui $_GET['pront'], caso verdadeiro e existente no BD,
 * continuar carregamento, caso contrário, redirecionar para index.php de volta.
 */

//$tpl->addFile('CONTEUDO', 'html_libs/views/index.html');


if(isset($_GET['pront'])){
    
    $today_date = Date('Y-m-d');
    $pront = mysql_real_escape_string($_GET['pront']);    
    $func_sql   = "SELECT * FROM usuario WHERE pront = '$pront' AND admissao <> '' ";
    $func_query = mysql_query($func_sql);
    if(mysql_num_rows($func_query) == 1){
        
        $tpl->addFile('CONTEUDO', 'html_libs/views/view.html');
        $funcionario= mysql_fetch_array($func_query, MYSQL_ASSOC);
        $tpl->NAME  = $funcionario['nome'];
        $tpl->PRONT = $funcionario['pront'];
        $tpl->RG    = $funcionario['rg2'];
        $tpl->ADMISS= $aquisi_ini = setDateDiaMesAno($funcionario['admissao']);
        $tpl->DIR   = $funcionario['dir'];
        $tpl->DIV   = $funcionario['divisao'];
        $tpl->SER   = $funcionario['ser'];
        $tpl->SEC   = $funcionario['secao'];
        
        /*
         * Buscar Férias, preencher tabela e última data no form.
         * O iterador serve para comparar o último período de aquisição das férias
         * com a data de hoje. Caso seja menor, aparecerá o asterisco, e será 
         * necessário marcar as férias do funcionário.
         */
        $ferias_it  = 0;
        $ferias_sql = "SELECT * FROM ferias WHERE pront = '$pront'";
        $ferias_query = mysql_query($ferias_sql);
        $ferias_qtd = mysql_num_rows($ferias_query);    
        while($ferias = mysql_fetch_array($ferias_query, MYSQL_ASSOC)){
            
            $ferias_it++;
            $tpl->PERIODO   = setDateDiaMesAno($ferias['aquisicao_ini']) . " a " . setDateDiaMesAno($ferias['aquisicao_fin']);
            if($today_date > $ferias['aquisicao_fin'] && $ferias_it == $ferias_qtd) 
                $tpl->PERIODO .= ' <span class="glyphicon glyphicon-asterisk" style="color:red"></span>';
            $tpl->FERIAS    = setDateDiaMesAno($ferias['ferias_ini']) . " a " . setDateDiaMesAno($ferias['ferias_fin']);
            $tpl->ABONO     = ($ferias['abono']) ? "SIM" : "NÃO";
            $tpl->ADIANTA   = ($ferias['adiantamento']) ? "SIM" : "NÃO";
            $tpl->block('EACH_FERIAS');
            $aquisi_ini     = setDateDiaMesAno($ferias['aquisicao_ini']);
            
        }
        
        /*
         * Colocar data no form. Se houver última data, preencher com ela.
         * Se não, colocar data de admissão. Fim de período será preenchido com JS
         */
        $tpl->AQUISICAO_INI = $aquisi_ini;
        
    }else{
        
        header("Location: index.php");
        
    }
    
}else{
    
    header("Location: index.php");
    
}