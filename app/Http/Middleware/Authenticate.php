<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function unauthenticated($request, array $guards)
    {
        // ពិនិត្យមើលបើជា Request ធម្មតា (មិនមែន API/JSON)
        if (! $request->expectsJson()) {
            // បង្កើត RedirectResponse រួចបាញ់ Session Message ទៅកាន់ Home
            abort(redirect()->route('home')->with('warning', 'សូមធ្វើការ Login ជាមុនសិន ទើបអាចចូលប្រើប្រាស់បាន!'));
        }

        parent::unauthenticated($request, $guards);
    }
}
