<?php

namespace App;

use App\Authenticator;
class AccessHandler
{
  protected $authenticator;

  public function __construct(Authenticator $authenticator)
  {
    $this->authenticator = $authenticator;
  }

  public function check($role)
  {
    return $this->authenticator->check() && $this->authenticator->user()->role === $role;
  }
}