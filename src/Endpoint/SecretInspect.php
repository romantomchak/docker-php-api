<?php

declare(strict_types=1);

namespace Docker\API\Endpoint;

class SecretInspect extends \Docker\API\Runtime\Client\BaseEndpoint implements \Docker\API\Runtime\Client\Endpoint
{
    use \Docker\API\Runtime\Client\EndpointTrait;

    protected $id;

    /**
     *
     *
     * @param string $id ID of the secret
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{id}'], [$this->id], '/secrets/{id}');
    }

    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Docker\API\Exception\SecretInspectNotFoundException
     * @throws \Docker\API\Exception\SecretInspectInternalServerErrorException
     * @throws \Docker\API\Exception\SecretInspectServiceUnavailableException
     *
     * @return null|\Docker\API\Model\Secret
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (200 === $status) {
            return $serializer->deserialize($body, 'Docker\\API\\Model\\Secret', 'json');
        }
        if (404 === $status) {
            throw new \Docker\API\Exception\SecretInspectNotFoundException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
        if (500 === $status) {
            throw new \Docker\API\Exception\SecretInspectInternalServerErrorException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
        if (503 === $status) {
            throw new \Docker\API\Exception\SecretInspectServiceUnavailableException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
    }
}
