<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource as BaseResource;

/**
 * Description of JsonResource
 */
class Json extends BaseResource
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

    protected $locale = self::LOCALE_EN;
    protected $status = self::STATUS_OK;
    protected $message = '';
    
    
    /**
     * Create a new resource instance.
     *
     * @param mixed $resource
     */
    public function __construct($resource = null)
    {
        if ($resource === null) {
            $resource = [];
        }
        
        if (! is_object($resource) || ! method_exists($resource, 'toArray')) {
            $resource = collect($resource);
        }
        
        return parent::__construct($resource);
    }
    
    /**
     * @return string The locale or app locale if not set
     */
    public function getLocale()
    {
        if (! $this->locale) {
            $this->locale = app()->getLocale();
        }
        
        return $this->locale;
    }
    
    /**
     * @param string $locale
     *
     * @return Json
     */
    public function setLocale(string $locale)
    {
        $this->locale = $locale;
        
        return $this;
    }
    
    /**
     * @param string $locale
     *
     * @return Json
     */
    public function withLocale($locale)
    {
        return $this->setLocale($locale);
    }
    
    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * @param string $status
     *
     * @return Json
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
        
        return $this;
    }
    
    /**
     * @param string $status
     *
     * @return Json
     */
    public function withStatus($status)
    {
        return $this->setStatus($status);
    }
    
    /**
     * @return bool
     */
    public function isStatusOk()
    {
        return self::STATUS_OK == $this->getStatus();
    }
    
    /**
     * @return bool
     */
    public function isStatusError()
    {
        return self::STATUS_ERROR == $this->getStatus();
    }
    
    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * @param string $message
     *
     * @return Json
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
        
        return $this;
    }
    
    /**
     * @param string $message
     *
     * @return Json
     */
    public function withMessage($message)
    {
        return $this->setMessage($message);
    }
    
    /**
     * @param string $errorMessage
     *
     * @return Json
     */
    public function withError($errorMessage)
    {
        $this->withStatus(self::STATUS_ERROR)
            ->withMessage($errorMessage);
        
        return $this;
    }
    
    /**
     * @param string $successMessage
     *
     * @return Json
     */
    public function withSuccess($successMessage)
    {
        $this->withStatus(self::STATUS_OK)
            ->withMessage($successMessage);
        
        return $this;
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function with($request)
    {
        return [
            'locale' => $this->getLocale(),
            'message' => $this->getMessage(),
            'status' => $this->getStatus(),
        ];
    }
    
    /**
     * Customize the response for a request.
     *
     * @param \Illuminate\Http\Request      $request
     * @param \Illuminate\Http\JsonResponse $response
     */
    public function withResponse($request, $response)
    {
        if (! $this->isStatusOk()) {
            //Set status code to 400 if error is occured
            $response->setStatusCode(400);
        }
    }
}
