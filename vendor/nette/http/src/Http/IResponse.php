<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

namespace Nette\Http;


/**
 * IHttpResponse interface.
 */
interface IResponse
{
	/** @var int cookie expiration: forever (23.1.2037) */
	const PERMANENT = 2116333333;

	/** @var int cookie expiration: until the browser is closed */
	const BROWSER = 0;

	/** HTTP 1.1 response code */
	const
		S100_CONTINUE = 100,
		S101_SWITCHING_PROTOCOLS = 101,
		S200_OK = 200,
		S201_CREATED = 201,
		S202_ACCEPTED = 202,
		S203_NON_AUTHORITATIVE_INFORMATION = 203,
		S204_NO_CONTENT = 204,
		S205_RESET_CONTENT = 205,
		S206_PARTIAL_CONTENT = 206,
		S300_MULTIPLE_CHOICES = 300,
		S301_MOVED_PERMANENTLY = 301,
		S302_FOUND = 302,
		S303_SEE_OTHER = 303,
		S303_POST_GET = 303,
		S304_NOT_MODIFIED = 304,
		S305_USE_PROXY = 305,
		S307_TEMPORARY_REDIRECT = 307,
		S400_BAD_REQUEST = 400,
		S401_UNAUTHORIZED = 401,
		S402_PAYMENT_REQUIRED = 402,
		S403_FORBIDDEN = 403,
		S404_NOT_FOUND = 404,
		S405_METHOD_NOT_ALLOWED = 405,
		S406_NOT_ACCEPTABLE = 406,
		S407_PROXY_AUTHENTICATION_REQUIRED = 407,
		S408_REQUEST_TIMEOUT = 408,
		S409_CONFLICT = 409,
		S410_GONE = 410,
		S411_LENGTH_REQUIRED = 411,
		S412_PRECONDITION_FAILED = 412,
		S413_REQUEST_ENTITY_TOO_LARGE = 413,
		S414_REQUEST_URI_TOO_LONG = 414,
		S415_UNSUPPORTED_MEDIA_TYPE = 415,
		S416_REQUESTED_RANGE_NOT_SATISFIABLE = 416,
		S417_EXPECTATION_FAILED = 417,
		S426_UPGRADE_REQUIRED = 426,
		S500_INTERNAL_SERVER_ERROR = 500,
		S501_NOT_IMPLEMENTED = 501,
		S502_BAD_GATEWAY = 502,
		S503_SERVICE_UNAVAILABLE = 503,
		S504_GATEWAY_TIMEOUT = 504,
		S505_HTTP_VERSION_NOT_SUPPORTED = 505;

	/**
	 * Sets HTTP response code.
	 * @param  int
	 * @return void
	 */
	function setCode($code);

	/**
	 * Returns HTTP response code.
	 * @return int
	 */
	function getCode();

	/**
	 * Sends a HTTP header and replaces a previous one.
	 * @param  string  header name
	 * @param  string  header value
	 * @return void
	 */
	function setHeader($name, $value);

	/**
	 * Adds HTTP header.
	 * @param  string  header name
	 * @param  string  header value
	 * @return void
	 */
	function addHeader($name, $value);

	/**
	 * Sends a Content-type HTTP header.
	 * @param  string  mime-type
	 * @param  string  charset
	 * @return void
	 */
	function setContentType($type, $charset = NULL);

	/**
	 * Redirects to a new URL.
	 * @param  string  URL
	 * @param  int     HTTP code
	 * @return void
	 */
	function redirect($url, $code = self::S302_FOUND);

	/**
	 * Sets the number of seconds before a page cached on a browser expires.
	 * @param  string|int|\DateTime  time, value 0 means "until the browser is closed"
	 * @return void
	 */
	function setExpiration($seconds);

	/**
	 * Checks if headers have been sent.
	 * @return bool
	 */
	function isSent();

	/**
	 * Returns value of an HTTP header.
	 * @param  string
	 * @param  mixed
	 * @return mixed
	 */
	function getHeader($header, $default = NULL);

	/**
	 * Returns a list of headers to sent.
	 * @return array (name => value)
	 */
	function getHeaders();

	/**
	 * Sends a cookie.
	 * @param  string name of the cookie
	 * @param  string value
	 * @param  mixed expiration as unix timestamp or number of seconds; Value 0 means "until the browser is closed"
	 * @param  string
	 * @param  string
	 * @param  bool
	 * @param  bool
	 * @return void
	 */
	function setCookie($name, $value, $expire, $path = NULL, $domain = NULL, $secure = NULL, $httpOnly = NULL);

	/**
	 * Deletes a cookie.
	 * @param  string name of the cookie.
	 * @param  string
	 * @param  string
	 * @param  bool
	 * @return void
	 */
	function deleteCookie($name, $path = NULL, $domain = NULL, $secure = NULL);

}
