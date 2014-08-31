<?php

$settings = array();

$tmp = array(
	'useCookie' => array(
		'xtype' => 'combo-boolean',
		'value' => true,
	),
	'nameCookie' => array(
		'xtype' => 'textfield',
		'value' => 'ttTemplate',
	),
	'normalTag' => array(
		'xtype' => 'textfield',
		'value' => 'normal',
	),
	'mobileTag' => array(
		'xtype' => 'textfield',
		'value' => 'mobile',
	),
	'blindTag' => array(
		'xtype' => 'textfield',
		'value' => 'blind',
	),
	'variable' => array(
		'xtype' => 'textfield',
		'value' => 'theme',
	),
	'value_detect' => array(
		'xtype' => 'textfield',
		'value' => 'detect',
	),
	'value_normal' => array(
		'xtype' => 'textfield',
		'value' => 'normal',
	),
	'value_mobile' => array(
		'xtype' => 'textfield',
		'value' => 'mobile',
	),
	'value_blind' => array(
		'xtype' => 'textfield',
		'value' => 'blind',
	),
	'ipad' => array(
		'xtype' => 'combo-boolean',
		'value' => true,
	),
	'iphone' => array(
		'xtype' => 'combo-boolean',
		'value' => true,
	),
	'otherMobile' => array(
		'xtype' => 'combo-boolean',
		'value' => true,
	),
);

foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => PKG_NAME_LOWER.'_'.$k,
			'namespace' => PKG_NAME_LOWER,
			'area' => 'tagstemplate_main',
		), $v
	),'',true,true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
