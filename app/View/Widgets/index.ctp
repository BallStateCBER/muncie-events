<h1 class="page_title">
	<?php echo $title_for_layout; ?>
</h1>
<p>
	Have a website? Support your community by adding a Muncie Events widget to it
	and keeping your visitors informed about local events.
</p>

<p>
	Click on
	<?php echo $this->Html->link('Event Feed Widget', array(
		'action' => 'customize',
		'feed'
	)); ?>
	or
	<?php echo $this->Html->link('Monthly Calendar Widget', array(
		'action' => 'customize',
		'month'
	)); ?>
	to see customization options and get the code to embed into your website. 
</p>

<p class="footnote">
	Note: If you are using a content management system, it must allow you to use
	<a href="http://en.wikipedia.org/wiki/Iframe#Frames">iframes</a>. Have a CMS
	that is incompatible with iframes? <a href="/contact">Let us know</a> and we'll develop a plugin for
	you.
</p>

<div id="widgets_overview">
	<div>
		<h2>
			<?php echo $this->Html->link('Event Feed Widget', array(
				'action' => 'customize',
				'feed'
			)); ?>
		</h2>
		<iframe style="width:300px;height:400px;border:1px solid #000000;" src="<?php echo Router::url(array('action' => 'feed'), true); ?>"></iframe>
	</div><div>
		<h2>
			<?php echo $this->Html->link('Monthly Calendar Widget', array(
				'action' => 'customize',
				'month'
			)); ?>
		</h2>
		<iframe style="width:600px;height:400px;border:1px solid #000000;" src="<?php echo Router::url(array('action' => 'month'), true); ?>"></iframe>
	</div>
</div>

<br class="clear" />