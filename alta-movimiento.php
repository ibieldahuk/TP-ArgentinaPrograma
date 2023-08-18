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
        if (isset($_POST["fecha"]) && isset($_POST["tipo"]) && isset($_POST["descripcion"]) && isset($_POST["monto"]) && isset($_POST["forma-pago"]) && isset($_POST["familiar"])) {
            require_once("funcionalidad/conexion.php");
            $enlace = conectar();
            echo "entramos";
            $id = mysqli_num_rows(mysqli_query($enlace, "SELECT * FROM `movimientos`")) + 1;
            $fecha = $_POST["fecha"];
            $tipo = $_POST["tipo"];
            $descripcion = $_POST["descripcion"];
            $monto = $_POST["monto"];
            $forma_pago = $_POST["forma-pago"];
            $familiar = $_POST["familiar"];
            $sql = "INSERT INTO `movimientos` (`id_mov`, `fecha`, `tipo`, `descripcion`, `monto`, `forma_de_pago`, `id_familia`) VALUES ($id, '$fecha', '$tipo', '$descripcion', $monto, '$forma_pago', $familiar);";
            mysqli_query($enlace, $sql);
            desconectar($enlace);
        ?>
        <h1>Se dio de alta el familiar</h1>
        <?php
        } else {
        ?>
        <h1>Editar movimiento</h1>
        <form action="" method="post">
            <input type="date" name="fecha" id="fecha">
            <select name="tipo" id="tipo">
                <option value="ingreso">Ingreso</option>
                <option value="egreso">Egreso</option>
            </select>
            <input type="text" name="descripcion" id="descripcion" placeholder="descripción">
            <input type="number" step="0.01" name="monto" id="monto" placeholder="monto">
            <select name="forma-pago" id="forma-pago">
                <option value="efectivo">Efectivo</option>
                <option value="cheque">Cheque</option>
                <option value="tarjeta de crédito">Tarjeta de crédito</option>
                <option value="transferencia bancaria">Transferencia Bancaria</option>
            </select>
            <select name="familiar" id="familiar">
                <?php
                require_once("funcionalidad/conexion.php");
                $sql = "SELECT `id_familia`, `nombre` FROM `familiares`;";
                $enlace = conectar();
                $resultado = mysqli_query($enlace, $sql);
                desconectar($enlace);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                ?>
                <option value="<?php echo $fila["id_familia"]; ?>"><?php echo $fila["nombre"]; ?></option>
                <?php
                }
                ?>
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