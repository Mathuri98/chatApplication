<x-layout>

    {{-- to show a specific chat and highligted it in the sidebar --}}

    <div class="flex flex-1 overflow-hidden">

        <x-sidebar.navsection />{{-- on the left  --}}

        <main class="flex flex-col flex-1 overflow-hidden">
            <!-- Scrollable chat area -->
            <div class="flex-1 overflow-y-auto px-6 pt-2 space-y-2 " id="scrollableContainer">
                <x-export :chat="$chat" />
                {{-- section to DISPLAY the text messages --}}
                @if ($chat->texts->isNotEmpty())
                    @foreach ($chat->texts as $text)
                        @if ($text->senderType === 'user')
                            <div class="leading-relaxed flex justify-end px-8 py-1.5 mr-32">
                                <p class="border border-blue-500/20 px-4 py-1.5 rounded-xl text-xs bg-blue-300/30">
                                    {{ $text->sentence }} </p>
                            </div>
                        @else
                            {{-- if its from the llm then do this --}}
                            <div class="flex justify-start px-8 py-1.5 mr-32 ml-28   ">
                                <p
                                    class="leading-relaxed border border-gray-500/20 px-4 py-1.5 rounded-xl text-xs bg-gray-300/30">
                                    {{ $text->sentence }} </p>

                            </div>
                        @endif
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

            {{-- the part where the prompt is posted by the user --}}
            <div class="w-full  mb-10 flex justify-center">
                <div class="w-full max-w-3xl bg-white px-6 py-4 text-center">
                    <x-successMessage />


                    @if ($chat->texts->isEmpty())
                        <h1 class="text-3xl font-semibold mb-14" id="chatHeading">ChatApp</h1>
                    @endif

                    <form class="w-full mt-4" id="textForm">
                        {{-- the form to post the text message --}}
                        {{-- <input hidden name="chat_id" value={{ $chat->id }}> --}}
                        @csrf
                        <input type="text"
                            class="border border-black/20 rounded-3xl py-2 px-4 h-20 w-full focus:outline-none"
                            placeholder="What is the temperature like today?" id="sentence" name="sentence" autofocus>
                        {{-- <button class="hidden"></button> --}}
                    </form>




                    <script>
                        document.getElementById('textForm').addEventListener('submit', function(e) {
                            e.preventDefault(); // stop normal form submission

                            //get the prompt from the input field as "sentence"
                            let sentence = document.getElementById('sentence').value;
                            let chatId = {{ $chat->id }}; // from Blade (Chat show controller sends chat to this current view)
                            let csrfToken = document.querySelector('input[name="_token"]').value;

                            let heading = document.getElementById('chatHeading');
                            if (heading) {
                                heading.remove(); //remove the heading if it exists
                            }



                            fetch('/texts', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    body: JSON.stringify({ //this is the data we send to the server
                                        sentence: sentence,
                                        chat_id: chatId
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    console.log('Success:', data);

                                    // Append LLM response to chat UI

                                })
                          
                            //clears out the input field after submission
                            document.getElementById('sentence').value = '';
                        });
                    </script>


                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                             const currentChatId = {{ $chat->id }}; // embed as number
                            window.Echo.channel("chat")
                                .listen(".MessageSent", (data) => {
                                    console.log("📩 Message received:", data);

                                    let container = document.getElementById('scrollableContainer');
                                    let msg = document.createElement('div');

                                    if(currentChatId=== data.chatId) { // Check if the message is for this chat
                                        if (data.senderType === "user") {
                                        msg.className = 'leading-relaxed flex justify-end px-8 py-1.5 mr-32';
                                        msg.innerHTML =
                                            `<p class="border border-blue-500/20 px-4 py-1.5 rounded-xl text-xs bg-blue-300/30">${data.message}</p>`;
                                    } else {
                                        msg.className = 'flex justify-start px-8 py-1.5 mr-32 ml-28';
                                        msg.innerHTML =
                                            `<p class="leading-relaxed border border-gray-500/20 px-4 py-1.5 rounded-xl text-xs bg-gray-300/30">${data.message}</p>`;
                                    }
                                    } else {
                                        return; // Ignore messages not related to this chat
                                    }

                                    container.appendChild(msg);
                                    container.scrollTop = container.scrollHeight;
                                });
                        });
                    </script>



                </div>
            </div>

        </main>




    </div>

</x-layout>
