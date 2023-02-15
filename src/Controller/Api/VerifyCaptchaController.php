<?php

namespace App\Controller\Api;

use App\Service\CaptchaVerificatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VerifyCaptchaController extends AbstractController
{
    public function __construct(private RequestStack $requestStack, private CaptchaVerificatorInterface $verificator)
    {
    }

    #[Route('/api/captcha/verify', name: 'app_verify_captcha', methods: ['POST'])]
    public function verify(Request $request): JsonResponse
    {
        $session = $this->requestStack->getSession();

        /** @var \stdClass */
        $content = json_decode($request->getContent());

        if (!isset($content->clientResponse)) {
            return new JsonResponse(['result' => false], Response::HTTP_BAD_REQUEST);
        }

        $token = $content->clientResponse;
        $result = $this->verificator->verify($token);
        $session->set('is_captcha_verified', $result);

        $response = new JsonResponse([
            'result' => $session->get('is_captcha_verified'),
        ]);

        return $response;
    }

    #[Route('/api/captcha/test/verify', name: 'app_verify_captcha_test', methods: ['GET'], condition: "'dev' === '%kernel.environment%'")]
    public function testVerify(): JsonResponse
    {
        $session = $this->requestStack->getSession();

        $session->set('is_captcha_verified', true);

        return new JsonResponse([
            'result' => $session->get('is_captcha_verified'),
        ]);
    }

    #[Route('/api/captcha/test/reset', name: 'app_reset_captcha_test', methods: ['GET'], condition: "'dev' === '%kernel.environment%'")]
    public function testReset(): JsonResponse
    {
        $session = $this->requestStack->getSession();

        $session->set('is_captcha_verified', false);

        return new JsonResponse([
            'result' => $session->get('is_captcha_verified'),
        ]);
    }

    #[Route('/api/captcha/state', name: 'app_state_captcha_test', methods: ['GET'])]
    public function state(): JsonResponse
    {
        $session = $this->requestStack->getSession();

        return new JsonResponse([
            'result' => $session->get('is_captcha_verified'),
        ]);
    }
}
