@extends('supervisor.layout')

@section('content')

<p>Search: </p>
<div class="pb-3">
    <form class="d-flex" action="{{ url('/') }}" method="get">
        <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
        <button class="btn btn-secondary" type="submit">Search</button>
    </form>
</div>

<h4 class="mt-5">Data Supervisor</h4>


<a href="{{ route('supervisor.create') }}" type="button" class="btn btn-success rounded-3">Add Data</a>
<a href="{{ route('supervisor.restore') }}" type="button" class="btn btn-success rounded-3">Restore Data</a>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>Supervisor ID</th>
        <th>Supervisor Name</th>
        <th>Supervisor Identifier</th>
        <th>Action</th>
      </tr>
    </thead>


    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->supervisor_id }}</td>
                <td>{{ $data->supervisor_name }}</td>
                <td>{{ $data->supervisor_identifier }}</td>
                <td>
                    <a href="{{ route('supervisor.edit', $data->supervisor_id) }}" type="button" class="btn btn-warning rounded-3">Change</a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal{{ $data->supervisor_id }}">
                        Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="DeleteModal{{ $data->supervisor_id }}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteModalLabel">Confirm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('supervisor.delete', $data->supervisor_id) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Are you sure want to delete {{ $data->supervisor_name}}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Sure</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#softDeleteModal{{ $data->supervisor_id }}">
                        Soft Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="softDeleteModal{{ $data->supervisor_id }}" tabindex="-1" aria-labelledby="softDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="softDeleteModalLabel">Confirm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('supervisor.softDelete', $data->supervisor_id) }}">
                                    @csrf
                                    <div class="modal-body">
                                    Are you sure want to delete {{ $data->supervisor_name}}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Sure</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4 class="mt-5">Children Data</h4>

<a href="{{ route('children.create') }}" type="button" class="btn btn-success rounded-3">Add Data</a>
<a href="{{ route('children.restore') }}" type="button" class="btn btn-success rounded-3">Restore Data</a>

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>Children ID</th>
        <th>Name </th>
        <th>Identifier</th>
        <th>Blood Type</th>
        <th>Birthday</th>

        <th>Supervisor ID</th>
        <th>Action</th>
      </tr>
    </thead>


    <tbody>
        @foreach ($childrens as $children)
            <tr>
                <td>{{ $children->children_id }}</td>
                <td>{{ $children->children_name }}</td>
                <td>{{ $children->children_identifier }}</td>
                <td>{{ $children->children_bloodtype }}</td>
                <td>{{ $children->children_birthday }}</td>

                <td>{{ $children->supervisor_id }}</td>
                <td>
                    <a href="{{ route('children.edit', $children->children_id) }}" type="button" class="btn btn-warning rounded-3">Change</a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal2{{ $children->children_id }}">
                        Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="DeleteModal2{{ $children->children_id }}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteModalLabel">Confirm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('children.delete', $children->children_id) }}">
                                    @csrf
                                    <div class="modal-body">
                                    Are you sure want to delete {{ $children->children_name}}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Sure</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#softDeleteModal2{{ $children->children_id }}">
                        Soft Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="softDeleteModal2{{ $children->children_id }}" tabindex="-1" aria-labelledby="softDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="softDeleteModalLabel">Confirm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('children.softDelete', $children->children_id) }}">
                                    @csrf
                                    <div class="modal-body">
                                    Are you sure want to delete {{ $children->children_name}}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Sure</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4 class="mt-5">Farm Data</h4>

<a href="{{ route('farm.create') }}" type="button" class="btn btn-success rounded-3">Add Data</a>
<a href="{{ route('farm.restore') }}" type="button" class="btn btn-success rounded-3">Restore Data</a>

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>Farm ID</th>
        <th>name</th>
        <th>Identifier</th>
        <th>Supervisor ID</th>
        <th>Action</th>
      </tr>
    </thead>


    <tbody>
        @foreach ($farms as $farm)
            <tr>
                <td>{{ $farm->farm_id }}</td>
                <td>{{ $farm->farm_name }}</td>
                <td>{{ $farm->farm_identifier }}</td>
                <td>{{ $farm->supervisor_id }}</td>
                <td>
                    <a href="{{ route('farm.edit', $farm->farm_id) }}" type="button" class="btn btn-warning rounded-3">Change</a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal3{{ $farm->farm_id }}">
                        Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="DeleteModal3{{ $farm->farm_id }}" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteModalLabel">Confirm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('farm.delete', $farm->farm_id) }}">
                                    @csrf
                                    <div class="modal-body">
                                        AAre you sure want to delete {{ $farm->farm_name}}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Sure</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#softDeleteModal3{{ $farm->farm_id }}">
                        Soft Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="softDeleteModal3{{ $farm->farm_id }}" tabindex="-1" aria-labelledby="softDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="softDeleteModalLabel">Confirm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('farm.softDelete', $farm->farm_id) }}">
                                    @csrf
                                    <div class="modal-body">
                                    Are you sure want to delete {{ $farm->farm_name}} ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Sure</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4 class="mt-5">Join Supervisor and Children</h4>
<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>Supervisor Name</th>
        <th>Supervisor Identifier</th>
        <th>Children Name</th>
        <th>Children Identifier</th>
      </tr>
    </thead>
<tbody>
    @foreach ($joins as $join)
        <tr>
            <td>{{ $join->supervisor_name }}</td>
            <td>{{ $join->supervisor_identifier }}</td>
            <td>{{ $join->children_name }}</td>
            <td>{{ $join->children_identifier }}</td>
    @endforeach
</tbody>
</table>

<h4 class="mt-5">Join Supervisor and Farm</h4>
<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>Supervisor Name</th>
        <th>Supervisor Identifier</th>
        <th>Farm Name</th>
        <th>Farm Identifier</th>
      </tr>
    </thead>
<tbody>
    @foreach ($joins2 as $join2)
        <tr>
            <td>{{ $join2->supervisor_name }}</td>
            <td>{{ $join2->supervisor_identifier }}</td>
            <td>{{ $join2->farm_name }}</td>
            <td>{{ $join2->farm_identifier }}</td>
    @endforeach
</tbody>
</table>
@stop