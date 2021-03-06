<h1 class="page_title">
	<?php echo $title_for_layout; ?>
</h1>

<?php if (empty($past_locations)): ?>
	<p class="alert alert-info">
		No locations found for past events.
	</p>
<?php else: ?>
	<ul>
		<?php foreach ($past_locations as $past_location): ?>
			<li>
				<?php echo $this->Html->link($past_location, array(
					'controller' => 'events',
					'action' => 'location',
					$past_location,
					'past'
				)); ?>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
