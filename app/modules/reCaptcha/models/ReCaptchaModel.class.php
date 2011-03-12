<?php

require_once('recaptcha/recaptchalib.php');

class reCaptcha_ReCaptchaModel extends EEreCaptchaBaseModel
{

    public function getCaptchaFormParts($publicKey = null, $error = null, $useSSL = false) {
        if (is_null($publicKey)) {
            $publicKey = AgaviConfig::get('reCAPTCHA.publicKey');
        }
        return recaptcha_get_html($publicKey, $error, $useSSL);
    }

    public function checkAnswer($captchaChallenge, $captchaResponse,$privateKey=null) {
        if (is_null($privateKey)) {
            $privateKey = AgaviConfig::get('reCAPTCHA.privateKey');
        }

        $remoteIP = $_SERVER['REMOTE_ADDR'];
        $extra_params = array();

//        $s = array($privateKey, $remoteIP, $captchaChallenge, $captchaResponse, $extra_params);
//        print_r($s);
//        die('checkanswer');

        $response = recaptcha_check_answer($privateKey, $remoteIP, $captchaChallenge, $captchaResponse, $extra_params);

        if (!$response->is_valid) {
            throw new Exception($response->error);
        }
    }
}

?>