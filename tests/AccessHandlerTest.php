<?php

use PHPUnit\Framework\TestCase;
use App\AccessHandler;
use App\Authenticator;
use App\SessionFileDriver;
use App\SessionManager;

class AccessHandlerTest extends TestCase
{
  public function test_grant_access()
  {
    $driver = new SessionFileDriver();
    $session = new SessionManager($driver);
    $auth = new Authenticator($session);
    $access = new AccessHandler($auth);

    $this->assertTrue($access->check('admin'));
  }

  public function test_denied_access()
  {
    $driver = new SessionFileDriver();
    $session = new SessionManager($driver);
    $auth = new Authenticator($session);
    $access = new AccessHandler($auth);

    $this->assertFalse($access->check('editor'));
  }
}