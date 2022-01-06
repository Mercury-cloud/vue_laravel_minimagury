<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RaspberryPiAuthenticate
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
        // RaspberryPiからのアクセスをチェック

        // 入力値チェック
        if (!$request->has('secret_token'))
            return response()->json([
                'success' => false, 
                'message' => 'secret_tokenを指定してください'
            ], 403);
        // secret tokenチェック
        if ($request->get('secret_token') != env('SECRET_TOKEN'))
            return response()->json([
                'success' => false, 
                'message' => $request->get('secret_token').' 正しいsecret_tokenを指定してください'
            ], 403);

        return $next($request);
    }
}
