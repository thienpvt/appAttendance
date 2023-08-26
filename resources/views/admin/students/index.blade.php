@extends('layout.master')
@push('css')
    <link
        href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.6/b-2.4.1/b-colvis-2.4.1/b-html5-2.4.1/b-print-2.4.1/fc-4.3.0/fh-3.4.0/r-2.5.0/rg-1.4.0/sc-2.2.0/sb-1.5.0/sl-1.7.0/datatables.min.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@section('content')

    <div class="card">
        <div class="card-body">


            <div class="form-group col-lg-4">
                Course
                <select id="select-course-name" class="form-control">

                </select>
            </div>

            <table class="table table-centered " id="table-index">
                <thead>
                <th>#</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Date or birth</th>
                <th>Course</th>
                <th>Update</th>
                <th>Delete</th>
                </thead>

            </table>

        </div>
    </div>

    <!-- Standard modal -->

    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.students.update')}}" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title" id="standard-modalLabel">Update</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="modal-body">

                        @csrf
                        @method('PUT')
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="sid">SID</label>
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="birth_date">Birth-date</label>
                            <input type="text" id="birth_date" name="birth_date" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                        </div>
                        <div class="form-group">
                            <label for="current_course">Current Course</label>
                            <input type="text" id="current_course_name" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="select-course-name2">Select new course of not</label>
                            <select id="select-course-name2" name="course_id" class="form-control"></select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.6/b-2.4.1/b-colvis-2.4.1/b-html5-2.4.1/b-print-2.4.1/fc-4.3.0/fh-3.4.0/r-2.5.0/rg-1.4.0/sc-2.2.0/sb-1.5.0/sl-1.7.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function () {
            $("#select-course-name,#select-course-name2").select2({
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


            var buttonCommon = {
                exportOptions: {
                    columns: ':visible :not(.not-export)'
                }
            };
            var table = $('#table-index').DataTable({
                dom: 'Blfrtip',
                select: false,
                buttons: [
                    $.extend(true, {}, buttonCommon, {
                        extend: 'copyHtml5'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'excelHtml5'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'pdfHtml5'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'print'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'csvHtml5'
                    }),
                    'colvis'
                ],
                processing: true,
                serverSide: true,
                pageLength: 100,
                ajax: {
                    url: '{!! route('api.admin.api_students') !!}',
                    data: function (d) {
                        d.course_id = $('#select-course-name').val();
                    }
                },

                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'sid', name: 'sid'},
                    {data: 'name', name: 'name'},
                    {data: 'birth_date', name: 'birth_date'},
                    {data: 'course_name', name: 'course_name'},
                    {
                        data: 'edit', targets: 5,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return `
                            <form action="${data}" method="post">
                                @csrf
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#standard-modal">Edit</button>
                        </form>
`;
                        }
                    },
                    {
                        data: 'destroy',
                        targets: 6,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return `<form action="${data}" method="post">
                                @csrf
                            @method('DELETE')
                            <button type='button' class="btn-delete btn btn-danger">Delete</button>
                        </form>`;
                        }
                    },

                ],
            });
            $('#select-course-name').change(function () {
                table.column(4).search($(this).val()).draw();
            });

            $(document).on('click', '.btn-delete, .btn-success', function () {

                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function () {
                        $.toast({
                            heading: 'Successful!',
                            position: 'top-center',
                            showHideTransition: 'slide',
                            icon: 'success'
                        });
                        $("#standard-modal").modal("hide");
                        table.draw();
                    },
                    error: function () {
                        $.toast({
                            heading: 'Failed!',
                            showHideTransition: 'fade',
                            icon: 'error'
                        })
                    },
                });

            });

        });

        $(document).on('click', '.btn-primary', function () {
            let form = $(this).parents('form');
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: form.serialize(),
                success: function (response) {
                    $('#id').val(response.data.id);
                    $('#sid').val(response.data.sid);
                    $('#name').val(response.data.name);
                    $('#birth_date').val(response.data.birth_date);
                    $('#current_course_name').val(response.data.course.name);
                    $('#current_course_id').val(response.data.course.id);
                },
                error: function () {
                }
            });
        });
        // $('#form-submit').submit(function (e){
        //     e.preventDefault();
        //     $.ajax({
        //         url: $('#form-submit').attr('action'),
        //         type: 'POST',
        //         data:$('#form-submit').serialize(),
        //         success: function (response){
        //             if(response.success){
        //                 $.toast({
        //                     heading: 'Success',
        //                     text: 'Attendance successful!',
        //                     position: 'top-center',
        //                     showHideTransition: 'slide',
        //                     icon: 'success'
        //                 })
        //             } else {
        //                 $.toast({
        //                     heading: 'Error',
        //                     text: '',
        //                     showHideTransition: 'fade',
        //                     icon: 'error'
        //                 })
        //             }
        //         },
        //     })
        // })
    </script>
@endpush
