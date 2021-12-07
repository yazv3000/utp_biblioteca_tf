<?php encabezado() ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-lg-6 m-auto">
                    <form method="post" action="<?php echo base_url(); ?>Usuarios/actualizar" autocomplete="off">
                        <div class="card-header bg-dark">
                            <h6 class="title text-white text-center">Modificar Usuario</46>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nombre">Nombres</label>
                                <input id="id" type="hidden" name="id" value="<?php echo $data['id_user']; ?>">
                                <input id="nombres" class="form-control" type="text" name="nombres" placeholder="Nombre(s)" value="<?php echo $data['nombres']; ?>">
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                    <label for="apellidos">Apellidos</label>
                                <input id="apellidos" class="form-control" type="text" name="apellidos" placeholder="Apellido(s)" value="<?php echo $data['apellidos']; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="dni">Dni</label>
                                        <input id="dni" class="form-control" type="text" name="dni" placeholder="Documento de identidad" value="<?php echo $data['dni']; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="usuario">Usuario</label>
                                        <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario" value="<?php echo $data['usuario']; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="rol">Rol</label>
                                    <select id="rol" class="form-control" name="rol">
                                        <option value="1" <?php if ($data['rol'] == "1") {
                                                                            echo "selected";
                                                                        } ?>>Administrador</option>
                                        <option value="2" <?php if ($data['rol'] == "2") {
                                                                        echo "selected";
                                                                    } ?>>Supervisor</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Modificar</button>
                            <a class="btn btn-danger" href="<?php echo base_url();?>usuarios/listar">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
<?php pie() ?>