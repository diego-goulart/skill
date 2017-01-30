<?php

namespace Skill\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Routing\Redirector;

class LogSuccessfulLogin
{
	/**
	 * @var Redirector
	 */
	private $redirector;

	/**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Redirector $redirector)
    {
        //
	    $this->redirector = $redirector;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if($event->user->isSupervisor())
        {
        	$this->redirector->route('admin.users.index');
        }
    }
}
