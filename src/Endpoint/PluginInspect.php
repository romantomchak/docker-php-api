<?php

declare(strict_types=1);

namespace Docker\API\Endpoint;

class PluginInspect extends \Docker\API\Runtime\Client\BaseEndpoint implements \Docker\API\Runtime\Client\Endpoint
{
    use \Docker\API\Runtime\Client\EndpointTrait;

    protected $name;

    /**
     *
     *
     * @param string $name The name of the plugin. The `:latest` tag is optional, and is the
     * default if omitted.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{name}'], [$this->name], '/plugins/{name}/json');
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
     * @throws \Docker\API\Exception\PluginInspectNotFoundException
     * @throws \Docker\API\Exception\PluginInspectInternalServerErrorException
     *
     * @return null|\Docker\API\Model\Plugin
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (200 === $status) {
            return $serializer->deserialize($body, 'Docker\\API\\Model\\Plugin', 'json');
        }
        if (404 === $status) {
            throw new \Docker\API\Exception\PluginInspectNotFoundException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
        if (500 === $status) {
            throw new \Docker\API\Exception\PluginInspectInternalServerErrorException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
    }
}
