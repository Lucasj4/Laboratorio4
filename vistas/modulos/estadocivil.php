<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Estado civil</h1>
                    <?php if ($_SESSION["rol_usuario"] == "Admin") { ?>
                    <a href="agregar_estadocivil" class="btn btn-primary mt-3"><i class="fas fa-tag"></i></i> Agregar
                        Estado Civil</a>
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

                            <th>Fecha de creación</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $categorias = ControladorEstadoCivil::ctrMostrarEstadosCiviles(null, null);
                        
                   
                            
            
                        foreach ($categorias as $key => $value)
                        {
                        ?>
                        <tr>
                            <td>
                                <?php echo $value["nombre_estado_civil"]; ?>
                            </td>

                            <td>
                                <?php echo $value["fecha_creacion"]; ?>
                            </td>

                            <td>
                                <?php if ($_SESSION["rol_usuario"] == "Admin") { ?>
                                <a href="index.php?pagina=editar_estadocivil&estadocivil=<?php echo $value["id_estado_civil"]; ?>"
                                    class="btn btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                 

                                <button data-id="<?php echo $value["id_estado_civil"]; ?>" type="button"
                                    class="btn btn-danger btnEliminarEstadoCivil">
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

$eliminar = new ControladorEstadoCivil();
$eliminar->ctrEliminarEstadocivil();

?>