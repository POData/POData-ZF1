<?php

namespace UnitTests\POData\OperationContext\ZF1;


use POData\OperationContext\IHTTPRequest;
use POData\OperationContext\IOperationContext;
use POData\OperationContext\Web\OutgoingResponse;
use POData\OperationContext\ZF1\ZF1OperationContext;
use Phockito;

class ZF1OperationContextTest extends \PHPUnit_Framework_TestCase
{
	/** @var  \Zend_Controller_Request_Http */
	protected $mockRequest;

	public function setUp()
	{
		Phockito::include_hamcrest();
		$this->mockRequest = Phockito::mock('Zend_Controller_Request_Http');
	}

	public function testConstructor(){
		$op = new ZF1OperationContext($this->mockRequest);

		$this->assertTrue($op instanceof IOperationContext);

	}


	public function testIncomingRequest(){
		$op = new ZF1OperationContext($this->mockRequest);

		$req = $op->incomingRequest();

		$this->assertTrue($req instanceof IHTTPRequest);


	}


	public function testOutgoingResponse(){
		$op = new ZF1OperationContext($this->mockRequest);

		$res = $op->outgoingResponse();

		$this->assertTrue($res instanceof OutgoingResponse);

	}
}