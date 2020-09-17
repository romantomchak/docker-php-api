<?php

declare(strict_types=1);

namespace Docker\API\Endpoint;

class NetworkConnect extends \Docker\API\Runtime\Client\BaseEndpoint implements \Docker\API\Runtime\Client\Endpoint
{
    use \Docker\API\Runtime\Client\EndpointTrait;

    protected $id;

    /**
     *
     *
     * @param string $id Network ID or name
     * @param \Docker\API\Model\NetworksIdConnectPostBody $container
     */
    public function __construct(string $id, \Docker\API\Model\NetworksIdConnectPostBody $container)
    {
        $this->id = $id;
        $this->body = $container;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return str_replace(['{id}'], [$this->id], '/networks/{id}/connect');
    }

    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return $this->getSerializedBody($serializer);
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
     * @throws \Docker\API\Exception\NetworkConnectForbiddenException
     * @throws \Docker\API\Exception\NetworkConnectNotFoundException
     * @throws \Docker\API\Exception\NetworkConnectInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (200 === $status) {
            return null;
        }
        if (403 === $status) {
            throw new \Docker\API\Exception\NetworkConnectForbiddenException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
        if (404 === $status) {
            throw new \Docker\API\Exception\NetworkConnectNotFoundException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
        if (500 === $status) {
            throw new \Docker\API\Exception\NetworkConnectInternalServerErrorException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
    }
}
