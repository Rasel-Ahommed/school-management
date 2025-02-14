@extends('admin.layouts.app')
@section('title', '| Edit Sections')
@push('css')
@endpush

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Edit Section</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{url('/dashboard')}}">Dashboard</a></li>
                                <li><a href="{{route('section.index')}}">Section</a></li>
                                <li class="active">Edit Section</li>
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
                            <h5 class="fw-bold">Edit Section</h5>
                        </div>
                        <div class="mt-4">
                            <form action="{{ route('section.update',$section?->id) }}" method="post"
                                class="form-horizontal">
                                @csrf
                                <div class="row form-group mb-3">
                                    <div class="col col-md-2">
                                        <label for="name" class="form-control-label">Section Name</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="name" name="name"
                                            value="{{ $section?->name }}" placeholder="Section Name"
                                            class="form-control @error('name') is-invalid @enderror" required>
                                    </div>
                                </div>

                                <div class="row form-group mb-3">
                                    <div class="col col-md-2">
                                        <label for="course_id"class=" form-control-label">Class</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <select data-placeholder="Choose a Class..." name="course_id" class="standardSelect" tabindex="1" required>
                                            <option value="" label="default"></option>
                                            @foreach ($courses as $course)
                                                <option
                                                    {{ $section?->course_id ==  $course?->id ? 'selected' : ''}}
                                                    value="{{ $course?->id }}">{{ $course?->name }}
                                                </option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row form-group mb-3">
                                    <div class="col col-md-2">
                                        <label for="teacher_id"class=" form-control-label">Teacher</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <select data-placeholder="Choose a Teacher..." name="teacher_id" class="standardSelect" tabindex="1">
                                            <option value="" label="default"></option>
                                            @foreach ($teachers as $teacher)
                                                <option
                                                    {{ $section?->teacher_id ==  $teacher?->id ? 'selected' : ''}}
                                                    value="{{ $teacher?->id }}">{{ $teacher?->name }}
                                                </option> 
                                            @endforeach
                                        </select>
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

@endpush
