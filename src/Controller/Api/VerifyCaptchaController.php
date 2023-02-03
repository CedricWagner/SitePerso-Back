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
    private $requestStack;
    private $verificator;

    public function __construct(RequestStack $requestStack, CaptchaVerificatorInterface $verificator)
    {
        $this->requestStack = $requestStack;
        $this->verificator = $verificator;
    }

    #[Route('/api/captcha/verify', name: 'app_verify_captcha', methods: ['POST'])]
    public function verify(Request $request): JsonResponse
    {
        $session = $this->requestStack->getSession();

        $content = json_decode($request->getContent());
        
        if (!isset($content->clientResponse)) {
            return new JsonResponse(['result' => false], Response::HTTP_BAD_REQUEST);
        }

        $token = $content->clientResponse;
        $result = $this->verificator->verify($token);
        $session->set('is_captcha_verified', $result);
        
        return new JsonResponse([
            'result' => $session->get('is_captcha_verified'),
        ]);
    }
}
