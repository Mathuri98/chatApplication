<x-layout>

    <div class="flex-1 flex flex-col justify-center text-center items-center  w-full">

        <x-successMessage />

        <x-heading>Welcome Back</x-heading>

        <form action="" class="w-full max-w-xs" method="POST" action="/login">
            @csrf

            <div class="flex flex-col text-center  w-full p-3">
                <x-forms.label name="email" label="Email Address" />
                <x-forms.input id="email" type="email" required value="{{ old('email') }}" />
                <x-forms.errors error_name="email" />
            </div>


            <div class="flex flex-col text-center  w-full p-3">
                <x-forms.label name="password" label="Password" />
                <x-forms.input id="password" type="password" required />
                <x-forms.errors error_name="password" />
            </div>
            <x-forms.button>Log In</x-forms.button>
        </form>
    </div>

</x-layout>
