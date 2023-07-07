<?php

namespace App\Services\Image;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    protected $image = null;
    protected bool $fromRemoteServer = false;

    protected string $name;

    protected string $extension;

    protected string $mainPath = 'app' . DIRECTORY_SEPARATOR . 'public';

    public function load($image, Model $model): static
    {
        $this->mainPath = $this->mainPath . DIRECTORY_SEPARATOR . $this->makePathFromModelName($model);

        $this->image = \Intervention\Image\Facades\Image::make($image);
        if (is_string($image)) {
            $this->fromRemoteServer = true;
        }
        $this->extension = $this->getExtension();
        if (config('file_storage.progressive_image', default: true)) {
            $this->extension = '.webp';
            $this->image->encode('webp', 90);
        }
        return $this;
    }

    protected function generateName(): string
    {
        $this->name = uniqid() . '_download';
        return $this->name;
    }

    protected function getExtension(): string
    {
        return match ($this->image->mime()) {
            'image/jpeg' => '.jpg',
            'image/png' => '.png',
            'image/gif' => '.gif',
            default => '.jpeg',
        };
    }

    public function getPath(bool $isThumbnail = false): string
    {

        $dir = storage_path($this->mainPath . DIRECTORY_SEPARATOR . ($isThumbnail ? 'thmb' : 'full'));

        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        return $dir;
    }

    public function getPathForDelete(string $path, bool $isThumbnail = false): string
    {
        return 'public' . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . ($isThumbnail ? 'thmb' : 'full');
    }

    public function optimizeResolution(): static
    {
        if ($this->image->width() > 1500) {
            $this->resize(1200);
        }
        return $this;
    }

    public function resize(?int $width = null, ?int $height = null): static
    {
        $this->image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        return $this;
    }

    public function setName($name): static
    {
        $this->name = $name;
        return $this;
    }

    public function save(bool $withThumbnail = true, int $quality = 90): bool|string
    {
        $name = ($this->name ?? $this->generateName()) . $this->extension;
        if ($this->image->save($this->getPath() . DIRECTORY_SEPARATOR . $name, $quality)) {
            if ($withThumbnail) {
                $this->resize(300);
                $this->image->save($this->getPath(true) . DIRECTORY_SEPARATOR . $name, $quality);
            }
            return $name;
        }
        return false;
    }

    public function delete(string $image, string $path, bool $withThumbnail = true): bool
    {
        Storage::delete($this->getPathForDelete($path) . DIRECTORY_SEPARATOR . $image);
        if ($withThumbnail) {
            Storage::delete($this->getPathForDelete($path, true) . DIRECTORY_SEPARATOR . $image);
        }
        return true;
    }

    protected function makePathFromModelName($model): string
    {
        $model = get_class($model);
        $modelName = explode('\\', $model);
        return strtolower($modelName[array_key_last($modelName)]);
    }

}
