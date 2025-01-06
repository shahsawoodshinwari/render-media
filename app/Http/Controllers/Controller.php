<?php

namespace App\Http\Controllers;

abstract class Controller
{
  /**
   * Indicates if the resource should be paginated.
   */
  public bool $shouldPaginate;

  /**
   * Create a new controller instance.
   */
  public function __construct()
  {
    $this->shouldPaginate = request()->boolean('should_paginate');
  }
}
