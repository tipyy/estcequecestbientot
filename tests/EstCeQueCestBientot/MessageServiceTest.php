<?php

use EstCeQueCestBientot\Service\MessageService;

class MessageServiceTest extends \PHPUnit_Framework_TestCase
{

 	protected $configurationServiceMock;
 	protected $messageService;

	public function setUp() {
    	parent::setUp();

        $this->configurationServiceMock = $this->getMockBuilder('EstCeQueCestBientot\Service\ConfigurationService')
				    ->disableOriginalConstructor()
				    ->setMethods(array('getMessages'))
				    ->getMock();

    	$this->messageService = new MessageService($this->configurationServiceMock);
  	}

	/**
	 * @cover MessageService::getMessageAt
	 * @expectedException EstCeQueCestBientot\Exception\MessageNotFoundException
	 */
    public function test_getMessageAt_emptyMessageList()
    {
    	$this->configurationServiceMock->expects($this->once())
					->method('getMessages')
    				->will($this->returnValue(array()));
    	$datetime = new \DateTime();

    	$this->messageService->getMessageAt($datetime);
    }

	/**
	 * @cover EstCeQueCestBientot\Service\MessageService::getMessageAt
	 * @expectedException EstCeQueCestBientot\Exception\MessageNotFoundException
	 */
    public function test_getMessageAt_messageNotFound()
    {
        $this->configurationServiceMock->expects($this->once())
					->method('getMessages')
    				->will($this->returnValue($this->getMessageList()));
		$datetime = \DateTime::createFromFormat('H:i', '6:00');

        $this->messageService->getMessageAt($datetime);
    }

    /**
	 * @cover EstCeQueCestBientot\Service\MessageService::getMessageAt
	 */
    public function test_getMessageAt_messageFound()
    {
    	$this->configurationServiceMock->expects($this->once())
					->method('getMessages')
    				->will($this->returnValue($this->getMessageList()));
		$datetime = \DateTime::createFromFormat('H:i', '11:00');

        $message = $this->messageService->getMessageAt($datetime);

        $this->assertEquals('Test2', $message->getMessage());
        $this->assertTrue($message->isItTime());

    }

	/**
	 * @return array
	 */
    private function getMessageList() {
    	return array(
    		array(
    			'message' => 'Test1',
    			'startTime' => '0:00',
    			'endTime' => '1:00'
    		),
    		array(
    			'message' => 'Test2',
    			'startTime' => '10:00',
    			'endTime' => '11:20',
    			'itsTime' => true
    		),
    		array(
    			'message' => 'Test3',
    			'startTime' => '15:00',
    			'endTime' => '19:00'
    		)
    	);
    }
}