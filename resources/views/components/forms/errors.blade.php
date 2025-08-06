@props(['error_name'])

@error($error_name)
    <p class="text-sm text-red-600">{{$message}}</p>

  @enderror