<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstap-css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/app.css">
    
    <title>Empleados_Detalle</title>
</head>

<body>

    <?php
    include "components/navbar.php";
    ?>

    <div class="container">
        <?php session_start();
        if (isset($_SESSION['respuesta'])) {
            if ($_SESSION['respuesta']) { ?>
                <div style="width: 100%; border-left:3px solid green; padding:20px; background-color:rgba(29, 175, 0, 0.357);">
                    <?php echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                    unset($_SESSION['respuesta']) ?>
                </div>
            <?php } else {
            ?>
                <div style="width: 100%; border-left:3px solid red; padding:20px; background-color:rgba(175, 12, 0, 0.357);">
                    <?php echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                    unset($_SESSION['respuesta']) ?>
                </div>
        <?php  }
        } ?>
        <h2 style="margin: 20px 0 30px 0;">Empleados activos</h2>


        <a class="btn btn-primary" href="/Views/alta_empleado.php">Dar de alta un empleado</a>
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Id Legajo</th>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>Direccón</th>
                    <th>Localidad</th>
                    <th>Id tipo documento</th>
                    <th>Tipo de documento</th>
                    <th>Número de documento</th>
                    <th>Código postal</th>
                    <th>Id provincia</th>
                    <th>Provincia</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $url = "http://" . $_SERVER['SERVER_NAME'] . "/Controllers/EmpleadoController.php?accion=listarEmpleados";
                $empleados = json_decode(file_get_contents($url), true);

                $url = "http://" . $_SERVER['SERVER_NAME'] . "/Controllers/ProvinciaController.php";
                $provinces = json_decode(file_get_contents($url), true); ?>

                <?php
                    foreach ($empleados as $empleado) {
                        if ($empleado['activo'] == "si") {
                ?>
                            <tr>
                                <td scope="row"><?php echo $empleado['IdLegajo']; ?></td>
                                <td><?php echo $empleado['Apellido']; ?></td>
                                <td><?php echo $empleado['Nombre']; ?></td>
                                <td><?php echo $empleado['Direccion']; ?></td>
                                <td><?php echo $empleado['Localidad']; ?></td>
                                <td><?php echo $empleado['ID_TIPO_DOCUMENTO']; ?></td>
                                <td><?php echo $empleado['ID_TIPO_DOCUMENTO'] == 1 ? "DNI" : "PASAPORTE"; ?></td>
                                <td><?php echo $empleado['NroDocumento']; ?></td>
                                <td><?php echo $empleado['CodigoPostal']; ?></td>
                                <td><?php echo $empleado['ID_PROVINCIA']; ?></td>
                                <td>
                                    <?php
                                    foreach ($provinces as $province) {
                                        if ($province["id_provincia"] == $empleado['ID_PROVINCIA']) echo $province['provincia'];
                                    }
                                    ?>
                                </td>
                                <td><a style="width: 130px;" class="btn btn-danger" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/Controllers/EmpleadoController.php?idLegajo=<?php echo $empleado['IdLegajo']; ?>">Dar de baja</a></td>
                            </tr>
                <?php
                        }
                    }
                ?>


            </tbody>
        </table>

    </div>
</body>

</html>