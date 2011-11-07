<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_timekeeping_domain_model_family'] = array(
	'ctrl' => $TCA['tx_timekeeping_domain_model_family']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'name, start, end, assignments, required_hours, children',
	),
	'types' => array(
		'1' => array('showitem' => 'name, start, end, assignments, required_hours, children'),
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
		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_family.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'start' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_family.start',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'max' => 20,
				'eval' => 'date,required',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'end' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_family.end',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'max' => 20,
				'eval' => 'date,required',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'assignments' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_family.assignments',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_timekeeping_domain_model_assignment',
				'foreign_field' => 'family',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom'
				),
			),
		),
		'required_hours' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_family.required_hours',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_timekeeping_domain_model_requiredhours',
				'minitems' => 1,
				'maxitems' => 1,
			),
		),
		'children' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_family.children',
			'config'  => array(
				'type' => 'inline',
				'foreign_table' => 'tx_timekeeping_domain_model_family',
				'foreign_field' => 'family',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),
		'family' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_family',
			'config' => array(
				'type' => 'select',
				'foreign_class' => 'Tx_Timekeeping_Domain_Model_Family',
				'foreign_table' => 'tx_timekeeping_domain_model_family',
				'maxitems' => 1
			)
		),
	),
);
?>