   @guest
     <div class="h-14  flex space-x-8 justify-end pr-9 py-3 ">
        <a href="/login" class="rounded-xl border border-black/20 px-4  bg-black text-white">Log in</a>
        <a href="/register" class="rounded-xl border border-black/20 px-4 ">Sign up for free</a>
    </div>

    <hr class="black">

   @endguest


   @auth
     <div class="h-14  flex space-x-8 justify-end pr-9 py-3 ">
      {{-- form to log out not yet implemented --}}
      
                <form action="/logout" method="POST">
                  @csrf
                  <button class="rounded-xl border border-black/20 px-4 py-1  bg-black text-white">Log Out</button>
                </form>
       
       
    </div>

    <hr class="black">

   @endauth