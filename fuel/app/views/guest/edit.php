<h2>Editing <span class='muted'>Guest</span></h2>
<br>

<?php echo render('guest/_form'); ?>
<p>
	<?php echo Html::anchor('guest/view/'.$guest->id, 'View'); ?> |
	<?php echo Html::anchor('guest', 'Back'); ?></p>
