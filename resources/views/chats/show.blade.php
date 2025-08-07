<x-layout>

    {{-- to show a specific chat and highligted it in the sidebar --}}

    <div class="flex flex-1 overflow-hidden">

        <x-sidebar.navsection />{{-- on the left  --}}

        <main class="flex flex-col flex-1 overflow-hidden">
            <!-- Scrollable chat area -->
            <div class="flex-1 overflow-y-auto px-6 pt-2 space-y-2" id="scrollableContainer">
                <x-export :chat="$chat"/>
                @if ($chat->texts->isNotEmpty())
                    @foreach ($chat->texts as $text)
                        <div class="flex justify-end px-8 py-0.5 mr-16">
                            <p class="border border-blue-500/20 px-4 py-1.5 rounded-xl text-xs bg-blue-300/30">
                                {{ $text->sentence }} </p>
                        </div>
                    @endforeach

                @endif

            </div>
            <script>
                // Scroll to bottom when the page loads
                window.onload = function() {
                    const container = document.getElementById('scrollableContainer');
                    container.scrollTop = container.scrollHeight;
                };
            </script>


            <div class="w-full  mb-10 flex justify-center">
                <div class="w-full max-w-3xl bg-white px-6 py-4 text-center">
                    <x-successMessage />


                    @if ($chat->texts->isEmpty())
                        <h1 class="text-3xl font-semibold mb-14">ChatApp</h1>
                    @endif

                    <form method="POST" action="/texts" class="w-full mt-4">
                        <input hidden name="chat_id" value={{ $chat->id }}>
                        @csrf
                        <input type="text"
                            class="border border-black/20 rounded-3xl py-2 px-4 h-20 w-full focus:outline-none"
                            placeholder="What is the temperature like today?" id="sentence" name="sentence">
                        <button class="hidden"></button>
                    </form>
                </div>
            </div>

        </main>




    </div>

</x-layout>
