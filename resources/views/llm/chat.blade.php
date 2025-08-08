<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>


  @if (isset($reply))
  <p>{{$reply}}</p>
  @else
  <p>Its not set</p>
    
  @endif
  
  <form action="/llm/chat" method="POST" >

    @csrf

   <div class="flex flex-col ">

     <label for="message">User input</label>
    <input type="text" id="message" name="message" class="border border-black/20 rounded-3xl py-2 px-4 h-20 w-full max-w-3xl focus:outline-none" placeholder="What is the temperature like today?">

   </div>
   
   <button>Submit</button>
  </form>
</body>
</html>