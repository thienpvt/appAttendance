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
            <form id="form_create" action="{{route('admin.students.store')}}" method="get">
                    @csrf
                    <div class="form-group ">
                        <label for="sid" class="col-form-label">SID</label>
                        <input type="number" class="form-control" id="sid" name="sid" placeholder="SID">
                    </div>
                    <div class="form-group ">
                        <label for="name" class="col-form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group " >
                        <label for="birth_date">Birth-date</label>
                        <input type="text" id="birth_date" name="birth_date" class="form-control" data-provide="datepicker"
                               data-date-format="yyyy-mm-dd" placeholder="Birth_date" >
                    </div>
                    <div class="form-group ">
                        Course
                        <select id="select-course-name" class="form-control" name="course_id">
                        </select>
                    </div>
                    <div class="form-group ">
                        <button type="button" class="btn btn-primary">Create</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function(){
            $("#select-course-name").select2({
                ajax: {
                    url: "{{ route('api.admin.get_course') }}",
                    method: "post",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                },
                placeholder: 'Search for course name',
                allowClear: true
            });
        })
        $(document).on('click', '.btn-primary', function () {
            let form = $(this).parents('form');
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: form.serialize(),
                success: function (response) {
                    $.toast({
                        heading: 'Successful!',
                        position: 'top-center',
                        showHideTransition: 'slide',
                        icon: 'success'
                    });
                    $('#form_create').trigger("reset");
                },
                error: function () {
                    $.toast({
                        heading: 'Failed!',
                        showHideTransition: 'fade',
                        icon: 'error'
                    })
                }
            });
        });
    </script>
@endpush
