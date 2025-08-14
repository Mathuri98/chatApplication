<x-layout>
        <div class="flex flex-1 ">

            <nav class=" flex flex-col w-[14rem] py-5 px-5 bg-gray-300/20 space-y-4">
                <x-sidebar.navlink route="">New Chat</x-sidebar.navlink>
                <x-sidebar.navlink route="">Search Chat</x-sidebar.navlink>
            </nav>
            <main class="flex-1 flex flex-col border">
                <div class=" flex flex-col flex-1 items-center justify-end mb-16 overflow-auto space-y-12">
                    <x-successMessage/>
                    <h1 class="text-4xl font-semibold">ChatApp</h1>

                   <form action="" method="POST" action="" class=" w-full max-w-3xl">
                     <input type="text"
                        class="border border-black/20 rounded-3xl py-2 px-4 h-20 w-full max-w-3xl  focus:outline-none" placeholder="What is the temperature like today?">

                        <button class="hidden"></button>
                   </form>
                </div>
            </main>

        </div>

</x-layout>
