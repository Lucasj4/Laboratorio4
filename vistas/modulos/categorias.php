<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categorias</h1>
                    <?php if ($_SESSION["rol_usuario"] == "Admin") { ?>
                    <a href="agregar_categoria" class="btn btn-primary mt-3"><i class="fas fa-tag"></i></i> Agregar
                        categoria</a>
                        <?php } ?>
                </div>
            </div>
        </div>

    </section>

    <section class="content">

        <div class="card">

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped tablaClientes">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Fecha de creación</th>
                        
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $categorias = ControladorCategorias::ctrMostrarCategorias(null, null);
                        
                   
                            
            
                        foreach ($categorias as $key => $value)
                        {
                        ?>
                        <tr>
                            <td>
                                <?php echo $value["nombre_categoria"]; ?>
                            </td>

                            <td>
                                <?php echo $value["descripcion_categoria"]; ?>
                            </td>
                            <td>
                                <?php echo $value["fecha_creacion"]; ?>
                            </td>
                            
                            <td>
                                <?php if ($_SESSION["rol_usuario"] == "Admin") { ?>
                                <a href="index.php?pagina=editar_categoria&categoria=<?php echo $value["id_categoria"]; ?>"
                                    class="btn btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <button data-id="<?php echo $value["id_categoria"]; ?>" type="button"
                                    class="btn btn-danger btnEliminarCategoria">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                <?php } ?>
                            </td>
                           
                           
                        </tr>

                        <?php } ?>

                        </tfoot>
                </table>
            </div>

        </div>

    </section>
 
</div>
<?php

$eliminar = new ControladorCategorias();
$eliminar->ctrEliminarCategoria();

?>