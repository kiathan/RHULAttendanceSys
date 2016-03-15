<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class apiSignIn
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = \App\User::where("username", $request->get('username'))->first();

        if (!is_null($user) && $user->checkToken($request->get('token'))) {
            $this->auth->login($user);
        }

        if (!is_null($user) && env('APP_DEBUG') && ($request->get('token') == "login")) {
            $this->auth->login($user);
        }


        if ($this->auth->guest()) {
            $errorRepose = array();
            $errorRepose['status'] = "error";
            $errorRepose['message'] = "token out of date, please sign in again";
            return json_encode($errorRepose);

        }

        return $next($request);
    }

}
