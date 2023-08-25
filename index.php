<?php


$conexion = mysqli_connect(
	'localhost',
	'root',
	'edqnYMSDf13.',
	'biblioteca'
);

if ($conexion == FALSE){
	echo('Error en la conexion');
	exit();
}
else{
	echo('se conecto correctamente!');
	$resultado = mysqli_query(
	$conexion, 'select * from libros');
	#comprobar si hay resultados
	if($resultado == FALSE){
	echo('no hay datos en la base de datos!');
	exit();
	}
	else{
	echo('<br>Si hay datos, sigue leyendo para mostrarlos! <br>');

	while($fila = mysqli_fetch_row($resultado)){
		printf("(%u) %s - %s<br/>",
		$fila[0],$fila[1],$fila[2]);
	}
	}
}

?>
