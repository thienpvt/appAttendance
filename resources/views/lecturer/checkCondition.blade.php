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
                <select id="select-course-name" class="form-control" name="course_id">
                    @foreach($courses as $course)
                        <option value="{{$course->id}}"
                                @if($loop->first)
                                    checked
                            @endif>
                            {{$course->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-lg-4">
                Subject
                <select id="subject" class="form-control" name="subject_id">
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-lg-4">
                Number of weeks: <span id="weeks"></span>
            </div>

            <table class="table table-centered " id="table-index">
                <thead>
                <th>#</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Date or birth</th>
                <th>Points</th>
                <th>Eligibility</th>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.6/b-2.4.1/b-colvis-2.4.1/b-html5-2.4.1/b-print-2.4.1/fc-4.3.0/fh-3.4.0/r-2.5.0/rg-1.4.0/sc-2.2.0/sb-1.5.0/sl-1.7.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>


        $(function () {
            $('#select-course-name,#subject').change(function () {
                $.ajax({
                    url: '{{ route('api.lecturer.getNumWeeks') }}',
                    type: 'post',
                    data:{
                        course_id : $('#select-course-name').val(),
                        subject_id : $('#subject').val()
                    },
                    success: function (response) {
                        document.getElementById('weeks').innerHTML=response.data;
                    }
                });
                table.draw();
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
                    url: '{!! route('api.lecturer.check_condition') !!}',
                    data: function (d) {
                        d.course_id = $('#select-course-name').val();
                        d.subject_id = $('#subject').val();
                    },

                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'sid', name: 'sid'},
                    {data: 'name', name: 'name'},
                    {data: 'birth_date', name: 'birth_date'},
                    {
                        data: 'totalPoints',
                        targets: 4,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return `${data}/45`
                        }
                    },
                    {
                        data: 'totalPoints',
                        targets: 5,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            if (data>=36) return `<span class="btn btn-primary">Pass</span>`
                            return `<span class="btn btn-danger">Fail</span>`
                        }
                    },
                ],

            });

        });



    </script>
@endpush
