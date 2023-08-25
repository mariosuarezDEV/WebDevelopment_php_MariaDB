
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos/estilos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - LMCS</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores de los campos del formulario
    $titulo = $_GET["titulo"];
    $descripcion = $_GET["descripcion"];
    
    // Puedes hacer cualquier procesamiento necesario con los valores
    
}
?>
    <h1>DESARROLLO WEB CON PHP Y SQL</h1>

    <div class="registrar">
    <p class="indicaciones">¡Registra un libro!</p>
        <form name="guardar_libros" method="get" action="" class="formulario">
            <input type="text" name="titulo" placeholder="Ingresa nombre del libro">
            <select name="descripcion" id="">
                <option value="1er semestre" selected="true">1er semestre</option>
                <option value="2do semestre">2do semestre</option>
                <option value="3er semestre">3er semestre</option>
                <option value="4to semestre">4to semestre</option>
                <option value="5to semestre">5to semestre</option>
                <option value="6to semestre">6to semestre</option>
            </select>
            <input type="submit" name="subir" value="Subir">
        </form>
    </div>

    
    <?php

    #creando la conexion a la base de datos
    $conexion = mysqli_connect(
        'localhost',
        'root',
        'edqnYMSDf13.',
        'biblioteca'
    );

    #comprobar si se hizo la conexion
    if($conexion == FALSE){
        printf("Error al realizar la conexion a la base de datos! Intentalo de nuevo<br>");
        
        exit();
    } else{
        #se hizo la conexion
        #printf("se logro la conexion con la base de datos!<br>");
        #hacer una consulta para obtener los datos
        $resultado = mysqli_query(
            $conexion, 'select * from libros');
        
        #comprobar si hay datos
        if($resultado == FALSE){
            printf("no se pueden recuperar los datos!<br>");
            mysqli_close($conexion);
            exit();
        } else{
            #printf("se recuperaron datos de la BD<br>");
        }

    }

    ?>

    <table>
        <tr>
            <th>
                ID
            </th>
            <th>
                TITULO
            </th>
            <th>
                DESCRIPCION
            </th>
        </tr>

        <?php
            while($fila = mysqli_fetch_row($resultado)){
                printf("<tr>");

                printf(
                    "<td>%u</td><td>%s</td><td>%s</td>",
                    $fila[0],$fila[1],$fila[2]
                );

                printf("</tr>");
            }
        ?>
    </table>
    <?php
        #subir los datos a la base de datos
        $pInformacion = false;
        if(count($_GET) != 0){
            $pInformacion = $_GET;
        } elseif(count($_POST) != 0){
            $pInformacion = $_POST;
        }

        if ($pInformacion != false){
            $sTitulo = $pInformacion['titulo'];
            $sDescripcion = $pInformacion['descripcion'];
            #echo ($sTitulo);
            #echo ($sDescripcion);
            if (($sTitulo == "") or ($sDescripcion == "")){
                #echo('No puede subirse informacion incompleta');
            } else{
                #echo ('se puede subir');
                $sConsulta = <<< CONSULTA
                insert into libros (nombre,descripcion) values('$sTitulo','$sDescripcion');
                CONSULTA;

                #Crear la inserción
                $query = $conexion -> query($sConsulta);
                #verificar que se haga la insercion
                if($query == false){
                    echo('No se pueden agregar los datos!');
                    echo($conexion->error);
                    exit();
                } else{
                    header("Location: genero.php"); // Redirige después de la inserción
                    exit(); // Asegura que el script se detenga
                }

            }
        }
        ?>
</body>
</html>