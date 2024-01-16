<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="{{route('sendmail')}}" method="POST">
    @csrf
    <label for="">Enter Mail</label>
    <input type="text" name="mail" id=""placeholder="Enter mail address">

    <label for="">Message</label>
    <textarea name="message" id="" cols="10" rows="3"></textarea>

    <button>Submit</button>
  </form>
  <div>
    <a href="{{route('testmail')}}">Test Mail</a>
  </div>
</body>
</html>