<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CaNhanController;
use Closure;
use Illuminate\Http\Request;

class kiemTraDangNhapSinhVien
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        if((new CaNhanController)->isSinhVien())
            return $next($request);
//        return redirect()->route('login');
    }
}
