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

class GenericResourcesItemNamedResourceSpecNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Docker\\API\\Model\\GenericResourcesItemNamedResourceSpec';
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Docker\\API\\Model\\GenericResourcesItemNamedResourceSpec';
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Docker\API\Model\GenericResourcesItemNamedResourceSpec();
        if (null === $data) {
            return $object;
        }
        if (\array_key_exists('Kind', $data) && $data['Kind'] !== null) {
            $object->setKind($data['Kind']);
        } elseif (\array_key_exists('Kind', $data) && $data['Kind'] === null) {
            $object->setKind(null);
        }
        if (\array_key_exists('Value', $data) && $data['Value'] !== null) {
            $object->setValue($data['Value']);
        } elseif (\array_key_exists('Value', $data) && $data['Value'] === null) {
            $object->setValue(null);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getKind()) {
            $data['Kind'] = $object->getKind();
        }
        if (null !== $object->getValue()) {
            $data['Value'] = $object->getValue();
        }

        return $data;
    }
}
