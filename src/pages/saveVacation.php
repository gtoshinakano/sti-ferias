<?php

/* 
 * Este arquivo é chamado em view.php na condição do usuário enviar formulário de férias.
 * Algumas variáveis do outro arquivo serão utilizadas aqui.
 * VARIAVEIS POSTS 
 * aquisicao-ini-post,aquisicao-fin-post,ferias-ini-post,ferias-fin-post,ferias-obs
 * OPT abono, adiantamento
 */

$aqui_ini = mysql_real_escape_string($_POST['aquisicao-ini-post']);
$aqui_ini = getTransformDate($aqui_ini);
$aqui_fin = mysql_real_escape_string($_POST['aquisicao-fin-post']);
$aqui_fin = getTransformDate($aqui_fin);
$feri_ini = mysql_real_escape_string($_POST['ferias-ini-post']);
$feri_ini = getTransformDate($feri_ini);
$feri_fin = mysql_real_escape_string($_POST['ferias-fin-post']);
$feri_fin = getTransformDate($feri_fin);
$feri_obs = mysql_real_escape_string($_POST['ferias-obs']);
$abono    = (isset($_POST['abono'])) ? true : false;
$adianta  = (isset($_POST['adiantamento'])) ? true : false;

if($aqui_ini != "" && $aqui_fin != "" && $feri_ini != "" && $feri_fin != "" ){
    
    
    // TODO: VALIDAR DATAS MAIORES, MENORES CONFORME REGRAS DE FÉRIAS 
    $sql = "INSERT INTO ferias(pront, created_on, abono, adiantamento, aquisicao_ini, aquisicao_fin, ferias_ini, ferias_fin, obs) "; 
    $sql.= "VALUES ('$pront', NOW(), $abono, $adianta, '$aqui_ini', '$aqui_fin', '$feri_ini', '$feri_fin', '$feri_obs')"; 
    if(mysql_query($sql)) {
    
        $tpl->block('SUCESSO');
        
    }else{
        $tpl->AVISO_MSG = mysql_error();
        $tpl->block('AVISO');
    }
    
}else{
    
    $tpl->AVISO_MSG = "Você deixou alguma data em branco.";
    $tpl->block('AVISO');
    
}






//$tpl->block('AVISO');
