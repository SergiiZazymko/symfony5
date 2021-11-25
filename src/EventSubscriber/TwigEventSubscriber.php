<?php

namespace App\EventSubscriber;

use App\Repository\ConferenceRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

/**
 *
 */
class TwigEventSubscriber implements EventSubscriberInterface
{
    /**
     * TwigEventSubscriber constructor.
     *
     * @param Environment $twig
     * @param ConferenceRepository $conferenceRepository
     */
    public function __construct(
        private Environment $twig,
        private ConferenceRepository $conferenceRepository,
    ) {}

    /**
     * @param ControllerEvent $event
     */
    public function onKernelController(ControllerEvent $event): void
    {
        $conferences = $this->conferenceRepository->findAll();
        $this->twig->addGlobal('conferences', $conferences);
    }

    /**
     * @return string[]
     */
    public static function getSubscribedEvents()
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}
