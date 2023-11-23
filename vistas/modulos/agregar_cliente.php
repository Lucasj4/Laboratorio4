<?php

$estadosCiviles = ControladorClientes::mdlMostrarEstadosCiviles();
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agregar cliente</h1>
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
                <h3 class="card-title">Datos de cliente</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre_cliente">Nombre</label>
                        <input type="text" name="nombre_cliente" class="form-control" placeholder="Ingrese el nombre"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="apellido_cliente">Apellido</label>
                        <input type="text" name="apellido_cliente" class="form-control"
                            placeholder="Ingrese el apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="email_cliente">Email</label>
                        <input type="email" name="email_cliente" class="form-control" placeholder="Ingrese un email"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="dni_cliente">DNI</label>
                        <input type="text" name="dni_cliente" class="form-control" placeholder="Ingrese el DNI"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_nacimiento_cliente">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento_cliente" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="estado_civil_cliente">Estado Civil</label>
                        <select class="form-control" name="estado_civil_id" required>
                            <option value="">Seleccione un estado civil</option>
                            <?php
                                foreach ($estadosCiviles as $estadoCivil) {
                                    echo "<option value='" . $estadoCivil["id_estado_civil"] . "'>" . $estadoCivil["nombre_estado_civil"] . "</option>";
                                }
                                ?>
                        </select>
                    </div>
                    <!-- /.card-body -->

                    <?php
                // Aquí debes utilizar el controlador y método correspondiente para agregar clientes
                $agregar = new ControladorClientes();
                $agregar->ctrAgregarCliente();
                ?>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
            </form>
        </div>
    </section>
</div>