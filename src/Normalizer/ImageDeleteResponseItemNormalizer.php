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

class ImageDeleteResponseItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Docker\\API\\Model\\ImageDeleteResponseItem';
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Docker\\API\\Model\\ImageDeleteResponseItem';
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Docker\API\Model\ImageDeleteResponseItem();
        if (null === $data) {
            return $object;
        }
        if (\array_key_exists('Untagged', $data) && $data['Untagged'] !== null) {
            $object->setUntagged($data['Untagged']);
        } elseif (\array_key_exists('Untagged', $data) && $data['Untagged'] === null) {
            $object->setUntagged(null);
        }
        if (\array_key_exists('Deleted', $data) && $data['Deleted'] !== null) {
            $object->setDeleted($data['Deleted']);
        } elseif (\array_key_exists('Deleted', $data) && $data['Deleted'] === null) {
            $object->setDeleted(null);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getUntagged()) {
            $data['Untagged'] = $object->getUntagged();
        }
        if (null !== $object->getDeleted()) {
            $data['Deleted'] = $object->getDeleted();
        }

        return $data;
    }
}
