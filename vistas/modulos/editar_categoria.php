<?php

    
    $categoria = ControladorCategorias::ctrMostrarCategorias("id_categoria", $_GET["categoria"]);
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
                    <h1>Editar Categoria</h1>


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
                <h3 class="card-title">Datos de categiria</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" name="nombre_categoria" value="<?php echo $categoria["nombre_categoria"]; ?>"
                            class="form-control" placeholder="Ingrese el nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Descripcion</label>
                        <input type="text" name="descripcion_categoria" value="<?php echo $categoria["descripcion_categoria"]; ?>"
                            class="form-control" placeholder="Ingrese descripcion" required>
                    </div>

                  

              


                </div>
                <!-- /.card-body -->
                <input type="hidden" name="id_categoria" value="<?php echo $_GET["categoria"]; ?>">


                <?php

                $editar = new ControladorCategorias();
                $editar->ctrEditarCategoria();


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