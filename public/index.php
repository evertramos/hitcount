<?php

error_reporting(E_ALL);
ini_set('display_errors','On');

require_once(__DIR__ . '/../Db.php');

use HitCount\Db;

try {
    $db = new Db;
} catch (Exception $e) {
    $db = false;
}

/**
 * Add hit to website
 */
$origem='';;
$destino='';

if ( isset($_GET['from']) ) { $origem=$_GET['from']; }
if ( isset($_GET['to']) ) { $destino=$_GET['to']; }

// check if db exist
if ( $db == false ) {
    header('Location:http://' . $destino);
    die();   
}

//Show access
if ( $origem == '' ) {
    $all = $db->getAllHits();
 
    echo '<hr>';

    echo '<table border="1">';
    echo '<tr>';
    echo '<th>origem</th>';
    echo '<th>destino</th>';
    echo '<th>count</th>';
    echo '<th>updated_at</th>';
    echo '</tr>';

    foreach ($all as $line) {
        echo '<tr>';
        foreach ($line as $key => $value ) {
            if ( $key === 'origem') {
                echo '<td>' . $value . '</td>';
            } elseif ( $key === 'destino' ) {
                echo '<td>' . $value . '</td>';
            } elseif ( $key === 'count' ) {
                echo '<td>' . $value . '</td>';
            } elseif ( $key === 'updated_at' ) {
                echo '<td>' . date('j/m/Y', strtotime($value)) . '</td>';
            }
        }
        echo '</tr>';
    }
    echo '</table>';
    
/*
    echo "<tr>";

    foreach($all as $line) {

        foreach($line as $key => $cell){
            if($key == 'updated_at'){
                $cell = date('j \d\e F Y H:i:s', strtotime($cell)); // format date August 20, 2011 4:07:01
            } elseif($key == 'count'){
                $cell = $cell; // format time in minutes
            }
            echo "<td>$cell</td>";
        }
    }
*/

   // echo "</tr>\n";
    die();

}

//$count = $db->getHit('excelguru.com.br','fraternidadesemfronteiras.org.br');
$count = $db->getHit($origem, $destino);
if ( empty($count) ) {
    $db->createHit('hits',$origem, $destino);
}
$count = $db->getHit($origem, $destino);
$count=$count+1;

$add = $db->addHit($origem, $destino, $count);

header('Location:http://' . $destino);
die();
