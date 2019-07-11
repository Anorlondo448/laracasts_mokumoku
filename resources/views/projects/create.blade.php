@extends('layout')

@section('content')
    <h1 class="title">Create Project</h1>

    <form method="POST" action="/projects" style="margin-bottom: lem;">
        @method('POST')
        @csrf

        <div class="field">
            <label class="label" for="title">Title</label>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="Project title" value="{{ old('title') }}" {{ $errors->has('title') ? 'is-danger' : '' }} required>
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">description</label>

            <div class="control">
                <textarea name="description" class="textarea" placeholder="Project description" required>{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Create Project</button>
            </div>
        </div>

        @include ('errors')
    </form>
@endsection