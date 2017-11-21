<?php

namespace App\Entity;

use Symfony\Component\Finder\SplFileInfo;

class GalleryImage
{
    /**
     * @var string|null
     */
    private $path = null;
    /**
     * @var int
     */
    private $width = 0;
    /**
     * @var int
     */
    private $height = 0;

    public function __construct(
        SplFileInfo $file,
        string $splitDir
    )
    {
        if (in_array($file->getExtension(), GalleryImageCollection::FILE_EXT)) {
            $this->path = explode($splitDir, $file->getPathname())[1];
            list($width, $height) = getimagesize($file->getRealPath());
            $this->width = $width;
            $this->height = $height;
        }
    }

    /**
     * @return null|string
     */
    public function getPath(): ?string
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
}