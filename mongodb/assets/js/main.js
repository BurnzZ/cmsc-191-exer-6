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

		var fruitId = $(this).parent().parent().find('.fruit-id').text();
		var id = $(this).parent().parent().attr('id');
		var fruitName = $(this).parent().parent().find('.fruit-name').text();
		var pricelist;
		jQuery.ajax({
			type: "POST",
			url: "index.php/homepage/getPrices",
			dataType: 'json',
			fruitdata: {id: fruitId},

			success: function(fruitdata) {

				var fruitdate = fruitdata[0];
				fruitdate = fruitdate.split('-');

				$('#highcharts').highcharts({
			        chart: {
			            type: 'area'
			        },
			        title: {
			            text: 'Fruit Price'
			        },
			        subtitle: {
			            text: fruitName + ' Price over the last days'
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
			            data: fruitdata.slice(1,fruitdata.length),//fruitdata array index 0 as date then the rest is fruit list
			            pointStart: Date.UTC(parseInt(fruitdate[0]), parseInt(fruitdate[1])-1, parseInt(fruitdate[2])),	// put current date here
		        		pointInterval: 24 * 3600 * 1000 // one day
			        }]
			    });
			},
			error: function(err) {
				console.log(err);
			}
		});

	});

	$(".btn-delete").on('click', function(event) {

		var fruitId = $(this).parent().parent().find('.fruit-id').text();

		jQuery.ajax({
			type: "POST",
			url: "index.php/homepage/delete",
			dataType: 'json',
			data: {id: fruitId},

			success: function(data) {
				window.location = window.location;
			},
			error: function(err) {
				console.log(err);
			}
		});

	});
});