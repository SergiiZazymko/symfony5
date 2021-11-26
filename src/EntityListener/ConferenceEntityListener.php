<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\Conference;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 *
 */
class ConferenceEntityListener
{
    /**
     * ConferenceEntityListener constructor.
     *
     * @param SluggerInterface $slugger
     */
    public function __construct(
        private SluggerInterface $slugger,
    ) {}

    /**
     * @param Conference $conference
     * @param LifecycleEventArgs $event
     */
    public function prePersist(Conference $conference, LifecycleEventArgs $event): void
    {
        $conference->computeSlug($this->slugger);
    }

    /**
     * @param Conference $conference
     * @param LifecycleEventArgs $event
     */
    public function preUpdate(Conference $conference, LifecycleEventArgs $event): void
    {
        $conference->computeSlug($this->slugger);
    }
}
