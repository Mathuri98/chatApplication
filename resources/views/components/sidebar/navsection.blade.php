<nav class=" flex flex-col w-[14rem] py-5 px-5 bg-gray-300/20 space-y-4 overflow-y-auto">
    <x-sidebar.navlink route="/chats/create">New Chat</x-sidebar.navlink>


    @if (Auth::user()->chats->isNotEmpty())
        @php
            $chats = \App\Models\Chat::where('user_id', auth()->id())
            ->latest() // same as ->orderBy('created_at', 'desc')
            ->get();


        @endphp

        @foreach ($chats as $chat)
            <div class=" ">
                <x-sidebar.navlink route="/chats/show/{{$chat->id}}" class="">{{$chat->title}}</x-sidebar.navlink>

            </div>
        @endforeach



      

    @endif

</nav>
