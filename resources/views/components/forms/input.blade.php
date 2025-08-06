@props(['id', 'type'])

<input type={{$type}} name={{$id}} id={{$id}} {{ $attributes->merge(['class' => "border border-gray-400 px-2 py-1"]) }}/>
