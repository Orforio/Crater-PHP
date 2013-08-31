<div class="row">
	<div class="col-md-12">
		<h2>Setlists</h2>
		<p class="lead">These are all the setlists currently stored in Crater. This view won't be available in the final version.</p>
		<p><?php echo $this->Html->link('Add Setlist', array(
			'controller' => 'setlists',
			'action' => 'add'), array(
			'class' => 'btn btn-success')); ?></p>
		<table class="table table-striped table-bordered">
			<tr>
				<th>Name</th>
				<th>Author</th>
				<th>Modified</th>
			</tr>
			<?php foreach ($setlists as $setlist): ?>
			<tr>
				<td><?php echo $this->Html->link($setlist['Setlist']['name'], array(
					'action' => 'view', $setlist['Setlist']['urlhash'])); ?>
				</td>
				<td><?php echo h($setlist['Setlist']['author']); ?></td>
				<td><?php echo h($setlist['Setlist']['modified']); ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>