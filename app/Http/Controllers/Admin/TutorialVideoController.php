<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TutorialVideo;
use Illuminate\Http\Request;
use App\Traits\HandlesYouTubeUrls;

class TutorialVideoController extends Controller
{
    use HandlesYouTubeUrls;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = TutorialVideo::orderBy('sort_order')->latest()->paginate(10);
        return view('admin.tutorial-videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tutorial-videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $data = $request->all();
        $data['video_url'] = $this->convertToYoutubeEmbedUrl($data['video_url']);

        TutorialVideo::create($data);

        return redirect()->route('admin.tutorial-videos.index')->with('success', 'Tutorial video created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TutorialVideo $tutorialVideo)
    {
        return view('admin.tutorial-videos.edit', compact('tutorialVideo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TutorialVideo $tutorialVideo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'sort_order' => 'required|integer',
        ]);

        $data = $request->all();
        $data['video_url'] = $this->convertToYoutubeEmbedUrl($data['video_url']);

        $tutorialVideo->update($data);

        return redirect()->route('admin.tutorial-videos.index')->with('success', 'Tutorial video updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TutorialVideo $tutorialVideo)
    {
        $tutorialVideo->delete();

        return redirect()->route('admin.tutorial-videos.index')->with('success', 'Tutorial video deleted successfully.');
    }
}
