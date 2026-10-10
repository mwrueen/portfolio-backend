<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublicPageController extends Controller
{
    /**
     * Display a listing of published pages.
     * Can filter with ?menu=1 to retrieve only pages enabled for the navigation menu.
     */
    public function index(Request $request): JsonResponse
    {
        $query = CustomPage::published();

        if ($request->has('menu') && $request->menu == '1') {
            $query->inMenu();
        } else {
            $query->orderBy('order_index', 'asc')->orderBy('created_at', 'desc');
        }

        $pages = $query->get(['id', 'title', 'slug', 'summary', 'show_in_menu', 'order_index']);

        return response()->json([
            'data' => $pages,
            'count' => $pages->count(),
        ]);
    }

    /**
     * Display the specified custom page details by slug.
     */
    public function show(string $slug): JsonResponse
    {
        $page = CustomPage::published()
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json([
            'data' => $page,
        ]);
    }
}
