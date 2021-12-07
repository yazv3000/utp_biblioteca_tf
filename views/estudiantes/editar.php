<?php encabezado() ?>
<!-- Begin Page Content -->
<div id="layoutSidenav_content">
        
    <!-- VISTA EDITAR ESTUDIANTE -->
    <main>
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-lg-6 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>estudiantes/modificar" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="codigo">Código</label>
                                            <input type="hidden" name="codigo" value="<?php echo $data['estudiante']['codigo']; ?>">
                                            <input id="codigo" class="form-control" type="text" name="codigo" value="<?php echo $data['estudiante']['codigo']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dni">Dni</label>
                                            <input id="dni" class="form-control" type="text" name="dni" value="<?php echo $data['estudiante']['dni']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombres">Nombre</label>
                                            <input id="nombres" class="form-control" type="text" name="nombres" value="<?php echo $data['estudiante']['nombres']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="apellidos">Apellidos</label>
                                            <input id="apellidos" class="form-control" type="text" name="apellidos" value="<?php echo $data['estudiante']['apellidos']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="carrera">Carrera</label>
                                            <select id="carrera" class="form-control" name="carrera">
                                                <?php foreach ($data['carreras'] as $carrera) { ?>
                                                    <option <?php if ($carrera['id_carrera'] == $data['estudiante']['id_carrera']) {
                                                                echo 'selected';
                                                            } ?> value="<?php echo $carrera['id_carrera']; ?>"><?php echo $carrera['nom_carrera']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="telefono">Télefono</label>
                                            <input id="telefono" class="form-control" type="text" name="telefono" value="<?php echo $data['estudiante']['telefono']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input id="direccion" class="form-control" type="text" name="direccion" value="<?php echo $data['estudiante']['direccion']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Modificar</button>
                                            <a class="btn btn-danger" href="<?php echo base_url(); ?>estudiantes">Atras</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--/FIN VISTA EDITAR ESTUDIANTE -->

    <?php pie() ?>