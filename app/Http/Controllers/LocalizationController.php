<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class LocalizationController extends Controller
{
    public function setLocale(Request $request, $locale)
    {

        if (!in_array($locale, config('app.locales'))) {
            abort(404);
        }

        $request->session()->put('locale', $locale);

        $previousUrl = URL::previous();
        $previousUrlWithoutLocale = $this->removeLocaleFromUrl($previousUrl);

        $newUrl = $this->prependLocaleToUrl($previousUrlWithoutLocale, $locale);

        return redirect()->to($newUrl);
    }

    private function removeLocaleFromUrl($url)
    {
        $locales = config('app.locales');

        foreach ($locales as $locale) {
            $url = preg_replace('#^https?://[^/]+/' . $locale . '#', '', $url, 1, $count);

            if ($count > 0) {
                break;
            }
        }

        return $url;
    }

    private function prependLocaleToUrl($url, $locale)
    {
        $baseUrl = url('/');
    
        if (str_starts_with($url, $baseUrl)) {
            $url = substr($url, strlen($baseUrl));
        }
    
        return rtrim($baseUrl, '/') . '/' . $locale . '/' . ltrim($url, '/');
    }
    
}






