<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class VideoFixtures extends Fixture implements DependentFixtureInterface
{

    public const VIDEO_REFERENCE = 'video';
    public function load(ObjectManager $manager): void
    {

        $trickNames = array("bluntslide", "corked-spin", "indy", "nose-press", "ollie-nollie", "rodeo", "tail", "tamedog", "tripod", "weddle");
        $videoLinks = array(
            '<iframe width="560" height="315" src="https://www.youtube.com/embed/6yA3XqjTh_w?si=OZlItTy3ftQ0wNZG" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="560" height="315" src="https://www.youtube.com/embed/4AlDWWsprZM?si=8sXIQWGrpuGMSUsw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="560" height="315" src="https://www.youtube.com/embed/c1vfTvXjVxY?si=Fn0TGTkvMJHzxiPN" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="560" height="315" src="https://www.youtube.com/embed/Kv0Ah4Xd8d0?si=dWVDeDTLePxFIxDs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="560" height="315" src="https://www.youtube.com/embed/aAzP3wNT220?si=GY5LKkWCIFbrXUhc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="560" height="315" src="https://www.youtube.com/embed/Px2YuKQVS_g?si=BztqaBZClScMfWve" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="560" height="315" src="https://www.youtube.com/embed/P6crQSwDjJY?si=ZC6iEsKC3A1fC8Ww" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="560" height="315" src="https://www.youtube.com/embed/qqNV0tI3Z4k?si=NLO-3qtthSN-ikNQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="560" height="315" src="https://www.youtube.com/embed/g0ge8fn1EpI?si=QWMmpD6izWFVZboP" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            '<iframe width="560" height="315" src="https://www.youtube.com/embed/O5DpwZjCsgA?si=QjjU26f_ZW8h1iCH" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>'
        );


        foreach ($trickNames as $trickName) {

            $video = new Video();
            $video->setTrick($this->getReference($trickName));
            $videoLinksRandKey = array_rand($videoLinks);
            $video->setLink($videoLinks[$videoLinksRandKey]);
            $manager->persist($video);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            TrickFixtures::class,
        );
    }
}
