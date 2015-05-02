$(document).ready( function() {

	$('#btn-add').on('click', function() {

		var form = '<form id="form-add" method="post" action=""> \
				<div class="field"> \
					<label for="new-fruit-name">Fruit Name</label> \
					<input type="text" id="new-fruit-name" name="new-fruit-name" required> \
				</div> \
				\
				<div class="field"> \
					<label for="new-fruit-quantity">Quantity</label> \
					<input type="text" id="new-fruit-quantity" name="new-fruit-quantity" required> \
				</div> \
				\
				<div class="field"> \
					<label for="new-fruit-distributor">Fruit Distributor</label> \
					<input type="text" id="new-fruit-distributor" name="new-fruit-distributor" required> \
				</div> \
				\
				<div class="field"> \
					<label for="new-fruit-price">Price</label> \
					<input type="text" id="new-fruit-price" name="new-fruit-price" required> \
				</div> \
				\
				<div class="field center"> \
			        <input type="submit"> \
			    </div> \
			</form>';

		$('#modal-add').html(form);
	});



	$('.btn-edit').on('click', function() {

		// gets the id of the fruit
		var id = $(this).parent().parent().attr('id');
		
		var form = '<form id="form-edit" method="post" action=""> \
				<div class="field"> \
					<label for="edit-fruit-name">Fruit Name</label> \
					<input type="text" id="edit-fruit-name" name="edit-fruit-name" required> \
				</div> \
				\
				<div class="field"> \
					<label for="edit-fruit-id">Fruit ID</label> \
					<input type="text" id="edit-fruit-id" name="edit-fruit-id" readonly> \
				</div> \
				\
				<div class="field"> \
					<label for="edit-fruit-quantity">Quantity</label> \
					<input type="text" id="edit-fruit-quantity" name="edit-fruit-quantity" required> \
				</div> \
				\
				<div class="field"> \
					<label for="edit-fruit-distributor">Fruit Distributor</label> \
					<input type="text" id="edit-fruit-distributor" name="edit-fruit-distributor" required> \
				</div> \
				\
				<div class="field"> \
					<label for="edit-fruit-price">New Price</label> \
					<input type="text" id="edit-fruit-price" name="edit-fruit-price" required> \
				</div> \
				\
				<div class="field center"> \
			        <input type="submit"> \
			    </div> \
			</form>';

		$('#modal-edit').html(form);

		$('#modal-edit #edit-fruit-name').val( $('#'+id+' .fruit-name').text() );
		$('#modal-edit #edit-fruit-id').val( $('#'+id+' .fruit-id').text() );
		$('#modal-edit #edit-fruit-quantity').val( $('#'+id+' .fruit-quantity').text() );
		$('#modal-edit #edit-fruit-distributor').val( $('#'+id+' .fruit-distributor').text() );
	});

	$('.btn-prices').on('click', function() {

		
		var id = $(this).parent().parent().attr('id');

		$('#highcharts').highcharts({
	        chart: {
	            type: 'area'
	        },
	        title: {
	            text: 'Fruit Price'
	        },
	        subtitle: {
	            text: 'Banana Price over the last days'
	        },
	        xAxis: {
	            allowDecimals: false,
	            labels: {
	                formatter: function () {
	                    return Highcharts.dateFormat('%d %b', this.value);
	                }
	            }
	        },
	        yAxis: {
	            title: {
	                text: 'Price in Pesos'
	            },
	            labels: {
	                formatter: function () {
	                    return this.value;
	                }
	            }
	        },
	        tooltip: {
	            pointFormat: '{series.name} priced at <b>{point.y:,.0f}</b><br/>at {point.x}'
	        },
	        plotOptions: {
	            area: {
	                pointStart: 2015,
	                marker: {
	                    enabled: false,
	                    symbol: 'circle',
	                    radius: 2,
	                    states: {
	                        hover: {
	                            enabled: true
	                        }
	                    }
	                }
	            }
	        },
	        series: [{
	            name: 'Banana',
	            data: [20, 50, 20, 30, 20, 25, 30],
	            pointStart: Date.UTC(2015, 3, 26),	// put current date here
        		pointInterval: 24 * 3600 * 1000 // one day
	        }]
	    });
	});

	$('.btn-delete').on('click', function() {

		// gets the id of the fruit
		var id = $(this).parent().parent().attr('id')

		alert("clicked DELETE on id=" + id);
	});
});