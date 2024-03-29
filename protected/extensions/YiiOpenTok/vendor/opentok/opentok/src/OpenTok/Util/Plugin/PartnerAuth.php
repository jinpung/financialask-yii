<?php

namespace OpenTok\Util\Plugin;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Guzzle\Common\Event;

/**
* @internal
*/
class PartnerAuth implements EventSubscriberInterface
{
    protected $apiKey;
    protected $apiSecret;

    public static function getSubscribedEvents()
    {
        return array('request.before_send' => 'onBeforeSend');
    }

    public function __construct($apiKey, $apiSecret)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }

    public function onBeforeSend(Event $event)
    {
        $request = $event['request'];
        $request->addHeader('X-TB-PARTNER-AUTH', $this->apiKey.':'.$this->apiSecret);
    }
}
