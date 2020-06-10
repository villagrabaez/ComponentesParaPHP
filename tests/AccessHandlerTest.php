<?php

use PHPUnit\Framework\TestCase;
use App\AccessHandler;
use App\Authenticator;
use App\SessionArrayDriver;
use App\SessionManager;
use App\Stubs\AuthenticatorStub;

class AccessHandlerTest extends TestCase
{
  public function test_grant_access()
  {
    // $driver = new SessionArrayDriver([
    //   'user_data' => [
    //     'name' => 'Bernardino',
    //     'role' => 'admin'
    //   ]
    // ]);

    // $session = new SessionManager($driver);
    // $auth = new Authenticator($session);
    $auth = new AuthenticatorStub();
    $access = new AccessHandler($auth);

    $this->assertTrue($access->check('admin'));
  }

  public function test_deny_access()
  {
    // $driver = new SessionArrayDriver([
    //   'user_data' => [
    //     'name' => 'Bernardino',
    //     'role' => 'admin'
    //   ]
    // ]);

    // $session = new SessionManager($driver);
    // $auth = new Authenticator($session);
    $auth = new AuthenticatorStub();
    $access = new AccessHandler($auth);

    $this->assertFalse($access->check('editor'));
  }
}
