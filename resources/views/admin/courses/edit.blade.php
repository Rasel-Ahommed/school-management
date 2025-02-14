@extends('admin.layouts.app')
@section('title', '| Edit Classes')
@push('css')
@endpush

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Edit Classes</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{url('/dashboard')}}">Dashboard</a></li>
                                <li><a href="{{route('course.index')}}">classess</a></li>
                                <li class="active">Edit Class</li>
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
                            <h5 class="fw-bold">Edit Class</h5>
                        </div>
                        <div class="mt-4">
                            <form action="{{ route('course.update', $course?->id) }}" method="post"
                                 class="form-horizontal">
                                @csrf
                                <div class="row form-group mb-3">
                                    <div class="col col-md-2">
                                        <label for="name" class="form-control-label">Class Name</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="text" id="name" name="name"
                                            value="{{$course?->name }}" placeholder="Class Name"
                                            class="form-control form-control-sm @error('name') is-invalid @enderror" required>
                                    </div>
                                </div>

                                <div class="row form-group mb-3">
                                    <div class="col col-md-2">
                                        <label for="class_type"class=" form-control-label">Class Type</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <select name="class_type" id="class_type" class="form-control form-control-sm">
                                            <option value="" disabled selected>Select Class Type</option>
                                            <option
                                                {{ $course?->class_type == 'Primary Education' ? 'selected' : '' }}
                                                value="Primary Education">Primary Education</option>
                                            <option
                                                {{ $course?->class_type == 'Junior Secondary Education' ? 'selected' : '' }}
                                                value="Junior Secondary Education">Junior Secondary Education
                                            </option>
                                            <option
                                                {{$course?->class_type =='Secondary Education' ? 'selected' : ''}}
                                                value="Secondary Education">Secondary Education</option>
                                            <option
                                                {{ $course?->class_type == 'Higher Secondary' ? 'selected' : '' }}
                                                value="Higher Secondary">Higher Secondary</option>
                                            <option {{ $course?->class_type == 'Undergraduate' ? 'selected' : '' }}
                                                value="Undergraduate">Undergraduate</option>
                                            <option {{ $course?->class_type == 'Post Graduate' ? 'selected' : '' }}
                                                value="Post Graduate">Post Graduate</option>
                                            <option {{ $course?->class_type == 'PHD' ? 'selected' : '' }}
                                                value="PHD">PHD</option>
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
