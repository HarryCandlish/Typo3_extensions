<?php
namespace Product\Productview\Tests\Unit\Controller;

/**
 * Test case.
 */
class ProductControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Product\Productview\Controller\ProductController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Product\Productview\Controller\ProductController::class)
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
    public function listActionFetchesAllProductsFromRepositoryAndAssignsThemToView()
    {

        $allProducts = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $productRepository = $this->getMockBuilder(\Product\Productview\Domain\Repository\ProductRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $productRepository->expects(self::once())->method('findAll')->will(self::returnValue($allProducts));
        $this->inject($this->subject, 'productRepository', $productRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('products', $allProducts);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenProductToView()
    {
        $product = new \Product\Productview\Domain\Model\Product();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('product', $product);

        $this->subject->showAction($product);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenProductToProductRepository()
    {
        $product = new \Product\Productview\Domain\Model\Product();

        $productRepository = $this->getMockBuilder(\Product\Productview\Domain\Repository\ProductRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $productRepository->expects(self::once())->method('add')->with($product);
        $this->inject($this->subject, 'productRepository', $productRepository);

        $this->subject->createAction($product);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenProductToView()
    {
        $product = new \Product\Productview\Domain\Model\Product();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('product', $product);

        $this->subject->editAction($product);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenProductInProductRepository()
    {
        $product = new \Product\Productview\Domain\Model\Product();

        $productRepository = $this->getMockBuilder(\Product\Productview\Domain\Repository\ProductRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $productRepository->expects(self::once())->method('update')->with($product);
        $this->inject($this->subject, 'productRepository', $productRepository);

        $this->subject->updateAction($product);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenProductFromProductRepository()
    {
        $product = new \Product\Productview\Domain\Model\Product();

        $productRepository = $this->getMockBuilder(\Product\Productview\Domain\Repository\ProductRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $productRepository->expects(self::once())->method('remove')->with($product);
        $this->inject($this->subject, 'productRepository', $productRepository);

        $this->subject->deleteAction($product);
    }
}
