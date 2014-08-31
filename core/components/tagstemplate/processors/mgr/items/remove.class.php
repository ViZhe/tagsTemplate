<?php
/**
 * Remove an Items
 */
class tagsTemplateItemsRemoveProcessor extends modProcessor {
    public $checkRemovePermission = true;
	public $objectType = 'tagsTemplateItem';
	public $classKey = 'tagsTemplateItem';
	public $languageTopics = array('tagstemplate');

	public function process() {

        foreach (explode(',',$this->getProperty('items')) as $id) {
            $item = $this->modx->getObject($this->classKey, $id);
            $item->remove();
        }
        
        return $this->success();

	}

}

return 'tagsTemplateItemsRemoveProcessor';