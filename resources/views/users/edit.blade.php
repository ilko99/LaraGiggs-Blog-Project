@extends('layout')

@section('content')

<div class="max-w-lg mx-auto my-8">
    <form method="POST" action="{{ route('users.update', $user->id) }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-6">
        <label for="avatar" class="inline-block text-lg mb-2">
            Company Logo
        </label>
        <input type="file" class="border border-gray-200 rounded p-2 w-full" name="avatar"/>
        <img class="w-48 mr-6 mb-6" src="{{$user->image ? $user->image->url() : asset('images/no-image.png')}}" alt=""/>
        @error('avatar')
        <p class="text-red-500 text-xs mt-1">
            {{$message}}
        </p>
        @enderror
    </div>
  
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="name">
          Name
        </label>
        <input name="name" id="name" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $user->name }}">
      </div>
  
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="email">
          Email
        </label>
        <input name="email" id="email" type="email" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $user->email }}">
      </div>
  
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="location">
          Location
        </label>
        <input name="location" id="location" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $user->location }}">
      </div>
  
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="description">
          Description
        </label>
        <textarea name="description" id="description" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $user->description }}</textarea>
      </div>
  
      <div class="flex items-center justify-between">
        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Save Changes
        </button>
        <a href="{{ route('users.show', $user->id) }}" class="inline-block align-baseline font-bold text-sm text-red-500 hover:text-red-800">
          Cancel
        </a>
      </div>
    </form>
  </div>
  

@endsection