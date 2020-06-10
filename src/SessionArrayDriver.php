<?php

namespace App;

class SessionArrayDriver implements SessionDriverInterface
{
  protected $data;

  public function __construct(array $data = [])
  {
    $this->data = $data;
  }

  public function load()
  {
    return $this->data;
  }
}