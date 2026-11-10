<?php

namespace WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Kevinrob\GuzzleCache\Storage;

use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Kevinrob\GuzzleCache\CacheEntry;
use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\League\Flysystem\Filesystem;
use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\League\Flysystem\FilesystemAdapter;
use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\League\Flysystem\FilesystemException;

class FlysystemStorage implements CacheStorageInterface
{

    /**
     * @var Filesystem
     */
    protected $filesystem;

    public function __construct(FilesystemAdapter $adapter)
    {
        $this->filesystem = new Filesystem($adapter);
    }

    /**
     * @inheritdoc
     */
    public function fetch($key)
    {
        if ($this->filesystem->fileExists($key)) {
            // The file exist, read it!
            $data = @unserialize(
                $this->filesystem->read($key)
            );

            if ($data instanceof CacheEntry) {
                return $data;
            }
        }

        return;
    }

    /**
     * @inheritdoc
     */
    public function save($key, CacheEntry $data)
    {
      try {
        $this->filesystem->write($key, serialize($data));
        return true;
      } catch (FilesystemException $e) {
        return false;
      }
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key)
    {
        try {
            return $this->filesystem->delete($key);
        } catch (FilesystemException $ex) {
            return true;
        }
    }
}
