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
        <h1>Lista de usuarios</h1>
        <article class="lista-resultado">
            <?php
            require_once("funcionalidad/conexion.php");
            $enlace = conectar();
            $sql = "SELECT * FROM `familiares`;";
            $resultado = mysqli_query($enlace, $sql);
            desconectar($enlace);
            ?>
            <div class="primera-fila">
                <div>Nombre</div>
                <div>Rol</div>
                <div>Edad</div>
            </div>
            
            <?php
            while ($fila=mysqli_fetch_assoc($resultado)) {
            ?>
            <div>
                <div><?php echo $fila["nombre"]; ?></div>
                <div><?php echo $fila["rol"]; ?></div>
                <div><?php echo $fila["edad"]; ?></div>
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