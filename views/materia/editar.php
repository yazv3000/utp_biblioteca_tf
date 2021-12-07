<?php encabezado() ?>
<!-- Begin Page Content -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-lg-6 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>materia/modificar" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombre">Nombre de la materia</label>
                                            <input type="hidden" name="id_materia" value="<?php echo $data['id_materia']; ?>">
                                            <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo $data['nom_materia']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Modificar</button>
                                            <a class="btn btn-danger" href="<?php echo base_url(); ?>materia" type="button">Atrás</a>
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
<?php pie() ?>