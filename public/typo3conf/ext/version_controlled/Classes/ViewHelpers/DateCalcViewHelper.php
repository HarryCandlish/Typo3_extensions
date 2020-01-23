<?php
namespace Ocular\VersionControlled\ViewHelpers;
/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
class DateCalcViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {
    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('date', 'string', 'Date to compare', true);
        $this->registerArgument('date_2', 'string', 'Optional - Compare against this date (Instead of today)', false);
}

	/**
	 * Compare 2 timestamps, and return the difference in days, hours, and minutes.
	 * If no date_2 is given, today's date will be used to compare against
	 *
	 * @return string
	 */
	public function render() {
        // convert date_1 from a timestamp into a DateTime object
        $timestamp_1 = strtotime($this->arguments['date']);
        $dateLower = new \DateTime('@' . $timestamp);

        // set today's date as default time to compare against
        $dateNow = new \DateTime();

        // convert date_2 (if it exists) from a timestamp into a DateTime object
        $timestamp_2 = $this->arguments['date_2'];
        if (!empty($timestamp_2)){
            // date_2 exists
            $timestamp_2 = strtotime($this->arguments['date_2']);
            $dateNow = new \DateTime('@' . $timestamp_2);
        }

        // compare the 2 dates and return the difference
		$diff = $dateLower->diff($dateNow);
		return $diff->format("%a days %h hours %I minutes") . " ago";
	}
}
