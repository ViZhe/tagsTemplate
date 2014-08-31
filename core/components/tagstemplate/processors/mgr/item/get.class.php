<?php
/**
 * Get an Item
 */
class tagsTemplateItemGetProcessor extends modObjectGetProcessor {
	public $objectType = 'tagsTemplateItem';
	public $classKey = 'tagsTemplateItem';
	public $languageTopics = array('tagstemplate:default');
}

return 'tagsTemplateItemGetProcessor';