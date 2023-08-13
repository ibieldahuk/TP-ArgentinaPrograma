<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" href="estilos/estilos-comunes.css">
    <link rel="stylesheet" href="estilos/estilos_vista-busqueda.css">
</head>
<body>
    <nav class="encabezado">
        <h2>S.U.R.F.</h2>
        <div>
            <a href="index.html">Página principal</a>
            <a href="busqueda.php">Búsqueda avanzada</a>
        </div>
    </nav>
    <main class="cuerpo">
        <?php
        if (isset($_GET["vista"])) {
            if ($_GET["vista"] == "usuarios") {
                $titulo = "Lista de usuarios";
                $primeraLinea = "<div>Nombre</div>
                                 <div>Rol</div>
                                 <div>Edad</div>";
                $estilo = "grid-template-columns: repeat(3, 1fr);";
                $sql = "SELECT * FROM `familiares`;";
            } else if ($_GET["vista"] == "movimientos") {
                $titulo = "Lista de movimientos";
                $primeraLinea = "<div>Fecha</div>
                                 <div>Tipo</div>
                                 <div>Descripcion</div>
                                 <div>Monto</div>
                                 <div>Forma de pago</div>
                                 <div>Responsable</div>";
                $estilo = "grid-template-columns: repeat(6, 1fr);";
                $sql = "SELECT * FROM `movimientos`;";
            }
        }
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
            while ($fila=mysqli_fetch_assoc($resultado)) {
            ?>
            <div style="<?php echo $estilo ?>">
            <?php if ($_GET["vista"] == "usuarios") { ?>
                <div><?php echo $fila["nombre"]; ?></div>
                <div><?php echo $fila["rol"]; ?></div>
                <div><?php echo $fila["edad"]; ?></div>
            <?php } else if ($_GET["vista"] == "movimientos") { ?>
                <div><?php echo $fila["fecha"]; ?></div>
                <div><?php echo $fila["tipo"]; ?></div>
                <div><?php echo $fila["descripcion"]; ?></div>
                <div><?php echo $fila["monto"]; ?></div>
                <div><?php echo $fila["forma_de_pago"]; ?></div>
                <div><?php echo $fila["id_familia"]; ?></div>
            <?php } ?>
            </div>
            <?php
            }
            ?>
            
        </article>
    </main>
    <footer class="pie-de-pagina">
        <article id='pie-1'><p>Eldahuk, Ibi Khalil Adib</p><p>Trabajo Práctico Integrador</p></article>
        <article id='pie-2'><p>#SeProgramar - Argentina Programa 4.0</p><p>Programación en PHP</p></article>
    </footer>
</body>
</html>