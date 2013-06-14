<h1>Edit Setlist</h1>
<?php
    echo $this->Form->create('Setlist');
    echo $this->Form->input('name', array('type' => 'string'));
    echo $this->Form->input('author', array('type' => 'string'));
?>
<table>
	<tr>
		<th>#</th>
		<th>Artist</th>
		<th>Title</th>
		<th>Label</th>
		<th>Length</th>
		<th>BPM</th>
		<th>Key</th>
	</tr>
<?php
	$i = 0;
	foreach($tracks as $track):
?>
	<tr>
<?php
	echo $this->Form->input('Track.' . $i . '.id', array('type' => 'hidden'));
?>
		<td><?php echo $this->Form->input('Track.' . $i . '.setlist_order', array('type' => 'string', 'size' => 2)); ?></td>
		<td><?php echo $this->Form->input('Track.' . $i . '.artist', array('type' => 'string')); ?></td>
		<td><?php echo $this->Form->input('Track.' . $i . '.title', array('type' => 'string')); ?></td>
		<td><?php echo $this->Form->input('Track.' . $i . '.label', array('type' => 'string')); ?></td>
		<td><?php echo $this->Form->input('Track.' . $i . '.length', array('type' => 'string')); ?></td>
		<td><?php echo $this->Form->input('Track.' . $i . '.bpm_start', array('type' => 'string')); ?></td>
		<td><?php echo $this->Form->input('Track.' . $i . '.key_start', array('type' => 'string')); ?></td>
	</tr>
<?php
	$i++;
	endforeach;
?>
</table>
<?php
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Save Setlist');
?>