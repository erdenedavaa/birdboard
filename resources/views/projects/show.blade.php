@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-sm font-normal text-gray-600">
                <a href="/projects" class="text-sm font-normal text-gray-600 no-underline">My Projects</a> / {{ $project->title }}
            </p>

            <div class="flex items-center">
                @foreach ($project->members as $member)
                    <img
                        src="{{ gravatar_url($member->email) }}"
                        alt="{{ $member->name }}'s avatar"
                        class="rounded-full w-8 mr-2">
                @endforeach

                <img
                    src="{{ gravatar_url($project->owner->email) }}"
                    alt="{{ $project->owner->name }}'s avatar"
                    class="rounded-full w-8 mr-2">

                <a href="{{ $project->path() . '/edit' }}" class="button ml-4">Edit Project</a>
            </div>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg font-normal text-gray-600 mb-3">Tasks</h2>
                    <!-- tasks -->
                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="POST" action="{{ $task->path() }}">
                                @method('PATCH')
                                @csrf

                                <div class="flex items-center">
                                    <input type="text" name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-gray-400' : '' }}">
                                    <input name="completed" type="checkbox" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf

                            <input placeholder="Add new task..." class="w-full" name="body">
                        </form>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-normal text-gray-600 mb-3">General Notes</h2>

                    <!-- general notes -->
                    <form method="POST" action="{{ $project->path() }}">
                        @csrf
                        @method('PATCH')

                        <textarea
                            name="notes"
                            class="card w-full mb-4"
                            style="min-height: 200px"
                            placeholder="Anything special that you want to make a note of?"
                        >{{ $project->notes }}</textarea>

                        <button type="submit" class="button">Save</button>
                    </form>

                    @include('errors')

                </div>
            </div>
            <div class="lg:w-1/4 px-3 lg:py-10">
                @include('projects.card')
                @include('projects.activity.card')

{{--                @if (auth()->user()->is($project->owner))--}}
{{--                    @include('projects.invite')--}}
{{--                @endif--}}

                @can('manage', $project)
                    @include(('projects.invite'))
                @endcan
            </div>
        </div>
    </main>



@endsection

{{--<div class="card">--}}
{{--    <h1>{{ $project->title }}</h1>--}}
{{--    <div>{{ $project->description }}</div>--}}
{{--    <a href="/projects">Go Back</a>--}}
{{--</div>--}}
