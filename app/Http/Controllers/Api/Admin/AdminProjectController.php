<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProjectController extends Controller
{
    public function index(): JsonResponse
    {
        $projects = Project::with('techStacks')
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => $projects,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug',
            'tagline' => 'required|string|max:255',
            'summary' => 'required|string',
            'description' => 'required|string',
            'cover_image' => 'nullable|string|url',
            'demo_url' => 'nullable|string|url',
            'github_url' => 'nullable|string|url',
            'architecture_notes' => 'nullable|string',
            'features' => 'nullable|array',
            'metrics' => 'nullable|array',
            'is_featured' => 'boolean',
            'status' => 'string|in:draft,published',
            'tech_stack_ids' => 'nullable|array',
            'tech_stack_ids.*' => 'exists:tech_stacks,id',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $project = Project::create($validated);

        if (! empty($validated['tech_stack_ids'])) {
            $project->techStacks()->sync($validated['tech_stack_ids']);
        }

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $project->load('techStacks'),
        ], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug,'.$id,
            'tagline' => 'required|string|max:255',
            'summary' => 'required|string',
            'description' => 'required|string',
            'cover_image' => 'nullable|string',
            'demo_url' => 'nullable|string',
            'github_url' => 'nullable|string',
            'architecture_notes' => 'nullable|string',
            'features' => 'nullable|array',
            'metrics' => 'nullable|array',
            'is_featured' => 'boolean',
            'status' => 'string|in:draft,published',
            'tech_stack_ids' => 'nullable|array',
            'tech_stack_ids.*' => 'exists:tech_stacks,id',
        ]);

        $project->update($validated);

        if (isset($validated['tech_stack_ids'])) {
            $project->techStacks()->sync($validated['tech_stack_ids']);
        }

        return response()->json([
            'message' => 'Project updated successfully',
            'data' => $project->load('techStacks'),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully',
        ]);
    }

    public function toggleFeatured(int $id): JsonResponse
    {
        $project = Project::findOrFail($id);
        $project->is_featured = ! $project->is_featured;
        $project->save();

        return response()->json([
            'message' => 'Featured status updated',
            'is_featured' => $project->is_featured,
        ]);
    }
}
