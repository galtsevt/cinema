<?php

namespace App\Traits;

use App\Services\Image\ImageService;

trait HasImage
{
    public function loadImage($image, string $attributeName, bool $withThumbnail = true): void
    {
        $imageService = new ImageService();
        $this->$attributeName = $imageService->load($image, $this)->save($withThumbnail, 90);
    }

    public function getImageFull(string $attributeName): ?string
    {
        if ($this->$attributeName) {
            return $this->getImagePath('full') . $this->$attributeName;
        }
        return null;
    }

    public function getImagePreview(string $attributeName): ?string
    {
        if ($this->$attributeName) {
            return $this->getImagePath('thmb') . $this->$attributeName;
        }

        return null;
    }

    protected function getImagePath($type): string
    {
        return '/storage/' . $this->getPathFromModelName() . '/' . $type . '/';
    }

    public function getPathFromModelName(): string
    {
        $modelName = explode('\\', get_class($this));
        return strtolower(end($modelName));
    }
}
