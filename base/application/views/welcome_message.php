<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Fruit -- BASE</title>

	<link rel="stylesheet" type="text/css" href="./assets/styles/css/styles.css">

	<script type="text/javascript" src="./assets/js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="./assets/js/main.js"></script>
</head>
<body>


	<div id="welcome">

		<article id="home">
			<header>
				<h1>FRUITS</h1>
				<p>View, Add, Edit and Delete fruit stuff.</p>
			</header>

			<nav>
				<ul>
					<li><a href="<?php echo str_replace(basename(base_url())."/", "mongodb", base_url()); ?>">MongoDb</a></li>
					<li><a href="<?php echo str_replace(basename(base_url())."/", "mysql", base_url()); ?>">MySQL</a></li>
					<li><a href="<?php echo str_replace(basename(base_url())."/", "couchdb", base_url()); ?>">CouchDB</a></li>
				</ul>
			</nav>
		</article>
	</div>

	<div id="wrapper">
		<div id="fruit-basket">
			
			<!-- these are the sample structure of the fruit -->

			<!-- the contents of id="fruit-basket" should be empty initially
				 and just has to be populated from the controller to the view.
			-->

			<article class="fruit" id="1">
				<header class="fruit-name">
					APPLE
				</header>

				<section class="fruit-details">
					<div class="fruit-quantity">10</div>
					<div class="fruit-distributor">del Monte</div>
				</section>

				<section class="fruit-mods">
					<div class="btn-edit">EDIT</div>
					<div class="btn-delete">DELETE</div>
				</section>
			</article>

			<article class="fruit" id="2">
				<header class="fruit-name">
					APPLE
				</header>

				<section class="fruit-details">
					<div class="fruit-quantity">10</div>
					<div class="fruit-distributor">del Monte</div>
				</section>

				<section class="fruit-mods">
					<div class="btn-edit">EDIT</div>
					<div class="btn-delete">DELETE</div>
				</section>
			</article>

			<article class="fruit" id="3">
				<header class="fruit-name">
					APPLE
				</header>

				<section class="fruit-details">
					<div class="fruit-quantity">10</div>
					<div class="fruit-distributor">del Monte</div>
				</section>

				<section class="fruit-mods">
					<div class="btn-edit">EDIT</div>
					<div class="btn-delete">DELETE</div>
				</section>
			</article>

			<article class="fruit" id="4">
				<header class="fruit-name">
					APPLE
				</header>

				<section class="fruit-details">
					<div class="fruit-quantity">10</div>
					<div class="fruit-distributor">del Monte</div>
				</section>

				<section class="fruit-mods">
					<div class="btn-edit">EDIT</div>
					<div class="btn-delete">DELETE</div>
				</section>
			</article>

			<article class="fruit" id="5">
				<header class="fruit-name">
					APPLE
				</header>

				<section class="fruit-details">
					<div class="fruit-quantity">10</div>
					<div class="fruit-distributor">del Monte</div>
				</section>

				<section class="fruit-mods">
					<div class="btn-edit">EDIT</div>
					<div class="btn-delete">DELETE</div>
				</section>
			</article>

			<article class="fruit" id="6">
				<header class="fruit-name">
					APPLE
				</header>

				<section class="fruit-details">
					<div class="fruit-quantity">10</div>
					<div class="fruit-distributor">del Monte</div>
				</section>

				<section class="fruit-mods">
					<div class="btn-edit">EDIT</div>
					<div class="btn-delete">DELETE</div>
				</section>
			</article>

		</div>
	</div>

</body>
</html>