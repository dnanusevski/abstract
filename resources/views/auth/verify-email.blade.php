<x-guest-layout>
    <h2>Verify email</h2>
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

    <div>Please verify email</div>
    @if (session('status') == 'verification-link-sent')
        <div>
            A new verification link has been sent to the email address you provided in your profile settings.
        </div>
    @endif
    <div>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <button type="submit">
                    Resend Verification Email
                </button>
            </div>
        </form>
    </div>

    <div>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf

            <button type="submit">Log Out</button>
        </form>
    </div>
</x-guest-layout>
