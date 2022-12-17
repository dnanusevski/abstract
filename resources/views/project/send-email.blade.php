<x-app-layout>
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


    <h1>Send email</h1>
    <input type="text" id="template" value="{{ $template }}" />
    <input type="text" id="driver" value="{{ json_encode($driver) }}" />
    <input type="text" id="params" value="{{ json_encode($params) }}" />
    <button type="button" id="send_mail">Send mail</button>
</x-app-layout>
