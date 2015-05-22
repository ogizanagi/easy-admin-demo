<?php

namespace AppBundle\Event\Subscriber;

use JavierEguiluz\Bundle\EasyAdminBundle\Event\EasyAdminEvent;
use JavierEguiluz\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminEventSubscriber implements EventSubscriberInterface
{
    private $templating;

    function __construct(TwigEngine $templating)
    {
        $this->templating = $templating;
    }

    public static function getSubscribedEvents()
    {
        return array(
            EasyAdminEvents::POST_LIST => array('onPostList'),
        );
    }

    public function onPostList(EasyAdminEvent $event)
    {
        $event->addAdditionalField('testExtra', function ($entity, array $config) {
            return $this->templating->render('AppBundle:EasyAdmin:testExtra.field.html.twig', array(
                'class' => get_class($entity),
                'entity' => $entity,
                'config' => $config,
            ));
        });
    }
}
