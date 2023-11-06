<?php

namespace Api\Features\Share\Controllers;

use Api\Core\BaseController;
use Api\Features\Share\Http\CaptchaResponse;
use Api\Features\Share\Services\CaptchaService;
use OpenApi\Attributes as OA;

class CaptchaController extends BaseController
{
    #[OA\Get(
        path: '/api/captcha/ssid',
        description: 'Получить капчу',
        tags: ['Captcha'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',
                content: new OA\JsonContent(ref: CaptchaResponse::class)
            ),
        ]
    )]
    public function ssidAction(CaptchaService $captchaService)
    {
        return $captchaService
            ->get()
            ->toResponse();
    }
}