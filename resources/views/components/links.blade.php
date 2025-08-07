   @guest
     <div class="h-14  flex space-x-8 justify-end pr-9 py-4 ">
        <a href="/login" class="rounded-xl border border-black/20 px-4  bg-black text-white text-sm">Log in</a>
        <a href="/register" class="rounded-xl border border-black/20 px-4 text-sm">Sign up for free</a>
    </div>

    <hr class="black">

   @endguest


   @auth
   
     <div class="h-14  flex space-x-8 justify-end pr-9 py-3 ">
      

                   <x-sidebar.navlink route="/" class="">Home</x-sidebar.navlink>

      
                <form action="/logout" method="POST">
                  @csrf
                  <button class="rounded-xl border border-black/20 px-4 py-1  bg-black text-white text-sm">Log Out</button>
                </form>
       
       
    </div>

    <hr class="black">

   @endauth