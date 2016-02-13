<?php

error_reporting(E_ALL);
ini_set('display_errors','On');

require_once('Db.php');

use HitCount\Db;

try {
    $db = new Db;
} catch (Exception $e) {
    $db = false;
}

//print_r($db);
//die();

/**
 * Add Site
 */
//echo '<hr>';
//$add = $db->createHit('hits','excelguru.com.br','fraternidadesemfronteiras.org.br');
//echo '<hr>';

/**
 * Add hit to website
 */
$origem=$_GET['from'];
$destino=$_GET['to'];

// check if db exist
if ( $db === false ) {
    header('Location:http://' . $destino);
    die();   
}

//$count = $db->getHit('excelguru.com.br','fraternidadesemfronteiras.org.br');
$count = $db->getHit($origem, $destino);
$count=$count+1;

$add = $db->addHit($origem, $destino, $count);

header('Location:http://' . $destino);
die();

