@extends('supervisor.layout')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mt-4">
        <div class="card-body">

            <h5 class="card-title fw-bolder mb-3">Add Children</h5>

            <form method="post" action="{{ route('children.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="children_id" class="form-label">Children ID</label>
                    <input type="text" class="form-control" id="children_id" name="children_id">
                </div>
                <div class="mb-3">
                    <label for="children_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="children_name" name="children_name">
                </div>
                <div class="mb-3">
                    <label for="children_identifier" class="form-label">Farm Identifier</label>
                    <input type="text" class="form-control" id="children_identifier" name="children_identifier">
                </div>
                <div class="mb-3">
                    <label for="children_bloodtype" class="form-label">Blood Type</label>
                    <input type="text" class="form-control" id="children_bloodtype" name="children_bloodtype">
                </div>
                <div class="mb-3">
                    <label for="children_birthday" class="form-label">Birthday</label>
                    <input type="text" class="form-control" id="children_birthday" name="children_birthday">
                </div>
                <div class="mb-3">
                    <label for="images" class="form-label">images</label>
                    <input type="images" class="form-control" id="images" name="images">
                </div>
                <div class="mb-3">
                    <label for="supervisor_id" class="form-label">Supervisor ID</label>
                    <input type="text" class="form-control" id="supervisor_id" name="supervisor_id">
                </div>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Add" />
                </div>
            </form>
        </div>
    </div>

@stop