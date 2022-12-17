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
              <a href="{{route('profile')}}" > Profile </a>
            </li>
            <li>
                <a href="{{route('send-email')}}" > Send mail </a>
              </li>
            <li>
                <a href="{{route('project')}}" > Create project </a>
              </li>
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
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>

</html>
