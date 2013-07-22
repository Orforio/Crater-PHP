<h2><?php echo h($setlist['Setlist']['name']); ?></h2>

<table class="table table-bordered">
	<tr>
		<td><strong>Author</strong>: <?php echo h($setlist['Setlist']['author']); ?></td>
	</tr>
	<tr>
		<td><strong>Genre</strong>: <?php echo h($setlist['Setlist']['genre']); ?></td>
	</tr>
	<tr>
		<td><strong>Modified</strong>: <?php echo $this->Time->niceShort($setlist['Setlist']['modified']); ?></td>
	</tr>
</table>

<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th>#</th>
			<th>Artist - Title</th>
			<th>Label</th>
			<th>Length</th>
			<th>BPM</th>
			<th>Key Code</th>
			<th>Key</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($tracks as $track): ?>
		<tr>
			<td><?php echo h($track['Track']['setlist_order']); ?></td>
			<td><?php echo h($track['Track']['artist']) . " - " . h($track['Track']['title']); ?></td>
			<td><?php echo h($track['Track']['label']); ?></td>
			<td><?php echo h($track['Track']['length']); ?></td>
			<td><?php echo h($track['Track']['bpm_start']); ?></td>
			<td><?php echo h($track['Track']['key_start']); ?></td>
			<td><?php echo h($track['Track']['key_notation_start']); ?></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>