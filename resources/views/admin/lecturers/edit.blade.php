@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-body col-lg-6">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="form_create" action="{{route('admin.lecturers.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group ">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group ">
                    <label for="name" class="col-form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
                <div class="form-group ">
                    <label for="password" class="col-form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="name" placeholder="Password">
                </div>
                <div class="form-group " >
                    <label for="birth_date">Birth-date</label>
                    <input type="text" id="birth_date" name="birth_date" class="form-control" data-provide="datepicker"
                           data-date-format="yyyy-mm-dd" placeholder="Birth_date" >
                </div>
                <div class="form-group ">
                    <label for="avatar" class="col-form-label">Avatar</label>
                    <input type="file" accept="image/*" class="form-control-file" id="avatar" name="avatar" >
                </div>
                <div class="form-group ">
                    <button class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
