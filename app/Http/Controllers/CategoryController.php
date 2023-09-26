<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(7);
        return view('category.list', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        if ($request->file('icon')) {
            $icon = $request->file('icon');
            $icon_name = time() . '_' . $icon->getClientOriginalName();

            // File upload location
            $icon_location = 'Images/icon/';

            // Upload file
            $icon->move($icon_location, $icon_name);
        }

        if ($request->file('logo')) {
            $logo = $request->file('logo');
            $logo_name = time() . '_' . $logo->getClientOriginalName();

            // File upload location
            $logo_location = 'Images/logo/';

            // Upload file
            $logo->move($logo_location, $logo_name);
        }

        $is_active = $request->is_active == "on" ? 1 : 0;
        $is_popular = $request->is_popular == "on" ? 1 : 0;
        $is_technical = $request->is_technical == "on" ? 1 : 0;

        $category = Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'icon' => $icon_location . $icon_name,
            'logo' => $logo_location . $logo_name,
            'is_active' => $is_active,
            'is_popular' => $is_popular,
            'is_technical' => $is_technical
        ]);

        $slug = $category->slugs()->create([
            'slug' => $request->slug,
        ]);

        session()->flash('success', 'Category Created successfully.');
        return redirect()->route('category.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Category $category): View
    {
        return view('category.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        if ($request->hasFile('icon')) {

            $icon_location = 'Images/icon/';

            //code for remove old file
            if (!empty($category->icon)) {
                unlink(public_path($category->icon));
            }
            //upload new file
            $icon = $request->file('icon');
            $icon_name = time() . '_' . $icon->getClientOriginalName();

            // File upload location
            $icon_location = 'Images/icon/';

            $icon->move($icon_location, $icon_name);
            $category->update(['icon' => $icon_location . $icon_name]);
        }
        if ($request['removeicontxt'] != null) {
            $category->icon = null;
        }
        if (!empty($request->file('logo'))) {

            $icon_location = 'Images/logo/';

            //code for remove old file
            if (!empty($category->logo)) {
                unlink(public_path($category->logo));
            }
            //upload new file
            $logo = $request->file('logo');
            $logo_name = time() . '_' . $logo->getClientOriginalName();

            // File upload location
            $logo_location = 'Images/logo/';

            $logo->move($logo_location, $logo_name);

            $category->update(['logo' => $logo_location . $logo_name]);
        }
        if ($request['removelogotxt'] != null) {
            $category->icon = null;
        }

        $is_active = $request->is_active == "on" ? 1 : 0;
        $is_popular = $request->is_popular == "on" ? 1 : 0;
        $is_technical = $request->is_technical == "on" ? 1 : 0;

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'is_active' => $is_active,
            'is_popular' => $is_popular,
            'is_technical' => $is_technical
        ]);

        $category->slugs()->updateOrCreate(
            ['slug' => $request->slug]
        );
        session()->flash('success', 'Category updated successfully.');

        return redirect()->route('category.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        session()->flash('danger', 'Category Deleted successfully.');
        return redirect()->route('category.index');
    }
}
