<?php

/* 
 * SISTEMA DE CONTROLE DE FÉRIAS (13/11/2015)
 * Este tem a finalidade de armazenar informações de Férias dos servidores.
 * Utiliza o mesmo banco de dados do SistemaGerenciadorDeChamados.
 * Provisoriamente, não terá menu principal para que haja a possibilidade de 
 * criação de um portal de controle da STI.
 */

/*
 * Carregando arquivos necessários:
 * 1- Controle de Acesso Restrito
 * 2- Conexão com banco de dados do SGDC e transformação total dos dados em UTF-8
 * 3- Classe de Template para separação de PHP e HTML
 */
require "../conexao.php";
mysql_set_charset('UTF8');
mysql_query("SET NAMES 'UTF8'");
mysql_query("SET CHARACTER SET 'UTF-8'");
require "src/classes/Template.class.php";
require "src/functions/functions.php";

// Tempo de início de para verificar tempo de execução do BackEnd
$exec_ini = execTime();

/*
 * Verificar se usuário está logado. 
 * Pego de SGDC/acesso.php 
 */
if (!isset($_COOKIE['l'])){
    
    Header('Location: ../login.php');
  
}else{
    
    $tpl = new Template('html_libs/template_all.html');
    
    if(!isset($_GET['page'])){
        
        include "src/pages/index.php";
        
    }else{
        
        switch ($_GET['page']){
            
            // Colocar aqui, casos de valores para page.
            // Páginas estão em src/pages/*.php
            case "": 
                
            break;
            default:
                include "src/pages/index.php";
            break;
            
        }

    }
    
    // Calcula tempo de execução e mostra no Template.
    $exec_fin     = execTime();
    $elapsed_time   = number_format(($exec_fin - $exec_ini),6);
    $tpl->EXECTIME = "Tempo de Execução: <b>". $elapsed_time ."</b> segundos";    
    $tpl->show();
    
}


var_dump($_COOKIE);