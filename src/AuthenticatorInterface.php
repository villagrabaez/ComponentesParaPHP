<?php

namespace App;

interface AuthenticatorInterface
{
  /**
   * @return boolean
   */
  public function check();

  /**
   * @return \App\User
   */
  public function user();
}