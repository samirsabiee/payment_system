<?php


namespace App\Support\Storage;


use Countable;
use Session;

class SessionStorage implements Contracts\StorageInterface, Countable
{
    private string $bucket;

    /**
     * SessionStorage constructor.
     * @param string $bucket
     */
    public function __construct(string $bucket = 'default')
    {
        $this->bucket = $bucket;
    }


    public function get($index)
    {
        return Session::get($this->bucket . "." . $index);
    }

    public function set($index, $value)
    {
        Session::put($this->bucket . "." . $index, $value);
    }

    public function all()
    {
        return Session::get($this->bucket) ?? [];
    }

    public function exist($index): bool
    {
        return Session::has($this->bucket . "." . $index);
    }

    public function unset($index)
    {
        Session::forget($this->bucket . "." . $index);
    }

    public function clear()
    {
        Session::forget($this->bucket);
    }

    public function count(): int
    {
        return count($this->all());
    }
}
