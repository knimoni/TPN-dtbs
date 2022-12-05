@extends('supervisor.layout')

@section('content')

<p></p>
<h2 style="text-align:center">Dataset Search</h2>
<div class="pb-3">
    <form class="d-flex" action="{{ url('/') }}" method="get">
        <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Search for Dataset" aria-label="Search">
        <button style=background-color:skyblue; class="btn btn-secondary" type="submit">Search</button>
    </form>
</div>

<h4 class="mt-4">Data Supervisor </h4>


<a style="background-color:blue; border-color:blue;" style=background-color:green; href="{{ route('supervisor.create') }}" type="button" class="btn btn-success rounded-3">Add Data</a>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<table class="table table-hover mt-2 ">
    <thead>
      <tr>
        <th style="text-align:center">Supervisor ID</th>
        <th style="text-align:center">Supervisor Name</th>
        <th style="text-align:center">Supervisor Identifier</th>
        <th style="text-align:center">Action</th>
      </tr>
    </thead>


    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td style="text-align:center">{{ $data->supervisor_id }}</td>
                <td style="text-align:center">{{ $data->supervisor_name }}</td>
                <td style="text-align:center">{{ $data->supervisor_identifier }}</td>
                <td>
                    <a style="float:right;" style=color:white;  href="{{ route('supervisor.edit', $data->supervisor_id) }}" type="button" class="btn btn-warning rounded-3">Change</a>

                    <!-- Button trigger modal -->
                    <button style="float:right; margin-right:10px; margin-left:10px" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal{{ $data->supervisor_id }}">
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

                    <button style="background-color:purple; float:right"; type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#softDeleteModal{{ $data->supervisor_id }}">
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
<a style="background-color:gray; border-color:gray; float:right" href="{{ route('supervisor.restore') }}" type="button" class="btn btn-success rounded-3">Restore Data</a>


<h4 class="mt-5">Children Data</h4>

<a style="background-color:blue; border-color:blue;" href="{{ route('children.create') }}" type="button" class="btn btn-success rounded-3">Add Data</a>

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th style="text-align:center">Children ID</th>
        <th style="text-align:center">Name </th>
        <th style="text-align:center">Identifier</th>
        <th style="text-align:center">Blood Type</th>
        <th style="text-align:center">Birthday</th>

        <th style="text-align:center">Supervisor ID</th>
        <th style="text-align:center">Action</th>
      </tr>
    </thead>


    <tbody>
        @foreach ($childrens as $children)
            <tr>
                <td style="text-align:center">{{ $children->children_id }}</td>
                <td style="text-align:center">{{ $children->children_name }}</td>
                <td style="text-align:center">{{ $children->children_identifier }}</td>
                <td style="text-align:center">{{ $children->children_bloodtype }}</td>
                <td style="text-align:center">{{ $children->children_birthday }}</td>

                <td style="text-align:center">{{ $children->supervisor_id }}</td>
                <td>
                    <a style="float:right" href="{{ route('children.edit', $children->children_id) }}" type="button" class="btn btn-warning rounded-3">Change</a>

                    <!-- Button trigger modal -->
                    <button style="float:right; margin-right:10px; margin-left:10px" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal2{{ $children->children_id }}">
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

                    <button style="background-color:purple; float:right"; type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#softDeleteModal2{{ $children->children_id }}">
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

<a style="background-color:gray; border-color:gray; float:right" href="{{ route('children.restore') }}" type="button" class="btn btn-success rounded-3">Restore Data</a>

<h4 class="mt-5">Farm Data</h4>

<a style="background-color:blue; border-color:blue;" href="{{ route('farm.create') }}" type="button" class="btn btn-success rounded-3">Add Data</a>

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th style="text-align:center">Farm ID</th>
        <th style="text-align:center">Name</th>
        <th style="text-align:center">Identifier</th>
        <th style="text-align:center">Supervisor ID</th>
        <th style="text-align:center">Action</th>
      </tr>
    </thead>


    <tbody>
        @foreach ($farms as $farm)
            <tr>
                <td style="text-align:center">{{ $farm->farm_id }}</td>
                <td style="text-align:center">{{ $farm->farm_name }}</td>
                <td style="text-align:center">{{ $farm->farm_identifier }}</td>
                <td style="text-align:center">{{ $farm->supervisor_id }}</td>
                <td style="text-align:center">
                
                    <a style="float:right" href="{{ route('farm.edit', $farm->farm_id) }}" type="button" class="btn btn-warning rounded-3">Change</a>

                    <!-- Button trigger modal -->
                    <button style="float:right; margin-right:10px; margin-left:10px" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal3{{ $farm->farm_id }}">
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
                    <button style="background-color:purple; float:right" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#softDeleteModal3{{ $farm->farm_id }}">
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
<a style="background-color:gray; border-color:gray; float:right" href="{{ route('farm.restore') }}" type="button" class="btn btn-success rounded-3">Restore Data</a>

<div style="white-space: pre"> </div>
<h4 style="color:navy;" class="mt-5 text-center ">Join Supervisor and Children</h4>
<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th style="text-align:center">Supervisor Name</th>
        <th style="text-align:center">Supervisor Identifier</th>
        <th style="text-align:center">Children Name</th>
        <th style="text-align:center">Children Identifier</th>
      </tr>
    </thead>
<tbody>
    @foreach ($joins as $join)
        <tr>
            <td style="text-align:center">{{ $join->supervisor_name }}</td>
            <td style="text-align:center">{{ $join->supervisor_identifier }}</td>
            <td style="text-align:center">{{ $join->children_name }}</td>
            <td style="text-align:center">{{ $join->children_identifier }}</td>
    @endforeach
</tbody>
</table>

<h4 style="color:navy;" class="mt-5 text-center">Join Supervisor and Farm</h4>
<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th style="text-align:center">Supervisor Name</th>
        <th style="text-align:center">Supervisor Identifier</th>
        <th style="text-align:center">Farm Name</th>
        <th style="text-align:center">Farm Identifier</th>
      </tr>
    </thead>
<tbody>
    @foreach ($joins2 as $join2)
        <tr>
            <td style="text-align:center">{{ $join2->supervisor_name }}</td>
            <td style="text-align:center">{{ $join2->supervisor_identifier }}</td>
            <td style="text-align:center">{{ $join2->farm_name }}</td>
            <td style="text-align:center">{{ $join2->farm_identifier }}</td>
    @endforeach
</tbody>
</table>
@stop