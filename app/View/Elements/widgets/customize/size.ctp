<h3>
	<a href="#">Size</a>
</h3>
<div>
	<label for="WidgetHeight">
		Height:
	</label>
	<input id="WidgetHeight" value="<?php echo $defaults['iframe_options']['height']; ?>px" name="height" type="text" class="style" />

	<br />
	
	<label for="WidgetWidth">
		Width:
	</label>
	<input id="WidgetWidth" value="<?php echo $defaults['iframe_options']['width']; ?>px" name="width" type="text" class="style" />
	<p class="note">
		Sizes can be in pixels (e.g. 300px) or percentages (e.g. 100%).
	</p>
</div>