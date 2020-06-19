<?php

namespace App;

use Closure;
use InvalidArgumentException;
use ReflectionClass;

class Container
{
  protected $shared = [];
  protected $bindings = [];

  public function  bind($name, $resolver)
  {
    $this->bindings[$name] = [
      'resolver' => $resolver
    ];
  }

  public function instance($name, $object)
  {
    $this->shared[$name] = $object;
  }

  public function make($name)
  {
    if (isset ($this->shared[$name])) {
      return $this->shared[$name];
    }

    $resolver = $this->bindings[$name]['resolver'];

    if ($resolver instanceof Closure) {
      $object = $resolver($this);
    } else {
      $object = $this->build($resolver);
    }

    return $object;
  }

  public function build($name)
  {
    $reflection = new ReflectionClass($name);

    if ( ! $reflection->isInstantiable() ) {
      throw new InvalidArgumentException("$name is not instantiable");
    }

    $costructor = $reflection->getConstructor();

    if ( is_null($costructor) ) {
      return new $name;
    }

    $constructorParameters = $costructor->getParameters();

    $arguments = [];

    foreach($constructorParameters as $constructorParameter) {
      $parameterClassName = $constructorParameter->getClass()->getName();

      $arguments[] = $this->build($parameterClassName);
    }

    return $reflection->newInstanceArgs($arguments);
  }
}
