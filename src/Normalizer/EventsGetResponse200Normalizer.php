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

class EventsGetResponse200Normalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Docker\\API\\Model\\EventsGetResponse200';
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'Docker\\API\\Model\\EventsGetResponse200';
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Docker\API\Model\EventsGetResponse200();
        if (null === $data) {
            return $object;
        }
        if (\array_key_exists('Type', $data) && $data['Type'] !== null) {
            $object->setType($data['Type']);
        } elseif (\array_key_exists('Type', $data) && $data['Type'] === null) {
            $object->setType(null);
        }
        if (\array_key_exists('Action', $data) && $data['Action'] !== null) {
            $object->setAction($data['Action']);
        } elseif (\array_key_exists('Action', $data) && $data['Action'] === null) {
            $object->setAction(null);
        }
        if (\array_key_exists('Actor', $data) && $data['Actor'] !== null) {
            $object->setActor($this->denormalizer->denormalize($data['Actor'], 'Docker\\API\\Model\\EventsGetResponse200Actor', 'json', $context));
        } elseif (\array_key_exists('Actor', $data) && $data['Actor'] === null) {
            $object->setActor(null);
        }
        if (\array_key_exists('time', $data) && $data['time'] !== null) {
            $object->setTime($data['time']);
        } elseif (\array_key_exists('time', $data) && $data['time'] === null) {
            $object->setTime(null);
        }
        if (\array_key_exists('timeNano', $data) && $data['timeNano'] !== null) {
            $object->setTimeNano($data['timeNano']);
        } elseif (\array_key_exists('timeNano', $data) && $data['timeNano'] === null) {
            $object->setTimeNano(null);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getType()) {
            $data['Type'] = $object->getType();
        }
        if (null !== $object->getAction()) {
            $data['Action'] = $object->getAction();
        }
        if (null !== $object->getActor()) {
            $data['Actor'] = $this->normalizer->normalize($object->getActor(), 'json', $context);
        }
        if (null !== $object->getTime()) {
            $data['time'] = $object->getTime();
        }
        if (null !== $object->getTimeNano()) {
            $data['timeNano'] = $object->getTimeNano();
        }

        return $data;
    }
}
