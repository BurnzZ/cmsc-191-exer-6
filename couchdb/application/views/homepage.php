<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Fruits in CouchDB</title>

	<link rel="stylesheet" type="text/css" href="./assets/styles/css/styles.css">
	<link rel="stylesheet" href="./assets/js/jquery-modal/jquery.modal.css" type="text/css" media="screen" />

	<script type="text/javascript" src="./assets/js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="./assets/js/main.js"></script>
	<script type="text/javascript" src="./assets/js/jquery-modal/jquery.modal.js"></script>
	<script type="text/javascript" src="./assets/js/custom-highcharts.js"></script>
	<script>
		var base_url="<?php echo base_url(); ?>";
	</script>

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
					<li><a class="active" href="<?php echo str_replace(basename(base_url())."/", "couchdb", base_url()); ?>">CouchDB</a></li>
				</ul>
			</nav>
		</article>
	</div>

	<div id="wrapper">

		<div class="btn-container">
			<a class="modal-link" href="#modal-add" rel="modal:open">
				<div id="btn-add">Add Fruit</div>
			</a>
		</div>
		
		<div id="fruit-basket">
			
			<!-- these are the sample structure of the fruit -->

			<!-- the contents of id="fruit-basket" should be empty initially
				 and just has to be populated from the controller to the view.
			-->

			<?php

				foreach ($fruits as $fruit) {
					echo '<article class="fruit" id="' . $fruit['id'] . '">';
						echo '<header class="fruit-name">' . $fruit['name'] . '</header>';

						echo '<section class="fruit-details">';
							echo '<div class="fruit-quantity">' . $fruit['qty'] . '</div>';
							echo '<div class="fruit-distributor">' . $fruit['dist'] . '</div>';
							echo '<div class="fruit-prices">' . "Price: " .$fruit['price'] . '</div>';
						echo '</section>';

						echo '<section class="fruit-mods">';
							echo '<div class="btn-edit"><a class="modal-link" href="#modal-edit" rel="modal:open">EDIT</a></div>';
							echo '<div class="btn-prices"><a class="modal-link" href="#modal-prices" rel="modal:open">PRICES</a></div>';
							echo '<div class="btn-delete">DELETE</div>';
						echo '</section>';

					echo '</article>';
				}

			?>

			<!-- Modal for when clicking ADD FRUIT -->
			<div id="modal-add" style="display:none;"></div>

			<!-- Modal for when clicking EDIT -->
			<div id="modal-edit" style="display:none;"></div>

			<!-- Modal for when clicking PRICES -->
			<div id="modal-prices" style="display:none; min-width: 600px;">
				<div id="highcharts" style="min-width: 600px; height: 400px; margin: 0 auto"></div>
			</div>

		</div>
	</div>

</body>
</html>