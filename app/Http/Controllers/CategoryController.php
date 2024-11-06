<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    function index()
    {
        $data = Category::all();
        return view('category', ['category' => $data]);
    }

    // Dashboard displaying all categories
    function dashboard()
    {
        $data = Category::all();
        return view('category/dashboard', ['data' => $data]);
    }

    // Show the form to create a new category
    function create()
    {
        return view('category/create');
    }

    // Store a newly created category
    function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the image and get its path
        $imagePath = $request->file('image')->store('cimages', 'public');

        // Create the category and save to the database
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        // Redirect to the dashboard with success message
        return redirect()->route('category.dashboard')->with('success', 'Category created successfully!');
    }

    // Show the form to edit a category
    public function edit($id)
    {
        // Find the category by ID or fail if not found
        $category = Category::findOrFail($id);

        // Return the edit view with the category data
        return view('category.edit', compact('category'));
    }

    // Update the category details
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Image is optional here
        ]);

        // Find the category by ID or fail if not found
        $category = Category::findOrFail($id);

        // Update category details
        $category->name = $request->name;
        $category->description = $request->description;

        // Handle file upload for the image
        if ($request->hasFile('image')) {
            // Delete the old image from storage (if exists)
            Storage::disk('public')->delete($category->image);

            // Store the new image and update the path in the database
            $imagePath = $request->file('image')->store('cimages', 'public');
            $category->image = $imagePath;
        }

        // Save the updated category
        $category->save();

        // Redirect back to the category dashboard with success message
        return redirect()->route('category.dashboard')->with('success', 'Category updated successfully!');
    }

    // Delete the category
    public function destroy($id)
    {
        // Find the category by ID or fail if not found
        $category = Category::findOrFail($id);

        // Delete the category's image file from storage (if exists)
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        // Delete the category
        $category->delete();

        // Redirect back to the category dashboard with success message
        return redirect()->route('category.dashboard')->with('success', 'Category deleted successfully!');
    }
}
