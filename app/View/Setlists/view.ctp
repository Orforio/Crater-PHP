<h1><?php echo h($setlist['Setlist']['name']); ?></h1>

<p>Author: <?php echo h($setlist['Setlist']['author']); ?></p>

<p>Modified: <?php echo $this->Time->niceShort($setlist['Setlist']['modified']); ?></p>

<table>
	<tr>
		<th>#</th>
		<th>Artist - Title</th>
		<th>Label</th>
		<th>Length</th>
		<th>BPM</th>
		<th>Key</th>
		<th>Key Code</th>
	</tr>
<?php foreach ($tracks as $track): ?>
	<tr>
		<td><?php echo h($track['Track']['setlist_order']); ?></td>
		<td><?php echo h($track['Track']['artist']) . " - " . h($track['Track']['title']); ?></td>
		<td><?php echo h($track['Track']['label']); ?></td>
		<td><?php if ($track['Track']['length']) { echo $this->Time->format('i:s', $track['Track']['length']); } ?></td>
		<td><?php echo h($track['Track']['bpm_start']); ?></td>
		<td><?php echo h($track['Track']['key_start']); ?></td>
		<td><?php echo h($track['Track']['key_code_start']); ?></td>
	</tr>
<?php endforeach; ?>
</table>