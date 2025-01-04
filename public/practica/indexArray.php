<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Crea un array llamado nombres que contenga varios nombres</h1>
<?php
    $array=array("Hector","Pedro","Luis");
    echo nl2br($array[0].PHP_EOL);
    echo nl2br($array[1].PHP_EOL);
    echo nl2br($array[2].PHP_EOL);
    foreach($array as $a){
        echo nl2br($a.PHP_EOL);
    }
    for($i = 0;$i<count($array);$i++){
        echo nl2br($array[$i].PHP_EOL);
    }
    //count() nos indica cuantos elemntos tiene el array
    echo nl2br(count($array).PHP_EOL);
    //sort() y rsort()
    sort($array);
    foreach($array as $a){
        echo nl2br($a.PHP_EOL);
    }
    rsort($array);
    foreach($array as $a){
        echo nl2br($a.PHP_EOL);
    }
    //asort() y arsort() ordenan un array asociativo por valor
    $notas = array('Manuel García'=>8.5, 'Ana López'=>7, 'Juan Solís'=>9);
    asort($notas);
    foreach($notas as $a=>$b){
        echo nl2br($a . " " .$b.PHP_EOL);
    }      
    arsort($notas);
    foreach($notas as $a=>$b){
        echo nl2br($a . " " .$b.PHP_EOL);
    } 
    //ksort() krsort() ordenand un array asociativo por sus claves
    $notas = array('Manuel García'=>8.5, 'Ana López'=>7, 'Juan Solís'=>9);
    ksort($notas);
    foreach($notas as $a=>$b){
        echo nl2br($a . " " .$b.PHP_EOL);
    }      
    krsort($notas);
    foreach($notas as $a=>$b){
        echo nl2br($a . " " .$b.PHP_EOL);
    } 
    //usort(array,funcion) ordena el array segun la funcion que defina el usuarios como segundo parametro
    
    $alimentos = array(
        array("nombre" => "Arroz", "precio" => 1.95),
        array("nombre" => "Carne picada", "precio" => 3.45),
        array("nombre" => "Tomate frito", "precio" => 2.15)
    );
    usort($alimentos,function($item1,$item2){
        return $item1["precio"] <=> $item2["precio"];
    });
    
    $notas = array('Manuel García'=>8.5, 'Ana López'=>7, 'Juan Solís'=>9);
    usort($notas,function($item1,$item2){
        return $item1 <=> $item2;
    });
    foreach($notas as $a=>$b){
        echo nl2br($a . " " .$b.PHP_EOL);
    }
    usort($notas,function($item1,$item2){
        return strcmp($item1,$item2);
    });
    foreach($notas as $a=>$b){
        echo nl2br($a . " " .$b.PHP_EOL);
    }
?>
<h2>Crea una cadena que contenga los nombres de los alumnos existentes en el
array separados por un espacio y muéstrala (función de strings implode)
</h2>
<?php
    //implode() convierte un array en una cadena
    $nombres = array("Hector","Pedro","Luis");
    $cadena = implode(" ",$nombres);

    echo $cadena;
?>

<h2>Muestra el array en el orden inverso al que se creó (función array_reverse)</h2>
<?php
    //array_reverse() invierte el orden de los elementos de un array
    $nombres = array("Hector","Pedro","Luis");
    $nombres = array_reverse($nombres);
    foreach($nombres as $n){
        echo $n . " ";
    }
?>
<h2>Muestra la posición que tiene tu nombre en el array (función array_search)</h2>
<?php
    //array_search() devuelve la posicion de un elemento en un array
    $nombres = array("Hector","Pedro","Luis");
    $pos = array_search("Hector",$nombres);
    echo $pos;
?>
<h2>Crea un array de alumnos donde cada elemento sea otro array que
contenga el id, nombre y edad del alumno.</h2>
<?php
    $alumnos = array(
        array("id"=>1,"nombre"=>"Hector","edad"=>20),
        array("id"=>2,"nombre"=>"Pedro","edad"=>21),
        array("id"=>3,"nombre"=>"Luis","edad"=>22)
    );
    foreach($alumnos as $a){
        echo $a["id"] . " " . $a["nombre"] . " " . $a["edad"] . "<br>";
    }
?>
<h2>Crea una tabla html en la que se muestren todos los datos de los alumnos.
</h2>
<table border="1">
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Edad</th>
    </tr>
    <?php
        foreach($alumnos as $a){
            echo "<tr>";
            echo "<td>" . $a["id"] . "</td>";
            echo "<td>" . $a["nombre"] . "</td>";
            echo "<td>" . $a["edad"] . "</td>";
            echo "</tr>";
        }
    ?>
</table>
<h2>Utiliza la función array_column para obtener un array indexado que
contenga únicamente los nombres de los alumnos y muéstralo por pantalla.</h2>
<?php
    //array_column() extrae una columna de un array asociativo
    $nombres = array_column($alumnos,"nombre");
    foreach($nombres as $n){
        echo $n . " ";
    }
?>
<h2>Crea un array con 10 números y utiliza la función array_sum para obtener la
suma de los 10 números.</h2>
<?php
    //array_sum() suma los elementos de un array
    $numeros = array(1,2,3,4,5,6,7,8,9,10);
    $suma = array_sum($numeros);
    echo $suma;
?>
<h2>Array que filtre los que empiezen por la letra a</h2>
<?php
    $nombres = array("Hector","Pedro","Luis","Ana","Alberto");
    $nombres = array_filter($nombres,function($n){
        return substr($n,0,1) == "A";
    });
    foreach($nombres as $n){
        echo $n . " ";
    }
?>
<h2>Array que filtre los que tengan una longitud mayor a 4</h2>
<?php
    $nombres = array("Hector","Pedro","Luis","Ana","Alberto");
    $nombres = array_filter($nombres,function($n){
        return strlen($n) > 4;
    });
    foreach($nombres as $n){
        echo $n . " ";
    }
?>
<h2>Array que filtre los que tengan una longitud mayor a 4 y empiezen por la letra a</h2>
<?php
    $nombres = array("Hector","Pedro","Luis","Ana","Alberto");
    $nombres = array_filter($nombres,function($n){
        return strlen($n) > 4 && substr($n,0,1) == "A";
    });
    foreach($nombres as $n){
        echo $n . " ";
    }
?>
<h2>Array que filtre los que tengan una longitud mayor a 4 y empiezen por la letra a y los ordene alfabeticamente</h2>
<?php
    $nombres = array("Hector","Pedro","Luis","Ana","Alberto");
    $nombres = array_filter($nombres,function($n){
        return strlen($n) > 4 && substr($n,0,1) == "A";
    });
    sort($nombres);
    foreach($nombres as $n){
        echo $n . " ";
    }
?>
<h2>Array que filtre los que tengan una longitud mayor a 4 y empiezen por la letra a y los ordene alfabeticamente y los muestre en una lista html</h2>
<ul>
    <?php
        $nombres = array("Hector","Pedro","Luis","Ana","Alberto");
        $nombres = array_filter($nombres,function($n){
            return strlen($n) > 4 && substr($n,0,1) == "A";
        });
        sort($nombres);
        foreach($nombres as $n){
            echo "<li>" . $n . "</li>";
        }
    ?>
</ul>
<h2>Array que filtre los que tengan una longitud mayor a 4 y empiezen por la letra a y los ordene alfabeticamente y los muestre en una lista html y los muestre en una tabla html</h2>
<table border="1">
    <tr>
        <th>Nombre</th>
    </tr>
    <?php
        $nombres = array("Hector","Pedro","Luis","Ana","Alberto");
        $nombres = array_filter($nombres,function($n){
            return strlen($n) > 4 && substr($n,0,1) == "A";
        });
        sort($nombres);
        foreach($nombres as $n){
            echo "<tr>";
            echo "<td>" . $n . "</td>";
            echo "</tr>";
        }
    ?>
</table>
<h2>Juntar tres array en uno solo</h2>
<?php
    $nombres1 = array("Hector","Pedro","Luis");
    $nombres2 = array("Ana","Alberto","Maria");
    $nombres3 = array("Juan","Carlos","Manuel");
    $nombres = array_merge($nombres1,$nombres2,$nombres3);
    foreach($nombres as $n){
        echo $n . " ";
    }   
?>
<h2>Juntar 2 arrays para hacerlo bidemensional</h2>
<?php
    $nombres1 = array("Hector","Pedro","Luis");
    $nombres2 = array("Ana","Alberto","Maria");
    $nombres = array($nombres1,$nombres2);
    foreach($nombres as $n){
        foreach($n as $nn){
            echo $nn . " ";
        }
        echo "<br>";
    }
?>
</body>
</html>