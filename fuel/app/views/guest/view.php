<h2>Viewing <span class='muted'>#<?php echo $guest->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?php echo $guest->name; ?></p>

<?php echo Html::anchor('guest/edit/'.$guest->id, 'Edit'); ?> |
<?php echo Html::anchor('guest', 'Back'); ?>