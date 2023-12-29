<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Traits\SupportTicketManager;

class AgentTicketController extends Controller
{
    use SupportTicketManager;

    public function __construct()
    {
        $this->activeTemplate = '';

        $this->middleware(function ($request, $next) {
            $this->user = authAgent();
            return $next($request);
        });
        $this->layout = 'master';
        $this->userType = 'agent';
        $this->column = 'agent_id';
    }
}
