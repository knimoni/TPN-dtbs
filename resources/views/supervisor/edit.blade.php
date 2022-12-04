@extends('supervisor.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Change Data Supervisor {{ $data->supervisor_id }}</h5>

		<form method="post" action="{{ route('supervisor.update', $data->supervisor_id) }}">
			@csrf
            <div class="mb-3">
                <label for="supervisor_id" class="form-label">Supervisor ID</label>
                <input type="text" class="form-control" id="supervisor_id" name="supervisor_id" value="{{ $data->supervisor_id }}">
            </div>
			<div class="mb-3">
                <label for="supervisor_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="supervisor_name" name="supervisor_name" value="{{ $data->supervisor_name }}">
            </div>
            <div class="mb-3">
                <label for="supervisor_identifier" class="form-label">Identifier</label>
                <input type="text" class="form-control" id="supervisor_identifier" name="supervisor_identifier" value="{{ $data->supervisor_identifier }}">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop