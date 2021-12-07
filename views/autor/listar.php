<?php encabezado() ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h5 class="text-center">Autores</h5>
            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#nuevoAutor">Nuevo</button>
                    <div class="table-responsive">
                        <table class="table table-light mt-4" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Foto</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $autor) {
                                    if ($autor['estado'] == 1) {
                                        $estado = '<span class="badge-success p-1 rounded">Activo</span>';
                                    } else {
                                        $estado = '<span class="badge-danger p-1 rounded">Inactivo</span>';
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $autor['id_autor']; ?></td>
                                        <td><?php echo $autor['nom_autor']." ".$autor['ape_autor']; ?></td>
                                        <td><img class="img-thumbnail" src="<?php echo base_url() ?>assets/images/autor/<?php echo $autor['imagen']; ?>" width="100"></td>
                                        <td><?php echo $estado; ?></td>
                                        <td>
                                            <a class="btn btn-primary" href="<?php echo base_url() ?>autor/editar?id=<?php echo $autor['id_autor'] ?>"><i class="fas fa-edit"></i></a>
                                            <form method="post" action="<?php echo base_url() ?>autor/eliminar" class="d-inline eliminar">
                                                    <input type="hidden" name="id_autor" value="<?php echo $autor['id_autor']; ?>">
                                                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                            </form>

                                            <?php if ($autor['estado'] == 1) { ?>
                                                <form method="post" action="<?php echo base_url() ?>autor/darBaja" class="d-inline dar_baja">
                                                    <input type="hidden" name="id_autor" value="<?php echo $autor['id_autor']; ?>">
                                                    <button class="btn btn-warning" type="submit"><i class="fas fa-minus-circle"></i></button>
                                                </form>
                                            <?php } else { ?>
                                                <form method="post" action="<?php echo base_url() ?>autor/reingresar" class="d-inline reingresar">
                                                    <input type="hidden" name="id_autor" value="<?php echo $autor['id_autor']; ?>">
                                                    <button class="btn btn-success" type="submit"><i class="fas fa-audio-description"></i></button>
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
        <div id="nuevoAutor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="my-modal-title">Registro Autor</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url();?>autor/registrar" method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombres">Nombres</label>
                                        <input id="nombres" class="form-control" type="text" name="nombres" required placeholder="Nombre(s) del autor">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label>
                                        <input id="apellidos" class="form-control" type="text" name="apellidos" required placeholder="Apellido(s) del autor">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <input id="foto" class="form-control" type="file" name="imagen">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Registrar</button>
                                        <button class="btn btn-danger" data-dismiss="modal" type="button">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php pie() ?>