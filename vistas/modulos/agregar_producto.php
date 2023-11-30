<?php
// Obtener las categorías de productos
$categoriasProductos = ModeloProductos::mdlMostrarCategoriasProductos();
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agregar producto</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos de producto</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre_producto">Nombre</label>
                        <input type="text" name="nombre_producto" class="form-control" placeholder="Ingrese el nombre"
                            required>
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
                    <div class="form-group">
                        <label for="precio_producto">Precio</label>
                        <input type="text" name="precio_producto" class="form-control" placeholder="Ingrese el precio"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="imagen_producto">Imagen</label>
                        <input type="text" name="imagen_producto" class="form-control"
                            placeholder="Ingrese la URL de la imagen" required>
                    </div>
                    <div class="form-group">
                        <label for="estado_producto">Estado</label>
                        <select class="form-control" name="estado_producto" required>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="stock_producto">Stock</label>
                        <input type="text" name="stock_producto" class="form-control" placeholder="Ingrese el stock"
                            required>
                    </div>

                </div>
                <!-- /.card-body -->
                <input type="hidden" name="id_usuario" value="<?php echo isset($_GET["usuario"]) ? $_GET["usuario"] : ''; ?>">

                <?php
                // Aquí debes utilizar el controlador y método correspondiente para agregar productos
                $agregarProducto = new ControladorProductos();
                $agregarProducto->ctrAgregarProducto();
                ?>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </section>
</div>