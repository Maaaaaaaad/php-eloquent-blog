<?php

namespace App;

class InMemoryKV
{
    private $dbmemory;

    public function __construct($dbmemory, $initial = [])
    {
        $this->dbmemory = $dbmemory;

        array_map(fn($key, $value) => $this->set($key, $value), array_keys($initial), $initial);
    }

    public function set($key, $value)
    {
        $content = $this->dbmemory;
        $data = $content ? $content : [];
        $data[$key] = $value;
        $this->dbmemory = $data;
    }

    public function unset($key)
    {
        $data = $this->dbmemory;
        unset($data[$key]);
        $this->dbmemory = $data;
    }

    public function get($key, $default = null)
    {
        $content = $this->dbmemory;
        return $content[$key] ?? $default;
    }

    public function toArray()
    {
        $content = $this->dbmemory;
        return $content;
    }
}
