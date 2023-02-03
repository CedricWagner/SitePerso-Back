<?php
// api/src/Serializer/BookAttributeNormalizer.php
namespace App\Serializer;

use App\Entity\ProfileInformation;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProfileInformationNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    private const ALREADY_CALLED = 'PROFILE_INFORMATION_NORMALIZER_ALREADY_CALLED';

    public function __construct(private RequestStack $requestStack){}

    public function normalize($object, $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        /** @var ProfileInformation $object */
        if (!$this->userHasPermissionsForInfo($object)) {
            $object->setValue('');
        }

        $context[self::ALREADY_CALLED] = true;

        return $this->normalizer->normalize($object, $format, $context);
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        // Make sure we're not called twice
        if (isset($context[self::ALREADY_CALLED])) {
            return false;
        }

        return $data instanceof ProfileInformation;
    }

    private function userHasPermissionsForInfo(ProfileInformation $object): bool
    {
        if (!$object->isPrivate()) {
            return true;
        }

        $session = $this->requestStack->getSession();
        return $session->has('is_captcha_verified') && $session->get('is_captcha_verified') === true;
    }
}