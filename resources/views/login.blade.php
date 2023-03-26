<!DOCTYPE html>
<html lang="en">
<head>
  <title>SHA256-Hashing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link href="/css/css1.css" rel="stylesheet">
  @include('bootstrap.main')
</head>
<body>


    <div class="login-main-container">
    <br>
        <p class="logintitle">Login</p>
       
        <form action="{{ route('user.login') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
        <p class="inputlabel">Username</p>
        <input type="text" class="inputclass" placeholder="Type Here" name="UserName">
        <br><br>
        <p class="inputlabel">Password</p>
        <input type="text" class="inputclass" placeholder="Type Here" name="Password">
        <br><br>
        
        @if(count($errors) > 0) 
        <div class="errorwrapper">
        @foreach($errors->all() as $error)
        <p class="warning-text1"> {{ $error }}</p>
        @endforeach
        </div><br>
        @endif

        @if(Session::get('notes'))
        <br><p class="warning-text1">{{ Session::get('notes') }}</p>
        @endif

        <button type="submit" class="loginbutton">Login</button>
        <br><br>
        </form>

    </div>



</body>
</html>