<h2>Edit Setlist</h2>
<?php
    echo $this->Form->create('Setlist', array(
		'inputDefaults' => array(
			'label' => false,
			'type' => 'text',
			'div' => false,
			'error' => array(
				'attributes' => array(
					'class' => 'alert alert-error'))
			)
		));
	echo $this->Form->input('id', array('type' => 'hidden'));
?>
<table class="table table-bordered">
	<tr>
		<td><?php echo $this->Form->input('name', array('label' => 'Name')); ?></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->input('author', array('label' => 'Author')); ?></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->input('genre', array('label' => 'Genre')); ?></td>
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
	foreach($tracks as $i => $track):
?>
		<tr>
<?php
	echo $this->Form->input('Track.' . $i . '.id', array('type' => 'hidden'));
	echo $this->Form->input('Track.' . $i . '.setlist_order', array('type' => 'hidden'));
	$this->Form->unlockField('Track.' . $i . '.setlist_order');
?>
			<td class="draggable" style="white-space: nowrap;"><i class="icon-resize-vertical"></i><label class="setlist_order"> <?php echo h($track['Track']['setlist_order']); ?></label></td>
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
</div>
<?php
    $this->Js->get('#editForm tbody');
	$this->Js->sortable(array(
	    'distance' => 5,
	    'containment' => 'parent',
	    'handle' => '.draggable',
	    'axis' => 'y',
	    'cursor' => 'move',
	    'delay' => 150,
	    'revert' => true,
	    'items' => '> tr',
	    'helper' => 'clone',
	    'update' => 'onSortableUpdate(event, ui)'
	));
?>