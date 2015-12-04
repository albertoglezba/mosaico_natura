<h3><strong>Aquí va la infografía de las bases del concurso</strong></h3>


<?php
/*
//Para borrar el directorio
function deleteDirectory($dir) {
	if (!file_exists($dir)) {
		return true;
	}

	if (!is_dir($dir)) {
		return unlink($dir);
	}

	foreach (scandir($dir) as $item) {
		if ($item == '.' || $item == '..') {
			continue;
		}

		if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
			return false;
		}

	}

	return rmdir($dir);
}

$dir = Yii::app()->basePath."/../imagenes/fotografias";
deleteDirectory($dir);
*/

/*
$salt = rand()*rand() + rand();
echo "<br>salt: ".$salt;
$passwd = "leti";
echo "<br>passwd:".$passwd;
$md5 = md5($passwd."|".$salt);
echo "<br>md5:".$md5;
*/
?>

