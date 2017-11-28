<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class GalleryImage
 * @package App\Entity
 * @author Daniel West <daniel@silverback.is>
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable()
 */
class GalleryImage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string|null
     */
    private $path;

    /**
     * @Vich\UploadableField(mapping="gallery", fileNameProperty="path")
     * @var File|null
     */
    private $file;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $width = 0;

    /**
     * @ORM\Column(type="integer", )
     * @var int
     */
    private $height = 0;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null
     */
    private $caption;

    /**
     * @ORM\PrePersist()
     */
    public function prePersistUpdate()
    {
        $this->updatedAt = new \DateTime('now');
        $file = $this->getFile();
        if (!$file) {
            if (!$this->getPath()) {
                $this->width = 0;
                $this->height = 0;
            }
        } else {
           list($this->width, $this->height) = getimagesize($file->getRealPath());
        }
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param string|null $path
     */
    public function setPath(string $path = null)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param File|null $image
     */
    public function setFile(File $image = null)
    {
        $this->file = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File|null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return null|string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param null|string $caption
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
    }
}
