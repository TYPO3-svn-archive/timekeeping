<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Alexander Grein <ag@mediaessenz.eu>, MEDIA::ESSENZ
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/


/**
 *
 *
 * @package timekeeping
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */


class Tx_Timekeeping_ViewHelpers_JsToFooterFileViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {



	/**
	 * renders a special title for the page
	 *
	 * @param mixed $file Custom JavaScript file to be loaded
	 * @return void
	 */
	public function render($file = NULL) {

	    if ($file === NULL) {
	        $file = $this->renderChildren();
	    }
	    // Makes no sense to use the DPI here
	    //$pageRenderer = t3lib_div::makeInstance('t3lib_PageRenderer');
		$pageRenderer = $GLOBALS['TSFE']->getPageRenderer();
		// it is a singleton, so we get always the same instance
	    /* @var $pageRenderer t3lib_PageRenderer */
	    //$pageRenderer->addJsFooterFile($file);
		/*
	    if ($file !== NULL) {
		    if(is_array($file)) {
			    foreach($file as $singleFile) {
				    $pageRenderer->addJsFooterFile($singleFile);
			    }
		    } else {
			    $pageRenderer->addJsFile($file, 'text/javascript', FALSE);
				t3lib_div::devlog($file, 'timekeeping', 0, $pageRenderer);
		    }
	    }
		*/

	    if ($this->controllerContext->getRequest()->isCached()) {
	        // Makes no sense to use the DPI
	        $pageRenderer = t3lib_div::makeInstance('t3lib_PageRenderer');
	        /* @var $pageRenderer t3lib_PageRenderer */
	        $pageRenderer->addJsFooterFile($file);
	    } else {
	        $data = '<script src="' .$file. '" type="text/javascript"></script>';
	        $mvcWebResponse = $this->controllerContext->getResponse();
	        /* @var $mvcWebResponse Tx_Extbase_MVC_Web_Response */
	        $mvcWebResponse->addAdditionalHeaderData($data);
	    }

	}
}
?>