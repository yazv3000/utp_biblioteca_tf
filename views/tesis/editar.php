<?php encabezado() ?>
<div id="layoutSidenav_content">
    
    <!-- VISTA EDITAR TESTS  -->
    <main>
        <div class="container-fluid">
            <div class="row p-5">
                <form action="<?php echo base_url() ?>tesis/modificar" method="post" id="frmTesis" class="row" autocomplete="off" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="hidden" name="id_recurso" value="<?php echo $data['tesis']['id_recurso']; ?>">
                            <input id="titulo" class="form-control" type="text" name="titulo" value="<?php echo $data['tesis']['titulo']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="autor">Autor</label>
                            <select id="autor" class="form-control" name="autor">
                                <?php foreach ($data['autores'] as $autor) { ?>
                                    <option <?php if ($autor['id_autor'] == $data['tesis']['id_autor']) {
                                                echo 'selected';
                                            } ?> value="<?php echo $autor['id_autor']; ?>"><?php echo $autor['nom_autor']." ".$autor['ape_autor']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="materia">Materia</label>
                            <select id="materia" class="form-control" name="materia">
                                <?php foreach ($data['materias'] as $materia) { ?>
                                    <option <?php if ($materia['id_materia'] == $data['tesis']['id_materia']) {
                                                echo 'selected';
                                            } ?> value="<?php echo $materia['id_materia']; ?>"><?php echo $materia['nom_materia']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input id="cantidad" class="form-control" type="text" name="cantidad" value="<?php echo $data['tesis']['cant_disponible'] ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="paginas">Cantidad de páginas</label>
                            <input id="paginas" class="form-control" type="number" name="paginas" value="<?php echo $data['tesis']['paginas']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="anio">Año de Publicación</label>
                            <input id="anio" class="form-control" type="date" name="anio" value="<?php echo $data['tesis']['anio']; ?>">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" class="form-control" name="descripcion" rows="2"><?php echo $data['tesis']['descripcion']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Modificar</button>
                            <a class="btn btn-danger" href="<?php echo base_url(); ?>tesis">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <!-- /FIN VISTA EDITAR TESIS  -->
    <?php pie() ?>