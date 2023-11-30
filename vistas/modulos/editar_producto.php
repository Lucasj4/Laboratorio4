<?php


$producto = ControladorProductos::ctrMostrarProductos("id_producto", $_GET["producto"]);
$categoriasProductos = ModeloProductos::mdlMostrarCategoriasProductos();

// Resto del código...
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Producto</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Editar Producto</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos del producto</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre_producto">Nombre del Producto</label>
                        <input type="text" name="nombre_producto" value="<?php echo $producto["nombre_producto"]; ?>"
                            class="form-control" placeholder="Ingrese el nombre del producto" required>
                    </div>
                    <div class="form-group">
                        <label for="imagen_producto">Imagen del Producto</label>
                        <input type="text" name="imagen_producto" value="<?php echo $producto["imagen_producto"]; ?>"
                            class="form-control" placeholder="Ingrese el nombre del producto" required>
                    </div>
                    <div class="form-group">
                        <label for="stock_producto">Stock</label>
                        <input type="number" name="stock_producto" value="<?php echo $producto["stock_producto"]; ?>"
                            class="form-control" placeholder="Ingrese el nombre del producto" required>
                    </div>
                    <div class="form-group">
                        <label for="estado_producto">Estado</label>
                        <select class="form-control" name="estado_producto" required>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre_producto">Precio</label>
                        <input type="number" name="precio_producto" value="<?php echo $producto["precio_producto"]; ?>"
                            class="form-control" placeholder="Ingrese el nombre del producto" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="categoria_producto">Categoría</label>
                        <select class="form-control" name="categoria_producto" required>
                            <option value="">Seleccione una categoría</option>
                            <?php
                            foreach ($categoriasProductos as $categoriaProducto) {
                                echo "<option value='" . $categoriaProducto["nombre_categoria"]  . "'>" . $categoriaProducto["nombre_categoria"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>



                    


                  
                </div>
                <!-- /.card-body -->
                <input type="hidden" name="id_producto" value="<?php echo $_GET["producto"]; ?>">
                                
                <?php
                $editarProducto = new ControladorProductos();
                $editarProducto->ctrEditarProducto();
                ?>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
