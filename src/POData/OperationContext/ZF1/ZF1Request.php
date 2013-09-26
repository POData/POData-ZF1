<?php

namespace POData\OperationContext\ZF1;

use POData\Common\ODataConstants;
use POData\OperationContext\HTTPRequestMethod;
use POData\OperationContext\IHTTPRequest;

class ZF1Request implements IHTTPRequest
{

	/**
	 * @var \Zend_Controller_Request_Http
	 */
	protected $request;

	/**
	 * @var string
	 */
	protected $overriddenAccept;

	public function __construct(\Zend_Controller_Request_Http $zendRequest  )
	{
		$this->request = $zendRequest;
	}

	/**
	 * get the raw incoming url
	 *
	 * @return string RequestURI called by User with the value of QueryString
	 */
	public function getRawUrl()
	{
		return $this->request->getScheme() . "://" . $this->request->getHttpHost() . $this->request->getRequestUri();
	}

	/**
	 * get the specific request headers
	 *
	 * @param string $key The header name
	 *
	 * @return string|null value of the header, NULL if header is absent.
	 */
	public function getRequestHeader($key)
	{
		if($key === ODataConstants::HTTPREQUEST_HEADER_ACCEPT && !is_null($this->overriddenAccept)){
			//Some call was made to setRequestAccept
			return $this->overriddenAccept;
		}

		$result = $this->request->getHeader($key);
		//Zend returns false for a missing header...POData needs a null
		if($result === false) return null;

		return $result;

	}

	/**
	 * Split the QueryString and assigns them as array element in KEY=VALUE
	 *
	 * @return string[]
	 */
	public function getQueryParameters()
	{
		//TODO: the contract is more specific than this, it requires the name and values to be decoded
		//not sure how to test that...
		//TODO: another issue.  This may not be the right thing to return...since POData only really understands GET requests today
		return $this->request->getParams();
	}

	/**
	 * Get the HTTP method/verb of the HTTP Request
	 *
	 * @return HTTPRequestMethod
	 */
	public function getMethod()
	{
		return new HTTPRequestMethod($this->request->getMethod());
	}

	/**
	 * To change the request accept type header in the request.
	 * Note: This method will be used only when client specified $format query option.
	 * Any subsequent call to getRequestHeader("HTTP_ACCEPT") must return the value set with this call
	 *
	 * @param string $mime The mime value.
	 *
	 * @return void
	 */
	public function setRequestAccept($mime)
	{
		$this->overriddenAccept = $mime;
	}
}