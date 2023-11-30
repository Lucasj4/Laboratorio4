
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agregar Estado civil</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos de Estado Civil</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre_estado_civil">Nombre</label>
                        <input type="text" name="nombre_estado_civil" class="form-control" placeholder="Ingrese el nombre de Estado Civil"
                            required>
                    </div>

                  
                    <!-- /.card-body -->
                  
                    <?php
                // Aquí debes utilizar el controlador y método correspondiente para agregar clientes
                $agregar = new ControladorEstadoCivil();
                $agregar->ctrAgregarEstadoCivil();
                ?>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
            </form>
        </div>
    </section>
</div>