<x-guest-layout>
    <h2>Forgot password</h2>
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
    <form action="/forgot-password" method="POST">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="{{ old('email') }}" autofocus>
        </div>
        <div>
            <button>Reset password</button>
        </div>
    </form>
</x-guest-layout>
