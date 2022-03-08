<?php

    include "../BS/ServiciosEmpleado.php";
    $servicios = new ServiciosEmpleado();

    if ($_GET["accion"] == "listarEmpleados") {

        echo json_encode($servicios->obtenerTodosLosEmpleados());

        exit();

    } else if ($_GET["accion"] == "altaEmpleado") {

        $response = $servicios->darDeAltaEmpleado($_POST);

        session_start();

        if ($response["isCreated"]) {
            $_SESSION['respuesta'] = true;
            $_SESSION['msg'] = "Empleado dado de alta correctamente";
            header("Location: http://" . $_SERVER['SERVER_NAME'] . "/Views/empleado_detalle.php");
        } else {
            $_SESSION['respuesta'] = false;
            $_SESSION['msg'] = $response['msg'];
            header("Location: http://" . $_SERVER['SERVER_NAME'] . "/Views/alta_empleado.php");
        }

        
        exit();
    } else if(isset($_GET["idLegajo"])) {

        $dadoDeBaja = $servicios->darDeBajaEmpleado($_GET["idLegajo"]);

        session_start();

        if ($dadoDeBaja) {
            $_SESSION['respuesta'] = true;
            $_SESSION['msg'] = "Empleado dado de baja correctamente";
        } else {
            $_SESSION['respuesta'] = false;
        }
        
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/Views/empleado_detalle.php");
        exit();
    }
