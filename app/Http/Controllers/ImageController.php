<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\image;
//use Illuminate\Support\Facades\Storage

 class ImageController extends Controller
{

        public function index()
        {
            $images = Image::all();
            return view('Tables.image.index', compact('images'));
        }

        public function create()
        {
            return view('Tables.image.create');
        }

        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'required|image|max:4096',
            ]);

            $image = $request->file('image');
            $imagePath = $image->store('public/images');

            Image::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'path' => $imagePath,
            ]);

            return redirect()->route('Tables.image.index')->with('success', 'Image created successfully.');
        }

        public function edit($id)
        {
            $image = Image::findOrFail($id);
            return view('Tables.image.edit', compact('image'));
        }

        public function update(Request $request, $id)
        {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|max:4096',
            ]);

            $image = Image::findOrFail($id);

            if ($request->hasFile('image')) {
                Storage::delete($image->path);
                $imagePath = $request->file('image')->store('public/images');
                $image->path = $imagePath;
            }

            $image->title = $validatedData['title'];
            $image->description = $validatedData['description'];
            $image->save();

            return redirect()->route('Tables.image.index')->with('success', 'Image updated successfully.');
        }

        public function destroy($id)
        {
            $image = Image::findOrFail($id);
            Storage::delete($image->path);
            $image->delete();

            return redirect()->route('Tables.image.index')->with('success', 'Image deleted successfully.');
        }
    }

