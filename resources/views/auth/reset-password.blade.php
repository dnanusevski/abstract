<x-guest-layout>
    <h2>Reset password</h2>
    @if ($errors->any())
        <div>
            <div>Something went wrong</div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('status'))
        <div>
            {{ session('status') }}
        </div>
    @endif
    <form action="/reset-password" method="POST">
        @csrf
        <input type="hidden" name="token" value = "{{$request->route('token')}}" />
        <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="{{ old('email', $request->email) }}" autofocus>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <label for="password_confirmation">Password confirm</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>
        <div>
            <button>Reset password</button>
        </div>
    </form>
</x-guest-layout>
