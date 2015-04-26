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