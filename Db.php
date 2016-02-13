<?php

namespace HitCount;

use \PDO;
use \Exception;
/**
 * @TODO
 *
 * 1. namespaecing
 * 2. implement class
 * 
 */

class Db {

    protected $host;
    protected $db;
    protected $charset;
    protected $user;
    protected $pass;

    protected $dsn;
    protected $conn;

    public function __construct() {
        
        require_once 'config.php';
        $this->host = $host;
        $this->db = $db;
        $this->charset = $charset;
        $this->user = $user;
        $this->pass = $pass;

        $this->dsn ='mysql:host=' . $this->host . ';dbname=' . $this->db . ';charset=' . $this->charset; 

        if ( empty($this->host) || empty($this->db) || empty($this->charset) || empty($this->user) || empty($this->pass) ) {
            throw new Exception('Erro: config.php incompleto...');
        }

       $this->conn = new PDO($this->dsn, $this->user, $this->pass);        
    }

    public function openConn() {
    
       return $this->conn;
       //return $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db.';charset='.$this->charset, $this->user, $this->pass);        
    }

    public function createHit($table, $origin, $destination) {

        return $this->conn->query('INSERT INTO ' . $table . ' (origem, destino, created_at, updated_at) values ("' . $origin . '","' . $destination . '",now(),now())');
    }

    public function getHit($origin, $destination) {
    
        $get = $this->conn->prepare('SELECT count FROM hits where origem="' . $origin . '" and destino="' . $destination . '"');
        $get->execute();
        //$result->fetch(PDO::FETCH_ASSOC);
        $result = $get->fetchAll();
        if ( ! empty($result) ) {
            return $result[0]['count'];
        } else {
            return null;
        }
    }

    public function addHit($origin, $destination, $count) {

        return $this->conn->query('UPDATE hits set count="' . $count . '", updated_at=now()  where  origem="' . $origin . '" and destino="' . $destination . '"');
    }
}
