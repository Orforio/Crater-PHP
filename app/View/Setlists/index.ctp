<h1>Setlists</h1>
<?php echo $this->Html->link('Add Setlist', array(
	'controller' => 'setlists',
	'action' => 'add'), array(
	'class' => 'btn btn-success')); ?>
<table class="table table-striped table-bordered">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Action</th> 
		<th>Modified</th>
	</tr>
	<?php foreach ($setlists as $setlist): ?>
	<tr>
		<td><?php echo $setlist['Setlist']['id']; ?></td>
		<td><?php echo $this->Html->link($setlist['Setlist']['name'], array(
			'action' => 'view',
			$setlist['Setlist']['urlhash'])); ?>
		</td>
		<td><?php echo $this->Html->link('Edit', array(
				'action' => 'edit',
				$setlist['Setlist']['urlhash']), array(
				'class' => 'btn btn-primary')); ?>
		</td>
		<td><?php echo $setlist['Setlist']['modified']; ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($setlist); ?>
</table>