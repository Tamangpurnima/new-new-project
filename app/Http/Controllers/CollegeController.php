<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;


class CollegeController extends Controller
{
    public function create()
{
    return view('college.create');
}

// public function store(Request $request)
// {
//     $data = $request->validate([
//         'name' => 'required|string',
//         'description' => 'required|string',
//         'logo' => 'required|image|mimes:jpeg,png,jpg,gif',
//         'images.*' => 'image|mimes:jpeg,png,jpg,gif',
//     ]);

//     $logoPath = $request->file('logo')->store('logos', 'public');
//     $data['logo'] = $logoPath;

//     $college = College::create($data);

//     if ($request->hasFile('images')) {
//         foreach ($request->file('images') as $image) {
//             $imagePath = $image->store('images', 'public');
//             $college->images()->create(['path' => $imagePath]);
//         }
//     }

//     return redirect('/college/register')->with('success', 'College registered successfully!');
// }

public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:colleges,email',
        'phone' => 'required|string',
        'password' => 'required|string',
        'contact' => 'required|string',
        'description' => 'required|string',
        'logo' => 'image|mimes:jpeg,png,jpg,gif',
        'gallery.*' => 'image|mimes:jpeg,png,jpg,gif',
    ]);

    // Handle Logo Upload
    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('logos', 'public');
        $data['logo'] = $logoPath;
    }

    // Create College
    $college = College::create($data);

    // Handle Gallery Image Uploads
    if ($request->hasFile('gallery')) {
        foreach ($request->file('gallery') as $image) {
            $imagePath = $image->store('gallery', 'public');
            $college->images()->create(['path' => $imagePath]);
        }
    }

    return redirect()->route('home')->with('success', 'College registered successfully!');
}
     function show(College $college)
    {
        $college=College::all();
        return view('admin.collegeshow',['college'=>$college]);
    }
     function showForStudent(College $college)
    {
        $college=College::all();
        return view('home.college',['college'=>$college]);
    }
    public function getById($id)
    {
        $college= College::find($id);
        return view('college.viewcollegedes', compact('college'));
    }
    // public function getByIdForAdmin($id)
    // {
    //     $college = College::find($id);
    //     return view('admin.collegeDetailView', compact('college'));
    // }
    public function getByIdForAdmin($id)
    {
        $college = College::with('courseDetails.course')->find($id);
        return view('admin.collegeDetailView', compact('college'));
    }
    public function getByIdForStudent($id)
    {
        $college = College::with('courseDetails.course')->find($id);
        return view('home.collegeDetailView', compact('college'));
    }


}
