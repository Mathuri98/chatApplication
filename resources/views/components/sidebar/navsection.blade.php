<nav class=" flex flex-col w-[14rem] py-5 px-5 bg-gray-300/20 space-y-4 overflow-y-auto">
    <x-sidebar.navlink route="/chats/create">New Chat</x-sidebar.navlink>



    <form action="" method="GET" class="relative w-full max-w-sm">
        @csrf
        <input type="text" name="q" id="q" placeholder="Search Chat"
            class="w-full text-sm py-1.5 pr-16 pl-3 border border-black/10 rounded-xl focus:outline-none">
        <button type="submit"
            class="absolute right-1 top-1/2 -translate-y-1/2 bg-blue-500 text-white text-xs px-3 py-1 rounded-xl hover:bg-blue-600">
            Search
        </button>
    </form>



    @if (Auth::user()->chats->isNotEmpty())
        @php
            // $chats = \App\Models\Chat::where('user_id', auth()->id())
            //     ->latest() // same as ->orderBy('created_at', 'desc')
            //     ->get();

            $query = request('q');
            // Step 2: Start building the query for the Chat model
            $chatQuery = \App\Models\Chat::where('user_id', auth()->id());

            // Step 3: If a search term exists, filter chats by title
            if ($query) {
                $chatQuery->where('title', 'like', '%' . $query . '%');
            }

            // Step 4: Order the chats from newest to oldest
            $chatQuery->latest(); // same as ->orderBy('created_at', 'desc')

            // Step 5: Run the query and get the results
            $chats = $chatQuery->get();
            if ($chats->isEmpty()) {
                echo '<p class="text-center text-gray-500 text-sm ">No chats found</p>';
                // <x-sidebar.navlink route="/chats/create">New Chat</x-sidebar.navlink>
            }

        @endphp

        @foreach ($chats as $chat)
            <div class=" ">
                <x-sidebar.navlink route="/chats/show/{{ $chat->id }}"
                    class="">{{ $chat->title }}</x-sidebar.navlink>

            </div>
        @endforeach





    @endif

</nav>
