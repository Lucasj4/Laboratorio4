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
                    <?php if ($_SESSION["rol_usuario"] == "admin") { ?>
                    <a href="agregar_producto" class="btn btn-primary mt-3"><i class="fa-solid fa-user-plus"></i> Agregar
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

                        <?php 
                        foreach ($productos as $key => $value) { ?>
                            <tr>
                                <td>
                                    <?php echo $value["nombre_producto"]; ?>
                                </td>
                                <td>
                                    $
                                    <?php echo number_format($value["precio_producto"], 2); ?>
                                </td>
                                <td>
                                    <?php echo $value["id_categoria"]; ?>
                                </td>
                                <td>
                                             <?php
                                            if ($value["estado_producto"] == "En Stock")
                                            {
                                                $estado = "<span class='badge badge-success'>En stock</span>";
                                            }
                                            else
                                            {
                                                $estado = "<span class='badge badge-danger'>Sin stock</span>";
                                            }
                                            echo $estado;
                                                    ?>
                                            
                                </td>
                                <td>
                                <a href="index.php?pagina=editar_producto&producto=<?php echo $value["id_producto"]; ?>"
                                        class="btn btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button id_cliente="<?php echo $id_producto["id_producto"]; ?>" type="button" class="btn btn-danger btnEliminarProducto">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
    <!-- /.content -->

</div>
