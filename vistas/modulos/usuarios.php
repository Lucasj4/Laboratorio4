

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios</h1>
                    <?php if ($_SESSION["rol_usuario"] == "Admin") { ?>
                    <a href="agregar_usuario" class="btn btn-primary mt-3"><i class="fa-solid fa-user-plus"></i> Agregar
                        usuario</a>
                    <?php } ?>
                </div>
            </div>
        </div>

    </section>

    <section class="content">

        <div class="card">

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped tablaUsuarios">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $usuarios = ControladorUsuarios::ctrMostrarUsuarios();
                       

                        foreach ($usuarios as $key => $value)
                        {
                            if ($value["estado_usuario"] == 1)
                            {
                                $estado = "<span class='badge badge-success'>Activo</span>";
                            }
                            else
                            {
                                $estado = "<span class='badge badge-danger'>Inactivo</span>";
                            }

                            ?>
                        <tr>
                            <td>
                                <?php echo $value["nombre_usuario"]; ?>
                            </td>

                            <td>
                                <?php echo $value["apellido_usuario"]; ?>

                            </td>

                            <td>
                                <?php echo $value["email_usuario"]; ?>
                            </td>
                            <td>
                                <?php echo $value["rol_usuario"]; ?>
                            </td>
                            <td>
                                <?php echo $estado; ?>
                            </td>
                            <td>
                            <?php if ($_SESSION["rol_usuario"] == "Admin") { ?>
                                <a href="index.php?pagina=editar_usuario&usuario=<?php echo $value["id_usuario"]; ?>"
                                    class="btn btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <button data-id="<?php echo $value["id_usuario"]; ?>" type="button"
                                    class="btn btn-danger btnEliminarUsuario">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                <?php } ?>
                            </td>
                        </tr>

                        <?php } ?>

                        </tfoot>
                </table>
            </div>

        </div>

    </section>
</div>

<?php

$eliminar = new ControladorUsuarios();
$eliminar->ctrEliminarUsuario();

?>