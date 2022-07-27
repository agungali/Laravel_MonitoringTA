<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Providers\RouteServiceProvider;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (in_array($request->user()->role, $roles)) {
            return $next($request);
        }
        if (Auth::user()->role == 'admin') {
            return redirect(RouteServiceProvider::ADMIN);
            //return Redirect::to('admin');
        } elseif (Auth::user()->role == 'dosen') {
            return redirect(RouteServiceProvider::DOSEN);
            //return Redirect::to('dosen');
        } elseif (Auth::user()->role == 'mahasiswa') {
            return redirect(RouteServiceProvider::MAHASISWA);
            //return Redirect::to('mahasiswa');
        }
        
    }
}
