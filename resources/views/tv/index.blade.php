@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-tv"> <!-- Popular-Tv -->
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold text-center">Popular Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($popularTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
            @endforeach
            </div>
        </div> <!-- End-Popular-Tv -->

        <div class="top-rated-tv py-24"> <!-- Top-Rated-Tv  -->
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold text-center">Top Rated</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($topRatedTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
            @endforeach
            </div>
        </div> <!-- End-Top-Rated-Tv -->
    </div>
@endsection