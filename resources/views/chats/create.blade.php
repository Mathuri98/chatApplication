<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat Application</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="h-screen flex flex-col ">

    <x-links />



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



</body>

</html>
