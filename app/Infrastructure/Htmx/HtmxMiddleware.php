<?php

namespace App\Infrastructure\Htmx;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as BaseResponse;

/**
 * Add specific headers for handling form errors gracefully with HTMX
 */
class HtmxMiddleware
{
    public function handle($request, \Closure $next): BaseResponse
    {
        $response = $next($request);
        if (
            $response instanceof Response &&
            $request->header('HX-Request') &&
            $request->session()->has('errors')
        ) {
            // We want to only replace the form that sent the request to display errors
            $target = sprintf('#%s', $request->header('HX-Target'));
            $response = $response
                ->withHeaders([
                    'HX-Retarget' => $target,
                    'HX-Reswap' => 'outerHTML',
                    'HX-Reselect' => $target,
                ])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $response;
    }
}
