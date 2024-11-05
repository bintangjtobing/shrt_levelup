<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortLinkController;
use App\Models\ShortLink;

Route::get('/{short_link}', function ($short_link) {
    $shortLinkEntry = ShortLink::where('short_link', $short_link)->first();

    if ($shortLinkEntry) {
        return redirect($shortLinkEntry->url_links);
    }

    abort(404);
});
Route::get('/', function () {
    return redirect('/shortlinks/create');
});
Route::resource('shortlinks', ShortLinkController::class);