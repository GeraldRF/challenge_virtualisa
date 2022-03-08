<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstap-css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/app.css">
    <title>Alta de empleados</title>
</head>

<body>
    <?php include "components/navbar.php" ?>

    <div class="div-form">
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

        <h3>Ingrese los datos del empleado</h3>

        <form action="/Controllers/EmpleadoController.php?accion=altaEmpleado" method="post" class="alta-form">
            <div class="items-div">
                <div class="form-item">
                    <label for="IdLegalo">Id Legajo</label>
                    <input type="text" name="IdLegajo" required>
                </div>
                <div class="form-item">
                    <label for="Apellido">Apellido</label>
                    <input type="text" name="Apellido" required>
                </div>
                <div class="form-item">

                    <label for="Nombre">Nombre</label>
                    <input type="text" name="Nombre" required>
                </div>
                <div class="form-item">
                    <label for="Direccion">Dirección</label>
                    <input type="text" name="Direccion" required>
                </div>
                <div class="form-item">
                    <label for="Localidad">Localidad</label>
                    <input type="text" name="Localidad" required>
                </div>
                <div class="form-item">
                    <label for="ID_TIPO_DOCUMENTO">Tipo de documento</label>
                    <select name="ID_TIPO_DOCUMENTO" required>
                        <option value="1">DNI</option>
                        <option value="2">PASAPORTE</option>
                    </select>
                </div>
                <div class="form-item">
                    <label for="NroDocumento">Número de documento</label>
                    <input type="text" name="NroDocumento" required>
                </div>
                <div class="form-item">
                    <label for="CodigoPostal">Código postal</label>
                    <input type="text" name="CodigoPostal" required>
                </div>
                <div class="form-item">
                    <label for="ID_PROVINCIA">Provincia</label>
                    <select name="ID_PROVINCIA" required>
                        <?php
                        $url = "http://" . $_SERVER['SERVER_NAME'] . "/Controllers/ProvinciaController.php";
                        $provinces = json_decode(file_get_contents($url), true);

                        foreach ($provinces as $province) {
                            echo "<option value=\"" . $province["id_provincia"] . "\">" . $province['provincia'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div style="display: flex; flex-direction: row; gap:30px; width: 100%;justify-content: center;">
                <input style="width: 130px;" type="submit" class="btn btn-success" value="Alta">
                <a style="width: 130px;" href="/" class="btn btn-warning">Salir</a>
            </div>

        </form>
    </div>
</body>

</html>