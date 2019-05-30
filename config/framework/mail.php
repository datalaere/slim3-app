<?php

$container['mailer'] = function($c) {
    $settings = $c->get('settings')['mail'];
    $twig = $c['view'];
    $mailer = new \Anddye\Mailer\Mailer($twig, $settings);
        
    // Set the details of the default sender
    $mailer->setDefaultFrom(
        $settings['default']['email'], 
        $settings['default']['from']
    );
    
    return $mailer;
};
