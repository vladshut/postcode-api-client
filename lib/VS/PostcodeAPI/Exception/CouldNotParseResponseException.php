<?php

namespace VS\PostcodeAPI\Exception;

use Psr\Http\Message\ResponseInterface;

final class CouldNotParseResponseException extends \Exception implements PostcodeApiExceptionInterface
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @param string $message
     * @param ResponseInterface $response
     */
    public function __construct($message, ResponseInterface $response)
    {
        parent::__construct($message);

        $this->response = $response;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }
}
