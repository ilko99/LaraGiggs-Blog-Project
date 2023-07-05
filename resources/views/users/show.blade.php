@extends('layout')

@section('content')

<div class="flex flex-col items-center space-y-4">
    <img src="{{$user->image ? $user->image->url() : asset('images/no-image.png')}}" alt="Profile picture" class="w-32 h-32 rounded-full">
    <h1 class="text-2xl font-bold">{{$user->name}}</h1>
    <p class="text-gray-600">{{$user->email}}</p>
    <p class="text-gray-600">{{$user->location}}</p>
    <p class="text-gray-700 text-center max-w-lg">{{$user->description}}</p>

      <a href="{{route('users.edit', ['user' => $user->id])}}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
        Edit you profile
      </a>

  </div>

@endsection