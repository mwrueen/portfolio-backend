<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\TechStack;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublicProjectController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Project::with('techStacks')->published();

        if ($request->has('featured') && $request->featured == '1') {
            $query->featured();
        }

        if ($request->filled('tech')) {
            $query->filterByTech($request->tech);
        }

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $projects = $query->orderBy('is_featured', 'desc')
            ->orderBy('order_index', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => $projects,
            'count' => $projects->count(),
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $project = Project::with('techStacks')
            ->where('slug', $slug)
            ->firstOrFail();

        // Related projects sharing tech stack or category
        $relatedProjects = Project::with('techStacks')
            ->where('id', '!=', $project->id)
            ->published()
            ->limit(3)
            ->get();

        return response()->json([
            'data' => $project,
            'related' => $relatedProjects,
        ]);
    }

    public function techStacks(): JsonResponse
    {
        $techStacks = TechStack::withCount('projects')
            ->orderBy('projects_count', 'desc')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json([
            'data' => $techStacks,
        ]);
    }
}
