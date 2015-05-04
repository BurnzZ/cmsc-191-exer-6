$(document).ready( function() {

	$('#btn-add').on('click', function() {

		var form = '<form id="form-add" method="post" action="index.php/homepage/addFruits"> \
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
		
		var form = '<form id="form-edit" method="post" action="index.php/homepage/editFruits"> \
				<input type="hidden" id="edit-fruit-id" name="edit-fruit-id" value="'+id+'"> \
				<div class="field"> \
					<label for="edit-fruit-name">Fruit Name</label> \
					<input type="text" id="edit-fruit-name" name="edit-fruit-name" required> \
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
		$('#modal-edit #edit-fruit-quantity').val( $('#'+id+' .fruit-quantity').text() );
		$('#modal-edit #edit-fruit-distributor').val( $('#'+id+' .fruit-distributor').text() );
	});

	$('.btn-prices').on('click', function() {
		var id = $(this).parent().parent().attr('id');
		var fruitname = $(this).parent().parent().children('.fruit-name').text();
	
	
		$.ajax({
			type: "POST",
			url: "index.php/homepage/getPrices",
			dataType: 'json',
			data: {id: id},
			success: function(priceObj) {

				var prices = [];
				var date;

				keys = [];
				for(var p in priceObj)
					keys.push(p);

				// get start date at the end of the list
				// coz they're decrementing
				pStart = keys[keys.length-1];
				pStart = pStart.split('-');

				// creates dateObj for pointStart in Highcharts
				// 2nd arg has -1 since months in javascript starts in 0
				date = Date.UTC(parseInt(pStart[0]), parseInt(pStart[1])-1, parseInt(pStart[2]));

				// form the prices in ascending order
				// loop is descending since prices are inverted
				for (var i = keys.length-1; i >= 0; i--)
					prices.push(parseInt(priceObj[keys[i]]));


				$('#highcharts').highcharts({
			        chart: {
			            type: 'area'
			        },
			        title: {
			            text: 'Fruit Price'
			        },
			        subtitle: {
			            text: fruitname + ' Price over the last days'
			        },
			        xAxis: {
			            type: 'date',
			            tickInterval: 24 * 3600 * 1000,
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
			            pointFormat: '{point.y}'
			        },
			        plotOptions: {
			            area: {
			        		pointStart: date,	// put current date here
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
			            name: fruitname,
			            data: prices,
			        	pointInterval: 24 * 3600 * 1000, // one day
			        }]
			    });
			}
		});		
	});



	$('.btn-delete').on('click', function() {

		// gets the id of the fruit
		var id = $(this).parent().parent().attr('id')
		window.document.location = "index.php/homepage/deleteFruits/"+id;
	});
});