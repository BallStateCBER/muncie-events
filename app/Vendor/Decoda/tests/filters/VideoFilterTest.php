<?php
/**
 * @author      Miles Johnson - http://milesj.me
 * @copyright   Copyright 2006-2012, Miles Johnson, Inc.
 * @license     http://opensource.org/licenses/mit-license.php - Licensed under The MIT License
 * @link        http://milesj.me/code/php/decoda
 */

namespace mjohnson\decoda\tests\filters;

use mjohnson\decoda\filters\VideoFilter;
use mjohnson\decoda\tests\TestCase;

class VideoFilterTest extends TestCase {

	/**
	 * Set up Decoda.
	 */
	protected function setUp() {
		parent::setUp();

		$this->object->addFilter(new VideoFilter());
	}

	/**
	 * Test that [video] renders embedded video players.
	 */
	public function testVideo() {
		// iframe
		$this->assertEquals('<iframe src="http://youtube.com/embed/c0dE" width="640" height="360" frameborder="0"></iframe>', $this->object->reset('[video="youtube"]c0dE[/video]')->parse());
		$this->assertEquals('<iframe src="http://youtube.com/embed/c0dE" width="853" height="480" frameborder="0"></iframe>', $this->object->reset('[video="youtube" size="large"]c0dE[/video]')->parse());

		// embed
		$this->assertEquals('<iframe src="http://liveleak.com/e/c0dE" width="640" height="360" frameborder="0"></iframe>', $this->object->reset('[video="liveleak"]c0dE[/video]')->parse());
		$this->assertEquals('<iframe src="http://liveleak.com/e/c0dE" width="853" height="480" frameborder="0"></iframe>', $this->object->reset('[video="liveleak" size="large"]c0dE[/video]')->parse());

		// invalid
		$this->assertEquals('(Invalid video)', $this->object->reset('[video="youtube"]fake..w123c0code[/video]')->parse());
		$this->assertEquals('(Invalid someVideoService video code)', $this->object->reset('[video="someVideoService"]c0dE[/video]')->parse());
	}

	/**
	 * Test that vendor specific video tags work.
	 */
	public function testVideoSpecificTags() {
		$this->assertEquals('<iframe src="http://youtube.com/embed/c0dE" width="640" height="360" frameborder="0"></iframe>', $this->object->reset('[youtube]c0dE[/youtube]')->parse());
		$this->assertEquals('<iframe src="http://player.vimeo.com/video/c0dE" width="700" height="394" frameborder="0"></iframe>', $this->object->reset('[vimeo size="large"]c0dE[/vimeo]')->parse());
		$this->assertEquals('<iframe src="http://liveleak.com/e/c0dE" width="560" height="315" frameborder="0"></iframe>', $this->object->reset('[liveleak size="small"]c0dE[/liveleak]')->parse());
		$this->assertEquals('<embed src="http://veoh.com/swf/webplayer/WebPlayer.swf?version=AFrontend.5.7.0.1390&amp;permalinkId=c0dE&amp;player=videodetailsembedded&amp;videoAutoPlay=0&amp;id=anonymous" width="610" height="507" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true"></embed>', $this->object->reset('[veoh size="medium"]c0dE[/veoh]')->parse());
		$this->assertEquals('<iframe src="http://dailymotion.com/embed/video/c0dE" width="480" height="270" frameborder="0"></iframe>', $this->object->reset('[dailymotion]c0dE[/dailymotion]')->parse());
		$this->assertEquals('<embed src="http://mediaservices.myspace.com/services/media/embed.aspx/m=c0dE,t=1,mt=video" width="525" height="420" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true"></embed>', $this->object->reset('[myspace size="large"]c0dE[/myspace]')->parse());
		$this->assertEquals('<embed src="http://wegame.com/static/flash/player.swf?xmlrequest=http://www.wegame.com/player/video/c0dE&amp;embedPlayer=true" width="480" height="330" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true"></embed>', $this->object->reset('[wegame size="medium"]c0dE[/wegame]')->parse());
		$this->assertEquals('<iframe src="http://collegehumor.com/e/c0dE" width="300" height="169" frameborder="0"></iframe>', $this->object->reset('[collegehumor size="small"]c0dE[/collegehumor]')->parse());
	}

}