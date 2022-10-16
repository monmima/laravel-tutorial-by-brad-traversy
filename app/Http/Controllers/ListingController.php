<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($request->tag);
        return view('listings.index', [
            "listings" => Listing::latest()->filter(request(["tag", "search"]))->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("listings.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $formFields = $request->validate([
            "title" => "required",
            "company" => ["required", Rule::unique("listings", "company")],
            "location" => "required",
            "website" => "required", 
            "email" => ["required", "email"],
            "tags" => "required",
            "description" => "required"
        ]);

        if ($request->hasFile("logo")) {
            $formFields["logo"] = $request->file("logo")->store("logos", "public");
        }

        Listing::create($formFields);

        return redirect("/")->with("message", "Listing created successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        return view("listings.show", [
            "listing" => $listing
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        return view("listings.edit", ["listing" => $listing]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Listing $listing)
    // {
    //     $formFields = $request->validate([
    //         "title" => "required",
    //         "company" => ["required"],
    //         "location" => "required",
    //         "website" => "requi red", 
    //         "email" => ["required", "email"],
    //         "tags" => "required",
    //         "description" => "required"
    //     ]);

    //     if ($request->hasFile("logo")) {
    //         $formFields["logo"] = $request->file("logo")->store("logos", "public");
    //     } 
   
    //     $listing->update($formFields);

    //     return back()->with("message", "Listing updated successfully!");
    // }

    // Update Listing Data
    public function update(Request $request, Listing $listing) {
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect("/")->with("message", "Listing delete successfully!");
    }


}
