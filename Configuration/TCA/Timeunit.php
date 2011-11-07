<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_timekeeping_domain_model_timeunit'] = array(
	'ctrl' => $TCA['tx_timekeeping_domain_model_timeunit']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'date_of_work, description, duration, cleaning, assignment',
	),
	'types' => array(
		'1' => array('showitem' => 'date_of_work, description, duration, cleaning, assignment'),
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
		'date_of_work' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_timeunit.date_of_work',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'max' => 20,
				'eval' => 'date,required',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_timeunit.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim,required'
			),
		),
		'duration' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_timeunit.duration',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2,required'
			),
		),
		'cleaning' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_timeunit.cleaning',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		'assignment' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_timeunit.assignment',
			'config' => array(
				'type' => 'select',
				'foreign_class' => 'Tx_Timekeeping_Domain_Model_Assignment',
				'foreign_table' => 'tx_timekeeping_domain_model_assignment',
				'maxitems'      => 1,
			),
		),
	),
);
?>