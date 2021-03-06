<?php
namespace EditForm\Editform\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class EditFormTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \EditForm\Editform\Domain\Model\EditForm
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \EditForm\Editform\Domain\Model\EditForm();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );
    }
}
