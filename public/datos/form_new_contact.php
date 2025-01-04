<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Contacto</title>
</head>
<body>
    <h2>Añadir Nuevo Contacto</h2>
    <form method="POST" action="insert.php">
        <label for="name">Nombre:</label>
        <input type="text" name="name" >
        <br>
        <label for="email">Correo:</label>
        <input type="text" name="email" >
        <br>
        <label for="phone">Teléfono:</label>
        <input type="text" name="phone">
        <br>
        <button type="submit">Guardar</button>
    </form>
    <a href="index.php">Volver a la lista de contactos</a>
</body>
</html>
