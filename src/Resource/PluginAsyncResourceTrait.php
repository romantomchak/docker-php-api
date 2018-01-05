<?php

declare(strict_types=1);

/*
 * This file has been auto generated by Jane,
 *
 * Do no edit it directly.
 */

namespace Docker\API\Resource;

use Jane\OpenApiRuntime\Client\QueryParam;

trait PluginAsyncResourceTrait
{
    /**
     * Returns information about installed plugins.
     *
     * @param array $parameters {
     *
     *     @var string $filters A JSON encoded value of the filters (a `map[string][]string`) to process on the plugin list. Available filters:

     * }
     * @param string                 $fetch             Fetch mode (object or response)
     * @param \Amp\CancellationToken $cancellationToken Token to cancel the request
     *
     * @throws \Docker\API\Exception\PluginListInternalServerErrorException
     *
     * @return \Amp\Promise<\Amp\Artax\Response|\Docker\API\Model\Plugin>
     */
    public function pluginList(array $parameters = [], string $fetch = self::FETCH_OBJECT, \Amp\CancellationToken $cancellationToken = null): \Amp\Promise
    {
        return \Amp\call(function () use ($parameters, $fetch, $cancellationToken) {
            $queryParam = new QueryParam();
            $queryParam->addQueryParameter('filters', false, ['string']);
            $url = '/plugins';
            $url = $url . ('?' . $queryParam->buildQueryString($parameters));
            $headers = array_merge(['Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
            $body = $queryParam->buildFormDataString($parameters);
            $request = new \Amp\Artax\Request($url, 'GET');
            $request = $request->withHeaders($headers);
            $request = $request->withBody($body);
            $response = (yield $this->httpClient->request($request, [], $cancellationToken));
            if (self::FETCH_OBJECT === $fetch) {
                if (200 === $response->getStatus()) {
                    return $this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\Plugin[]', 'json');
                }
                if (500 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginListInternalServerErrorException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
            }

            return $response;
        });
    }

    /**
     * @param array $parameters {
     *
     *     @var string $remote The name of the plugin. The `:latest` tag is optional, and is the default if omitted.
     * }
     *
     * @param string                 $fetch             Fetch mode (object or response)
     * @param \Amp\CancellationToken $cancellationToken Token to cancel the request
     *
     * @throws \Docker\API\Exception\GetPluginPrivilegesInternalServerErrorException
     *
     * @return \Amp\Promise<\Amp\Artax\Response|\Docker\API\Model\PluginsPrivilegesGetResponse200Item>
     */
    public function getPluginPrivileges(array $parameters = [], string $fetch = self::FETCH_OBJECT, \Amp\CancellationToken $cancellationToken = null): \Amp\Promise
    {
        return \Amp\call(function () use ($parameters, $fetch, $cancellationToken) {
            $queryParam = new QueryParam();
            $queryParam->addQueryParameter('remote', true, ['string']);
            $url = '/plugins/privileges';
            $url = $url . ('?' . $queryParam->buildQueryString($parameters));
            $headers = array_merge(['Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
            $body = $queryParam->buildFormDataString($parameters);
            $request = new \Amp\Artax\Request($url, 'GET');
            $request = $request->withHeaders($headers);
            $request = $request->withBody($body);
            $response = (yield $this->httpClient->request($request, [], $cancellationToken));
            if (self::FETCH_OBJECT === $fetch) {
                if (200 === $response->getStatus()) {
                    return $this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\PluginsPrivilegesGetResponse200Item[]', 'json');
                }
                if (500 === $response->getStatus()) {
                    throw new \Docker\API\Exception\GetPluginPrivilegesInternalServerErrorException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
            }

            return $response;
        });
    }

    /**
     * Pulls and installs a plugin. After the plugin is installed, it can be enabled using the [`POST /plugins/{name}/enable` endpoint](#operation/PostPluginsEnable).

     *
     * @param array $body
     * @param array $parameters {
     *
     *     @var string $remote remote reference for plugin to install

     *     @var string $name local name for the pulled plugin

     *     @var string $X-Registry-Auth A base64-encoded auth configuration to use when pulling a plugin from a registry. [See the authentication section for details.](#section/Authentication)
     * }
     *
     * @param string                 $fetch             Fetch mode (object or response)
     * @param \Amp\CancellationToken $cancellationToken Token to cancel the request
     *
     * @throws \Docker\API\Exception\PluginPullInternalServerErrorException
     *
     * @return \Amp\Promise<\Amp\Artax\Response|null>
     */
    public function pluginPull(array $body, array $parameters = [], string $fetch = self::FETCH_OBJECT, \Amp\CancellationToken $cancellationToken = null): \Amp\Promise
    {
        return \Amp\call(function () use ($body, $parameters, $fetch, $cancellationToken) {
            $queryParam = new QueryParam();
            $queryParam->addQueryParameter('remote', true, ['string']);
            $queryParam->addQueryParameter('name', false, ['string']);
            $queryParam->addHeaderParameter('X-Registry-Auth', false, ['string']);
            $url = '/plugins/pull';
            $url = $url . ('?' . $queryParam->buildQueryString($parameters));
            $headers = array_merge(['Accept' => ['application/json'], 'Content-Type' => ['application/json']], $queryParam->buildHeaders($parameters));
            $body = $body;
            $request = new \Amp\Artax\Request($url, 'POST');
            $request = $request->withHeaders($headers);
            $request = $request->withBody($body);
            $response = (yield $this->httpClient->request($request, [], $cancellationToken));
            if (self::FETCH_OBJECT === $fetch) {
                if (204 === $response->getStatus()) {
                    return null;
                }
                if (500 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginPullInternalServerErrorException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
            }

            return $response;
        });
    }

    /**
     * @param string                 $name              The name of the plugin. The `:latest` tag is optional, and is the default if omitted.
     * @param array                  $parameters        List of parameters
     * @param string                 $fetch             Fetch mode (object or response)
     * @param \Amp\CancellationToken $cancellationToken Token to cancel the request
     *
     * @throws \Docker\API\Exception\PluginInspectNotFoundException
     * @throws \Docker\API\Exception\PluginInspectInternalServerErrorException
     *
     * @return \Amp\Promise<\Amp\Artax\Response|\Docker\API\Model\Plugin>
     */
    public function pluginInspect(string $name, array $parameters = [], string $fetch = self::FETCH_OBJECT, \Amp\CancellationToken $cancellationToken = null): \Amp\Promise
    {
        return \Amp\call(function () use ($name, $parameters, $fetch, $cancellationToken) {
            $queryParam = new QueryParam();
            $url = '/plugins/{name}/json';
            $url = str_replace('{name}', urlencode($name), $url);
            $url = $url . ('?' . $queryParam->buildQueryString($parameters));
            $headers = array_merge(['Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
            $body = $queryParam->buildFormDataString($parameters);
            $request = new \Amp\Artax\Request($url, 'GET');
            $request = $request->withHeaders($headers);
            $request = $request->withBody($body);
            $response = (yield $this->httpClient->request($request, [], $cancellationToken));
            if (self::FETCH_OBJECT === $fetch) {
                if (200 === $response->getStatus()) {
                    return $this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\Plugin', 'json');
                }
                if (404 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginInspectNotFoundException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
                if (500 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginInspectInternalServerErrorException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
            }

            return $response;
        });
    }

    /**
     * @param string $name       The name of the plugin. The `:latest` tag is optional, and is the default if omitted.
     * @param array  $parameters {
     *
     *     @var bool $force Disable the plugin before removing. This may result in issues if the plugin is in use by a container.
     * }
     *
     * @param string                 $fetch             Fetch mode (object or response)
     * @param \Amp\CancellationToken $cancellationToken Token to cancel the request
     *
     * @throws \Docker\API\Exception\PluginDeleteNotFoundException
     * @throws \Docker\API\Exception\PluginDeleteInternalServerErrorException
     *
     * @return \Amp\Promise<\Amp\Artax\Response|\Docker\API\Model\Plugin>
     */
    public function pluginDelete(string $name, array $parameters = [], string $fetch = self::FETCH_OBJECT, \Amp\CancellationToken $cancellationToken = null): \Amp\Promise
    {
        return \Amp\call(function () use ($name, $parameters, $fetch, $cancellationToken) {
            $queryParam = new QueryParam();
            $queryParam->addQueryParameter('force', false, ['bool'], false);
            $url = '/plugins/{name}';
            $url = str_replace('{name}', urlencode($name), $url);
            $url = $url . ('?' . $queryParam->buildQueryString($parameters));
            $headers = array_merge(['Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
            $body = $queryParam->buildFormDataString($parameters);
            $request = new \Amp\Artax\Request($url, 'DELETE');
            $request = $request->withHeaders($headers);
            $request = $request->withBody($body);
            $response = (yield $this->httpClient->request($request, [], $cancellationToken));
            if (self::FETCH_OBJECT === $fetch) {
                if (200 === $response->getStatus()) {
                    return $this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\Plugin', 'json');
                }
                if (404 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginDeleteNotFoundException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
                if (500 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginDeleteInternalServerErrorException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
            }

            return $response;
        });
    }

    /**
     * @param string $name       The name of the plugin. The `:latest` tag is optional, and is the default if omitted.
     * @param array  $parameters {
     *
     *     @var int $timeout Set the HTTP client timeout (in seconds)
     * }
     *
     * @param string                 $fetch             Fetch mode (object or response)
     * @param \Amp\CancellationToken $cancellationToken Token to cancel the request
     *
     * @throws \Docker\API\Exception\PluginEnableNotFoundException
     * @throws \Docker\API\Exception\PluginEnableInternalServerErrorException
     *
     * @return \Amp\Promise<\Amp\Artax\Response|null>
     */
    public function pluginEnable(string $name, array $parameters = [], string $fetch = self::FETCH_OBJECT, \Amp\CancellationToken $cancellationToken = null): \Amp\Promise
    {
        return \Amp\call(function () use ($name, $parameters, $fetch, $cancellationToken) {
            $queryParam = new QueryParam();
            $queryParam->addQueryParameter('timeout', false, ['int'], 0);
            $url = '/plugins/{name}/enable';
            $url = str_replace('{name}', urlencode($name), $url);
            $url = $url . ('?' . $queryParam->buildQueryString($parameters));
            $headers = array_merge(['Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
            $body = $queryParam->buildFormDataString($parameters);
            $request = new \Amp\Artax\Request($url, 'POST');
            $request = $request->withHeaders($headers);
            $request = $request->withBody($body);
            $response = (yield $this->httpClient->request($request, [], $cancellationToken));
            if (self::FETCH_OBJECT === $fetch) {
                if (200 === $response->getStatus()) {
                    return null;
                }
                if (404 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginEnableNotFoundException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
                if (500 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginEnableInternalServerErrorException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
            }

            return $response;
        });
    }

    /**
     * @param string                 $name              The name of the plugin. The `:latest` tag is optional, and is the default if omitted.
     * @param array                  $parameters        List of parameters
     * @param string                 $fetch             Fetch mode (object or response)
     * @param \Amp\CancellationToken $cancellationToken Token to cancel the request
     *
     * @throws \Docker\API\Exception\PluginDisableNotFoundException
     * @throws \Docker\API\Exception\PluginDisableInternalServerErrorException
     *
     * @return \Amp\Promise<\Amp\Artax\Response|null>
     */
    public function pluginDisable(string $name, array $parameters = [], string $fetch = self::FETCH_OBJECT, \Amp\CancellationToken $cancellationToken = null): \Amp\Promise
    {
        return \Amp\call(function () use ($name, $parameters, $fetch, $cancellationToken) {
            $queryParam = new QueryParam();
            $url = '/plugins/{name}/disable';
            $url = str_replace('{name}', urlencode($name), $url);
            $url = $url . ('?' . $queryParam->buildQueryString($parameters));
            $headers = array_merge(['Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
            $body = $queryParam->buildFormDataString($parameters);
            $request = new \Amp\Artax\Request($url, 'POST');
            $request = $request->withHeaders($headers);
            $request = $request->withBody($body);
            $response = (yield $this->httpClient->request($request, [], $cancellationToken));
            if (self::FETCH_OBJECT === $fetch) {
                if (200 === $response->getStatus()) {
                    return null;
                }
                if (404 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginDisableNotFoundException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
                if (500 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginDisableInternalServerErrorException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
            }

            return $response;
        });
    }

    /**
     * @param string $name       The name of the plugin. The `:latest` tag is optional, and is the default if omitted.
     * @param array  $body
     * @param array  $parameters {
     *
     *     @var string $remote remote reference to upgrade to

     *     @var string $X-Registry-Auth A base64-encoded auth configuration to use when pulling a plugin from a registry. [See the authentication section for details.](#section/Authentication)
     * }
     *
     * @param string                 $fetch             Fetch mode (object or response)
     * @param \Amp\CancellationToken $cancellationToken Token to cancel the request
     *
     * @throws \Docker\API\Exception\PluginUpgradeNotFoundException
     * @throws \Docker\API\Exception\PluginUpgradeInternalServerErrorException
     *
     * @return \Amp\Promise<\Amp\Artax\Response|null>
     */
    public function pluginUpgrade(string $name, array $body, array $parameters = [], string $fetch = self::FETCH_OBJECT, \Amp\CancellationToken $cancellationToken = null): \Amp\Promise
    {
        return \Amp\call(function () use ($name, $body, $parameters, $fetch, $cancellationToken) {
            $queryParam = new QueryParam();
            $queryParam->addQueryParameter('remote', true, ['string']);
            $queryParam->addHeaderParameter('X-Registry-Auth', false, ['string']);
            $url = '/plugins/{name}/upgrade';
            $url = str_replace('{name}', urlencode($name), $url);
            $url = $url . ('?' . $queryParam->buildQueryString($parameters));
            $headers = array_merge(['Accept' => ['application/json'], 'Content-Type' => ['application/json']], $queryParam->buildHeaders($parameters));
            $body = $body;
            $request = new \Amp\Artax\Request($url, 'POST');
            $request = $request->withHeaders($headers);
            $request = $request->withBody($body);
            $response = (yield $this->httpClient->request($request, [], $cancellationToken));
            if (self::FETCH_OBJECT === $fetch) {
                if (204 === $response->getStatus()) {
                    return null;
                }
                if (404 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginUpgradeNotFoundException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
                if (500 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginUpgradeInternalServerErrorException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
            }

            return $response;
        });
    }

    /**
     * @param string $tarContext Path to tar containing plugin rootfs and manifest
     * @param array  $parameters {
     *
     *     @var string $name The name of the plugin. The `:latest` tag is optional, and is the default if omitted.
     * }
     *
     * @param string                 $fetch             Fetch mode (object or response)
     * @param \Amp\CancellationToken $cancellationToken Token to cancel the request
     *
     * @throws \Docker\API\Exception\PluginCreateInternalServerErrorException
     *
     * @return \Amp\Promise<\Amp\Artax\Response|null>
     */
    public function pluginCreate($tarContext, array $parameters = [], string $fetch = self::FETCH_OBJECT, \Amp\CancellationToken $cancellationToken = null): \Amp\Promise
    {
        return \Amp\call(function () use ($tarContext, $parameters, $fetch, $cancellationToken) {
            $queryParam = new QueryParam();
            $queryParam->addQueryParameter('name', true, ['string']);
            $url = '/plugins/create';
            $url = $url . ('?' . $queryParam->buildQueryString($parameters));
            $headers = array_merge(['Accept' => ['application/json'], 'Content-Type' => ['application/json']], $queryParam->buildHeaders($parameters));
            $body = $tarContext;
            $request = new \Amp\Artax\Request($url, 'POST');
            $request = $request->withHeaders($headers);
            $request = $request->withBody($body);
            $response = (yield $this->httpClient->request($request, [], $cancellationToken));
            if (self::FETCH_OBJECT === $fetch) {
                if (204 === $response->getStatus()) {
                    return null;
                }
                if (500 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginCreateInternalServerErrorException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
            }

            return $response;
        });
    }

    /**
     * Push a plugin to the registry.
     *
     * @param string                 $name              The name of the plugin. The `:latest` tag is optional, and is the default if omitted.
     * @param array                  $parameters        List of parameters
     * @param string                 $fetch             Fetch mode (object or response)
     * @param \Amp\CancellationToken $cancellationToken Token to cancel the request
     *
     * @throws \Docker\API\Exception\PluginPushNotFoundException
     * @throws \Docker\API\Exception\PluginPushInternalServerErrorException
     *
     * @return \Amp\Promise<\Amp\Artax\Response|null>
     */
    public function pluginPush(string $name, array $parameters = [], string $fetch = self::FETCH_OBJECT, \Amp\CancellationToken $cancellationToken = null): \Amp\Promise
    {
        return \Amp\call(function () use ($name, $parameters, $fetch, $cancellationToken) {
            $queryParam = new QueryParam();
            $url = '/plugins/{name}/push';
            $url = str_replace('{name}', urlencode($name), $url);
            $url = $url . ('?' . $queryParam->buildQueryString($parameters));
            $headers = array_merge(['Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
            $body = $queryParam->buildFormDataString($parameters);
            $request = new \Amp\Artax\Request($url, 'POST');
            $request = $request->withHeaders($headers);
            $request = $request->withBody($body);
            $response = (yield $this->httpClient->request($request, [], $cancellationToken));
            if (self::FETCH_OBJECT === $fetch) {
                if (200 === $response->getStatus()) {
                    return null;
                }
                if (404 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginPushNotFoundException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
                if (500 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginPushInternalServerErrorException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
            }

            return $response;
        });
    }

    /**
     * @param string                 $name              The name of the plugin. The `:latest` tag is optional, and is the default if omitted.
     * @param array                  $body
     * @param array                  $parameters        List of parameters
     * @param string                 $fetch             Fetch mode (object or response)
     * @param \Amp\CancellationToken $cancellationToken Token to cancel the request
     *
     * @throws \Docker\API\Exception\PluginSetNotFoundException
     * @throws \Docker\API\Exception\PluginSetInternalServerErrorException
     *
     * @return \Amp\Promise<\Amp\Artax\Response|null>
     */
    public function pluginSet(string $name, array $body, array $parameters = [], string $fetch = self::FETCH_OBJECT, \Amp\CancellationToken $cancellationToken = null): \Amp\Promise
    {
        return \Amp\call(function () use ($name, $body, $parameters, $fetch, $cancellationToken) {
            $queryParam = new QueryParam();
            $url = '/plugins/{name}/set';
            $url = str_replace('{name}', urlencode($name), $url);
            $url = $url . ('?' . $queryParam->buildQueryString($parameters));
            $headers = array_merge(['Accept' => ['application/json'], 'Content-Type' => ['application/json']], $queryParam->buildHeaders($parameters));
            $body = $body;
            $request = new \Amp\Artax\Request($url, 'POST');
            $request = $request->withHeaders($headers);
            $request = $request->withBody($body);
            $response = (yield $this->httpClient->request($request, [], $cancellationToken));
            if (self::FETCH_OBJECT === $fetch) {
                if (204 === $response->getStatus()) {
                    return null;
                }
                if (404 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginSetNotFoundException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
                if (500 === $response->getStatus()) {
                    throw new \Docker\API\Exception\PluginSetInternalServerErrorException($this->serializer->deserialize((yield $response->getBody()), 'Docker\\API\\Model\\ErrorResponse', 'json'));
                }
            }

            return $response;
        });
    }
}