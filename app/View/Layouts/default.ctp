<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

// $cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Crater: <?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'));
		echo $this->Html->css(array('bootstrap'), null, array('media' => 'screen'));
		echo $this->Html->script(array('jquery', 'jquery-ui', 'bootstrap', 'crater'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Crater</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li<?php if($this->params['controller'] == 'pages' && $this->params['pass'][0] == 'home') { echo ' class="active"'; } ?>><a href="/">Home</a></li>
					<li<?php if($this->params['controller'] == 'setlists' && $this->action == 'index') { echo ' class="active"'; } ?>><a href="/setlists">Setlists</a></li>
					<li<?php if($this->params['controller'] == 'setlists' && $this->action == 'add') { echo ' class="active"'; } ?>><a href="/setlists/add">Add</a></li>
					<?php if($this->params['controller'] == 'setlists' && $this->action == 'view'): ?>
					<li class="active"><?php echo $this->Html->link('View', array('controller' => 'setlists', 'action' => 'view', $this->params['pass'][0])); ?></li>
					<?php elseif($this->params['controller'] == 'setlists' && $this->action == 'edit'): ?>
					<li><?php echo $this->Html->link('View', array('controller' => 'setlists', 'action' => 'view', $this->params['pass'][0])); ?></li>
					<?php else: ?>
					<li class="navbar-text">View</li>
					<?php endif; ?>
					<?php if($this->params['controller'] == 'setlists' && $this->action == 'edit'): ?>
					<li class="active"><?php echo $this->Html->link('Edit', array('controller' => 'setlists', 'action' => 'edit', $this->params['pass'][0], $this->params['pass'][1])); ?></li>
					<?php else: ?>
					<li class="navbar-text">Edit</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
    
	<div class="jumbotron">
		<div class="container">
			<h1>Crater<small>alpha</small></h1>
			<p>Find a bug? Want a new feature? Please <a href="https://github.com/PkerUNO/Crater/issues">let me know on GitHub</a>. <strong>Please note</strong> that Crater is a work-in-progress and data may be modified or removed at any time.</p>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php echo $this->Session->flash(); ?>
			</div>
		</div>
		<?php echo $this->fetch('content'); ?>
		<footer>
			<p>&copy; <a href="http://www.sblorgh.org">Richard Whittaker</a> | Version "Andromeda"</p>
		</footer>
	</div>
	<?php //echo $this->element('sql_dump'); 
		echo $this->Js->writeBuffer();
	?>
</body>
</html>
