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
            <button class="btn btn-primary">Update</button>

        </div>
    </div>

    <!-- Standard modal -->

    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Save changes</button>
                </div>
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
                placeholder: 'Search for a name',
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
                        heading: 'Success',
                        text: 'Delete successful!',
                        position: 'top-center',
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                    table.draw();
                },
                error: function () {
                    $.toast({
                        heading: 'Error',
                        text: 'Delete failed!',
                        showHideTransition: 'fade',
                        icon: 'error'
                    })
                }
            });
        });
        $(document).on('click', '.btn-primary',function (){
            let form = $(this).parents('form');
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: form.serialize(),
                success: function () {
                    $.toast({
                        heading: 'Success',
                        text: 'Delete successful!',
                        position: 'top-center',
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                    table.draw();
                },
                error: function () {
                    $.toast({
                        heading: 'Error',
                        text: 'Delete failed!',
                        showHideTransition: 'fade',
                        icon: 'error'
                    })
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