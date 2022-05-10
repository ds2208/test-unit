<?php

namespace App\Http\Resources;

interface ResponseBaseOpportunities
{
    const STATUS_OK = 200;
    const STATUS_CREATED = 201;
    const STATUS_ACCEPTED = 202;
    const STATUS_NO_CONTENT = 204;
    const STATUS_MOVED_PERMANENTLY = 301;
    const STATUS_NOT_MODIFIED = 304;
    const STATUS_TEMPORARY_REDIRECT = 307;
    const STATUS_PERMANENT_REDIRECT = 308;
    const STATUS_BAD_REQUEST = 400;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_PAGE_NOT_FOUND = 404;
    const STATUS_NOT_ALLOWED = 405;
    const STATUS_REQUEST_TIMEOUT = 408;
    const STATUS_VALIDATION_FAILD = 412;
    const STATUS_ERROR = 500;
    
    
    const LOCALE_EN = 'en';
    const LOCALE_rs = 'rs';

    /**
     * @return string The locale or app locale if not set
     */
    public abstract function getLocale();
    
    /**
     * @param string $locale
     *
     * @return Json
     */
    public abstract function setLocale(string $locale);
    
    /**
     * @param string $locale
     *
     * @return Json
     */
    public abstract function withLocale($locale);
    
    /**
     * @return string
     */
    public abstract function getStatus();
    
    /**
     * @param string $status
     *
     * @return Json
     */
    public abstract function setStatus(string $status);
    
    /**
     * @param string $status
     *
     * @return Json
     */
    public abstract function withStatus($status);

    /**
     * @return bool
     */
    public abstract function isStatusOk();
    
    /**
     * @return bool
     */
    public abstract function isStatusError();
    
    /**
     * @return string
     */
    public abstract function getMessage();
    
    /**
     * @param string $message
     *
     * @return Json
     */
    public abstract function setMessage(string $message);
    
    /**
     * @param string $message
     *
     * @return Json
     */
    public abstract function withMessage($message);
    
    /**
     * @param string $errorMessage
     *
     * @return Json
     */
    public abstract function withError($errorMessage);
    
    /**
     * @param string $successMessage
     *
     * @return Json
     */
    public abstract function withSuccess($successMessage);

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public abstract function with($request);
    
    /**
     * Customize the response for a request.
     *
     * @param \Illuminate\Http\Request      $request
     * @param \Illuminate\Http\JsonResponse $response
     */
    public abstract function withResponse($request, $response);
}
