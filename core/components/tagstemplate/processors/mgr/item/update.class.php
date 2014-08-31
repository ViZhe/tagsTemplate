<?php
/**
 * Update an Item
 */
class tagsTemplateItemUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'tagsTemplateItem';
	public $classKey = 'tagsTemplateItem';
	public $languageTopics = array('tagstemplate');
	public $permission = 'edit_document';
}

return 'tagsTemplateItemUpdateProcessor';
