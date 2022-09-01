<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Date;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    

    public function load(ObjectManager $manager): void
    {

        $date = new Date();
        $datetime = new DateTime();

        $event = new Event();
        $event->setName('Concert Alborosie');
        $event->setDescription('Un concert de reaggae avec Alborosie en vedette.');
        $event->setPrice(35);
        $event->setCreatedAt($date('2022-08-23'));
        $event->setStart($datetime('2022-09-02 21:00:00'));
        $event->setEnd($datetime('2022-09-02 23:00:00'));
        $event->setImage('null');
        $manager->persist($event);

        $event = new Event();
        $event->setName('Festival de l\'été');
        $event->setDescription('Mickey3D, Pierpoljak, Vianney, Bob Sinclar');
        $event->setPrice(45);
        $event->setCreatedAt($date('2022-08-22'));
        $event->setStart($datetime('2022-09-04 17:00:00'));
        $event->setEnd($datetime('2022-09-05 23:30:00'));
        $event->setImage('null');
        $manager->persist($event);

        $manager->flush();
    }
}
