<div class="container">
	<ul>
	<?php foreach ($results as $row): ?>
		<ul>
		<?php foreach ($row as $entry): ?>
			<li> <?=$entry?> </li>
		<?php endforeach; ?>
		</ul> <br>
	<?php endforeach; ?>
	</ul>
	<p> <?=$pagination?> </p>

</div>