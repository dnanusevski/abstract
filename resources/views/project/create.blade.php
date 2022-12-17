<x-app-layout>
    <h1>Create project</h1>
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
            {{session('status')}}
        </div>
    @endif
    <form action = "{{route('create-project')}}" method="POST">
        @csrf
        <h3>Project</h3>
        <div>
            <label for="project">Project</label>
            <input type="text" name="name" id="name" value="My project"/>
        </div>
        <h3>Select mail providers</h3>
        <div>
            <label for="providers">
                <input type="checkbox" id="smtp1" name="smtp1" value="smtp1" checked >
                <span>smtp1</span>
                <br/>
                <input type="checkbox" id="smtp2" name="smtp2" value="smtp2">
                <span>smtp2</span>
            </label>
        </div>
        <h3>Add mail template</h3>
        <div id="mail_templates">
            <label for="template_1">
                <span>Default</span>
                <input type="radio" id="default_template_1" name="default_tamplate" value = "tamplate_1" checked>
            </label>
            <textarea name ="template_1">template_1</textarea>
        </div>
        <button id="addTemplate" type="button" >Add more templates</button>
        <hr>
        <button type="submit">Submit</button>
    </form>
</x-app-layout>
