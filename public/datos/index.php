<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <table>
        <tr>
            <td>id</td>
            <td>Nombre</td>
            <td>Telefono</td>
            <td>Correo</td>
        </tr>
    <?php
        require_once("consulta.php");

        while($fila = $consulta->fetch()){
            echo "<tr>";
            echo "<td>".$fila['id']."</td>";
            echo "<td>".$fila['name']."</td>";
            echo "<td>".$fila['phone']."</td>";
            echo "<td>".$fila['email']."</td>";
            echo "</tr>";
        }

    ?>
    </table>
    <a href="form_new_contact.php">new</a>
    <a href="form_edit_contact.php">Edit</a>
    <a href="form_delete_contact.php">Delete</a>
    <a href="batch.php">Bacth</a>
</body>
</html>