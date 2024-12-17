<!DOCTYPE html>
<html>

<head>
	<title>Pet Shop</title>
	<meta charset="iso-8859-1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	<style>
		.user-info {
			display: flex;
			align-items: center;
			margin-left: auto;
		}

		.user-info .user-name {
			margin-left: 10px;
			/* Reduce el margen entre el nombre de usuario y el logo */
		}

		.user-info img {
			margin-left: 5px;
			/* Reduce el margen entre el nombre y la imagen */
			width: 40px;
			height: 40px;
		}

		.navigation {
			display: flex;
			justify-content: center;
			align-items: center;
			padding: 0;
			list-style: none;
		}

		.navigation li {
			margin: 0 5px;
			/* Reducido para acercar los elementos */
			/* Reduce el margen entre los elementos de navegación */
		}

		.featured ul {
			list-style: none;
			padding: 0;
			display: flex;
			justify-content: center;
			align-items: flex-start;
		}

		.featured li {
			text-align: center;
			width: 400px;
			height: 200px;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.featured img {
			max-width: 100%;
			height: auto;
		}

		.container {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			margin-top: 20px;
		}

		.logout-icon {
			color: #ffffff;
			font-size: 24px;
			margin-left: 2px;

		}



		.logout-img {
			width: 30px;
			height: 25px;
		}
	</style>

</head>

<body>
	<div id="header">
		<a href="<?= site_url('Welcome/empleado') ?>" id="logo"><img src="<?= base_url() ?>assets/images/logo.gif"
				alt="Logo"></a>
		<ul class="navigation">
			<li class="active"><a href="<?= site_url('Welcome/productos') ?>">Productos</a></li>
			<li><a href="<?= site_url('Welcome/ver_pedidos') ?>">Pedidos</a></li>
			<li><a href="<?= site_url('Welcome/carrito') ?>">Carrito</a></li>
			<?php if (isset($nombre)): ?>
				<li class="user-info">
					<span class="user-name">Empleado <?= $nombre; ?></span>
					<img src="<?= base_url() ?>assets/images/empleado.png" alt="User Icon">
				</li>
			<?php endif; ?>
			<li><a href="<?= site_url('Welcome/miCuenta') ?>">Mi cuenta</a></li>
			<li>
				<a href="<?php echo site_url('Welcome/cerrarsesion'); ?>" title="Cerrar Sesión" class="btn-exit-system">
					<img src="<?= base_url() ?>assets/images/apagar.png" alt="Cerrar sesión" class="logout-img">
				</a>
			</li>
		</ul>
	</div>

	<div id="body">
		<div class="banner">&nbsp;</div>
		<div id="content">
			<div class="content">
				<ul>
					<li>
						<a href="#"><img src="<?= base_url() ?>assets/images/puppy.jpg" width="114" height="160"
								alt=""></a>
						<h2>Lo que necesitan</h2>
						<p>Es sorprendente comprobar cómo en la epo se escribió la letra gótica, que ahora creemos no
							muy clara <a class="more" href="#">View all</a></p>
					</li>
					<li>
						<a href="#"><img src="<?= base_url() ?>assets/images/cat.jpg" width="114" height="160"
								alt=""></a>
						<h2>Algo bueno</h2>
						<p>El gótico, que ahora creemos que no está muy claro, ha precedido durante siglos a las formas
							literarias de la humanidad. <a class="more" href="#">View all</a></p>
					</li>
					<li>
						<a href="#"><img src="<?= base_url() ?>assets/images/koi.jpg" width="114" height="160"
								alt=""></a>
						<h2></h2>Tipos de peces</h2>
						<p>Como ahora nos parece poco claro, la literatura ha precedido a las formas de la humanidad
							durante el siglo IV. <a class="more" href="#">View all</a></p>
					</li>
					<li>
						<a href="#"><img src="<?= base_url() ?>assets/images/bird.jpg" width="114" height="160"
								alt=""></a>
						<h2>Pájaros divertidos</h2>
						<p>Es sorprendente observar cómo la literatura gótica, que ahora creemos que es un poco clara,
							le precedió. <a class="more" href="#">View all</a></p>
					</li>
				</ul>
			</div>
		</div>
	</div>
</body>

</html>