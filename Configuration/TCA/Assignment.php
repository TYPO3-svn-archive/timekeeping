<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_timekeeping_domain_model_assignment'] = array(
	'ctrl' => $TCA['tx_timekeeping_domain_model_assignment']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'role, timeunits, family, user',
	),
	'types' => array(
		'1' => array('showitem' => 'role, timeunits, family, user'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		't3ver_label' => array(
			'displayCond' => 'FIELD:t3ver_label:REQ:true',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type'=>'none',
				'cols' => 27
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'role' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_assignment.role',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_timekeeping_domain_model_role',
				'minitems' => 1,
				'maxitems' => 1,
			),
		),
		'timeunits' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_assignment.timeunits',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_timekeeping_domain_model_timeunit',
				'foreign_field' => 'assignment',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom',
				),
			),
		),
		'family' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_assignment.family',
			'config' => array(
				'type' => 'select',
				'foreign_class' => 'Tx_Timekeeping_Domain_Model_Family',
				'foreign_table' => 'tx_Timekeeping_domain_model_family',
				'maxitems' => 1
			),
		),
		'user' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:timekeeping/Resources/Private/Language/locallang_db.xml:tx_timekeeping_domain_model_assignment.user',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'maxitems' => 1
			),
		)
	),
);
?>