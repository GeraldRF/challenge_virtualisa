<?php

class ServiciosProvincia {

    public $dbConn;

    function __construct()
    {
        include "../DA/DBConfig.php";
        include "../DA/QueryUtils.php";


        $this->dbConn =  connect(
            array(
                'host' => HOST,
                'username' => USERNAME,
                'password' => PASSWORD,
                'db' => DB
            )
        );
    }

    function obtenerProvincias()
    {
        $sql = $this->dbConn->prepare("SELECT * FROM `provincia`");
        $sql->execute();

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        return  $sql->fetchAll();
    }

}