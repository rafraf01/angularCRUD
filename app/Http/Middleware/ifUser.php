<?php
/**
 * Created by PhpStorm.
 * User: rafael.delacruz
 * Date: 2/8/18
 * Time: 9:41 AM
 */

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Types\AccountType;
class ifUser {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return Auth::user()->account_type == AccountType::USR ? $next($request) : redirect('/logout');
    }
} 