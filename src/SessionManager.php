<?php

namespace App;

class SessionManager
{
  protected $data = [];
  protected $driver;

  public function __construct(SessionDriverInterface $driver)
  {
    $this->driver = $driver;

    $this->load();
  }

  public function load()
  {
    $this->data = $this->driver->load();
  }

  public function get($key)
  {
    return isset($this->data[$key])
      ? $this->data[$key]
      : null;
  }
}