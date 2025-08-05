<x-layout>

<div class="flex-1 flex flex-col justify-center text-center items-center w-full">

  <x-heading>Welcome Back</x-heading>

  <form action="" class="w-full max-w-xs" method="POST" action="/login">
    <div class="flex flex-col text-center  w-full p-3">
      <x-forms.label name="email" label="Email Address" />
      <x-forms.input title="email"/>
    </div>


     <div class="flex flex-col text-center  w-full p-3">
      <x-forms.label name="password" label="Password"/>
      <x-forms.input title="password"/> 
    </div>

    


    <x-forms.button>Log In</x-forms.button>

    




   
  </form>
</div>

</x-layout>