<?php
/**
 * Remove an Item
 */
class tagsTemplateItemRemoveProcessor extends modObjectRemoveProcessor {
	public $checkRemovePermission = true;
	public $objectType = 'tagsTemplateItem';
	public $classKey = 'tagsTemplateItem';
	public $languageTopics = array('tagstemplate');

}

return 'tagsTemplateItemRemoveProcessor';