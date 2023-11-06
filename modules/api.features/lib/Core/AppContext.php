<?php

namespace Api\Core;

use CCaptcha;
use COption;

class AppContext
{
    private static ?AppContext $_instance = null;
    private static CCaptcha $captcha;

    public static function getInstance(): AppContext|static
    {
        if(self::$_instance == null) {
            self::$_instance = new static();
            self::init();
        }
        return self::$_instance;
    }

    private static function init()
    {
        self::initCaptcha();
    }

    private static function initCaptcha(): void
    {
        self::$captcha = new CCaptcha();
        $captchaPass = COption::GetOptionString("main", "captcha_password", "");
        if(strlen($captchaPass) <= 0)
        {
            $captchaPass = randString(10);
            COption::SetOptionString("main", "captcha_password", $captchaPass);
        }
        self::$captcha->SetCodeCrypt($captchaPass);
    }

    public function getCaptcha(): CCaptcha
    {
        return self::$captcha;
    }
}

