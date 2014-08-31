<?php
/**
 * The home manager controller for tagsTemplate.
 *
 */
class tagsTemplateHomeManagerController extends tagsTemplateMainController {
	/* @var tagsTemplate $tagsTemplate */
	public $tagsTemplate;


	/**
	 * @param array $scriptProperties
	 */
	public function process(array $scriptProperties = array()) {
	}


	/**
	 * @return null|string
	 */
	public function getPageTitle() {
		return $this->modx->lexicon('tagstemplate');
	}


	/**
	 * @return void
	 */
	public function loadCustomCssJs() {
		$this->addJavascript($this->tagsTemplate->config['jsUrl'] . 'mgr/widgets/items.grid.js');
		$this->addJavascript($this->tagsTemplate->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->tagsTemplate->config['jsUrl'] . 'mgr/sections/home.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "tagstemplate-page-home"});
		});
		</script>');
	}


	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->tagsTemplate->config['templatesPath'] . 'home.tpl';
	}
}