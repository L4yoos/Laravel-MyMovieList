<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input
        x-ref="search"
        @keydown.window="
            if (event.keyCode === 191) {
                event.preventDefault();
                $refs.search.focus();
            }
        " 
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"  
        wire:model.debounce.500ms="search" type="text" class="bg-gray-800 text-sm rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline" placeholder="Search (Press '/' to focus)">
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>
    </div>

    <div wire:loading class="absolute spinner top-0 right-0 mr-4 mt-4"></div>

    @if (strlen($this->search) >= 2)
        <div 
            class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4" 
            x-show.transition.opacity="isOpen"
        >
            <ul>
                @if($searchResults->count() > 0)
                @foreach ($searchResults as $result)
                    @if ($result['media_type'] === 'movie')
                        <li class="border-b border-gray-700">
                            <a 
                                href="{{ route('movies.show', $result['id'] ) }}" 
                                class="block hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out duration-150"
                                @if ($loop->last) @keydown.tab.exact="isOpen = false" @endif
                            >
                            @if ($result['poster_path'])
                                <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster" class="w-16">
                            @else
                                <img src="https://via.placeholder.com/50x75" alt="poster" class="w-16">
                            @endif

                            @isset($result['title'])
                                <span class="ml-4">{{ $result['title'] }}</span>
                            @endisset
                            </a>
                        </li>
                    @elseif ($result['media_type'] === 'tv')
                        <li class="border-b border-gray-700">
                            <a 
                                href="{{ route('tv.show', $result['id'] ) }}" 
                                class="block hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out duration-150"
                                @if ($loop->last) @keydown.tab.exact="isOpen = false" @endif
                            >
                            @if ($result['poster_path'])
                                <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster" class="w-16">
                            @else
                                <img src="https://via.placeholder.com/50x75" alt="poster" class="w-16">
                            @endif

                            @isset($result['name'])
                                <span class="ml-4">{{ $result['name'] }}</span>
                            @endisset
                            </a>
                        </li>
                    @else
                        <li class="border-b border-gray-700">
                            <a 
                                href="{{ route('actors.show', $result['id'] ) }}" 
                                class="block hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out duration-150"
                                @if ($loop->last) @keydown.tab.exact="isOpen = false" @endif
                            >
                            @if ($result['profile_path'])
                                <img src="https://image.tmdb.org/t/p/w92/{{ $result['profile_path'] }}" alt="poster" class="w-16">
                            @else
                                <img src="https://via.placeholder.com/50x75" alt="poster" class="w-16">
                            @endif

                            @isset($result['name'])
                                <span class="ml-4">{{ $result['name'] }}</span>
                            @endisset
                            </a>
                        </li>
                    @endif
                @endforeach
            @else
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif
            </ul>
        </div>
    @endif
</div>