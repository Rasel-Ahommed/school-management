@extends('admin.layouts.app')
@section('title', '| Subjects')
@push('css')
@endpush

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Subjects</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="active">Subjects</li>
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
                            <h5 class="fw-bold">Manage Subjects</h5>
                        </div>
                        <div class="default-tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link nav-padding  active" id="nav-profile-tab" data-toggle="tab"
                                        href="#nav-profile" role="tab" aria-controls="nav-profile"
                                        aria-selected="false">All Subjects</a>
                                    <a class="nav-item nav-link nav-padding" id="nav-home-tab" data-toggle="tab"
                                        href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><span
                                            class="ti-plus"></span> Create Subject</a>
                                </div>
                            </nav>

                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <div class="mt-4">
                                        <table id="bootstrap-data-table" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Subject Name</th>
                                                    <th>Short Name</th>
                                                    <th>Class</th>
                                                    <th>Section</th>
                                                    <th>Teacher</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($subjects as $subject)
                                                    <tr>
                                                        <td>{{ $subject?->name }}</td>
                                                        <td>{{ $subject?->short_name }}</td>
                                                        <td>{{ $subject?->course?->name }}</td>
                                                        <td>{{ $subject?->teacher?->name }}</td>
                                                        <td class="d-flex justify-content-center align-items-center"
                                                            style="gap: 10px">
                                                            <a href="{{ route('subject.edit', $subject?->slug) }}"
                                                                class="btn btn-outline-primary btn-sm">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <form action="{{ route('subject.destroy', $subject?->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-outline-danger btn-sm delete">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center">No Class Found</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                                    <div class="mt-4">
                                        <form action="{{ route('subject.store') }}" method="post" class="form-horizontal">
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
                                                                value="{{ old('name') }}" placeholder="Subject Name"
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
                                                            <input type="text" id="name" name="name"
                                                                value="{{ old('name') }}" placeholder="Section Name"
                                                                class="form-control form-control-sm @error('name') is-invalid @enderror"
                                                                required>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group mb-4">
                                                        <div class="col col-md-4">
                                                            <label for="course_id"class=" form-control-label">Class</label>
                                                        </div>
                                                        <div class="col-12 col-md-8">
                                                            <select data-placeholder="Choose a Class..." id="course"
                                                                name="course_id" class="standardSelect course"
                                                                tabindex="1" required>
                                                                <option value="" label="default"></option>
                                                                @foreach ($courses as $course)
                                                                    <option
                                                                        {{ old('course_id') == $course?->id ? 'selected' : '' }}
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
                                                            <select id="section" name="section_id" class="standardSelect" required>
                                                            </select>
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="row form-group mb-4">
                                                        <div class="col col-md-4">
                                                            <label
                                                                for="teacher_id"class=" form-control-label">Teacher</label>
                                                        </div>
                                                        <div class="col-12 col-md-8">
                                                            <select data-placeholder="Choose a Teacher..."
                                                                name="teacher_id" class="standardSelect" tabindex="1">
                                                                <option value="" label="default"></option>
                                                                @foreach ($teachers as $teacher)
                                                                    <option
                                                                        {{ old('teacher_id') == $teacher?->id ? 'selected' : '' }}
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
            </div>
        </div>
    </div>
@endsection

@push('js')
 
@endpush
