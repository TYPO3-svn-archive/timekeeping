<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_timekeeping_domain_model_requiredhours'] = array(
	'ctrl' => $TCA['tx_timekeeping_domain_model_requiredhours']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hours, cleaning_hours',
	),
	'types' => array(
		'1' => array('showitem' => 'hours, cleaning_hours'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'hours' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_requiredhours.hours',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2,required'
			),
		),
		'cleaning_hours' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_requiredhours.cleaning_hours',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2,required'
			),
		),
	),
);
?>