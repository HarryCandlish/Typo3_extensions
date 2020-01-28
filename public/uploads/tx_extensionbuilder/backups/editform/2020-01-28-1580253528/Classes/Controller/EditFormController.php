<?php
namespace EditForm\Editform\Controller;


/***
 *
 * This file is part of the "Edit Form" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 
 *
 ***/
/**
 * EditFormController
 */
class EditFormController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * editFormRepository
     * 
     * @var \EditForm\Editform\Domain\Repository\EditFormRepository
     * @inject
     */
    protected $editFormRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $editForms = $this->editFormRepository->findAll();
        $this->view->assign('editForms', $editForms);
    }

    /**
     * action show
     * 
     * @param \EditForm\Editform\Domain\Model\EditForm $editForm
     * @return void
     */
    public function showAction(\EditForm\Editform\Domain\Model\EditForm $editForm)
    {
        $this->view->assign('editForm', $editForm);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param \EditForm\Editform\Domain\Model\EditForm $newEditForm
     * @return void
     */
    public function createAction(\EditForm\Editform\Domain\Model\EditForm $newEditForm)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->editFormRepository->add($newEditForm);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \EditForm\Editform\Domain\Model\EditForm $editForm
     * @ignorevalidation $editForm
     * @return void
     */
    public function editAction(\EditForm\Editform\Domain\Model\EditForm $editForm)
    {
        $this->view->assign('editForm', $editForm);
    }

    /**
     * action update
     * 
     * @param \EditForm\Editform\Domain\Model\EditForm $editForm
     * @return void
     */
    public function updateAction(\EditForm\Editform\Domain\Model\EditForm $editForm)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->editFormRepository->update($editForm);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \EditForm\Editform\Domain\Model\EditForm $editForm
     * @return void
     */
    public function deleteAction(\EditForm\Editform\Domain\Model\EditForm $editForm)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->editFormRepository->remove($editForm);
        $this->redirect('list');
    }

    /**
     * action
     * 
     * @return void
     */
    public function Action()
    {
    }
}
