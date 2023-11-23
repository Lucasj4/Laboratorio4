<?php

// Verificar si se proporciona el parámetro "usuario" en la URL
if (isset($_GET["usuario"])) {
    // Obtener datos del usuario para mostrar en el formulario de edición
    $usuario = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $_GET["usuario"]);

    // Comprobación adicional: Verificar si $usuario es NULL antes de intentar acceder a las claves
    if ($usuario !== null && is_array($usuario) && isset($usuario[0])) {
        // Mostrar información de depuración
     
    
        // Acceder a las claves en el array interno
        $datosUsuario = $usuario[0];
    } else {
        // Manejo cuando $usuario es NULL o no tiene la estructura esperada
        echo "No se pudo obtener la información del usuario.";
        exit(); // Agregamos exit para detener la ejecución en este punto
    }

    // Verificar si se ha enviado el formulario para editar el usuario
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Llamar al método para editar el usuario
        $editar = new ControladorUsuarios();
        $editar->ctrEditarUsuario();
    }
} else {
    // Si no se proporciona el parámetro "usuario", redirigir o mostrar un mensaje de error
    // Puedes personalizar esto según tus necesidades
    header("Location: usuario.php");
    exit();
}

?>

<!-- Resto del código HTML -->

<div class="content-wrapper">
    <!-- Encabezado de contenido (header de la página) -->
    <section class="content-header">
        <!-- Tu código HTML actual para el encabezado -->
    </section>

    <!-- Contenido principal -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos de usuario</h3>
            </div>
            <!-- /.card-header -->
            <!-- Formulario de edición -->
            <form method="post">
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <!-- Manejo de nulos: Si 'nombre_usuario' no está definido, asigna un valor por defecto -->
                        <input type="text" name="nombre_usuario"
                            value="<?= isset($datosUsuario['nombre_usuario']) ? $datosUsuario['nombre_usuario'] : ''; ?>"
                            class="form-control" placeholder="Ingrese el nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <!-- Manejo de nulos: Si 'email_usuario' no está definido, asigna un valor por defecto -->
                        <input type="text" name="email_usuario"
                            value="<?= isset($datosUsuario['email_usuario']) ? $datosUsuario['email_usuario'] : ''; ?>"
                            class="form-control" placeholder="Ingrese un correo electrónico" required>
                    </div>

                    <div class="form-group">
                        <label for="password_usuario">Contraseña</label>
                        <input type="password" name="password_usuario" class="form-control"
                            placeholder="Ingrese la contraseña">
                        <small id="passwordHelp" class="form-text text-muted">Deje este campo en blanco para no cambiar
                            la contraseña.</small>
                    </div>




                    <div class="form-group">
                        <label for="exampleInputEmail1">Apellido</label>
                        <!-- Manejo de nulos: Si 'email_usuario' no está definido, asigna un valor por defecto -->
                        <input type="text" name="apellido_usuario"
                            value="<?= isset($datosUsuario['apellido_usuario']) ? $datosUsuario['apellido_usuario'] : ''; ?>"
                            class="form-control" placeholder="Ingrese apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="estado_usuario">Estado</label>
                        <select class="form-control" name="estado_usuario" required>
                            <option value="1" <?php echo ($usuario['estado_usuario'] ?? 0) == 1 ? 'selected' : ''; ?>>
                                Activo</option>
                            <option value="0" <?php echo ($usuario['estado_usuario'] ?? 0) == 0 ? 'selected' : ''; ?>>
                                Inactivo</option>
                        </select>
                        <label for="rol_usuario">Rol</label>
                        <select class="form-control" name="rol_usuario" required>
                            <option value="admin"
                                <?php echo ($datosUsuario['rol_usuario'] ?? '') == 'admin' ? 'selected' : ''; ?>>Admin
                            </option>
                            <option value="usuario"
                                <?php echo ($datosUsuario['rol_usuario'] ?? '') == 'usuario' ? 'selected' : ''; ?>>
                                Usuario</option>
                        </select>
                    </div>

                    <!-- Agrega campos adicionales según sea necesario -->


                </div>
                <!-- /.card-body -->

                <!-- Resto del código HTML -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->