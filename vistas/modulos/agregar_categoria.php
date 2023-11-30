



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agregar categoria</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos de cliente</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre_categoria">Nombre</label>
                        <input type="text" name="nombre_categoria" class="form-control" placeholder="Ingrese el nombre de la categoria"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion_categoria">Descripcion</label>
                        <input type="text" name="descripcion_categoria" class="form-control"
                            placeholder="Ingrese descripcion" required>
                    </div>
                  
                    <!-- /.card-body -->
                  
                    <?php
                // Aquí debes utilizar el controlador y método correspondiente para agregar clientes
                $agregar = new ControladorCategorias();
                $agregar->ctrAgregarCategoria();
                ?>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
            </form>
        </div>
    </section>
</div>