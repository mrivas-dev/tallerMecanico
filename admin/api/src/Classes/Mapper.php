<?php
namespace App;
/**
* 
Clase Mapper
Mapeadora 
*
**/
abstract class Mapper {
    protected $db;
    public function __construct($db) {
        $this->db = $db;
    }
}