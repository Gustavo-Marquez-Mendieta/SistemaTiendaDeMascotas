<!DOCTYPE html>
<html>

<head>
	<title>Pet Shop</title>
	<meta charset="iso-8859-1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
	<div id="header">
		<a href="<?= site_url('Welcome/index') ?>" id="logo"><img src="<?= base_url() ?>assets/images/logo.gif" width="310" height="114" alt=""></a>
		<ul class="navigation">
			<li class="active"><a href="<?= site_url('Welcome/productos') ?>">Tienda</a></li>
			<li><a href="<?= site_url('Welcome/carrito') ?>">Carrito <i class="fas fa-shopping-cart"></i></a></li>
			<li><a href="<?= site_url('Welcome/contacto') ?>">Acerca de</a></li>
			<li><a href="<?= site_url('Welcome/contacto') ?>">Contacto</a></li>
		</ul>
	</div>

	<div id="body">
		<div class="banner">&nbsp;</div>
		<div id="content">
			<div class="content">
				<ul>
					<li>
						<a href="#"><img src="<?= base_url() ?>assets/images/puppy.jpg" width="114" height="160" alt=""></a>
						<h2>Lo que necesitan</h2>
						<p>Es sorprendente comprobar cómo en la epo se escribió la letra gótica, que ahora creemos no muy clara <a class="more" href="#">View all</a></p>
					</li>
					<li>
						<a href="#"><img src="<?= base_url() ?>assets/images/cat.jpg" width="114" height="160" alt=""></a>
						<h2>Algo bueno</h2>
						<p>El gótico, que ahora creemos que no está muy claro, ha precedido durante siglos a las formas literarias de la humanidad. <a class="more" href="#">View all</a></p>
					</li>
					<li>
						<a href="#"><img src="<?= base_url() ?>assets/images/koi.jpg" width="114" height="160" alt=""></a>
						<h2></h2>Tipos de peces</h2>
						<p>Como ahora nos parece poco claro, la literatura ha precedido a las formas de la humanidad durante el siglo IV. <a class="more" href="#">View all</a></p>
					</li>
					<li>
						<a href="#"><img src="<?= base_url() ?>assets/images/bird.jpg" width="114" height="160" alt=""></a>
						<h2>Pájaros divertidos</h2>
						<p>Es sorprendente observar cómo la literatura gótica, que ahora creemos que es un poco clara, le precedió. <a class="more" href="#">View all</a></p>
					</li>
				</ul>
			</div>
		</div>
	</div>
</body>

</html>