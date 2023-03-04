<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return CategoryResource::collection(
            Category::query()
                ->orderBy('created_at')
                ->paginate($request->has('per-page') ? $request->get('per-page') : setting('per-page'))
        );
    }

    /**
     * @param StoreRequest $storeRequest
     * @return JsonResponse
     */
    public function store(StoreRequest $storeRequest): JsonResponse
    {
        try {
            return response()->json([
                'message' => __('admin.category.store.success'),
                'record' => CategoryResource::make(Category::create($storeRequest->all()))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => __('admin.category.store.error'),
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category): CategoryResource
    {
        return CategoryResource::make($category);
    }

    /**
     * @param UpdateRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Category $category): JsonResponse
    {
        try {
            $category->update($request->all());

            return response()->json(['message' => __('admin.category.update.success')]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => __('admin.category.update.error'),
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        try {
            $category->delete();

            return response()->json(['message' => __('admin.category.delete.success')]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => __('admin.category.delete.error'),
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
