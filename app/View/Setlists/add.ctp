<h1>Add Setlist</h1>
<?php
	echo $this->Form->create('Setlist', array(
		'inputDefaults' => array(
			'label' => false,
			'type' => 'string'
			)
		));
	echo $this->Form->input('name', array('label' => "Setlist name"));
	echo $this->Form->input('author', array('label' => "Author"));
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
	for ($i = 0; $i < 15; $i++):
?>
	<tr>
		<td><?php echo $this->Form->input('Track.' . $i . '.setlist_order', array('size' => '3', 'readonly' => true, 'default' => $i + 1)); ?></td>
		<td><?php echo $this->Form->input('Track.' . $i . '.artist'); ?></td>
		<td><?php echo $this->Form->input('Track.' . $i . '.title'); ?></td>
		<td><?php echo $this->Form->input('Track.' . $i . '.label'); ?></td>
		<td><?php echo $this->Form->input('Track.' . $i . '.length'); ?></td>
		<td><?php echo $this->Form->input('Track.' . $i . '.bpm_start'); ?></td>
		<td><?php echo $this->Form->input('Track.' . $i . '.key_start'); ?></td>
	</tr>
<?php
	endfor;
?>
</table>
<?php
	echo $this->Form->end('Save Setlist');
?>