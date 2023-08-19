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
        function verificar() {
            if (!isset($_GET["id"])) {
                return false;
            }
            require_once("funcionalidad/conexion.php");
            $enlace = conectar();
            $id = $_GET["id"];
            $sql = "SELECT * FROM `movimientos` WHERE id_mov = $id";
            $resultado = mysqli_query($enlace, $sql);
            $fila = mysqli_fetch_array($resultado);
            desconectar($enlace);
            if (!$fila) {
                return false;
            }
            return $fila;
        }
        $movimiento = verificar();
        if (isset($_POST["fecha"]) && isset($_POST["tipo"]) && isset($_POST["descripcion"]) && isset($_POST["monto"]) && isset($_POST["forma-pago"]) && isset($_POST["familiar"])) {
            echo "entramos";
            $id = $_GET["id"];
            $fecha = $_POST["fecha"];
            $tipo = $_POST["tipo"];
            $descripcion = $_POST["descripcion"];
            $monto = $_POST["monto"];
            $forma_pago = $_POST["forma-pago"];
            $familiar = $_POST["familiar"];
            $sql = "UPDATE `movimientos` 
            SET `fecha` = '$fecha', 
            `tipo` = '$tipo', 
            `descripcion` = '$descripcion', 
            `monto` = $monto, 
            `forma_de_pago` = '$forma_pago', 
            `id_familia` = $familiar 
            WHERE `id_mov` = $id;";
            $enlace = conectar();
            mysqli_query($enlace, $sql);
            desconectar($enlace);
        ?>
        <h1>Se actualizó correctamente</h1>
        <?php
        } else if (!$movimiento) {
        ?>
        <h1>No se encontró el movimiento</h1>
        <?php
        } else {
        ?>

        <h1>Editar movimiento</h1>
        <form action="" method="post">
            <input type="date" name="fecha" id="fecha" value="<?php echo $movimiento["fecha"]; ?>">
            <select name="tipo" id="tipo">
                <option value="ingreso" <?php if ($movimiento["tipo"] == "ingreso") { echo "selected"; } ?>>Ingreso</option>
                <option value="egreso" <?php if ($movimiento["tipo"] == "egreso") { echo "selected"; } ?>>Egreso</option>
            </select>
            <input type="text" name="descripcion" id="descripcion"  value="<?php echo $movimiento["descripcion"]; ?>">
            <input type="number" step="0.01" name="monto" id="monto"  value="<?php echo $movimiento["monto"]; ?>">
            <select name="forma-pago" id="forma-pago">
                <option value="efectivo" <?php if ($movimiento["forma_de_pago"] == "efectivo") { echo "selected"; } ?>>Efectivo</option>
                <option value="cheque" <?php if ($movimiento["forma_de_pago"] == "cheque") { echo "selected"; } ?>>Cheque</option>
                <option value="tarjeta de crédito" <?php if ($movimiento["forma_de_pago"] == "tarjeta de crédito") { echo "selected"; } ?>>Tarjeta de crédito</option>
                <option value="transferencia bancaria" <?php if ($movimiento["forma_de_pago"] == "transferencia bancaria") { echo "selected"; } ?>>Transferencia Bancaria</option>
            </select>
            <select name="familiar" id="familiar">
                <?php
                $sql = "SELECT `id_familia`, `nombre` FROM `familiares`;";
                $enlace = conectar();
                $resultado = mysqli_query($enlace, $sql);
                desconectar($enlace);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    ?>
                <option value="<?php echo $fila["id_familia"]; ?>" <?php if ($movimiento["id_familia"] == $fila["id_familia"]) { echo "selected"; } ?>><?php echo $fila["nombre"]; ?></option>
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