<?php

declare(strict_types=1);

namespace Docker\API\Endpoint;

class PluginUpgrade extends \Docker\API\Runtime\Client\BaseEndpoint implements \Docker\API\Runtime\Client\Endpoint
{
    use \Docker\API\Runtime\Client\EndpointTrait;

    protected $name;

    /**
     *
     *
     * @param string $name The name of the plugin. The `:latest` tag is optional, and is the
     * default if omitted.
     *
     * @param array $body
     * @param array $queryParameters {
     *     @var string $remote Remote reference to upgrade to.
     *
     * The `:latest` tag is optional, and is used as the default if omitted.
     *
     * }
     * @param array $headerParameters {
     *     @var string $X-Registry-Auth A base64url-encoded auth configuration to use when pulling a plugin
     * from a registry.
     *
     * Refer to the [authentication section](#section/Authentication) for
     * details.
     *
     * }
     */
    public function __construct(string $name, array $body, array $queryParameters = [], array $headerParameters = [])
    {
        $this->name = $name;
        $this->body = $body;
        $this->queryParameters = $queryParameters;
        $this->headerParameters = $headerParameters;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return str_replace(['{name}'], [$this->name], '/plugins/{name}/upgrade');
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

    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['remote']);
        $optionsResolver->setRequired(['remote']);
        $optionsResolver->setDefaults([]);
        $optionsResolver->setAllowedTypes('remote', ['string']);

        return $optionsResolver;
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
     * @throws \Docker\API\Exception\PluginUpgradeNotFoundException
     * @throws \Docker\API\Exception\PluginUpgradeInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (204 === $status) {
            return null;
        }
        if (404 === $status) {
            throw new \Docker\API\Exception\PluginUpgradeNotFoundException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
        if (500 === $status) {
            throw new \Docker\API\Exception\PluginUpgradeInternalServerErrorException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
    }
}
