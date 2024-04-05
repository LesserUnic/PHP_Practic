<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
        <option selected>Open this select menu</option>
        @foreach($notes as $note)
            <option value="{{$note->id}}"> {{$note->Name}}</option>  
        @endforeach
    </select>
    
</body>
</html>