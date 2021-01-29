<?php namespace App\Http\Middleware;
/**
 *
 * This file is part of the software provided by AppsWWW <http://www.appswww.com>
 *
 * Reproduce, re-sell, distribute, sublicense, disclose, market,
 * rent, lease or transfer the Licensed Software is not permitted
 * by this Agreement
 *
 *
 * For full copyright and license information, please visit
 * http://www.appswww.com/license-agreement/
 *
 * @copyright (c) Laimonas Prei (l.preisas@gmail.com)
 */

use Closure, Session;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class App extends BaseVerifier {

    /**
     * The availables languages.
     *
     * @array $languages
     */
    protected $languages = ['en','fr'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(! Session::has('locale'))
        {
            Session::put('locale', 'en'); //HARDCODED FOR EN!!!
        }

        app()->setLocale(Session::get('locale'));

        return $next($request);
    }

}
