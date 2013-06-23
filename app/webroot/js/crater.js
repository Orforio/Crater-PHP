function onSortableUpdate(event, ui) {
	var newTrackOrder = $('#editForm tbody').sortable('toArray', {attribute: 'data-trackorder'});	// Array of new order
	console.debug(newTrackOrder);
	
	$('#editForm tbody tr').each(function(currentTrackIndex) {
		updateSort(currentTrackIndex, newTrackOrder, this);
	});
	
	
	
/*	for (var i = 0, currentTrackOrder = 1; i < newTrackOrder.length; i++, currentTrackOrder++) {
		console.debug(currentTrackOrder);
		
		updateSort(currentTrackOrder);	*/
		
//		console.debug($('#editForm tbody tr:nth-child(' + currentTrackOrder + ') td:nth-child(2) input').attr('value'));
/*		$('#editForm tbody tr:nth-child(' + newTrackOrder[i] + ') input:nth-child(2)').attr('value', newTrackOrderString);

		console.debug("Before: " + $('#editForm tbody tr:nth-child(' + newTrackOrder[i] + ')').data('trackorder')); */
		
//		$('#editForm tbody tr:nth-child(' + newTrackOrder[i] + ')').data('trackorder', currentTrackOrder);
		
//		console.debug("New array index " + i + ", corresponding to old number " + newTrackOrder[i] + " now has trackorder value of " + $('#editForm tbody tr:nth-child(' + newTrackOrder[i] + ')').data('trackorder'));
//	}
}

function updateSort(currentTrackIndex, newTrackOrder, currentRow) {
	var currentTrackOrder = currentTrackIndex + 1;
//	var newTrackOrderNumber = (jQuery.inArray(currentTrackOrder, newTrackOrder)) + 1;
	$(currentRow).find('td .setlist_order').html(' ' + currentTrackOrder);
	$(currentRow).find('input[id$="SetlistOrder"]').attr('value', currentTrackOrder);
}