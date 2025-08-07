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



    <div class="flex flex-1 overflow-hidden">

        <x-sidebar.navsection />{{-- on the left  --}}

        <main class="flex flex-col flex-1 overflow-hidden">
            <!-- Scrollable chat area -->
            <div class="flex-1 overflow-y-auto px-6 pt-6 space-y-2">
                <div class="flex justify-end px-8 py-2">
                    <p class="border border-blue-500 px-4 py-2 rounded-xl text-sm">Index page</p>
                </div>
               
            </div>


            <div class="w-full  mb-10 flex justify-center">
                <div class="w-full max-w-3xl bg-white px-6 py-4 text-center">
                    <x-successMessage />
                  

                    <h1 class="text-4xl font-semibold mb-10">ChatApp</h1>

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



</body>

</html>
