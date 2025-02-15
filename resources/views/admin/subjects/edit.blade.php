@extends('admin.layouts.app')
@section('title', '| Edit Subjects')
@push('css')
@endpush

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Edit Subjects</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{url('/dashboard')}}">Dashboard</a></li>
                                <li><a href="{{route('subject.index')}}">Subjects</a></li>
                                <li class="active">Edit Subject</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="pb-3">
                            <h5 class="fw-bold">Edit Subject</h5>
                        </div>
                        <div class="mt-4">
                            <form action="{{ route('subject.update', $subject?->id) }}" method="post" class="form-horizontal">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="row form-group mb-4">
                                            <div class="col col-md-4">
                                                <label for="name" class="form-control-label">Subject
                                                    Name</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <input type="text" id="name" name="name"
                                                    value="{{ $subject?->name }}" placeholder="Subject Name"
                                                    class="form-control form-control-sm @error('name') is-invalid @enderror"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="row form-group mb-4">
                                            <div class="col col-md-4">
                                                <label for="name" class="form-control-label">Short
                                                    Name</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <input type="text" id="short_name" name="short_name"
                                                    value="{{ $subject?->short_name }}" placeholder="Section Name"
                                                    class="form-control form-control-sm @error('short_name') is-invalid @enderror"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="row form-group mb-4">
                                            <div class="col col-md-4">
                                                <label for="course_id"class=" form-control-label">Class</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <select id="course" name="course_id"
                                                    class="form-control form-control-sm  course" tabindex="1" required>
                                                    <option value="">Select Class</option>
                                                    @foreach ($courses as $course)
                                                        <option
                                                            {{ $subject?->course_id == $course?->id ? 'selected' : '' }}
                                                            value="{{ $course?->id }}">{{ $course?->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6">
                                        <div class="row form-group mb-4">
                                            <div class="col col-md-4">
                                                <label
                                                    for="course_id"class=" form-control-label">Section</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <select id="section_id" name="section_id"
                                                    class="form-control form-control-sm " tabindex="1" required>
                                                    <option value="">Select Class</option>
                                                    @foreach ($sections as $section)
                                                        <option
                                                            {{ $subject?->section_id == $section?->id ? 'selected' : '' }}
                                                            value="{{ $section?->id }}">{{ $section?->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row form-group mb-4">
                                            <div class="col col-md-4">
                                                <label
                                                    for="teacher_id"class=" form-control-label">Teacher</label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <select name="teacher_id" class="form-control-sm form-control"
                                                    tabindex="1">
                                                    <option value="">Select Teacher</option>
                                                    @foreach ($teachers as $teacher)
                                                        <option
                                                            {{ $subject?->teacher_id == $teacher?->id ? 'selected' : '' }}
                                                            value="{{ $teacher?->id }}">{{ $teacher?->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info ">Sumbit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $('#course').on('change', function() {
        var course_id = $(this).val();
        $.ajax({
            url: "{{ route('subject.get_sections') }}",
            method: "GET",
            data: {
                course_id: course_id
            },
            dataType: "json",
            success: function(response) {
                $('#section').html('<option value="">Select Section</option>');
                $.each(response, function(index, section) {
                    $('#section').append('<option value="' + section.id + '">' + section.name +
                        '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", xhr.responseText);
            }
        });
    });
</script>
@endpush
