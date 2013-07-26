<h2>Add Setlist</h2>
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
	<tr>
		<td><?php echo $this->Form->input('master_bpm', array('label' => 'Master BPM', 'class' => 'input-mini')); ?></td>
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
	for ($i = 0; $i < 15; $i++):
?>
		<tr>
<?php
		echo $this->Form->input('Track.' . $i . '.setlist_order', array('type' => 'hidden', 'value' => $i + 1));
?>
			<td class="draggable"><i class="icon-resize-vertical"></i><label class="setlist_order"> <?php echo $i + 1; ?></label></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.artist', array('placeholder' => 'Artist')); ?></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.title', array('placeholder' => 'Title')); ?></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.label', array('class' => 'input-small', 'placeholder' => 'Label')); ?></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.length', array('class' => 'input-mini', 'placeholder' => '00:00')); ?></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.bpm_start', array('class' => 'input-mini', 'placeholder' => 'BPM')); ?></td>
			<td><?php echo $this->Form->input('Track.' . $i . '.key_start', array('class' => 'input-mini', 'placeholder' => 'Key')); ?></td>
		</tr>
<?php
	endfor;
?>
	</tbody>
</table>
<div class="form-actions">
	<p><?php echo $this->Form->button('Add row', array('type' => 'button', 'id' => 'addRowButton', 'class' => 'btn btn-mini btn-success')) . "&nbsp;" . $this->Form->button('Remove row', array('type' => 'button', 'id' => 'removeRowButton', 'class' => 'btn btn-mini btn-danger')); ?></p>
<?php echo $this->Form->end(array(
	'label' => 'Add Setlist',
	'class' => 'btn btn-primary'
	));
?>
</div>
<?php
    $this->Js->get('#editForm tbody')->sortable(array(
	    'distance' => 5,
	    'containment' => 'parent',
	    'handle' => '.draggable',
	    'axis' => 'y',
	    'cursor' => 'move',
	    'delay' => 150,
	    'revert' => false,
	    'items' => '> tr',
	    'update' => 'onSortableUpdate(event, ui)',
	    'cursorAt' => array('top' => 20)
	));
	
	$this->Js->get('#addRowButton')->event('click', 'addTrackRow()');
	$this->Js->get('#removeRowButton')->event('click', 'removeTrackRow()');
?>