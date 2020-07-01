@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-sm font-normal text-gray-600">
                <a href="/projects" class="text-sm font-normal text-gray-600 no-underline">My Projects</a> / {{ $project->title }}
            </p>
            <a href="/projects/create" class="button">New Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg font-normal text-gray-600 mb-3">Tasks</h2>
                    <!-- tasks -->
                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">{{ $task->body }}</div>
                    @endforeach
                </div>

                <div>
                    <h2 class="text-lg font-normal text-gray-600 mb-3">General Notes</h2>
                    <!-- general notes -->
                    <textarea class="card w-full" style="min-height: 200px">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, facere.</textarea>
                </div>
            </div>
            <div class="lg:w-1/4 px-3 lg:py-10">
                @include('projects.card')
            </div>
        </div>
    </main>



@endsection

{{--<div class="card">--}}
{{--    <h1>{{ $project->title }}</h1>--}}
{{--    <div>{{ $project->description }}</div>--}}
{{--    <a href="/projects">Go Back</a>--}}
{{--</div>--}}
