<?php encabezado() ?>
<!-- Begin Page Content -->
<div id="layoutSidenav_content">

    <!-- VISTA EDITAR AUTOR -->
    <main>
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-lg-6 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>autor/modificar" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombres">Nombres</label>
                                            <input type="hidden" name="id_autor" value="<?php echo $data['id_autor']; ?>" required>
                                            <input id="nombres" class="form-control" type="text" name="nombres" value="<?php echo $data['nom_autor']; ?>" required placeholder="Nombre(s) del autor">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="apellidos">Apellidos</label>
                                            <input type="hidden" name="id_autor" value="<?php echo $data['id_autor']; ?>" required>
                                            <input id="apellidos" class="form-control" type="text" name="apellidos" value="<?php echo $data['ape_autor']; ?>" required placeholder="Apellido(s) del autor">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="foto">Foto</label>
                                            <input id="foto" class="form-control" type="file" name="imagen">
                                            <input type="hidden" name="foto" value="<?php echo $data['imagen']; ?>">
                                            <img class="img-thumbnail" src="<?php echo base_url() . "Assets/images/autor/" . $data['imagen']; ?>" width="250">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Modificar</button>
                                            <a class="btn btn-danger" href="<?php echo base_url(); ?>autor" type="button">Atras</a>
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

    <!--/ FIN VISTA EDITAR AUTOR -->
    <?php pie() ?>