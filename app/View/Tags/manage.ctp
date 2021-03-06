<h1 class="page_title">
	<?php echo $title_for_layout; ?>
</h1>

<div id="tag_management_tabs" class="clearfix">
	<ul>
		<li><a href="#tab-arrange">Arrange</a></li>
		<li><a href="#tab-add">Add</a></li>
		<li><a href="#tab-remove">Remove</a></li>
		<li><a href="#tab-edit">Edit</a></li>
		<li><a href="#tab-merge">Merge</a></li>
		<li><a href="#tab-find">Find</a></li>
		<li><a href="#tab-fix">Fix</a></li>
	</ul>
	<div id="tab-arrange">
		<div id="tree-div" style="height: 400px; overflow: auto;"></div>
		<ul>
			<li>
				Tags that cannot be selected (selectable = false) are in <span style="color: blue;">blue</span>.
			</li>
			<li>
				Tags with no associated events are in <span style="color: red;">red</span>.
			</li>
			<li>
				Do not move or edit the 'Delete' and 'Unlisted' groups. You may, however, move tags into and out of them.
			</li>
			<li>
				The 'Unlisted' group is where new tags created by users automatically go.
				<br />Tags moved into or out of this group will automatically have their 'listed' field set appropriately.
				<br />Any tags (inside or outside of this group) with listed = false will not be presented as options when adding/editing events.
			</li>
			<li>
				PROTIP: Move a tag by clicking to the right of it and dragging
				it to the right of another tag, rather than clicking on its name and
				dragging it on top of another tag's name. For some reason, this
				is the only way to do it when root-level tags are involved.
			</li>
		</ul>
	</div>

	<div id="tab-add">
		<?php echo $this->Form->create('Tag', array('url' => array('controller' => 'tags', 'action' => 'add'))); ?>
		<strong>Tag</strong>(s)<br />
		Multiple tags go on separate lines. Child-tags can be indented under parent-tags with one hyphen or tab per level. Example:
	<pre style="background-color: #eee; font-size: 80%; margin-left: 20px; width: 200px;">Fruits
-Apples
--Granny Smith
--Red Delicious
-Nanners
Vegetables
-Taters</pre>
		<?php echo $this->Form->input('name', array('type' => 'textarea', 'label' => false, 'style' => 'width: 100%;', 'class' => 'form-control')); ?>
		<?php echo $this->Form->input('parent_name', array('label' => 'Parent Tag (optional)', 'type' => 'text', 'class' => 'search_field form-control form-control')); ?>
		<p>
			All tags will be created as both listed and selectable.
		</p>
		<?php echo $this->Form->submit('Add', ['class' => 'btn']); ?>
        <?php echo $this->Form->end(); ?>

		<div id="add_results"></div>
	</div>

	<div id="tab-remove">
		<p class="alert alert-info">
			Warning: If a tag is removed, all child-tags will also be removed. This cannot be undone.
		</p>
		<?php echo $this->Html->link('Remove all tags in the "Delete" group', array(
            'controller' => 'tags', 'action' => 'empty_delete_group'
        )); ?>
		<p>
			Or start typing a tag name:
		</p>
		<form id="tag_remove_form">
			<input type="text" id="tag_remove_field" class="search_field form-control form-control" />
			<input type="submit" value="Remove" class="btn" />
		</form>
		<div class="results"></div>
	</div>

	<div id="tab-edit">
		<p>
			Start typing a tag name:
		</p>
		<div>
			<form id="tag_edit_search_form">
				<input type="text" class="search_field form-control" />
				<br />
				<input type="submit" value="Edit this tag" class="btn" />
			</form>
		</div>
		<div class="results" id="edit_results"></div>
	</div>

	<div id="tab-merge">
		<p>
			Start typing tag names:
		</p>
		<form id="tag_merge_form">
			Merge
			<input type="text" id="tag_merge_from_field" class="search_field form-control"/>
			into
			<input type="text" id="tag_merge_into_field" class="search_field form-control"/>

			<span class="footnote">(The first tag will be <strong>removed</strong>.)</span>
			<br />
			<input type="submit" value="Merge" class="btn" />
		</form>
		<div class="results" id="merge_results"></div>
	</div>

	<div id="tab-find">
		<p>
			Start typing a tag name:
		</p>
		<div>
			<form id="tag_search_form">
				<input type="text" class="search_field form-control" />
				<br />
				<input type="submit" value="Trace path to this tag" class="btn" />
			</form>
		</div>
		<div class="results" id="trace_results"></div>
	</div>

	<div id="tab-fix">
		<p>
			These functions are safe to use at any time, and should be used to fix relevant problems
			that come up. But these were initially only set up to assist in the transition from
			The Muncie Scene's tag system to the new system.
		</p>
		<ul>
			<li>
				<?php echo $this->Html->link('Regroup unlisted tags', array('controller' => 'tags', 'action' => 'group_unlisted')); ?>
				<br />Moves unlisted root-level tags into the 'Unlisted' group
			</li>
			<li>
				<?php echo $this->Html->link('Recover tag tree', array('controller' => 'tags', 'action' => 'recover')); ?>
				<br />If the tree structure in the database (lft and rght fields) has gotten screwed up
			</li>
			<li>
				<?php echo $this->Html->link('Remove unlisted, unused, root-level, childless tags', array('controller' => 'tags', 'action' => 'remove_unlisted_unused')); ?>
				<br />These are probably just taking up space.
			</li>
			<li>
				<?php echo $this->Html->link('Remove duplicate tags', array('controller' => 'tags', 'action' => 'duplicates')); ?>
				<br />And merge associations into the retained tags
			</li>
			<li>
				<?php echo $this->Html->link('Remove broken associations', array('controller' => 'tags', 'action' => 'remove_broken_associations')); ?>
				<br />Associations in the events_tags table involving either nonexistent tags or events.
			</li>
		</ul>
		<div class="results"></div>
	</div>
</div>

<h2>Notes:</h2>
<ul>
	<li>
		Working with any tag that has a slash (/) in its name (and possibly other punctuation) may cause errors.
		This is because the <a href="http://httpd.apache.org/docs/2.2/mod/core.html#allowencodedslashes">AllowEncodedSlashes directive</a> in Apache creates a 404 error when an
		encoded slash (%2F) is in a URL, e.g. when the name of such a tag is included in a URL by
		an AJAX request.
	</li>
</ul>

<?php echo $this->Html->css('/ext-2.0.1/resources/css/ext-custom.css', null, array('inline' => false)); ?>
<?php echo $this->Html->script('/ext-2.0.1/ext-custom.js', array('inline' => false)); ?>
<?php echo $this->Html->script('jquery.form.js', array('inline' => false)); ?>
<?php echo $this->Html->script('admin.js', array('inline' => false)); ?>
<?php $this->Js->buffer("setupTagManager();"); ?>
