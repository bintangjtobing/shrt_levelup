<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    // Display all short links
    public function index()
    {
        $shortLinks = ShortLink::all()->sortByDesc('created_at');;
        return view('shortlinks.index', compact('shortLinks'));
    }


    // Show the form for creating a new short link
    public function create()
    {
        $shortLinks = ShortLink::orderByDesc('created_at')->paginate(5);
        return view('welcome', compact('shortLinks'));
    }

    // Store a newly created short link in storage
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'url_links' => 'required|url',
    ]);

    // Generate short link
    $shortLink = Str::random(6);

    // Simpan data ke database
    $shortLinkEntry = ShortLink::create([
        'name' => $request->name,
        'url_links' => $request->url_links,
        'short_link' => $shortLink
    ]);

    // Redirect ke halaman index dengan short link success message
    return redirect()->back()->with('success', 'Short URL created successfully.')
                             ->with('short_url', url($shortLinkEntry->short_link));
}

    // Show the form for editing the specified short link
    public function edit($id)
    {
        $shortLink = ShortLink::find($id);
        return view('shortlinks.edit', compact('shortLink'));
    }

    // Update the specified short link in storage
    public function update(Request $request, $id)
    {
        // Validasi short_link baru
        $request->validate([
            'short_link' => 'required|unique:short_links,short_link,' . $id,
        ]);

        // Cari entry yang ingin di-update
        $shortLink = ShortLink::find($id);

        // Update short_link di database
        $shortLink->update([
            'short_link' => $request->short_link,
        ]);

        // Redirect ke halaman sebelumnya dengan pesan sukses dan short URL baru
        return redirect()->back()->with('successEdit', 'Short URL updated successfully.')
                                ->with('short_url', url($shortLink->short_link));
    }

    // Remove the specified short link from storage
    public function destroy($id)
    {
        $shortLink = ShortLink::find($id);
        $shortLink->delete();

        return redirect()->back()->with('success', 'Short URL deleted successfully.');
    }
}
