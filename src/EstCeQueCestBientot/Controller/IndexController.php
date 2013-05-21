<?php

namespace EstCeQueCestBientot\Controller;

use Silex\Application;
use EstCeQueCestBientot\Model\Message;
use EstCeQueCestBientot\Exception\MessageNotFoundException;

/**
 * Unique controller handling messages and returning them to the twig template
 */
class IndexController {

    /**
     * @param Application $app
     */
    public function indexAction(Application $app) {
        $now = new \DateTime();

        try {
            $message = $app['message.service']->getMessageAt($now);
        } catch (MessageNotFoundException $e) {
            $message = new Message();
            $message->setMessage($app['config.service']->getDefaultMessage());
        }

        return $app['twig']->render('index.html.twig', array(
                    'title' => $app['config.service']->getAppTitle(),
                    'extraMessage' => $app['config.service']->getExtraMessage(),
                    'message' => $message
        ));
    }

}
