<x-layout>


    <div class="flex flex-1 overflow-hidden">

        <x-sidebar.navsection />{{-- on the left  --}}

        <main class="flex flex-col flex-1 overflow-hidden ">

        
            <div class="w-full  mb-10 flex justify-center">
                <div class="w-full max-w-3xl bg-white px-6 py-4 text-center">
                    <x-successMessage />
                  

                    <h1 class="text-3xl font-semibold mb-10">ChatApp</h1>

                    <form method="POST" action="/texts" class="w-full mt-4">
                      {{-- <input hidden name="chat_id" value={{$chat->id}}>  --}}
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