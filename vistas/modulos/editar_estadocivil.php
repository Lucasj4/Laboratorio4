<?php

    
$idEstadoCivil = isset($_GET["estadocivil"]) ? $_GET["estadocivil"] : null;

// Muestra los datos del estado civil correspondiente
$estadocivil = ControladorEstadoCivil::ctrMostrarEstadosCiviles("id_estado_civil", $idEstadoCivil);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Estado Civil</h1>


                </div>
  
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos de Estado civil</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" name="nombre_estado_civil" value="<?php echo $estadocivil["nombre_estado_civil"]; ?>"
                            class="form-control" placeholder="Ingrese el nombre" required>
                    </div>
 

                  

              


                </div>
                <!-- /.card-body -->
               
                <input type="hidden" name="id_estado_civil" value="<?php echo $idEstadoCivil; ?>">

                <?php

                $editar = new ControladorEstadoCivil();
                $editar->ctrEditarEstadoCivil();


                ?>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->