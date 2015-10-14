<?php

namespace EstCeQueCestBientot\Service;

use EstCeQueCestBientot\Model\Message;
use EstCeQueCestBientot\Exception\MessageNotFoundException;
use EstCeQueCestBientot\Service\ConfigurationService;

/**
 * Service handling messages
 */
class MessageService
{
    /**
     * @var array
     */
    private $yamlParser;

    /**
     * @param $configFile
     */
    public function __construct($configFile)
    {
        $this->yamlParser = Yaml::parse($configFile);
    }

    /**
     * Fetching messages from the Yaml file
     * @return array
     */
    public function fetchAll()
    {
        $messages = array();
        $messagesFromFile = $this->yamlParser['messages'];
        
        foreach ($messagesFromFile as $messageFromFile) {
            $message = new Message();
            $message->setMessage($messageFromFile['message'])
                    ->setStart($messageFromFile['startTime'])
                    ->setEnd($messageFromFile['endTime']);
            if (array_key_exists('itsTime', $messageFromFile)) {
                $message->setItsTime($messageFromFile['itsTime']);
            }

            $messages[] = $message;
        }

        return $messages;
    }

    /**
     * @param  \DateTime                $dateTime
     * @return Message
     * @throws MessageNotFoundException
     */
    public function getMessageAt(\DateTime $dateTime)
    {
        $messages = $this->fetchAll();
        $message = null;

        if (empty($messages)) {
            throw new MessageNotFoundException();
        }

        foreach ($messages as $msg) {
            if ($msg->getStart() <= $dateTime && $dateTime <= $msg->getEnd()) {
                $message = $msg;
                break;
            }
        }
        
        if (empty($message)) {
            throw new MessageNotFoundException();
        }

        return $message;
    }
}
