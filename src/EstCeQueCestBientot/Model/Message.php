<?php

namespace EstCeQueCestBientot\Model;

/**
 * Class defining a Message
 */
class Message
{
    /**
     * @var string
     */
    private $message;

    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * @var boolean
     */
    private $itsTime;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->start = new \DateTime();
        $this->end = new \DateTime();
        $this->itsTime = false;
    }

    /**
     * Returns the message start datetime
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Sets the message start datetime
     * @param  int     $startHour
     * @param  int     $startMinute
     * @return Message
     */
    public function setStart($startTime)
    {
        $this->start = \DateTime::createFromFormat('H:i', $startTime);

        return $this;
    }

    /**
     * Returns the message end datetime
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Sets the message end datetime
     * @param  int     $startHour
     * @param  int     $startMinute
     * @return Message
     */
    public function setEnd($endTime)
    {
        $this->end = \DateTime::createFromFormat('H:i', $endTime);

        return $this;
    }

    /**
     * Gets the message to be displayed
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets the message to be displayed
     * @param  string  $message
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Gets the coffee time flag
     * @return boolean
     */
    public function isItTime()
    {
        return $this->itsTime;
    }

    /**
     * Sets the coffee time flag
     * @param  boolean $coffeeTime
     * @return Message
     */
    public function setItsTime($coffeeTime)
    {
        $this->itsTime = $coffeeTime;

        return $this;
    }
}
