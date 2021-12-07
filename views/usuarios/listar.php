<?php encabezado() ?>
<!-- Begin Page Content -->
<div id="layoutSidenav_content">
    <!-- TABLA DE USUARIOS -->
    <main>
        <div class="container-fluid">
            <?php if (isset($_GET['error'])) { ?>
                <div class="toast ml-auto bg-danger text-white" id="errorCambioPass" role="alert" data-delay="3000" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <img src="<?php echo base_url(); ?>assets/img/error.png" class="rounded mr-2" width="25">
                        <strong class="mr-auto">Alerta</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        Contraseña actual incorrecta
                    </div>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#nuevo_user">Nuevo</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Usuario</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>DNI</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $us) {
                                    if ($us['rol'] == 1) {
                                        $rol = '<span class="badge-success p-1 rounded">Administrador</span>';
                                    } else {
                                        $rol = '<span class="badge-secondary p-1 rounded">Supervisor</span>';
                                    }
                                    if ($us['estado'] == 1) {
                                        $estado = '<span class="badge-primary p-1 rounded">Activo</span>';
                                    } else {
                                        $estado = '<span class="badge-danger p-1 rounded">Inactivo</span>';
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $us['id_user']; ?></td>
                                        <td><?php echo $us['usuario']; ?></td>
                                        <td><?php echo $us['nombres']; ?></td>
                                        <td><?php echo $us['apellidos']; ?></td>
                                        <td><?php echo $us['dni']; ?></td>
                                        <td><?php echo $rol; ?></td>
                                        <td><?php echo $estado; ?></td>
                                        <td>
                                            <a href="<?php echo base_url() ?>usuarios/editar?id=<?php echo $us['id_user']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <form method="post" action="<?php echo base_url() ?>usuarios/eliminar" class="d-inline eliminar">
                                                    <input type="hidden" name="id" value="<?php echo $us['id_user']; ?>">
                                                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                            <?php if ($us['estado'] == 1) { ?>
                                                <form action="<?php echo base_url() ?>usuarios/darBaja" method="post" class="d-inline dar_baja">
                                                    <input type="hidden" name="id" value="<?php echo $us['id_user']; ?>">
                                                    <button class="btn btn-warning" type="submit"><i class="fas fa-minus-circle"></i></button>
                                                </form>
                                            <?php } else { ?>
                                                <form action="<?php echo base_url() ?>usuarios/reingresar" method="post" class="d-inline reingresar">
                                                    <input type="hidden" name="id" value="<?php echo $us['id_user']; ?>">
                                                    <button type="submit" class="btn btn-success"><i class="fas fa-audio-description"></i></button>
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
        </div>
    </main>
    <div id="nuevo_user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="my-modal-title">Nuevo Usuario</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?php echo base_url(); ?>Usuarios/insertar" autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input id="nombres" class="form-control" type="text" name="nombres" placeholder="Nombre(s)">
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input id="apellidos" class="form-control" type="text" name="apellidos" placeholder="Apellido(s)">
                        </div>
                        <div class="form-group">
                                <label for="dni">DNI</label>
                                <input id="dni" class="form-control" type="text" name="dni" placeholder="Documento de identidad">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="clave">Contraseña</label>
                                    <input id="clave" class="form-control" type="password" name="clave" placeholder="Contraseña">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="rol">Rol</label>
                                <select id="rol" class="form-control" name="rol">
                                    <option value="1">Administrador</option>
                                    <option value="2">Supervisor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Registrar</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php pie() ?>