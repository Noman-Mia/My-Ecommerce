<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return Inertia::render('Brands/BrandList', [
            'brands' => $brands,
        ]);
    }

    public function create()
    {
        return Inertia::render('Brands/AddBrand');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $imageLocation = null;

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('brands', 'public'); // ✅ store inside 'brands' folder
                $imageLocation = Storage::url($path); // ✅ get correct url (ex: /storage/brands/abc.jpg)
            }

            Brand::create([
                'name' => $request->name,
                'image' => $imageLocation,
            ]);

            return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        return Inertia::render('Brands/EditBrand', [
            'brand' => $brand,
        ]);
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $brand = Brand::findOrFail($id);

            $imageLocation = $brand->image;

            if ($request->hasFile('image')) {
                // Delete old image first if exists
                if ($brand->image) {
                    $oldPath = str_replace('/storage/', '', $brand->image);
                    Storage::disk('public')->delete($oldPath);
                }

                // Store new image
                $path = $request->file('image')->store('brands', 'public');
                $imageLocation = Storage::url($path);
            }

            $brand->update([
                'name' => $request->name,
                'image' => $imageLocation,
            ]);

            return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);

        // Delete image
        if ($brand->image) {
            $path = str_replace('/storage/', '', $brand->image);
            Storage::disk('public')->delete($path);
        }

        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}
