<?php

namespace App\Http\Controllers;

use Laracasts\Flash\FlashNotifier;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Guard;

class EmailsController extends Controller
{
    protected $flash;
    protected $auth;

    public function __construct(FlashNotifier $flash, Guard $auth)
    {
        $this->flash = $flash;
        $this->auth = $auth;
    }
}