<?php
namespace EditForm\Editform\Tests\Unit\Controller;

/**
 * Test case.
 */
class EditFormControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \EditForm\Editform\Controller\EditFormController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\EditForm\Editform\Controller\EditFormController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllEditFormsFromRepositoryAndAssignsThemToView()
    {

        $allEditForms = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $editFormRepository = $this->getMockBuilder(\EditForm\Editform\Domain\Repository\EditFormRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $editFormRepository->expects(self::once())->method('findAll')->will(self::returnValue($allEditForms));
        $this->inject($this->subject, 'editFormRepository', $editFormRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('editForms', $allEditForms);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenEditFormToView()
    {
        $editForm = new \EditForm\Editform\Domain\Model\EditForm();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('editForm', $editForm);

        $this->subject->showAction($editForm);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenEditFormToEditFormRepository()
    {
        $editForm = new \EditForm\Editform\Domain\Model\EditForm();

        $editFormRepository = $this->getMockBuilder(\EditForm\Editform\Domain\Repository\EditFormRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $editFormRepository->expects(self::once())->method('add')->with($editForm);
        $this->inject($this->subject, 'editFormRepository', $editFormRepository);

        $this->subject->createAction($editForm);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenEditFormToView()
    {
        $editForm = new \EditForm\Editform\Domain\Model\EditForm();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('editForm', $editForm);

        $this->subject->editAction($editForm);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenEditFormInEditFormRepository()
    {
        $editForm = new \EditForm\Editform\Domain\Model\EditForm();

        $editFormRepository = $this->getMockBuilder(\EditForm\Editform\Domain\Repository\EditFormRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $editFormRepository->expects(self::once())->method('update')->with($editForm);
        $this->inject($this->subject, 'editFormRepository', $editFormRepository);

        $this->subject->updateAction($editForm);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenEditFormFromEditFormRepository()
    {
        $editForm = new \EditForm\Editform\Domain\Model\EditForm();

        $editFormRepository = $this->getMockBuilder(\EditForm\Editform\Domain\Repository\EditFormRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $editFormRepository->expects(self::once())->method('remove')->with($editForm);
        $this->inject($this->subject, 'editFormRepository', $editFormRepository);

        $this->subject->deleteAction($editForm);
    }
}
