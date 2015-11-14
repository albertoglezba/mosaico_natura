### mosaico_natura ###
Inscripcion al Concurso de Mosaico Natura

<strong>INTALACIÓN</strong>

Copiar el archivo protected/config/main.php_ejemplo.php a protected/config/main.php y configurar la base
Dar permisos 777 a las carpetas assets, protected/runtime

<strong>CONFIGURACION</strong>

Para cambiar el key, secret, bitacora en produccion, etc 
/var/www/html/concurso/protected/config

Para poner las extensiones de fotos y videos
/var/www/html/concurso/protected/views/fotos/_aws.php L61

Si requieres saber el identificador de un usuario en el controlador, modelo, etc "Yii::app()->user->id_usuario;"

Mis credenciales de amazon son: calonsogeek@gmail.com y la de mi maquina


<strong>PENDIENTES</strong>

Los campos "estado" y "municipio" en la tabla fotos serán sustituidos por los campos "ubicacion" y "coordenadas"
que serán obtenidos de un gmapa, donde el usuario podrá escoger donde tomo la foto, ya sea con coordenadas o por ubicacion

Crear una tabla en la base mosaico_natura llamada "videos"
Videos no tendrá los mismos campos que las fotos, solo tendra un campo obligatorio "descripcion", por ende tambien crear 
un nuevo formulario y modelo para los videos.

Las categorias varian de acuerdo a las prpuestas por Ivan

En ese archivo especificar cuanto debe ser el mínimo y máximo de peso en las
fots y los videos (consultar con Miguel e Ivan)

Las fotos de la categoria juvenil no tendrán un límite mínimo de peso para subir, asi mismo estas fotos tendrán
el widget de facebook para que la gente les de like y pueda elegir al ganador

Antes de subir la fotografía a AWS se debría de tener un candado de en que categorias puede 
subir para que se pueda organizar en carpetas y tener un mejor control



<strong>IMPORTANTE</strong>

Es necesario darle una cotizacion a Carlos de los posibles precios al mes por el hosting de AWS,
recordemos que deben ser aproximados ya que pagas solo por lo que se almacena (https://aws.amazon.com/s3/pricing/)











