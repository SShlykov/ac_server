<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Category as CategoryResource;


class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::paginate(8);
        return CategoryResource::collection($category);
    }

    public function update(Request $request)
    {
        \Log::info($request);

        $category = Category::findOrFail($request->id);

        $category->name = $request->input('name');

        $category->save();

        return $category;
    }
}
