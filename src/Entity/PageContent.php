<?php
/**
 * This file was created as part of a British Websites project
 *
 * Copyright (c) 2017 Daniel West <daniel@silverback.is>
 *
 * Once the project is fully paid, this copyright is passed to the British Websites
 * client without the need to modify this comment.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code. If there is none, then
 * this work is proprietary
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageContentRepository")
 */
class PageContent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Page", inversedBy="content")
     * @var Page
     */
    private $page;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $content;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Page
     */
    public function getPage(): Page
    {
        return $this->page;
    }

    /**
     * @param Page $page
     */
    public function setPage(Page $page)
    {
        $this->page = $page;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }
}
