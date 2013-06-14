<h1>Setlists</h1>
<?php echo $this->Html->link(
    'Add Setlist',
    array('controller' => 'setlists', 'action' => 'add')); ?>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th> 
        <th>Modified</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($setlists as $setlist): ?>
    <tr>
        <td><?php echo $setlist['Setlist']['id']; ?></td>
        <td>
            <?php echo $this->Html->link(
            $setlist['Setlist']['name'],
			array('controller' => 'setlists', 'action' => 'view', $setlist['Setlist']['id'])); ?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $setlist['Setlist']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $setlist['Setlist']['id'])); ?>
        </td>
        <td><?php echo $setlist['Setlist']['modified']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($setlist); ?>
</table>