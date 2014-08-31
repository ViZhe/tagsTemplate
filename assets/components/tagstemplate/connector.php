<?php

require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$corePath = $modx->getOption('tagstemplate_core_path', null, $modx->getOption('core_path') . 'components/tagstemplate/');
require_once $corePath . 'model/tagstemplate/tagstemplate.class.php';
$modx->tagstemplate = new tagsTemplate($modx);

$modx->lexicon->load('tagstemplate:default');

/* handle request */
$path = $modx->getOption('processorsPath', $modx->tagstemplate->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));