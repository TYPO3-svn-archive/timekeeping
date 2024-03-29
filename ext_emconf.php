<?php

########################################################################
# Extension Manager/Repository config file for ext "timekeeping".
#
# Auto generated 01-12-2011 10:00
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Timekeeping',
	'description' => 'Extension to keep and manage working time.',
	'category' => 'plugin',
	'author' => 'Alexander Grein',
	'author_email' => 'ag@mediaessenz.eu',
	'author_company' => 'MEDIA::ESSENZ',
	'shy' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '1.0.0',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'extbase' => '',
			'fluid' => '',
			't3jquery' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:105:{s:21:"ExtensionBuilder.json";s:4:"88d7";s:12:"ext_icon.gif";s:4:"91e2";s:17:"ext_localconf.php";s:4:"cf96";s:14:"ext_tables.php";s:4:"5e98";s:14:"ext_tables.sql";s:4:"283c";s:12:"t3jquery.txt";s:4:"8791";s:41:"Classes/Controller/AbstractController.php";s:4:"0f6a";s:40:"Classes/Controller/BackendController.php";s:4:"1924";s:39:"Classes/Controller/FamilyController.php";s:4:"e180";s:41:"Classes/Controller/TimeunitController.php";s:4:"58d8";s:37:"Classes/Controller/UserController.php";s:4:"7df4";s:46:"Classes/Domain/Exception/AbstractException.php";s:4:"b8d6";s:52:"Classes/Domain/Exception/NoFamilyMemberException.php";s:4:"4853";s:45:"Classes/Domain/Exception/NoLoginException.php";s:4:"829c";s:35:"Classes/Domain/Model/Assignment.php";s:4:"36c6";s:31:"Classes/Domain/Model/Family.php";s:4:"e738";s:38:"Classes/Domain/Model/RequiredHours.php";s:4:"cb1d";s:29:"Classes/Domain/Model/Role.php";s:4:"3888";s:33:"Classes/Domain/Model/Timeunit.php";s:4:"fe0d";s:29:"Classes/Domain/Model/User.php";s:4:"db1d";s:50:"Classes/Domain/Repository/AssignmentRepository.php";s:4:"b7b2";s:46:"Classes/Domain/Repository/FamilyRepository.php";s:4:"fffd";s:53:"Classes/Domain/Repository/RequiredHoursRepository.php";s:4:"bebf";s:44:"Classes/Domain/Repository/RoleRepository.php";s:4:"e6fa";s:48:"Classes/Domain/Repository/TimeunitRepository.php";s:4:"7739";s:44:"Classes/Domain/Repository/UserRepository.php";s:4:"e11d";s:46:"Classes/Domain/Validator/TimeunitValidator.php";s:4:"2411";s:46:"Classes/ViewHelpers/CleaningWorkViewHelper.php";s:4:"1cc7";s:38:"Classes/ViewHelpers/IconViewHelper.php";s:4:"e6d3";s:48:"Classes/ViewHelpers/JsToFooterFileViewHelper.php";s:4:"10f2";s:44:"Classes/ViewHelpers/TimeFormatViewHelper.php";s:4:"c2da";s:47:"Classes/ViewHelpers/Form/UserRoleViewHelper.php";s:4:"6ab6";s:44:"Configuration/ExtensionBuilder/settings.yaml";s:4:"2427";s:32:"Configuration/TCA/Assignment.php";s:4:"637f";s:28:"Configuration/TCA/Family.php";s:4:"a610";s:35:"Configuration/TCA/RequiredHours.php";s:4:"9c1e";s:26:"Configuration/TCA/Role.php";s:4:"a651";s:30:"Configuration/TCA/Timeunit.php";s:4:"dcdd";s:38:"Configuration/TypoScript/constants.txt";s:4:"755d";s:34:"Configuration/TypoScript/setup.txt";s:4:"7548";s:40:"Resources/Private/Language/locallang.xml";s:4:"18e5";s:83:"Resources/Private/Language/locallang_csh_tx_timekeeping_domain_model_assignment.xml";s:4:"1307";s:79:"Resources/Private/Language/locallang_csh_tx_timekeeping_domain_model_family.xml";s:4:"0979";s:86:"Resources/Private/Language/locallang_csh_tx_timekeeping_domain_model_requiredhours.xml";s:4:"8a17";s:77:"Resources/Private/Language/locallang_csh_tx_timekeeping_domain_model_role.xml";s:4:"f687";s:81:"Resources/Private/Language/locallang_csh_tx_timekeeping_domain_model_timeunit.xml";s:4:"4faa";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"7de9";s:44:"Resources/Private/Language/locallang_mod.xml";s:4:"0ad6";s:35:"Resources/Private/Layouts/main.html";s:4:"dfa5";s:41:"Resources/Private/Partials/exception.html";s:4:"e8f9";s:46:"Resources/Private/Partials/exception_full.html";s:4:"533e";s:42:"Resources/Private/Partials/familyForm.html";s:4:"3e4e";s:42:"Resources/Private/Partials/familyList.html";s:4:"737d";s:42:"Resources/Private/Partials/formErrors.html";s:4:"cc71";s:44:"Resources/Private/Partials/timeunitForm.html";s:4:"3e6c";s:44:"Resources/Private/Partials/timeunitList.html";s:4:"a965";s:48:"Resources/Private/Partials/timeunitUserList.html";s:4:"c8fb";s:46:"Resources/Private/Templates/Backend/index.html";s:4:"45a7";s:46:"Resources/Private/Templates/Default/error.html";s:4:"40f5";s:44:"Resources/Private/Templates/Family/edit.html";s:4:"77ad";s:45:"Resources/Private/Templates/Family/index.html";s:4:"b72c";s:43:"Resources/Private/Templates/Family/new.html";s:4:"10fc";s:44:"Resources/Private/Templates/Family/show.html";s:4:"eb9a";s:46:"Resources/Private/Templates/Timeunit/edit.html";s:4:"9e4a";s:47:"Resources/Private/Templates/Timeunit/index.html";s:4:"53b9";s:45:"Resources/Private/Templates/Timeunit/new.html";s:4:"0110";s:43:"Resources/Private/Templates/User/index.html";s:4:"d2fd";s:31:"Resources/Public/Css/basics.css";s:4:"cecf";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:65:"Resources/Public/Icons/tx_timekeeping_domain_model_assignment.gif";s:4:"1103";s:61:"Resources/Public/Icons/tx_timekeeping_domain_model_family.gif";s:4:"905a";s:67:"Resources/Public/Icons/tx_timekeeping_domain_model_familymember.gif";s:4:"905a";s:68:"Resources/Public/Icons/tx_timekeeping_domain_model_requiredhours.gif";s:4:"4e5b";s:59:"Resources/Public/Icons/tx_timekeeping_domain_model_role.gif";s:4:"905a";s:63:"Resources/Public/Icons/tx_timekeeping_domain_model_timeunit.gif";s:4:"1103";s:41:"Resources/Public/Images/Sorting icons.psd";s:4:"9c28";s:41:"Resources/Public/Images/back_disabled.jpg";s:4:"723b";s:40:"Resources/Public/Images/back_enabled.jpg";s:4:"5d4c";s:35:"Resources/Public/Images/favicon.ico";s:4:"c30d";s:44:"Resources/Public/Images/forward_disabled.jpg";s:4:"3cc6";s:43:"Resources/Public/Images/forward_enabled.jpg";s:4:"abc0";s:36:"Resources/Public/Images/sort_asc.png";s:4:"8ff0";s:45:"Resources/Public/Images/sort_asc_disabled.png";s:4:"d863";s:37:"Resources/Public/Images/sort_both.png";s:4:"f34b";s:37:"Resources/Public/Images/sort_desc.png";s:4:"4919";s:46:"Resources/Public/Images/sort_desc_disabled.png";s:4:"9ebc";s:44:"Resources/Public/Js/jquery.dataTables.min.js";s:4:"6147";s:34:"Resources/Public/Js/timekeeping.js";s:4:"58c3";s:33:"Resources/Public/Less/basics.less";s:4:"86a7";s:36:"Resources/Public/Less/demo_page.less";s:4:"6cef";s:37:"Resources/Public/Less/demo_table.less";s:4:"cd02";s:41:"Resources/Public/Less/demo_table_jui.less";s:4:"dead";s:46:"Tests/Unit/Controller/FamilyControllerTest.php";s:4:"2d76";s:52:"Tests/Unit/Controller/FamilyMemberControllerTest.php";s:4:"d43c";s:53:"Tests/Unit/Controller/RequiredHoursControllerTest.php";s:4:"3d2a";s:44:"Tests/Unit/Controller/RoleControllerTest.php";s:4:"e9ea";s:48:"Tests/Unit/Controller/TimeunitControllerTest.php";s:4:"25e8";s:42:"Tests/Unit/Domain/Model/AssignmentTest.php";s:4:"913c";s:43:"Tests/Unit/Domain/Model/AssignmentsTest.php";s:4:"913c";s:44:"Tests/Unit/Domain/Model/FamilyMemberTest.php";s:4:"8591";s:38:"Tests/Unit/Domain/Model/FamilyTest.php";s:4:"8870";s:45:"Tests/Unit/Domain/Model/RequiredHoursTest.php";s:4:"36a8";s:36:"Tests/Unit/Domain/Model/RoleTest.php";s:4:"727f";s:40:"Tests/Unit/Domain/Model/TimeunitTest.php";s:4:"71de";s:14:"doc/manual.sxw";s:4:"8d2d";}',
);

?>