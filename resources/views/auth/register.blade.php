<x-layout>

<div class="flex-1 flex flex-col justify-center text-center items-center  w-full">

  <x-successMessage/>

  <x-heading>Create an Account</x-heading>

  <form action="" class="w-full max-w-xs" method="POST" action="/login">
    @csrf

    <div class="flex flex-col text-center  w-full p-3">
      <x-forms.label name="name" label="Name" />
      <x-forms.input id="name" type="text" required value="{{old('name')}}" />
      <x-forms.errors error_name="name"/>
    </div>
    

    <div class="flex flex-col text-center  w-full p-3">
      <x-forms.label name="email" label="Email Address" />
      <x-forms.input id="email" type="email" required value="{{old('email')}}"/>
      <x-forms.errors error_name="email"/>
    </div>
    

     <div class="flex flex-col text-center  w-full p-3">
      <x-forms.label name="password" label="Password"/>
      <x-forms.input id="password" type="password" required />
      <x-forms.errors error_name="password"/> 
    </div>
    
     <div class="flex flex-col text-center  w-full p-3">
      <x-forms.label name="password_confirmation" label="Confirm Password"/>
      <x-forms.input id="password_confirmation" type="password" required /> 
      <x-forms.errors error_name="password_confirmation"/>
    </div>
  
    <x-forms.button>Create Account</x-forms.button>   
  </form>
</div>

</x-layout>