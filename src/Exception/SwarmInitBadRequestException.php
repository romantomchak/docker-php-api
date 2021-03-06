<?php

declare(strict_types=1);

namespace Docker\API\Exception;

class SwarmInitBadRequestException extends \RuntimeException implements ClientException
{
    private $errorResponse;

    public function __construct(\Docker\API\Model\ErrorResponse $errorResponse)
    {
        parent::__construct('bad parameter', 400);
        $this->errorResponse = $errorResponse;
    }

    public function getErrorResponse()
    {
        return $this->errorResponse;
    }
}
