<x-app-layout>
    <div>Logged in</div>
    <hr>
    <h1>Create project</h1>
    <form action="/create-project" methd="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="id" />
    </form>
</x-app-layout>
