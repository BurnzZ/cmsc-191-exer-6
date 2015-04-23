$(document).ready( function() {

	$('.btn-edit').on('click', function() {

		// gets the id of the fruit
		var id = $(this).parent().parent().attr('id');

		alert("clicked edit on id=" + id);
	});


	$('.btn-delete').on('click', function() {

		// gets the id of the fruit
		var id = $(this).parent().parent().attr('id')

		alert("clicked edit on id=" + id);
	});
});