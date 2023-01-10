<?php

namespace Phplover\Libraries;

use Nette\Utils\FileSystem;

/**
 * File based Caching System
 */
class Cache
{

    // check if a cache file exists
    public function cacheExists(string $file)
    {
        if (file_exists(CACHEPATH . $file))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // create a cache file
    public function createCache(string $data, string $file)
    {
        FileSystem::write(CACHEPATH . $file, $data);
    }

    // read a cache file
    public function readCache(string $file)
    {
        if (file_exists(CACHEPATH . $file))
        {
            return FileSystem::read(CACHEPATH . $file);
        } else {
            return false;
        }
    }

    // delete a cache file
    public function deleteCache(string $file)
    {
        if (file_exists(CACHEPATH . $file))
        {
            FileSystem::delete(CACHEPATH . $file);
        }
    }

    // delete all cache files
    public function deleteAllCache()
    {

        // delete cache directory
        FileSystem::delete(CACHEPATH);

    }

}