<?php

namespace App\DataFixtures\ORM;

use App\Entity\Page;
use App\Entity\PageContent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ServiceSubscriberInterface;
use Twig\Environment;

/**
 * Class PageFixtures
 * @package App\DataFixtures\ORM
 * @author Daniel West <daniel@silverback.is>
 */
class PageFixtures extends Fixture implements ServiceSubscriberInterface
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var ObjectManager
     */
    private $manager;


    public static function getSubscribedServices()
    {
        return [
            'twig' => '?' . Environment::class
        ];
    }

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->twig = $this->container->get('twig');

        $this->createPage('home');
        $this->createPage('about');
        $this->createPage('partners');
        $this->createPage('volunteering');
        $this->createPage('gallery');
        $this->createPage('contact');
        $this->createPage('donate');
        $this->createPage('register');
        $this->createPage('suggest');

        $manager->flush();
    }

    private function createPage(string $name)
    {
        $page = new Page();
        $page->setName($name);
        $this->manager->persist($page);
        $this->createPageContent($page);
        return $page;
    }

    private function createPageContent(Page $page)
    {
        try{
            $content = $this->twig->render('text/' . $page->getName() . '.html.twig');
            $pageContent = new PageContent();
            $pageContent->setContent($content);
            $pageContent->setPage($page);
            $page->addContent($pageContent);
            $this->manager->persist($pageContent);
        } catch(\Exception $e){}
    }
}
