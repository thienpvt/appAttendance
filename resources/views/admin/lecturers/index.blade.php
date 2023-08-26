@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="form-group ">
                <a href="{{route('admin.lecturers.create')}}" class="btn btn-primary">Insert</a>
            </div>
            <table class="table table-centered mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Avatar</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lecturers as $lecturer)
                    <tr>
                        <td>
                            {{$lecturer->id}}
                        </td>
                        <td>
                            <img src="" class="mr-2 rounded-circle"/>
                        </td>
                        <td>
                            {{$lecturer->email}}
                        </td>
                        <td>
                            {{$lecturer->name}}
                        </td>
                        <td>
                            {{$lecturer->birthdate}}
                        </td>
                        <td class="table-action">
                            <a href="" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                            <a href="" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
