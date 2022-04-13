<?php

namespace App\Classe;
use App\Entity\User;
use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = "98f668da877187f2843b53b287cfcc7b";
    private $api_key_secret = "65d5f959d808c4e2eeabdf45dd478d71";

    public function send($to_email, $to_name, $subject, $customerName, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret, true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "support@wellshape.fr",
                        'Name' => "Support BIGDEAL"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 3833895,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'customerName' => $customerName,
                        'content' => $content,
                        ]
                ]
            ]
        ];
        $mj->post(Resources::$Email, ['body' => $body]);
    }
}