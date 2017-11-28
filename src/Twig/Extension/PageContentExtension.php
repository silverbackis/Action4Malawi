<?php

namespace App\Twig\Extension;

use App\Entity\Page;
use Doctrine\ORM\EntityManagerInterface;

class PageContentExtension extends \Twig_Extension
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return [
          new \Twig_SimpleFunction('page_content', [$this, 'getPageContent'], [
              'is_safe' => ['html']
          ])
        ];
    }

    public function getPageContent(string $pageName)
    {
        /**
         * @var Page $page
         */
        $page = $this->em->getRepository(Page::class)->findOneBy([
            'name' => $pageName
        ]);
        $content = $page->getContent()->first();
        return $content ? $content->getContent() : null;
    }
}