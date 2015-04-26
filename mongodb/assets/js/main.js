$(document).ready( function() {

	$('.btn-edit').on('click', function() {

		// gets the id of the fruit
		var id = $(this).parent().parent().attr('id');
		
		var form = '<form id="form" method="post" action=""> \
				<div class="field"> \
					<label for="fruit-name">Fruit Name</label> \
					<input type="text" id="fruit-name" name="fruit-name" required> \
				</div> \
				\
				<div class="field"> \
					<label for="fruit-quantity">Quantity</label> \
					<input type="text" id="fruit-quantity" name="fruit-quantity" required> \
				</div> \
				\
				<div class="field"> \
					<label for="fruit-distributor">Fruit Distributor</label> \
					<input type="text" id="fruit-distributor" name="fruit-distributor" required> \
				</div> \
				\
				<div class="field"> \
					<label for="fruit-price">New Price</label> \
					<input type="text" id="fruit-price" name="fruit-price" required> \
				</div> \
				\
				<div class="field center"> \
			        <input type="submit"> \
			    </div> \
			</form>';

		$('#modal-edit').html(form);

		$('#modal-edit #fruit-name').val( $('#'+id+' .fruit-name').text() );
		$('#modal-edit #fruit-quantity').val( $('#'+id+' .fruit-quantity').text() );
		$('#modal-edit #fruit-distributor').val( $('#'+id+' .fruit-distributor').text() );


	});


	$('.btn-delete').on('click', function() {

		// gets the id of the fruit
		var id = $(this).parent().parent().attr('id')

		alert("clicked DELETE on id=" + id);
	});
});