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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PageContent", mappedBy="page")
     * @var ArrayCollection
     */
    private $content;

    public function __construct()
    {
        $this->content = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return Collection
     */
    public function getContent(): Collection
    {
        return $this->content;
    }

    /**
     * @param array $content
     */
    public function setContent(array $content)
    {
        foreach ($content as $item)
        {
            $this->addContent($item);
        }
    }

    /**
     * @param PageContent $pageContent
     */
    public function addContent(PageContent $pageContent)
    {
        $this->content->add($pageContent);
    }

    public function __toString()
    {
        return ucwords($this->getName());
    }
}
