function startSortable(table) {
	$(table).find('tbody').sortable({
		axis: "y",
		containment: "parent",
		cursor: "move",
		delay: 150,
		distance: 5,
		handle: ".draggable",
		helper: function(e, tr) {
			var $originals = tr.children();
			var $helper = tr.clone();
			$helper.children().each(function(index) {
				// Set helper cell sizes to match the original sizes
				$(this).width($originals.eq(index).width());
			});
			$helper.css({"background-color": "#cccccc"});	// TODO: Add this to site CSS instead
			return $helper;
		},
		forcePlaceholderSize: true,
	    start: function (event, ui) {
	        // Build a placeholder cell that spans all the cells in the row
	        var cellCount = 0;
	        $('td, th', ui.helper).each(function () {
	            // For each TD or TH try and get it's colspan attribute, and add that or 1 to the total
	            var colspan = 1;
	            var colspanAttr = $(this).attr('colspan');
	            if (colspanAttr > 1) {
	                colspan = colspanAttr;
	            }
	            cellCount += colspan;
	        });
	        // Add the placeholder UI - note that this is the item's content, so TD rather than TR
	        ui.placeholder.html('<td colspan="' + cellCount + '">&nbsp;</td>');
	    },
		items: "> tr",
		revert: true,
		update: function (event, ui) {
			onSortableUpdate(event, ui);
		}
	}).disableSelection();	
}

function onSortableUpdate(event, ui) {	// Runs every time an item in a sortable table is released in a new position
	$('#editForm').find('tbody > tr').each(function(currentTrackIndex) {
		updateSort(currentTrackIndex, this);
	});
}

function updateSort(currentTrackIndex, currentRow) {	// Goes through each row in order and updates its sort index
	var currentTrackOrder = currentTrackIndex + 1;
	$(currentRow).find('td > span > .setlist_order').html(' ' + currentTrackOrder);
	$(currentRow).find('input[id$="SetlistOrder"]').attr('value', currentTrackOrder);
}

function addTrackRow() {	// Add a new row to the end of the form
	var numberRows = $('#editForm').find('tbody > tr').length;
	var newRowNumber = numberRows + 1;
	var newRowIndex = numberRows;
	var newRow = '<tr>' +
			'<input type="hidden" name="data[Track][' + newRowIndex + '][setlist_order]" value="' + newRowNumber + '" id="Track' + newRowIndex + 'SetlistOrder">' +
			'<td class="draggable"><span class="glyphicon glyphicon-sort"><label class="setlist_order"> ' + newRowNumber + '</label></span></td>' +
			'<td><input name="data[Track][' + newRowIndex + '][artist]" placeholder="Artist" type="text" id="Track' + newRowIndex + 'Artist"></td>' +
			'<td><input name="data[Track][' + newRowIndex + '][title]" placeholder="Title" type="text" id="Track' + newRowIndex + 'Title" required="required"></td>' +
			'<td><input name="data[Track][' + newRowIndex + '][label]" class="input-small" placeholder="Label" type="text" id="Track' + newRowIndex + 'Label"></td>' +
			'<td><input name="data[Track][' + newRowIndex + '][length]" class="input-mini" placeholder="00:00" type="text" id="Track' + newRowIndex + 'Length"></td>' +
			'<td><input name="data[Track][' + newRowIndex + '][bpm_start]" class="input-mini" placeholder="BPM" type="text" id="Track' + newRowIndex + 'BpmStart"></td>' +
			'<td><input name="data[Track][' + newRowIndex + '][key_start]" class="input-mini" placeholder="Key" type="text" id="Track' + newRowIndex + 'KeyStart"></td>' +
		'</tr>';
	$('#editForm').find('tbody').append(newRow);
}

function removeTrackRow() {	// TODO: Remove the current row instead of the last row
	$(this).closest('tr').remove();
	onSortableUpdate(null, null);
}

function sortableHelper(e, ui) {
	ui.children().each(function() {
        $(this).width($(this).width());
 //       console.debug($(this).width($(this).width()));
    });
    return ui;
}