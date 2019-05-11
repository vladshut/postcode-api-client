<?php

namespace VS\PostcodeAPI\Exception;

use Psr\Http\Message\RequestInterface;

class ServerErrorException extends \Exception implements PostcodeApiExceptionInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @param RequestInterface $request
     * @return ServerErrorException
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param RequestInterface $request
     * @return ServerErrorException
     */
    public static function fromRequest(RequestInterface $request)
    {
        $self = new self();
        $self->setRequest($request);

        return $self;
    }
}
