function onSortableUpdate(event, ui) {
	$('#editForm tbody tr').each(function(currentTrackIndex) {
		updateSort(currentTrackIndex, this);
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

function updateSort(currentTrackIndex, currentRow) {
	var currentTrackOrder = currentTrackIndex + 1;
//	var newTrackOrderNumber = (jQuery.inArray(currentTrackOrder, newTrackOrder)) + 1;
	$(currentRow).find('td .setlist_order').html(' ' + currentTrackOrder);
	$(currentRow).find('input[id$="SetlistOrder"]').attr('value', currentTrackOrder);
}

function addTrackRow() {
	var numberRows = $('#editForm tbody tr').length;
	var newRowNumber = numberRows + 1;
	var newRowIndex = numberRows;
	var newRow = '<tr>' +
			'<input type="hidden" name="data[Track][' + newRowIndex + '][setlist_order]" value="' + newRowNumber + '" id="Track' + newRowIndex + 'SetlistOrder">' +
			'<td class="draggable"><i class="icon-resize-vertical"></i><label class="setlist_order"> ' + newRowNumber + '</label></td>' +
			'<td><input name="data[Track][' + newRowIndex + '][artist]" placeholder="Artist" type="text" id="Track' + newRowIndex + 'Artist"></td>' +
			'<td><input name="data[Track][' + newRowIndex + '][title]" placeholder="Title" type="text" id="Track' + newRowIndex + 'Title" required="required"></td>' +
			'<td><input name="data[Track][' + newRowIndex + '][label]" class="input-small" placeholder="Label" type="text" id="Track' + newRowIndex + 'Label"></td>' +
			'<td><input name="data[Track][' + newRowIndex + '][length]" class="input-mini" placeholder="00:00" type="text" id="Track' + newRowIndex + 'Length"></td>' +
			'<td><input name="data[Track][' + newRowIndex + '][bpm_start]" class="input-mini" placeholder="BPM" type="text" id="Track' + newRowIndex + 'BpmStart"></td>' +
			'<td><input name="data[Track][' + newRowIndex + '][key_start]" class="input-mini" placeholder="Key" type="text" id="Track' + newRowIndex + 'KeyStart"></td>' +
		'</tr>';
	$('#editForm tbody').append(newRow);
}

function removeTrackRow() {
	$('#editForm tbody tr:last').remove();
}

function sortableHelper(e, ui) {
	ui.children().each(function() {
        $(this).width($(this).width());
 //       console.debug($(this).width($(this).width()));
    });
    return ui;
}