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
	<tr>
		<td><strong>Master BPM</strong>: <?php echo h($setlist['Setlist']['master_bpm']); ?></td>
	</tr>
	<tr>
		<td><strong>URL Hash (replaces ID)</strong>: <?php echo h($setlist['Setlist']['urlhash']); ?></td>
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
			<th>Mod. Key</th>
			<th>Key N.</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($setlist['Track'] as $track): ?>
		<tr>
			<td><?php echo h($track['setlist_order']); ?></td>
			<td><?php echo h($track['artist']) . " - " . h($track['title']); ?></td>
			<td><?php echo h($track['label']); ?></td>
			<td><?php echo h($track['length']); ?></td>
			<td><?php echo h($track['bpm_start']);
				if ($setlist['Setlist']['master_bpm'] && $track['bpm_difference']) {
					echo $this->Track->displayBPM($track['bpm_difference']);
				} ?></td>
			<td><?php echo h($track['key_start']); ?></td>
			<td><?php if ($setlist['Setlist']['master_bpm'] && $track['key_start_modified']) {
					echo h($track['key_start_modified']);
			} ?></td>
			<td><?php echo h($track['key_notation_start']); ?></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>