<?php

declare(strict_types=1);

namespace Docker\API\Normalizer;

use Docker\API\Runtime\Normalizer\CheckArray;
use Jane\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class HealthConfigNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Docker\\API\\Model\\HealthConfig';
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Docker\\API\\Model\\HealthConfig';
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Docker\API\Model\HealthConfig();
        if (null === $data) {
            return $object;
        }
        if (\array_key_exists('Test', $data) && $data['Test'] !== null) {
            $values = [];
            foreach ($data['Test'] as $value) {
                $values[] = $value;
            }
            $object->setTest($values);
        } elseif (\array_key_exists('Test', $data) && $data['Test'] === null) {
            $object->setTest(null);
        }
        if (\array_key_exists('Interval', $data) && $data['Interval'] !== null) {
            $object->setInterval($data['Interval']);
        } elseif (\array_key_exists('Interval', $data) && $data['Interval'] === null) {
            $object->setInterval(null);
        }
        if (\array_key_exists('Timeout', $data) && $data['Timeout'] !== null) {
            $object->setTimeout($data['Timeout']);
        } elseif (\array_key_exists('Timeout', $data) && $data['Timeout'] === null) {
            $object->setTimeout(null);
        }
        if (\array_key_exists('Retries', $data) && $data['Retries'] !== null) {
            $object->setRetries($data['Retries']);
        } elseif (\array_key_exists('Retries', $data) && $data['Retries'] === null) {
            $object->setRetries(null);
        }
        if (\array_key_exists('StartPeriod', $data) && $data['StartPeriod'] !== null) {
            $object->setStartPeriod($data['StartPeriod']);
        } elseif (\array_key_exists('StartPeriod', $data) && $data['StartPeriod'] === null) {
            $object->setStartPeriod(null);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getTest()) {
            $values = [];
            foreach ($object->getTest() as $value) {
                $values[] = $value;
            }
            $data['Test'] = $values;
        }
        if (null !== $object->getInterval()) {
            $data['Interval'] = $object->getInterval();
        }
        if (null !== $object->getTimeout()) {
            $data['Timeout'] = $object->getTimeout();
        }
        if (null !== $object->getRetries()) {
            $data['Retries'] = $object->getRetries();
        }
        if (null !== $object->getStartPeriod()) {
            $data['StartPeriod'] = $object->getStartPeriod();
        }

        return $data;
    }
}
