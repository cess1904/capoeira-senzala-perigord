<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
    'title' => 'required|string|max:255',
    'content' => 'nullable|string',
    'seo_title' => 'nullable|string|max:60',
    'meta_description' => 'nullable|string|max:160',
]);

        $slug = $this->generateUniqueSlug($validated['title']);

       Page::create([
    'title' => $validated['title'],
    'slug' => $slug,
    'content' => $validated['content'] ?? null,
    'seo_title' => $validated['seo_title'] ?? null,
    'meta_description' => $validated['meta_description'] ?? null,
]);

        return redirect()
            ->route('admin.pages.index');
    }

    public function show(Page $page)
    {
        //
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

   public function update(Request $request, Page $page)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'nullable|string',
        'seo_title' => 'nullable|string|max:60',
        'meta_description' => 'nullable|string|max:160',
    ]);

    $page->update([
        'title' => $validated['title'],
        'content' => $validated['content'] ?? null,
        'seo_title' => $validated['seo_title'] ?? null,
        'meta_description' => $validated['meta_description'] ?? null,
    ]);

    return redirect()
        ->route('admin.pages.index');
}

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()
            ->route('admin.pages.index');
    }

    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);

        if ($baseSlug === '') {
            $baseSlug = 'page';
        }

        $slug = $baseSlug;
        $counter = 2;

        while (
            Page::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) => $query->where('id', '!=', $ignoreId)
                )
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}