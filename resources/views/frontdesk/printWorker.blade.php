<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor</title>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <p>Worker</p>
    <p>{{$worker->name}}</p>
    <p>{{$worker->phone}}</p>
    {!! DNS1D::getBarcodeSVG($worker->bar_code, "C39", 1, 33, '#2A3239') !!}
</body>
</html>
