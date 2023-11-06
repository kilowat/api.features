<?php

namespace Api\Features\Share\Services;

use Api\Core\AppContext;
use Api\Features\Share\Models\CaptchaModel;

class CaptchaService
{
    public function get(): CaptchaModel
    {
        $captcha = AppContext::getInstance()->getCaptcha();
        $ssid = $captcha->GetCodeCrypt();
        $picture = getDomain(). '/bitrix/tools/captcha.php?captcha_code='.$ssid;
        return new CaptchaModel(ssid: $ssid, picture: $picture);
    }
}