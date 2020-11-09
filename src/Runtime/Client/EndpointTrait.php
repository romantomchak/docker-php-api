<?php

declare(strict_types=1);

namespace Docker\API\Runtime\Client;

use Docker\API\Runtime\Client\Exception\InvalidFetchModeException;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

trait EndpointTrait
{
    public function parseResponse(ResponseInterface $response, SerializerInterface $serializer, string $fetchMode = Client::FETCH_OBJECT)
    {
        if ($fetchMode === Client::FETCH_OBJECT) {
            $contentType = $response->hasHeader('Content-Type') ? current($response->getHeader('Content-Type')) : null;

            return $this->transformResponseBody((string) $response->getBody(), $response->getStatusCode(), $serializer, $contentType);
        }
        if ($fetchMode === Client::FETCH_RESPONSE) {
            return $response;
        }
        throw new InvalidFetchModeException(sprintf('Fetch mode %s is not supported', $fetchMode));
    }

    abstract protected function transformResponseBody(string $body, int $status, SerializerInterface $serializer, string $contentType);
}
