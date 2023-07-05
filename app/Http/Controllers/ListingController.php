<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Requests\StoreListings;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListings $request)
    {
        $validateData = $request->validated();
        $validateData['user_id'] = $request->user()->id;
        $listing = Listing::create($validateData);

        if($request->hasFile('logo')){
            $path = $request->file('logo')->store('logos', 'public');
            $listing->image()->save(
                Image::make(['path' => $path])
            );
        }

        return redirect()->route('listings.show', ['listing' => $listing->id])->with('success', 'listing created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('listings.show', ['listing' => Listing::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $listing = Listing::findOrFail($id);
        $this->authorize('update', $listing);
        return view('listings.edit', ['listing' => $listing]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreListings $request, string $id)
    {
        $listing = Listing::findOrFail($id);

        $validateData = $request->validated();
        $listing->fill($validateData);

        if($request->hasFile('logo')){
            $path = $request->file('logo')->store('logos', 'public');
            if($listing->image){
                Storage::delete($listing->image->path);
                $listings->image->path = $path;
                $listing->image->save();
            }else{
                $listing->image()->save(
                    Image::make(['path' => $path])
                );
            } 
        }

        $listing->save();

        return redirect()->route('listings.show', ['listing' => $listing->id])->with('message', 'listing updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $listing = Listing::findOrFail($id);
        $this->authorize('delete', $listing);

        $listing->delete();

        return redirect()->route('listings.index');
    }
}
