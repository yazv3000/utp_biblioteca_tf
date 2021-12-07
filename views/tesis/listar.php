<?php encabezado() ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="text-center">Tesis</h5>
                    <button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#nuevaTesis">Nuevo</button>
                    <div class="table-responsive">
                        <table class="table table-light mt-4" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Título</th>
                                    <th>Cant</th>
                                    <th>Autor</th>
                                    <th>Anio</th>
                                    <th>Materia</th>
                                    <th>Estado</th>
                                    <th>Descripción</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['tesis'] as $tesis) {
                                    if ($tesis['estado'] == 1) {
                                        $estado = '<span class="badge-success p-1 rounded">Activo</span>';
                                    } else {
                                        $estado = '<span class="badge-danger p-1 rounded">Inactivo</span>';
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $tesis['titulo']; ?></td>
                                        <td><?php echo $tesis['cant_disponible']; ?></td>
                                        <td><?php echo $tesis['autor']; ?></td>
                                        <td><?php echo $tesis['anio']; ?></td>
                                        <td><?php echo $tesis['materia']; ?></td>
                                        <td><?php echo $estado ?></td>
                                        <td><?php echo $tesis['descripcion']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>tesis/editar?id=<?php echo $tesis['id_recurso']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <form method="post" action="<?php echo base_url() ?>tesis/eliminar" class="d-inline eliminar">
                                                    <input type="hidden" name="id_recurso" value="<?php echo $tesis['id_recurso']; ?>">
                                                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                                            </form>
            
                                            <?php if ($tesis['estado'] == 1) { ?>
                                                <form method="post" action="<?php echo base_url(); ?>tesis/darBaja" class="d-inline dar_baja">
                                                    <input type="hidden" name="id_recurso" value="<?php echo $tesis['id_recurso']; ?>">
                                                    <button class="btn btn-warning" type="submit"><i class="fas fa-minus-circle"></i></button>
                                                </form>
                                            <?php } else { ?>
                                                <form method="post" action="<?php echo base_url(); ?>tesis/reingresar" class="d-inline reingresar">
                                                    <input type="hidden" name="id_recurso" value="<?php echo $tesis['id_recurso']; ?>">
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
    </main>
    <div id="nuevaTesis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Registro de Artículo</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url() ?>tesis/registrar" method="post" id="frmTesis" class="row" autocomplete="off" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input id="titulo" class="form-control" type="text" name="titulo" placeholder="Título de la Tesis">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="autor">Autor</label>
                                <select id="autor" class="form-control" name="autor">
                                    <?php foreach ($data['autores'] as $autor) { ?>
                                        <option value="<?php echo $autor['id_autor']; ?>"><?php echo $autor['nom_autor']." ".$autor['ape_autor']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="materia">Materia</label>
                                <select id="materia" class="form-control" name="materia">
                                    <?php foreach ($data['materias'] as $materia) { ?>
                                        <option value="<?php echo $materia['id_materia']; ?>"><?php echo $materia['nom_materia']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input id="cantidad" class="form-control" type="text" name="cantidad" placeholder="Cantidad">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="paginas">Cantidad de páginas</label>
                                <input id="paginas" class="form-control" type="number" name="paginas" placeholder="Cantidad Página">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="anio">Año Publicación</label>
                                <input id="anio" class="form-control" type="date" name="anio" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea id="descripcion" class="form-control" name="descripcion" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Registrar</button>
                                <button class="btn btn-danger" data-dismiss="modal" type="button">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
       

    <?php pie() ?>