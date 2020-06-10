<?php

namespace App\Stubs;

use App\AuthenticatorInterface;
use App\User;

class AuthenticatorStub implements AuthenticatorInterface
{
  private $loggued;

  public function __construct($loggued = true)
  {
    $this->loggued = $loggued;
  }

  public function check()
  {
    return $this->loggued;
  }

  public function user()
  {
    return new User([
      'role' => 'admin'
    ]);
  }
}