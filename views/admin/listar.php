<?php encabezado() ?>

<div id="layoutSidenav_content">

    <!-- Alerta para cantidad de libros no suficiente en un préstamo -->
    <?php if (isset($_GET['no_s'])) { ?>
        <div class="toast ml-auto mr-1 bg-danger text-white" id="alerta" role="alert" data-delay="3000" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="<?php echo base_url(); ?>assets/img/error.png" class="rounded mr-2" width="20">
                <strong class="mr-auto">Alerta</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                No hay libro disponible intentelo en otro momento
            </div>
        </div>
    <?php } ?>

    <!-- VISTA DE PRÉSTAMOS -->
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 p-2">
                <?php if ($_SESSION['rol'] == 1) { ?>     <!-- solo Administrador puede agregar préstamos-->
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#prestar_libro">Préstamo Libro<i class="fas fa-plus-circle"></i></button>
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#prestar_articulo">Préstamo Artículo<i class="fas fa-plus-circle"></i></button>
                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#prestar_tesis">Préstamo Tesis<i class="fas fa-plus-circle"></i></button>
                <?php } ?>
                </div>
                <div class="col-md-12">
                    <table class="table" id="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Tipo de Recurso</th>
                                <th>Titulo</th>
                                <th>Estudiante</th>
                                <th>Fecha Préstamo</th>
                                <th>Fecha Límite Devolución</th>
                                <th>Cant</th>
                                <th>Observación</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['prestamos'] as $row) {
                                if ($row['estado_prestamo'] == 1) {
                                    $estado = '<span class="badge-danger p-1 rounded">Prestado</span>';
                                } else {
                                    $estado = '<span class="badge-success p-1 rounded">Devuelto</span>';
                                }
                            ?>
                                <tr>
                                    <td><?php echo $row['nom_tipo']; ?></td>
                                    <td><?php echo $row['titulo']; ?></td>
                                    <td><?php echo $row['nom_estudiante']; ?></td>
                                    <td><?php echo $row['fecha_prestamo']; ?></td>
                                    <td><?php echo $row['fecha_lim_dev']; ?></td>
                                    <td><?php echo $row['cantidad']; ?></td>
                                    <td><?php echo $row['observacion']; ?></td>
                                    <td><?php echo $estado; ?></td>
                                    <td>
                                        <?php if ($row['estado_prestamo'] == 1 && ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 )) { ?>
                                            <form method="post" action="<?php echo base_url(); ?>admin/devolver" class="devolver">
                                                <input type="hidden" name="id" value="<?php echo $row['id_prestamo']; ?>">
                                                <button class="btn btn-primary" data-id="<?php echo $row['id_prestamo']; ?>" type="submit"><i class="fas fa-plus-square"></i></button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- LIBRO -->
        <div id="prestar_libro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Prestar Libro</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?php echo base_url(); ?>admin/registrarPrestamoLibro">
                            <div class="form-group">
                                <label for="buscar_libr">Libros</label><br>
                                <select id="buscar_libr" class="form-control" name="libro">
                                <?php foreach ($data['libros'] as $libro) { ?>
                                        <option value="<?php echo $libro['id_recurso']; ?>"><?php echo $libro['titulo']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="row">
                            <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="estudiante_libro">Estudiante</label><br>
                                        <select name="estudiante_libro" id="estudiante_libro">
                                            <?php foreach ($data['estudiantes'] as $est) { ?>
                                                <option value="<?php echo $est['codigo']; ?>"><?php echo $est['codigo']." - ".$est['nombres']." ".$est['apellidos']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad</label>
                                        <input id="cantidad" class="form-control" type="number" name="cantidad" min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_prestamo">Fecha de Prestamo</label>
                                        <input id="fecha_prestamo" class="form-control" type="date" name="fecha_prestamo" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_lim_dev">Fecha de Devolución</label>
                                        <input id="fecha_lim_dev" class="form-control" type="date" name="fecha_lim_dev" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="observacion">Observación</label>
                                <textarea id="observacion" class="form-control" name="observacion" rows="3"></textarea>
                            </div>
                            <button class="btn btn-primary" type="submit">Prestar</button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ARTICULO -->
        <div id="prestar_articulo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true"> 
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Prestar Artículo de Revista</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?php echo base_url(); ?>admin/registrarPrestamoArticulo">
                            <div class="form-group">
                                <label for="buscar_articulo">Artículo</label><br>
                                <select id="buscar_articulo" class="form-control" name="articulo">
                                    <?php foreach ($data['articulos'] as $articulo) { ?>
                                        <option value="<?php echo $articulo['id_recurso']; ?>"><?php echo $articulo['titulo']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="estudiante_articulo">Estudiante</label><br>
                                        <select name="estudiante_articulo" id="estudiante_articulo">
                                            <?php foreach ($data['estudiantes'] as $est) { ?>
                                                <option value="<?php echo $est['codigo']; ?>"><?php echo $est['codigo']." - ".$est['nombres']." ".$est['apellidos']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad</label>
                                        <input id="cantidad" class="form-control" type="number" name="cantidad" min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_prestamo">Fecha de Prestamo</label>
                                        <input id="fecha_prestamo" class="form-control" type="date" name="fecha_prestamo" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_lim_dev">Fecha de Devolución</label>
                                        <input id="fecha_lim_dev" class="form-control" type="date" name="fecha_lim_dev" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="observacion">Observación</label>
                                <textarea id="observacion" class="form-control" name="observacion" rows="3"></textarea>
                            </div>
                            <button class="btn btn-primary" type="submit">Prestar</button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- TESIS -->
        <div id="prestar_tesis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Prestar Tesis</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?php echo base_url(); ?>admin/registrarPrestamoTesis">
                            <div class="form-group">
                                <label for="buscar_tesis">Tesis</label><br>
                                <select id="buscar_tesis" class="form-control" name="tesis">
                                    <?php foreach ($data['tesis'] as $tesis) { ?>
                                        <option value="<?php echo $tesis['id_recurso']; ?>"><?php echo $tesis['titulo']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="estudiante_tesis">Estudiante</label><br>
                                        <select name="estudiante_tesis" id="estudiante_tesis">
                                            <?php foreach ($data['estudiantes'] as $est) { ?>
                                                <option value="<?php echo $est['codigo']; ?>"><?php echo $est['codigo']." - ".$est['nombres']." ".$est['apellidos']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad</label>
                                        <input id="cantidad" class="form-control" type="number" name="cantidad" min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_prestamo">Fecha de Prestamo</label>
                                        <input id="fecha_prestamo" class="form-control" type="date" name="fecha_prestamo" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_lim_dev">Fecha de Devolución</label>
                                        <input id="fecha_lim_dev" class="form-control" type="date" name="fecha_lim_dev" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="observacion">Observación</label>
                                <textarea id="observacion" class="form-control" name="observacion" rows="3"></textarea>
                            </div>
                            <button class="btn btn-primary" type="submit">Prestar</button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </main>
    <?php pie() ?>