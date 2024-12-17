<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
    <title>Pet Shop Mimo</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #885932;">
                <div class="featured-image mb-3">
                    <img src="<?php echo base_url() ?>assets/images/4.png" class="img-fluid" style="width: 250px;">
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 900;">Pet Shop Mimo</p>
                <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Alimentos, juguetes y accesorios de calidad para mascotas.</small>
            </div>
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2 style="font-weight: 900;">Bienvenido</h2>
                        <p>Inicio de sesión</p>
                    </div>
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($success)) : ?>
                        <div class="alert alert-warning" role="alert">
                            <?= $success ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= site_url('Welcome/validarusuariobd') ?>" method="post">
                        <div class="input-group mb-3">
                            <input type="text" name="user" id="user" class="form-control form-control-lg bg-light fs-6" placeholder="Usuario">
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" name="password" id="password" class="form-control form-control-lg bg-light fs-6" placeholder="Contraseña">
                        </div>
                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Recordar</small></label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-lg btn-primary w-100 fs-6 btnlogin">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>