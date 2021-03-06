<?php
/**
 * CakeEngine
 *
 * Renders Decoda templates using CakePHP's View engine.
 *
 * @copyright	Copyright 2006-2012, Miles Johnson - http://milesj.me
 * @license		http://opensource.org/licenses/mit-license.php - Licensed under the MIT License
 * @link		http://milesj.me/code/cakephp/decoda
 */

App::uses('View', 'View');

//use mjohnson\decoda\Decoda;
//use mjohnson\decoda\engines\EngineAbstract;
use ..\..\..\Vendor\Decoda\Decoda;
use ..\..\..\Vendor\Decoda\engines\EngineAbstract;

class CakeEngine extends EngineAbstract {

	/**
	 * CakePHP View engine.
	 *
	 * @access protected
	 * @var View
	 */
	protected $_view;

	/**
	 * Initialize View and helpers.
	 *
	 * @access public
	 * @param array $helpers
	 */
	public function __construct(array $helpers) {
		$view = new View();
		$view->helpers = $helpers;
		$view->layout = null;
		$view->autoLayout = false;
		$view->name = 'Decoda';
		$view->viewPath = 'Decoda';

		$this->_view = $view;
	}

	/**
	 * Renders the tag by using Cake views.
	 *
	 * @access public
	 * @param array $tag
	 * @param string $content
	 * @return string
	 * @throws \Exception
	 */
	public function render(array $tag, $content) {
		$setup = $this->getFilter()->tag($tag['tag']);

		$vars = $tag['attributes'];
		$vars['filter'] = $this->getFilter();
		$vars['content'] = $content;

		$this->_view->set($vars);

		// Try outside of the plugin first in-case they use their own templates
		try {
			$response = $this->_view->render($setup['template']);

		// Else fallback to the plugin templates
		} catch (Exception $e) {
			$this->_view->plugin = 'Decoda';

			$response = $this->_view->render($setup['template']);
		}

		$this->_view->hasRendered = false;
		$this->_view->plugin = null;

		return $response;
	}

}