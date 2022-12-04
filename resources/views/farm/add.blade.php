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

            <h5 class="card-title fw-bolder mb-3">Add Farm</h5>

            <form method="post" action="{{ route('farm.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="farm_id" class="form-label">Farm ID</label>
                    <input type="text" class="form-control" id="farm_id" name="farm_id">
                </div>
                <div class="mb-3">
                    <label for="farm_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="farm_name" name="farm_name">
                </div>
                <div class="mb-3">
                    <label for="farm_identifier" class="form-label">Identifier</label>
                    <input type="text" class="form-control" id="farm_identifier" name="farm_identifier">
                </div>
                <div class="mb-3">
                    <label for="supervisor_id" class="form-label">Supervisor ID</label>
                    <input type="text" class="form-control" id="supervisor_id" name="supervisor_id">
                </div>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Tambah" />
                </div>
            </form>
        </div>
    </div>

@stop