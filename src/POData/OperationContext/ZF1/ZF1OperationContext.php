<?php

namespace POData\OperationContext\ZF1;

use POData\OperationContext\IHTTPRequest;
use POData\OperationContext\IOperationContext;
use POData\OperationContext\Web\OutgoingResponse;

class ZF1OperationContext implements IOperationContext
{

    /**
     * @var ZF1Request;
     */
    protected $request;

    protected $response;

    /**
     * @param \Zend_Controller_Request_Http $request
     */
    public function __construct(\Zend_Controller_Request_Http $request)
    {
        $this->request = new ZF1Request($request);
        $this->response = new OutgoingResponse();
    }

    /**
     * Gets the Web request context for the request being sent.
     *
     * @return OutgoingResponse reference of OutgoingResponse object
     */
    public function outgoingResponse()
    {
        return $this->response;
    }


    /**
     * Gets the Web request context for the request being received.
     *
     * @return IHTTPRequest reference of IncomingRequest object
     */
    public function incomingRequest()
    {
        return $this->request;
    }
}