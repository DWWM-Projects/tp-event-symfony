<?php

namespace App\DataFixtures;

use App\Entity\Event;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    

    public function load(ObjectManager $manager): void
    {
        $time1 = new DateTime('2022-09-01 13:00:00');
        $time2 = new DateTime('2022-09-02 21:00:00');
        $time3 = new DateTime('2022-09-02 23:00:00');
        $time4 = new DateTime('2022-09-01 14:00:00');
        $time5 = new DateTime('2022-09-04 17:00:00');
        $time6 = new DateTime('2022-09-05 23:30:00');

        $event = new Event();
        $event->setName('Concert Alborosie');
        $event->setDescription('Un concert de reaggae avec Alborosie en vedette.');
        $event->setPrice(35);
        $event->setCreated($time1);
        $event->setStart($time2);
        $event->setEnd($time3);
        $event->setImage('null');
        $manager->persist($event);

        $event = new Event();
        $event->setName('Festival de l\'été');
        $event->setDescription('Mickey3D, Pierpoljak, Vianney, Bob Sinclar');
        $event->setPrice(45);
        $event->setCreated($time4);
        $event->setStart($time5);
        $event->setEnd($time6);
        $event->setImage('null');
        $manager->persist($event);

        $manager->flush();
    }
}
