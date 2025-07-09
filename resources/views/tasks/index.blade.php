@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="card card-new-task">
                <div class="card-header">New Task</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" name="title" type="text" maxlength="255" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" autocomplete="off" />
                            @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input id="description" name="description" type="textarea" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" autocomplete="off" />
                            @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Tasks</div>

                <div class="card-body">
                    <table id="myTable" class="display">
                        <thead>
                            <tr>
                                <td>Title</td>
                                <td>Description</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr>
                                <td>
                                    {{ $task->title }}
                                </td>
                                <td>
                                    {{ $task->description }}
                                </td>
                                <td>
                                    {{ ucfirst($task->status) }}
                                </td>
                                <td><a href="{!! route('tasks.edit', $task->id) !!}"><i class="bi bi-pen"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document)
        .ready(function() {
            $('#myTable')
                .DataTable();
        });
</script>
@endsection