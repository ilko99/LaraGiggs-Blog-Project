@extends('layout')

@section('content')

<div class="bg-gray-50 border border-gray-200 p-10 rounded">
    <div
        class="flex flex-col items-center justify-center text-center"
    >
        <img
            class="w-48 mr-6 mb-6"
            src="{{$listing->image ? $listing->image->url() : asset('images/no-image.png')}}"
            alt=""
        />

        <h3 class="text-2xl mb-2">{{$listing->title}}</h3>
        <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
        <ul class="flex">
            
            <x-tags :tagsCsv="$listing->tags">
            </x-tags>

        </ul>
        <div class="text-lg my-4">
            <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
        </div>
        <div class="border border-gray-200 w-full mb-6"></div>
        <div>
            <h3 class="text-3xl font-bold mb-4">
                Job Description
            </h3>
            <div class="text-lg space-y-6">
                <p>
                    {{$listing->description}}
                </p>
                

                <a
                    href="mailto:test@test.com"
                    class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"
                    ><i class="fa-solid fa-envelope"></i>
                    {{$listing->email}}
                </a>

                <a
                    href="https://test.com"
                    target="_blank"
                    class="block bg-black text-white py-2 rounded-xl hover:opacity-80"
                    ><i class="fa-solid fa-globe"></i> {{$listing->website}}
                </a>
            </div>
        </div>
    </div>

    @can('update')
    <div class="bg-gray-50 border border-gray-200 rounded p-6 mt-4 p-2 flex space-x6">
        <a href="{{route('listings.edit', ['listing' => $listing->id])}}">
            <i class="fa-solid fa-pencil"></i> Edit  
        </a>
    @endcan
    @can('delete')
        <form action="{{route('listings.destroy', ['listing' => $listing->id])}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="text-red-500 ml-6">
                <i class="fa-solid fa-trash"></i> Delete this listing
            </button>
        </form>
    @endcan
    </div>

</div>
@endsection