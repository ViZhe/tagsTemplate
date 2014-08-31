<?php
/**
 * Create an Item
 */
class tagsTemplateItemCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'tagsTemplateItem';
	public $classKey = 'tagsTemplateItem';
	public $languageTopics = array('tagstemplate');
	public $permission = 'new_document';


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$alreadyExists = $this->modx->getObject('tagsTemplateItem', array(
			'name' => $this->getProperty('name'),
		));
		if ($alreadyExists) {
			$this->modx->error->addField('name', $this->modx->lexicon('tagstemplate_item_err_ae'));
		}

		return !$this->hasErrors();
	}

}

return 'tagsTemplateItemCreateProcessor';