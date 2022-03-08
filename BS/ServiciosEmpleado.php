<?php

class ServiciosEmpleado {

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

    function obtenerTodosLosEmpleados()
    {
        $sql = $this->dbConn->prepare("SELECT * FROM `EMPLEADOS`");
    
        $sql->execute();

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        return  $sql->fetchAll();
    }

    function darDeAltaEmpleado($input)
    {

        $sql = "INSERT INTO `EMPLEADOS` 
                (IdLegajo, Apellido, Nombre, Direccion, Localidad, ID_TIPO_DOCUMENTO, NroDocumento, CodigoPostal, ID_PROVINCIA)
                VALUES
                (:IdLegajo, :Apellido, :Nombre, :Direccion, :Localidad, :ID_TIPO_DOCUMENTO, :NroDocumento, :CodigoPostal, :ID_PROVINCIA)";

        try {

            $statement = $this->dbConn->prepare($sql);
            bindAllValues($statement, $input);

            $statement->execute();

            return ["isCreated" => true];
        } catch (PDOException $exception) {

            return ["isCreated" => false, "msg" => $exception->getMessage()];
        }
    }

    function darDeBajaEmpleado($IdLegajo)
    {
        try {
            $Id = filter_var($IdLegajo, FILTER_SANITIZE_NUMBER_INT);
            $statement = $this->dbConn->prepare("UPDATE `EMPLEADOS` SET activo='no' WHERE `IdLegajo`=:IdLegajo");
            $statement->bindValue(':IdLegajo', $Id);
            $statement->execute();

            return true;
        } catch (PDOException $exception) {

            return false;
        }
    }


}