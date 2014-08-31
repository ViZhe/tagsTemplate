<?php
/**
 * Update an Item
 */
class modExtraItemUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'modExtraItem';
	public $classKey = 'modExtraItem';
	public $languageTopics = array('modextra');
	public $permission = 'edit_document';
}

return 'modExtraItemUpdateProcessor';
