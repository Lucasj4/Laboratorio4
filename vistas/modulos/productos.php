<?php
$item  = null;
$valor = null;

$productos = ControladorProductos::ctrMostrarProductos(null, null);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Productos</h1>
                    <?php if ($_SESSION["rol_usuario"] == "Admin") { ?>
                    <a href="agregar_producto" class="btn btn-primary mt-3"><i class="fa-solid fa-user-plus"></i>
                        Agregar
                        producto</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Productos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre producto</th>
                            <th>Precio</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value["nombre_producto"]; ?></td>
                            <td>$<?php echo number_format($value["precio_producto"], 2); ?></td>
                            <td><?php echo $value["categoria_producto"]; ?></td>
                            <td>
                                <?php
                                    if ($value['stock_producto'] > 0) {
                                    $badge = '<span class="badge badge-success">';
                                    $stock = $value['stock_producto'];
                                    } else {
                                    $badge = '<span class="badge badge-danger">';
                                    $stock = 'Inactivo';
                                    }

                                    echo $badge . $stock . '</span>';
                                ?>
                            </td>
                            <td>
                                <?php if ($_SESSION["rol_usuario"] == "Admin") { ?>
                                <a href="index.php?pagina=editar_producto&producto=<?php echo $value["id_producto"]; ?>"
                                    class="btn btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button data-id="<?php echo $value["id_producto"]; ?>" type="button"
                                    class="btn btn-danger btnEliminarProducto">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                <button type="button" class="btn btn-default toastsDefaultDefault" data-toggle="modal"
                                    data-target="#modal-default" data-producto="<?php echo json_encode($value); ?>">
                                    <i class="fa-solid fa-search"></i>
                                    Ver Detalles
                                </button>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detalles de producto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Nombre: <?php echo $value["nombre_producto"]; ?> </p>
                        <p>Categoria: <?php echo $value["categoria_producto"]; ?> </p>
                        <p>Precio: <?php echo $value["precio_producto"]; ?> </p>
                        <p>Stock: <?php echo $value["stock_producto"]; ?> </p>
                        <p>Estado: <?php echo $value["estado_producto"]; ?> </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- /.modal -->
    </section>
    <!-- /.content -->
</div>



<?php
$eliminar = new ControladorProductos();
$eliminar->ctrEliminarProducto();
?>