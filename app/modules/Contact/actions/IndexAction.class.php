<?php

class Contact_IndexAction extends EEContactBaseAction {
    /**
     * Returns the default view if the action does not serve the request
     * method used.
     *
     * @return     mixed <ul>
     *                     <li>A string containing the view name associated
     *                     with this action; or</li>
     *                     <li>An array with two indices: the parent module
     *                     of the view to be executed and the view to be
     *                     executed.</li>
     *                   </ul>
     */
    public function getDefaultViewName() {
        return 'Input';
    }


    public function executeWrite(AgaviRequestDataHolder $rd) {

        $recaptchaChallenge = $rd->getParameter('recaptcha_challenge_field');
        $recaptchaResponse = $rd->getParameter('recaptcha_response_field');

        $reCaptcha = $this->getContext()->getModel('ReCaptcha', 'reCaptcha');

        try {
            if (!$this->getContext()->getUser()->isAuthenticated()) {
                $reCaptcha->checkAnswer($recaptchaChallenge, $recaptchaResponse);
            }
            $hash = md5(AgaviToolkit::uniqid());
            $boundary = sprintf("PHP-ALT-%s", $hash);
            $headers = sprintf("from: %s <%s>\r\nContent-Type: multipart/alternative; boundary=\"%s\"",
                    $rd->getParameter('name'),
                    $rd->getParameter('email'),
                    $boundary);

            $mailMessage = <<<MAILMESSAGE
--${boundary}
Content-Type: text/plain

%s

--${boundary}
Content-Type: text/html

%s

--${boundary}
MAILMESSAGE;
            //todo : check for other entities like &nbsp;
            $mailMessage = sprintf($mailMessage, 
                    htmlspecialchars_decode(strip_tags(preg_replace("/<br\/?>/", "\n", $rd->getParameter('message')))),
                    $rd->getParameter('message'));

            mail(
                    AgaviConfig::get('Contact.email'),
                    trim(AgaviConfig::get('Contact.subjectPrefix').' '.$rd->getParameter('subject')),
                    $mailMessage, //$rd->getParameter('message')),
                    $headers //sprintf('from: %s <%s>', $rd->getParameter('name'), $rd->getParameter('email'))
            );
            return 'Success';
        } catch (Exception $e) {
            $this->setAttribute('reCaptchaError', $e->getMessage());
            return 'Error';
        }

    }
}

?>