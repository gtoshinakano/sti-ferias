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
//require "../SistemaGerenciadorDeChamados/acesso.php";
require "../SistemaGerenciadorDeChamados/conexao.php";
mysql_set_charset('UTF8');
mysql_query("SET NAMES 'UTF8'");
mysql_query("SET CHARACTER SET 'UTF-8'");
require "src/classes/Template.class.php";

$tpl = new Template('html_libs/template_all.html');



$tpl->show();