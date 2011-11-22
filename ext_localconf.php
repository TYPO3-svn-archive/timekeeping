<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Pi1',
	array(
		'Family' => 'index,show,new,create,delete,edit,update',
		'Timeunit' => 'index,new,create,delete,edit,update',
	),
	// non-cacheable actions
	array(
		'Family' => 'index,show,new,create,delete,edit,update',
		'Timeunit' => 'index,new,create,delete,edit,update',
	)
);

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Pi2',
	array(
		'User' => 'index',
		'Timeunit' => 'new,create,edit,delete,update',
	),
	// non-cacheable actions
	array(
		'User' => 'index',
		'Timeunit' => 'new,create,edit,delete,update',
	)
);
?>