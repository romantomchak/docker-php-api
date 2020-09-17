<?php

declare(strict_types=1);

namespace Docker\API\Endpoint;

class ServiceCreate extends \Docker\API\Runtime\Client\BaseEndpoint implements \Docker\API\Runtime\Client\Endpoint
{
    use \Docker\API\Runtime\Client\EndpointTrait;

    /**
     *
     *
     * @param \Docker\API\Model\ServicesCreatePostBody $body
     * @param array $headerParameters {
     *     @var string $X-Registry-Auth A base64url-encoded auth configuration for pulling from private
     * registries.
     *
     * Refer to the [authentication section](#section/Authentication) for
     * details.
     *
     * }
     */
    public function __construct(\Docker\API\Model\ServicesCreatePostBody $body, array $headerParameters = [])
    {
        $this->body = $body;
        $this->headerParameters = $headerParameters;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/services/create';
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

    protected function getHeadersOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getHeadersOptionsResolver();
        $optionsResolver->setDefined(['X-Registry-Auth']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->setAllowedTypes('X-Registry-Auth', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Docker\API\Exception\ServiceCreateBadRequestException
     * @throws \Docker\API\Exception\ServiceCreateForbiddenException
     * @throws \Docker\API\Exception\ServiceCreateConflictException
     * @throws \Docker\API\Exception\ServiceCreateInternalServerErrorException
     * @throws \Docker\API\Exception\ServiceCreateServiceUnavailableException
     *
     * @return null|\Docker\API\Model\ServicesCreatePostResponse201
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (201 === $status) {
            return $serializer->deserialize($body, 'Docker\\API\\Model\\ServicesCreatePostResponse201', 'json');
        }
        if (400 === $status) {
            throw new \Docker\API\Exception\ServiceCreateBadRequestException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
        if (403 === $status) {
            throw new \Docker\API\Exception\ServiceCreateForbiddenException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
        if (409 === $status) {
            throw new \Docker\API\Exception\ServiceCreateConflictException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
        if (500 === $status) {
            throw new \Docker\API\Exception\ServiceCreateInternalServerErrorException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
        if (503 === $status) {
            throw new \Docker\API\Exception\ServiceCreateServiceUnavailableException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
    }
}
