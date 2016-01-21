<?php
namespace ingoreuter\CssPage\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013-2014 Ingo Reuter <mail@ingoreuter>
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
 * @package css_page
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class CssController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * pagesRepository
	 *
	 * @var \ingoreuter\CssPage\Domain\Repository\PagesRepository
	 * @inject
	 */
	protected $PagesRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
				
		/** @var \TYPO3\CMS\Extbase\Service\FlexFormService */
		$flexForm = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\CMS\Extbase\Service\FlexFormService");
		
		$cssFlexform = $this->PagesRepository->findAll();
		$cssValues = $flexForm->convertFlexFormContentToArray($cssFlexform->getCssContent());
		
		$theCssString = "body { \n";		
		foreach($cssValues['body'] as $property => $value) {
			if(!empty($value)) {
				if($property == "background-image") {
					$theCssString.= "\t" . $property . ": url(http://" . \TYPO3\CMS\Core\Utility\GeneralUtility::getHostname() . "/uploads/tx_csspage/backgroundimages/" . $value . ");  \n";
				}
				else {
					$theCssString.= "\t" . $property . ": " . $value . ";  \n";
				}
			}
		}
		if(!empty($cssValues['other']['body'])) {
			$theCssString.= $cssValues['other']['body'] . "\n";
		}
		$theCssString.= "}\n";
		if(!empty($cssValues['other']['page'])) {
			$theCssString.= $cssValues['other']['page'] . "\n";
		}
		
		$this->view	->assign('cssContent', $theCssString);
	}
}
?>