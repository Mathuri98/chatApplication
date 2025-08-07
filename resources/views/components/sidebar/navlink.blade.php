@props(['route'])

<a href="{{ $route }}"
   {{ $attributes->merge([
       'class' => 'block hover:bg-black/70 hover:text-white text-sm py-1 px-2 hover:rounded-xl ' . 
                  (request()->is(trim(parse_url($route, PHP_URL_PATH), '/')) ? 'bg-black/70 text-white rounded-xl' : '')
   ]) }}>
   {{ $slot }}
</a>
