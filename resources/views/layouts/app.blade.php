<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App layout</title>
</head>

<body>
    <div>
        Navigation for loged in user {{--(some class to handle nav would be the right choice)--}}
        <ul>
            <li>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <button>LOGOUT</button>
                </form>
            </li>
        </ul>
    </div>
    <div>
        {{ $slot }}
    </div>

</body>

</html>
