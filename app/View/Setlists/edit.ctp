<h2>Edit Setlist</h2>
<?php
    echo $this->Form->create('Setlist', array(
		'inputDefaults' => array(
			'label' => false,
			'type' => 'text',
			'div' => false,
			'error' => array(
				'attributes' => array(
					'class' => 'alert alert-danger'))
			)
		));
	echo $this->Form->input('Setlist.id', array('type' => 'hidden'));
?>
<div class="alert alert-info"><strong>Edit Key</strong>: In order to be able to edit this setlist in the future, please note down your Edit Key (<strong><?php echo h($setlist['Setlist']['private_key']); ?></strong>) or <strong><?php echo $this->Html->link('save this edit link', array('controller' => 'setlists', 'action' => 'edit', $setlist['Setlist']['urlhash'], $setlist['Setlist']['private_key']), array('class' => 'alert-link')); ?></strong></div>
<table class="table table-bordered">
	<tr>
		<td><?php echo $this->Form->input('Setlist.name', array('label' => 'Name')); ?></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->input('Setlist.author', array('label' => 'Author')); ?></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->input('Setlist.genre', array('label' => 'Genre')); ?></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->input('Setlist.master_bpm', array('label' => 'Master BPM', 'class' => 'input-mini', 'placeholder' => $setlist['Setlist']['suggested_bpm'])); ?></td>
	</tr>
</table>

<table class="table table-striped table-bordered table-condensed" id="editForm">
	<thead>
		<tr>
			<th>#</th>
			<th>Artist</th>
			<th>Title</th>
			<th>Label</th>
			<th>Length</th>
			<th>BPM</th>
			<th>Key</th>
		</tr>
	</thead>
	<tbody>
<?php
	foreach($setlist['Track'] as $i => $track):
?>
		<tr>
<?php
	echo $this->Form->input('Track.' . $i . '.id', array('type' => 'hidden'));
	echo $this->Form->input('Track.' . $i . '.setlist_order', array('type' => 'hidden'));
	$this->Form->unlockField('Track.' . $i . '.setlist_order');
?>
			<td class="draggable" style="white-space: nowrap;"><i class="icon-resize-vertical"></i><label class="setlist_order"> <?php echo h($track['setlist_order']); ?></label></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.artist'); ?></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.title'); ?></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.label', array('class' => 'input-small')); ?></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.length', array('class' => 'input-mini', 'placeholder' => '00:00')); ?></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.bpm_start', array('class' => 'input-mini')); ?></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.key_start', array('class' => 'input-mini')); ?></td>
		</tr>
<?php
	endforeach;
?>
	</tbody>
</table>
<div class="form-actions">
<?php echo $this->Form->end(array(
	'label' => 'Save Setlist',
	'class' => 'btn btn-primary'
	));
?>
<?php echo $this->Form->postLink('Delete', array(
		'action' => 'delete',
		$setlist['Setlist']['urlhash'],
		$setlist['Setlist']['private_key']
		), array(
		'confirm' => 'Are you sure?',
		'class' => 'btn btn-danger')); ?>
</div>
<?php
/*    $this->Js->get('#editForm tbody');
	$this->Js->sortable(array(
	    'distance' => 5,
	    'containment' => 'parent',
	    'handle' => '.draggable',
	    'axis' => 'y',
	    'cursor' => 'move',
	    'delay' => 150,
	    'revert' => true,
	    'items' => '> tr',
		'helper' => 'sortableHelper(e, tr)',
	    'update' => 'onSortableUpdate(event, ui)'
	)); */
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function () {
	$("#editForm tbody").sortable({
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
			return $helper;
		},
		forcePlaceholderSize: true,
		placeholder:'must-have-class',
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
});
//]]>
</script>