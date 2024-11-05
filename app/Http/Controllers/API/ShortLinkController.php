<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    // Display a listing of short links
    public function index()
    {
        $shortLinks = ShortLink::orderBy('created_at', 'desc')->paginate(10);
    return response()->json($shortLinks, 200);
    }

    // Store a newly created short link in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url_links' => 'required|url',
            'jira_ticket' => 'nullable|string',
        ]);

        $shortLink = Str::random(6);

        $shortLinkEntry = ShortLink::create([
            'name' => $request->name,
            'url_links' => $request->url_links,
            'short_link' => $shortLink,
            'jira_ticket' => $request->jira_ticket // Nullable field
        ]);

        return response()->json([
            'message' => 'Short URL created successfully.',
            'short_url' => url($shortLinkEntry->short_link)
        ], 201);
    }

    // Display the specified short link
    public function show($id)
    {
        $shortLink = ShortLink::find($id);
        if ($shortLink) {
            return response()->json($shortLink, 200);
        }

        return response()->json(['message' => 'Short URL not found'], 404);
    }

    // Update the specified short link in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'short_link' => 'required|unique:short_links,short_link,' . $id,
            'jira_ticket' => 'nullable|string',
        ]);

        $shortLink = ShortLink::find($id);

        if ($shortLink) {
            $shortLink->update([
                'short_link' => $request->short_link,
                'jira_ticket' => $request->jira_ticket // Allow updating jira_ticket
            ]);

            return response()->json([
                'message' => 'Short URL updated successfully.',
                'short_url' => url($shortLink->short_link)
            ], 200);
        }

        return response()->json(['message' => 'Short URL not found'], 404);
    }

    // Remove the specified short link from storage
    public function destroy($id)
    {
        $shortLink = ShortLink::find($id);

        if ($shortLink) {
            $shortLink->delete();
            return response()->json(['message' => 'Short URL deleted successfully'], 200);
        }

        return response()->json(['message' => 'Short URL not found'], 404);
    }
}