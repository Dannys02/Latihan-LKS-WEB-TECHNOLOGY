<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\TagRequest;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function index()
    {
        $tags = Auth::user()->tags;
        return view('users.tags.index', compact('tags'));
    }

    public function store(TagRequest $request)
    {
        $tag = $request->all();
        $tag['user_id'] = Auth::id();
        Tag::create([
            'name_tag' => $request->name_tag,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('users.tags.index')->with('success', 'Berhasil tambah tag');
    }

    public function edit($id)
    {
        $editTag = Tag::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $tags = Auth::user()->tags;
        return view('users.tags.index', compact('tags', 'editTag'));
    }

    public function update(TagRequest $request, $id)
    {
        $tags = $request->all();
        $tag = Tag::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $tag->update([
            'name_tag' => $request->name_tag,
            'user_id' => Auth::id()
        ]);
        return redirect()->route('users.tags.index')->with('success', 'Berhasil update tag');
    }

    public function destroy($id)
    {
        $tag = Tag::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $tag->delete();
        return redirect()->route('users.tags.index')->with('success', 'Berhasil hapus tag');
    }
}
