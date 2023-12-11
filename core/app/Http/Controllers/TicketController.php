<?php

namespace App\Http\Controllers;

use App\Traits\SupportTicketManager;

class TicketController extends Controller
{
    use SupportTicketManager;

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();

        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });

        $this->layout = 'frontend';
        if (auth()->check() && $this->user->isAuthorized()) {
            $this->layout = 'master';
        }
        $this->userType = 'user';
        $this->column = 'user_id';
    }
}
