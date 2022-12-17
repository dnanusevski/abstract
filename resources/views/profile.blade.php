<x-app-layout>
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
    @if (session('status') === 'profile-information-updated')
        <div>
            Profile info updated
        </div>
    @endif
    <form action="/user/profile-information" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" autofocus>
        </div>
        <div>
            <label for="email">Name</label>
            <input type="text" id="name" name="name" value="{{ auth()->user()->name }}">
        </div>

        <div>
            <label for="webhook_url">Webhook Url</label>
            <input type="text" id="webhook_url" name="webhook_url" value="{{ auth()->user()->webhook_url }}">
        </div>
        <div>
            <label for="webhook_url_format_type">Webhook url data type</label>
            <select id="webhook_url_format_type" name="webhook_url_format_type">
                <option value="json" {{ auth()->user()->webhook_url_format_type === 'json' ? 'selected' : '' }}>JSON
                </option>
                <option value="xml" {{ auth()->user()->webhook_url_format_type === 'xml' ? 'selected' : '' }}>XML
                </option>
            </select>

        </div>
        <div>
            <button>Update profile</button>
        </div>
    </form>
</x-app-layout>
