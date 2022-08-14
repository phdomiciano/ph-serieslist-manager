<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Interfaces\ProductInterface;

class UsersAutenticator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            throw new AuthenticationException();
        }
        return $next($request);
    }

    // verify if the user is owner of product
    public function owner(ProductInterface $product){
        $user = Auth::user();
        if($product->getUserId() != $user->id){
            throw new AuthenticationException();
        }
    }
}
