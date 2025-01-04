<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Muestra el valor de un parámetro llamado nombre recibido por querystring
eliminando los caracteres '/' del principio y el final si los hubiera (función
trim). Si no se pasa un parámetro nombre se utilizará tu nombre de pila.</h2>
<?php
    $nombre = $_GET['nombre'] ?? "/Hector/";
    $nombre = trim($nombre,"/");
    echo nl2br($nombre.PHP_EOL);
?>
<h2>Muestra la longitud del parámetro nombre (función strlen)</h2>
<?php
    echo nl2br(strlen($nombre).PHP_EOL);
?>
<h2>Muestra el nombre en mayúsculas (función strtoupper)</h2>
<?php
    echo nl2br(strtoupper($nombre).PHP_EOL);
?>
<h2>Muestra el nombre en minúsculas (función strtolower)</h2>
<?php
    echo nl2br(strtolower($nombre).PHP_EOL);
?>
<h2>Pasa un segundo parámetro por querystring llamado prefijo (para pasar más
de un parámetro por la querystring debes separarlos utilizando el carácter
&). Después indica si el nombre comienza por el prefijo pasado o no
(función strpos), se distinguirá entre mayúsculas y minúsculas. Si no se
pasa el prefijo no se realizará esta operación.</h2>
<?php
//strpos devuelve la posicion de la primera ocurrencia de una subcadena en otra cadena
    $prefijo = $_GET['prefijo'] ?? "H";
    if($prefijo != ""){
        if(strpos($nombre,$prefijo) === 0){
            echo nl2br("El nombre comienza por el prefijo".PHP_EOL);
        }else{
            echo nl2br("El nombre no comienza por el prefijo".PHP_EOL);
        }
    }
?>
<h2>Muestra el número de veces que aparece la letra a (mayúscula o minúscula)
en el parámetro nombre (funciones substr_count + (strtoupper o
strtolower)).</h2>
<?php
//substr_count cuenta el numero de veces que aparece una subcadena en otra cadena
//strtoupper convierte una cadena a mayusculas
    echo nl2br(substr_count(strtolower($nombre),"e").PHP_EOL);
?>
<h2>Muestra la posición de la primera a existente en el nombre (sea mayúscula
o minúscula). Si no hay ninguna mostrará un texto indicándolo (función
stripos).</h2>
<?php
//stripos devuelve la posicion de la primera ocurrencia de una subcadena en otra cadena
    $pos = stripos($nombre,"E");
    if($pos === false){
        echo nl2br("No se ha encontrado la letra a".PHP_EOL);
    }else{
        echo nl2br($pos.PHP_EOL);
    }
?>
<h2>Muestra el nombre sustituyendo las letras ‘o’ por el número cero (sea
mayúscula o minúscula) (función str_ireplace).</h2>
<?php
    //str_ireplace reemplaza todas las apariciones de una subcadena en otra cadena
    echo nl2br(str_ireplace("o","0",$nombre).PHP_EOL);
?>
<h2>  La función parse_url nos permite extraer distintas partes de una url. A partir de
una variable que contenga una url, por ejemplo:
$url = 'http://username:password@hostname:9090/path?arg=value';
Utiliza la función parse_url para extraer y mostrar por pantalla las siguientes partes
de la variable url del ejemplo: 
El protocolo utilizado (en el ejemplo http).
El nombre de usuario (en el ejemplo username).
El path de la url (en el ejemplo /path)
El querystring de la url (en el ejemplo arg=value)</h2>
<?php
    $url = 'http://username:password@hostname:9090/path?arg=value';
    $url = parse_url($url);
    print_r($url);
    echo nl2br($url['scheme'].PHP_EOL);
    echo nl2br($url['user'].PHP_EOL);
    echo nl2br($url['path'].PHP_EOL);
    echo nl2br($url['query'].PHP_EOL);
?>
</body>
</html>