<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style>
        .hovertext{
            border: solid 1px cornflowerblue;
            width: 50%;
            padding: 10px;
            margin:auto;
            border-radius: 10px;
            text-decoration: none;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-weight: bold;
            /*float: left;*/

        }
        .hovertext:hover{
            background-color: skyblue;
        }
    </style>
</head>

<body>

@foreach($data as $item)
    <div style="padding: 10px;width: 100%;">

        <a class="hovertext"
           href="/storage/uploads/{{ $item }}" target="_blank">{{substr($item,9)}}
        </a>

    </div>
@endforeach

</body>
</html>
