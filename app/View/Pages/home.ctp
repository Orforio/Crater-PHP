<div class="row">
	<div class="col-md-12">
		<h2>A simple setlist management tool for DJs</h2>
		<p>With this project my aim is to get to grips with PHP frameworks (namely CakePHP), front-end frameworks (Bootstrap), TDD and best design practices. While making a semi-useful application!</p>
		<p>The first public alpha of Crater (codename "Andromeda") lets users:</p>
		<ul>
			<li>input track information into a setlist</li>
			<li>rearrange tracks within the setlist</li>
			<li>add and remove tracks from an existing setlist</li>
			<li>add a master BPM to the setlist and have Crater automatically calculate individual track's new keys for harmonic mixing</li>
		</ul>
		<p>Features I'd like to add in the future:</p>
		<ul>
			<li>enable users to upload files directly and have Crater fill out data through the file's ID3 tags</li>
			<li>hook up to the Beatport API to automatically fetch key and BPM data</li>
			<li>suggest an optimal track order for harmonic mixing</li>
			<li>allow for BPM and key changes within individual tracks</li>
		</ul>
		<div class="alert alert-danger">
			<p class="lead">Warning</p>
			<p>This project is still in the early phases of development. The database schema might change, requiring data loss or security breaches may be found. Please don't input any information you want kept private during this alpha stage. Crater currently has no user registration and no personal data is stored. <strong>By using Crater alpha you understand that there is no guarantee any data you submit will be kept private and that data loss may occur without warning</strong>.</p>
		</div>
		<p><?php echo $this->Html->link('Get started!', array('controller' => 'setlists', 'action' => 'index'), array('class' => 'btn btn-success')); ?> <?php echo $this->Html->link('View project on GitHub', 'http://github.com/PkerUNO/Crater', array('class' => 'btn btn-primary')); ?></p>
	</div>
</div>