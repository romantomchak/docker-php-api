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

class ExecIdStartPostBodyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Docker\\API\\Model\\ExecIdStartPostBody';
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Docker\\API\\Model\\ExecIdStartPostBody';
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Docker\API\Model\ExecIdStartPostBody();
        if (null === $data) {
            return $object;
        }
        if (\array_key_exists('Detach', $data) && $data['Detach'] !== null) {
            $object->setDetach($data['Detach']);
        } elseif (\array_key_exists('Detach', $data) && $data['Detach'] === null) {
            $object->setDetach(null);
        }
        if (\array_key_exists('Tty', $data) && $data['Tty'] !== null) {
            $object->setTty($data['Tty']);
        } elseif (\array_key_exists('Tty', $data) && $data['Tty'] === null) {
            $object->setTty(null);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getDetach()) {
            $data['Detach'] = $object->getDetach();
        }
        if (null !== $object->getTty()) {
            $data['Tty'] = $object->getTty();
        }

        return $data;
    }
}
