<?php

/**
 * Class tagsTemplateMainController
 */
abstract class tagsTemplateMainController extends modExtraManagerController {
	/** @var tagsTemplate $tagsTemplate */
	public $tagsTemplate;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('tagstemplate_core_path', null, $this->modx->getOption('core_path') . 'components/tagstemplate/');
		require_once $corePath . 'model/tagstemplate/tagstemplate.class.php';

		$this->tagsTemplate = new tagsTemplate($this->modx);

		$this->addCss($this->tagsTemplate->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->tagsTemplate->config['jsUrl'] . 'mgr/tagstemplate.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			tagsTemplate.config = ' . $this->modx->toJSON($this->tagsTemplate->config) . ';
			tagsTemplate.config.connector_url = "' . $this->tagsTemplate->config['connectorUrl'] . '";
		});
		</script>');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('tagstemplate:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends tagsTemplateMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}