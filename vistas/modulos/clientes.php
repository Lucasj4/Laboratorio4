<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Clientes</h1>
                    <?php if ($_SESSION["rol_usuario"] == "admin") { ?>
                    <a href="agregar_cliente" class="btn btn-primary mt-3"><i class="fa-solid fa-user-plus"></i> Agregar
                        cliente</a>
                        <?php } ?>
                </div>
            </div>
        </div>

    </section>

    <section class="content">

        <div class="card">

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped tablaClientes">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DNI</th>
                            <th>Estado civil</th>
                            <th>Edad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $clientes = ControladorClientes::ctrMostrarClientes(null, null);
                        
                   
                            
            
                        foreach ($clientes as $key => $value)
                        {
                        ?>
                        <tr>
                            <td>
                                <?php echo $value["nombre_cliente"]; ?>
                            </td>

                            <td>
                                <?php echo $value["apellido_cliente"]; ?>
                            </td>
                            <td>
                                <?php echo $value["dni_cliente"]; ?>
                            </td>
                            <td>
                                <?php echo $value["estado_civil_id"]; ?>
                            </td>
                            <td>

                                <?php 
                                          $idCliente = $value["id_cliente"];
                                          $edadCliente = ControladorClientes::ctrobtenerEdadCliente($idCliente);
                                echo $edadCliente; ?>
                            </td>

                            <td>
                            <?php if ($_SESSION["rol_usuario"] == "admin") { ?>
                                <a href="index.php?pagina=editar_cliente&cliente=<?php echo $value["id_cliente"]; ?>"
                                    class="btn btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                              
                                <button id_cliente="<?php echo $id_cliente["id_cliente"]; ?>" type="button"
                                    class="btn btn-danger btnEliminarProducto">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                            </td>
                            <?php } ?>
                        </tr>

                        <?php } ?>

                        </tfoot>
                </table>
            </div>

        </div>

    </section>
</div>
<?php

$eliminar = new ControladorClientes();
$eliminar->ctrEliminarCliente();

?>