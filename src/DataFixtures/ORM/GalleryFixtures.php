<?php

namespace App\DataFixtures\ORM;

use App\Entity\GalleryImage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\File;

class GalleryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $finder = new Finder();
        $projectDir = $this->container->getParameter('kernel.project_dir');
        $galleryDir = $this->container->getParameter('app.path.gallery');
        $imageFiles = $finder->files()->name('/\.(jpg|png)$/')->in($projectDir . '/public' . $galleryDir);
        /**
         * @var $file File
         */
        foreach ($imageFiles as $file)
        {
            $image = new GalleryImage();
            $exploded = explode($galleryDir, $file->getRealPath());
            $image->setPath($exploded[1]);
            $image->setFile(new File($file->getRealPath()));
            $manager->persist($image);
        }
        $manager->flush();
    }
}