    CREATE DATABASE `TEST`


    CREATE TABLE `EMPLEADOS` (

        `IdLegajo` INT NOT NULL PRIMARY KEY,
        `Apellido` VARCHAR(50) NOT NULL,
        `Nombre` VARCHAR(50) NOT NULL,
        `Direccion` VARCHAR(50) NOT NULL,
        `Localidad` VARCHAR(50) NOT NULL,
        `ID_TIPO_DOCUMENTO` INT NOT NULL,
        `NroDocumento` NUMERIC(10) NOT NULL,
        `CodigoPostal` VARCHAR(10) NOT NULL,
        `ID_PROVINCIA` INT NOT NULL,
        `activo` ENUM("si","no") DEFAULT "si" NOT NULL,

        CONSTRAINT `FK_EMPLEADOS_PROVINCIA`
        FOREIGN KEY (`ID_PROVINCIA`)
        REFERENCES provincia (`id_provincia`) ON DELETE NO ACTION,
        CONSTRAINT `FK_EMPLEADOS_TIPO_DOCUMENTO`
        FOREIGN KEY (`ID_TIPO_DOCUMENTO`)
        REFERENCES tipo_documento (`id_tipo_documento`) ON DELETE NO ACTION

    );