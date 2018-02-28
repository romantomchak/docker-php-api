<?php

declare(strict_types=1);

/*
 * This file has been auto generated by Jane,
 *
 * Do no edit it directly.
 */

namespace Docker\API\Endpoint;

class ImageBuild extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\AmpArtaxEndpoint, \Jane\OpenApiRuntime\Client\Psr7HttplugEndpoint
{
    /**
     * Build an image from a tar archive with a `Dockerfile` in it.

    The `Dockerfile` specifies how the image is built from the tar archive. It is typically in the archive's root, but can be at a different path or have a different name by specifying the `dockerfile` parameter. [See the `Dockerfile` reference for more information](https://docs.docker.com/engine/reference/builder/).

    The Docker daemon performs a preliminary validation of the `Dockerfile` before starting the build, and returns an error if the syntax is incorrect. After that, each instruction is run one-by-one until the ID of the new image is output.

    The build is canceled if the client drops the connection by quitting or being killed.

     *
     * @param string|resource|\Psr\Http\Message\StreamInterface $inputStream     a tar archive compressed with one of the following algorithms: identity (no compression), gzip, bzip2, xz
     * @param array                                             $queryParameters {
     *
     *     @var string $dockerfile Path within the build context to the `Dockerfile`. This is ignored if `remote` is specified and points to an external `Dockerfile`.
     *     @var string $t A name and optional tag to apply to the image in the `name:tag` format. If you omit the tag the default `latest` value is assumed. You can provide several `t` parameters.
     *     @var string $remote A Git repository URI or HTTP/HTTPS context URI. If the URI points to a single text file, the file’s contents are placed into a file called `Dockerfile` and the image is built from that file. If the URI points to a tarball, the file is downloaded by the daemon and the contents therein used as the context for the build. If the URI points to a tarball and the `dockerfile` parameter is also specified, there must be a file with the corresponding path inside the tarball.
     *     @var bool $q suppress verbose build output
     *     @var bool $nocache do not use the cache when building the image
     *     @var string $cachefrom JSON array of images used for build cache resolution
     *     @var string $pull attempt to pull the image even if an older image exists locally
     *     @var bool $rm remove intermediate containers after a successful build
     *     @var bool $forcerm always remove intermediate containers, even upon failure
     *     @var int $memory set memory limit for build
     *     @var int $memswap Total memory (memory + swap). Set as `-1` to disable swap.
     *     @var int $cpushares CPU shares (relative weight)
     *     @var string $cpusetcpus CPUs in which to allow execution (e.g., `0-3`, `0,1`).
     *     @var int $cpuperiod the length of a CPU period in microseconds
     *     @var int $cpuquota microseconds of CPU time that the container can get in a CPU period
     *     @var string $buildargs JSON map of string pairs for build-time variables. Users pass these values at build-time. Docker uses the buildargs as the environment context for commands run via the `Dockerfile` RUN instruction, or for variable expansion in other `Dockerfile` instructions. This is not meant for passing secret values. [Read more about the buildargs instruction.](https://docs.docker.com/engine/reference/builder/#arg)
     *     @var int $shmsize Size of `/dev/shm` in bytes. The size must be greater than 0. If omitted the system uses 64MB.
     *     @var bool $squash Squash the resulting images layers into a single layer. *(Experimental release only.)*
     *     @var string $labels arbitrary key/value labels to set on the image, as a JSON map of string pairs
     *     @var string $networkmode Sets the networking mode for the run commands during build. Supported standard values are: `bridge`, `host`, `none`, and `container:<name|id>`. Any other value is taken as a custom network's name to which this container should connect to.
     * }
     *
     * @param array $headerParameters {
     *
     *     @var string $Content-type
     *     @var string $X-Registry-Config This is a base64-encoded JSON object with auth configurations for multiple registries that a build may refer to

    The key is a registry URL, and the value is an auth configuration object, [as described in the authentication section](#section/Authentication). For example:

    ```
    {
     "docker.example.com": {
       "username": "janedoe",
       "password": "hunter2"
     },
     "https://index.docker.io/v1/": {
       "username": "mobydock",
       "password": "conta1n3rize14"
     }
    }
    ```

    Only the registry domain name (and port if not the default 443) are required. However, for legacy reasons, the Docker Hub registry must be specified with both a `https://` prefix and a `/v1/` suffix even though Docker will prefer to use the v2 registry API.

     * }
     */
    public function __construct($inputStream, array $queryParameters = [], array $headerParameters = [])
    {
        $this->body = $inputStream;
        $this->queryParameters = $queryParameters;
        $this->headerParameters = $headerParameters;
    }

    use \Jane\OpenApiRuntime\Client\AmpArtaxEndpointTrait, \Jane\OpenApiRuntime\Client\Psr7HttplugEndpointTrait;

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/build';
    }

    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, \Http\Message\StreamFactory $streamFactory = null): array
    {
        return [[], $this->body];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['dockerfile', 't', 'remote', 'q', 'nocache', 'cachefrom', 'pull', 'rm', 'forcerm', 'memory', 'memswap', 'cpushares', 'cpusetcpus', 'cpuperiod', 'cpuquota', 'buildargs', 'shmsize', 'squash', 'labels', 'networkmode']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['dockerfile' => 'Dockerfile', 'q' => false, 'nocache' => false, 'rm' => true, 'forcerm' => false]);
        $optionsResolver->setAllowedTypes('dockerfile', ['string']);
        $optionsResolver->setAllowedTypes('t', ['string']);
        $optionsResolver->setAllowedTypes('remote', ['string']);
        $optionsResolver->setAllowedTypes('q', ['bool']);
        $optionsResolver->setAllowedTypes('nocache', ['bool']);
        $optionsResolver->setAllowedTypes('cachefrom', ['string']);
        $optionsResolver->setAllowedTypes('pull', ['string']);
        $optionsResolver->setAllowedTypes('rm', ['bool']);
        $optionsResolver->setAllowedTypes('forcerm', ['bool']);
        $optionsResolver->setAllowedTypes('memory', ['int']);
        $optionsResolver->setAllowedTypes('memswap', ['int']);
        $optionsResolver->setAllowedTypes('cpushares', ['int']);
        $optionsResolver->setAllowedTypes('cpusetcpus', ['string']);
        $optionsResolver->setAllowedTypes('cpuperiod', ['int']);
        $optionsResolver->setAllowedTypes('cpuquota', ['int']);
        $optionsResolver->setAllowedTypes('buildargs', ['string']);
        $optionsResolver->setAllowedTypes('shmsize', ['int']);
        $optionsResolver->setAllowedTypes('squash', ['bool']);
        $optionsResolver->setAllowedTypes('labels', ['string']);
        $optionsResolver->setAllowedTypes('networkmode', ['string']);

        return $optionsResolver;
    }

    protected function getHeadersOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getHeadersOptionsResolver();
        $optionsResolver->setDefined(['Content-type', 'X-Registry-Config']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['Content-type' => 'application/tar']);
        $optionsResolver->setAllowedTypes('Content-type', ['string']);
        $optionsResolver->setAllowedTypes('X-Registry-Config', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Docker\API\Exception\ImageBuildInternalServerErrorException
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer)
    {
        if (200 === $status) {
            return null;
        }
        if (500 === $status) {
            throw new \Docker\API\Exception\ImageBuildInternalServerErrorException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
    }
}
