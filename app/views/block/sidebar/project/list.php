<div class="btn-group-vertical">
<?php foreach ($clients as $client): ?>
	<div class="btn-group">
		<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
			<span class="badge">3</span>
			<?php echo $client->client;  ?>
		</button>
		<ul class="dropdown-menu">
			<?php foreach($client->projects as $project): ?>
			<li><a href="#"><?php echo $project ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endforeach; ?>
</div>