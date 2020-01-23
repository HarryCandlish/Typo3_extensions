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
class InArrayViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {

    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('needle', 'string|object', 'String or Object to be found in the array', true);
        $this->registerArgument('haystack', 'array|object', 'Array to search through', true);
    }

    /**
     * returns true if $needle is contained in $haystack array
     *
     * @return boolean
     */
    public function render() {
        $needle = $this->arguments['needle'];
        $haystack = $this->arguments['haystack'];

        //check what type $haystack is
        if ( is_object($haystack) ){
            //$haystack is an object
            foreach($haystack as $item){
                if ($item == $needle) return true;
            }
            return false;
        }
        //$haystack is an array
        return in_array($needle, $haystack);
    }

}
