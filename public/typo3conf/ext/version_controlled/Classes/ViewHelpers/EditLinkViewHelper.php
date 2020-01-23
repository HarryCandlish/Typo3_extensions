<?php
namespace Ocular\VersionControlled\ViewHelpers;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;
class EditLinkViewHelper extends AbstractTagBasedViewHelper
{
    /** @var string */
    protected $tagName = 'a';
    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerUniversalTagAttributes();
        $this->registerArgument('name', 'string', 'Specifies the name of an anchor');
        $this->registerTagAttribute('target', 'string', 'Specifies where to open the linked document');
        $this->registerArgument('parameters', 'string', 'Query string parameters');
        $this->registerArgument('module', 'string', 'module to return to');
        $this->registerArgument('moduleParams', 'array', 'params to add to the module');
        $this->registerArgument('confirm', 'string', 'Confirm message');
    }
    /**
     * Crafts a TYPO3 backend link to edit a database record or create a new one, for use in a backend module
     *
     * @return string The <a> tag
     * @see \TYPO3\CMS\Backend\Utility::editOnClick()
     */
    public function render()
    {
        $parameters = $this->arguments['parameters'];
        $module = $this->arguments['module'];
        $moduleParams = $this->arguments['moduleParams'];
        $confirm = $this->arguments['confirm'];
        $uri = BackendUtility::getModuleUrl('record_edit') . $parameters;
        if ($module != '') {
            $returnUrl = BackendUtility::getModuleUrl($module, $moduleParams);
            $uri .= '&returnUrl=' . rawurlencode($returnUrl);
        }
        if (!empty($confirm)) {
            $this->tag->addAttribute('onclick', "return confirm('$confirm');");
        }
        $this->tag->addAttribute('href', $uri);
        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(true);
        return $this->tag->render();
    }
}
