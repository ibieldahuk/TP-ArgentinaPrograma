<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajo Práctico 11</title>
    <link rel="stylesheet" href="estilos/estilos-comunes.css">
    <link rel="stylesheet" href="estilos/estilos-index.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="encabezado">
        <h2>S.U.R.F.</h2>
        <div>
            <a href="index.html" class="actual">Página principal</a>
            <a href="busqueda.php">Búsqueda avanzada</a>
        </div>
    </nav>
    <main class="cuerpo">
        <?php
        function verificar() {
            if (!isset($_GET["id"])) {
                return false;
            }
            require_once("funcionalidad/conexion.php");
            $enlace = conectar();
            $id = $_GET["id"];
            $sql = "SELECT * FROM `familiares` WHERE id_familia = $id";
            $resultado = mysqli_query($enlace, $sql);
            $fila = mysqli_fetch_array($resultado);
            desconectar($enlace);
            if (!$fila) {
                return false;
            }
            return $fila;
        }
        $familiar = verificar();
        if (isset($_POST["nombre"]) && isset($_POST["nombre"]) && isset($_POST["nombre"])) {
            $id = $_GET["id"];
            $nombre = $_POST["nombre"];
            $edad = $_POST["edad"];
            $rol = $_POST["rol"];
            $sql = "UPDATE `familiares` SET `nombre` = '$nombre', `edad` = $edad, `rol` = '$rol' WHERE `id_familia` = $id;";
            $enlace = conectar();
            mysqli_query($enlace, $sql);
            desconectar($enlace);
        ?>
        <h1>Se actualizó correctamente</h1>
        <?php
        } else if (!$familiar) {
        ?>
        <h1>No se encontró el famiiar</h1>
        <?php
        } else {
        ?>

        <h1>Editar familiar</h1>
        <form action="" method="post">
            <input type="text" name="nombre" id="nombre" value="<?php echo $familiar["nombre"]; ?>">
            <input type="number" name="edad" id="edad" value="<?php echo $familiar["edad"]; ?>">
            <select name="rol" id="rol">
                <option value="padre/madre" <?php if ($familiar["rol"] == "padre/madre") {echo "selected";} ?>>Padre/Madre</option>
                <option value="hijo/hija" <?php if ($familiar["rol"] == "hijo/hija") {echo "selected";} ?>>Hijo/Hija</option>
                <option value="otro/otra" <?php if ($familiar["rol"] == "otro/otra") {echo "selected";} ?>>Otro/Otra</option>
            </select>
            <input type="submit" value="Aceptar">
        </form>

        <?php } ?>
    </main>
    <footer class="pie-de-pagina">
        <article id='pie-1'><p>Eldahuk, Ibi Khalil Adib</p><p>Trabajo Práctico Integrador</p></article>
        <article id='pie-2'><p>#SeProgramar - Argentina Programa 4.0</p><p>Programación en PHP</p></article>
    </footer>
</body>
</html>