

<x-layout>

    <div class="flex flex-1 ">

        <x-sidebar.navsection />{{-- on the left  --}}

        <main class="flex items-start mt-20  ml-64 mx-auto">
            <form action="/chats" method="POST" class="flex flex-col text-center ">
              @csrf
                <div class="flex flex-col text-center  w-full p-3">
                    <x-forms.label name="title" label="Title for your chat" />
                    <x-forms.input id="title" type="title" required />
                    <x-forms.errors error_name="title" />
                </div>

                <x-forms.button>Create</x-forms.button>

            </form>

        </main>




    </div>


</x-layout>