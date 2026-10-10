<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPageController extends Controller
{
    public function index(): JsonResponse
    {
        $pages = CustomPage::orderBy('order_index', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => $pages,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:custom_pages,slug',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'show_in_menu' => 'boolean',
            'order_index' => 'nullable|integer',
            'is_published' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $page = CustomPage::create($validated);

        return response()->json([
            'message' => 'Custom page created successfully',
            'data' => $page,
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $page = CustomPage::findOrFail($id);

        return response()->json([
            'data' => $page,
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $page = CustomPage::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:custom_pages,slug,'.$id,
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'show_in_menu' => 'boolean',
            'order_index' => 'nullable|integer',
            'is_published' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $page->update($validated);

        return response()->json([
            'message' => 'Custom page updated successfully',
            'data' => $page,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $page = CustomPage::findOrFail($id);
        $page->delete();

        return response()->json([
            'message' => 'Custom page deleted successfully',
        ]);
    }

    public function toggleMenu(int $id): JsonResponse
    {
        $page = CustomPage::findOrFail($id);
        $page->show_in_menu = ! $page->show_in_menu;
        $page->save();

        return response()->json([
            'message' => $page->show_in_menu ? 'Page added to navbar menu' : 'Page removed from navbar menu',
            'data' => $page,
        ]);
    }
}
