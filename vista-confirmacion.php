<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" href="estilos/estilos-comunes.css">
    <link rel="stylesheet" href="estilos/estilos_vista-busqueda.css">
    <link rel="stylesheet" href="estilos/estilos-confirmacion.css">
    <script src="https://kit.fontawesome.com/960d99f23d.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="encabezado">
        <h2>S.U.R.F.</h2>
        <div>
            <a href="index.html">Página principal</a>
        </div>
    </nav>
    <main class="cuerpo">
        <?php
        if ($_GET["vista"] == "usuario") {
            $titulo = "¿Eliminar este familiar?";
            $id = $_GET["id"];
            $primeraLinea = "<div>Nombre</div>
                                <div>Rol</div>
                                <div>Edad</div>";
            $estilo = "grid-template-columns: repeat(3, 4fr);";
            $sql = "SELECT * FROM `familiares` WHERE `id_familia` = $id;";
        } else if ($_GET["vista"] == "movimiento") {
            $titulo = "¿Eliminar este movimiento?";
            $id = $_GET["id"];
            $primeraLinea = "<div>Fecha</div>
                                <div>Tipo</div>
                                <div>Descripcion</div>
                                <div>Monto</div>
                                <div>Forma de pago</div>
                                <div>Responsable</div>";
            $estilo = "grid-template-columns: repeat(6, 2fr);";
            $sql = "SELECT * FROM `movimientos` WHERE `id_mov` = $id;";
        }
        if (isset($_GET["del"]) && $_GET["del"]) {
            $sql = "";
            $id = $_GET["id"];
            if ($_GET["vista"] == "movimiento") {
                $sql = "DELETE FROM `movimientos` WHERE `id_mov` = $id;";
            } else {
                $sql = "DELETE FROM `familiares` WHERE `id_familia` = $id;";
            }
            require_once("funcionalidad/conexion.php");
            $enlace = conectar();
            mysqli_query($enlace, $sql);
            desconectar($enlace);
        ?><h1>Borrado con éxito</h1><?php
        } else {
        ?>
        <h1><?php echo $titulo; ?></h1>
        <article class="lista-resultado">

            <?php
            require_once("funcionalidad/conexion.php");
            $enlace = conectar();
            $resultado = mysqli_query($enlace, $sql);
            desconectar($enlace);
            ?>
            <div class="primera-fila" style="<?php echo $estilo ?>">
                <?php echo $primeraLinea; ?>
            </div>
            
            <?php
            $fila=mysqli_fetch_array($resultado)
            ?>
            <div style="<?php echo $estilo ?>">
            <?php if ($_GET["vista"] == "usuario") { ?>
                <div class="celda">
                    <?php echo $fila["nombre"]; ?>
                </div>
                <div class="celda">
                    <?php echo $fila["rol"]; ?>
                </div>
                <div class="celda">
                    <?php echo $fila["edad"]; ?>
                </div>
            <?php } else if ($_GET["vista"] == "movimiento") { ?>
                <div class="celda">
                    <?php echo $fila["fecha"]; ?>
                </div>
                <div class="celda">
                    <?php echo $fila["tipo"]; ?>
                </div>
                <div class="celda">
                    <?php echo $fila["descripcion"]; ?>
                </div>
                <div class="celda">
                    <?php echo $fila["monto"]; ?>
                </div>
                <div class="celda">
                    <?php echo $fila["forma_de_pago"]; ?>
                </div>
                <div class="celda">
                    <?php echo $fila["id_familia"]; ?>
                </div>
            <?php } ?>
            </div>
            <span class="botones">
                <a href="vista-confirmacion.php?vista=<?php echo $_GET["vista"]; ?>&id=<?php echo $id; ?>&del=true">Aceptar</a>
                <a href="vista-de-busqueda.php?vista=<?php echo $_GET["vista"]; ?>s">Cancelar</a>
            </span>
        </article>
        <?php } ?>
    </main>
    <footer class="pie-de-pagina">
        <article id='pie-1'><p>Eldahuk, Ibi Khalil Adib</p><p>Trabajo Práctico Integrador</p></article>
        <article id='pie-2'><p>#SeProgramar - Argentina Programa 4.0</p><p>Programación en PHP</p></article>
    </footer>
</body>
</html>