<?php

    
    $cliente = ControladorClientes::ctrMostrarClientes("id_cliente", $_GET["cliente"]);
    $estadosCiviles = ControladorEstadoCivil::ctrMostrarEstadosCiviles(null, null);
    // $funciones = new Funciones();
    // $edadCliente = $funciones->calcularEdad($cliente["f_nacimiento"]);
 
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Cliente</h1>


                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Inicio</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos del cliente</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" name="nombre_cliente" value="<?php echo $cliente["nombre_cliente"]; ?>"
                            class="form-control" placeholder="Ingrese el nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Apellido</label>
                        <input type="text" name="apellido_cliente" value="<?php echo $cliente["apellido_cliente"]; ?>"
                            class="form-control" placeholder="Ingrese el apellido" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email_cliente" value="<?php echo $cliente["email_cliente"]; ?>"
                            class="form-control" placeholder="Ingrese el email" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">DNI</label>
                        <input type="text" name="dni_cliente" value="<?php echo $cliente["dni_cliente"]; ?>"
                            class="form-control" placeholder="Ingrese el DNI" required pattern="\d*">
                    </div>

                    <div class="form-group">
                        <label for="estado_civil">Estado Civil</label>
                        <select class="form-control" name="estado_civil" required>
                            <option value="">Seleccione un estado civil</option>
                            <?php
                                foreach ($estadosCiviles as $estadoCivil) {
                                    echo "<option value='" .  $estadoCivil["nombre_estado_civil"] . "'>" . $estadoCivil["nombre_estado_civil"] . "</option>";
                                }
                                ?>
                        </select>
                    </div>

              


                </div>
                <!-- /.card-body -->
                <input type="hidden" name="id_cliente" value="<?php echo $_GET["cliente"]; ?>">

                <?php

                $editar = new ControladorClientes();
                $editar->ctrEditarCliente();


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
