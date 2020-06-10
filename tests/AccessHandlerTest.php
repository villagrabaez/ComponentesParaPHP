<?php

use PHPUnit\Framework\TestCase;
use App\AccessHandler;
use App\Authenticator;
use App\User;

class AccessHandlerTest extends TestCase
{
  protected $access;

  public function setUp() : void
  {
    $this->access = new AccessHandler($this->getAuthenticatorMock());
  }

  public function tearDown() : void
  {
    Mockery::close();
  }

  public function test_grant_access()
  {
    $this->assertTrue($this->access->check('admin'));
  }

  public function test_deny_access()
  {
    $this->assertFalse($this->access->check('editor'));
  }

  protected function getAuthenticatorMock()
  {
    $user = Mockery::mock(User::class);
    $user->role = 'admin';

    $auth = Mockery::mock(Authenticator::class);

    $auth->shouldReceive('check')
      ->once()
      ->andReturn(true);

    $auth->shouldReceive('user')
      ->once()
      ->andReturn($user);

    return $auth;
  }
}
