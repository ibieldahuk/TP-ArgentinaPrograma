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
        </div>
    </nav>
    <main class="cuerpo">
        <?php
        if (isset($_POST["nombre"]) && isset($_POST["nombre"]) && isset($_POST["nombre"])) {
            require_once("funcionalidad/conexion.php");
            $enlace = conectar();
            $id = mysqli_num_rows(mysqli_query($enlace, "SELECT * FROM `familiares`")) + 1;
            $nombre = $_POST["nombre"];
            $edad = $_POST["edad"];
            $rol = $_POST["rol"];
            $sql = "INSERT INTO `familiares` (`id_familia`, `nombre`, `edad`, `rol`) VALUES  ($id, '$nombre', $edad, '$rol');";
            mysqli_query($enlace, $sql);
            desconectar($enlace);
        ?>
        <h1>Se dio de alta el familiar</h1>
        <?php
        } else {
        ?>
        <h1>Editar familiar</h1>
        <form action="" method="post">
            <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            <input type="number" name="edad" id="edad" placeholder="Edad">
            <select name="rol" id="rol">
                <option value="padre/madre">Padre/Madre</option>
                <option value="hijo/hija">Hijo/Hija</option>
                <option value="otro/otra">Otro/Otra</option>
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