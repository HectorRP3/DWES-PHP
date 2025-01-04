<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Contacto</title>
</head>
<body>
    <h2>Modificar Contacto</h2>
    <form method="POST" action="update.php">
		<label for="id">Identificador:</label>
        <input type="text" name="id" >
		<br>
        <label for="name">Nombre:</label>
        <input type="text" name="name" >
        <br>
        <label for="email">Correo:</label>
        <input type="email" name="email" >
        <br>
        <label for="phone">Teléfono:</label>
        <input type="text" name="phone">
        <br>
        <button type="submit">Guardar</button>
    </form>
    <a href="index.php">Volver a la lista de contactos</a>
</body>
</html>
