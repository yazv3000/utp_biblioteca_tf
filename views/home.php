<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Trabajo Final - Taller de Programación Web" />
    <meta name="author" content="Y. Zapata Vargas" />
    <title>Biblioteca UTP - Autenticación Personal</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css" id="theme-stylesheet">
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <!-- Alerta usuario o contraseña incorrecta -->
            <?php if (isset($_GET['msg'])) { ?>
                <div class="toast ml-auto" id="errorPass" data-delay="3000" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <img src="<?php echo base_url(); ?>assets/img/error.png" class="rounded mr-2" width="20">
                        <strong class="mr-auto">Alerta</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        Usuario o contraseña incorrecta
                    </div>
                </div>
            <?php } ?>
            <!-- /fin alerta -->

            <!-- PANEL PRINCIPAL AUTENTICACIÓN -->
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card border-0 rounded-lg mt-5 sb-sidenav-dark">
                                <div class="card-header text-center ">
                                    <h3 class="font-weight my-4">Autenticación</h3>
                                    <img class="img-thumbnail" src="<?php echo base_url(); ?>assets/img/logo.png" width="150">
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo base_url(); ?>Usuarios/login" method="post" autocomplete="off">
                                        <div class="form-group">
                                            <strong class="text-white">Usuario</strong>
                                            <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario">
                                        </div>
                                        <div class="form-group">
                                            <strong class="text-white">Contraseña</strong>
                                            <input id="clave" class="form-control" type="password" name="clave" placeholder="Contraseña">
                                        </div>
                                        <button class="btn btn-primary btn-block" type="submit">Iniciar Sesión</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- fin PANEL PRINCIPAL LOGIN --> 
        </div>

        <!-- footer -->
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Desarrollado por Y. Zapata</div>    
                        <div class="text-muted">Copyright &copy; Vida Informático</div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- /fin footer -->
    </div>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
    <script>
        $(document).ready(function() {
            $('#errorPass').toast('show');
        });
    </script>
</body>

</html>