@extends('admin.layouts.app')
@section('title', '| Classes')
@push('css')
@endpush

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Classes</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li class="active">Classes</li>
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
                            <h5 class="fw-bold">Manage Classes</h5>
                        </div>
                        <div class="default-tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link nav-padding  active" id="nav-profile-tab" data-toggle="tab"
                                        href="#nav-profile" role="tab" aria-controls="nav-profile"
                                        aria-selected="false">All Classes</a>
                                    <a class="nav-item nav-link nav-padding" id="nav-home-tab" data-toggle="tab"
                                        href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><span
                                            class="ti-plus"></span> Create Class</a>
                                </div>
                            </nav>

                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="mt-4">
                                        <table id="bootstrap-data-table" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Class Name</th>
                                                    <th>Class Type</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($courses as $course)
                                                    <tr>
                                                        <td>{{ $course?->name }}</td>
                                                        <td>{{ $course?->class_type }}</td>
                                                        <td class="d-flex justify-content-center align-items-center" style="gap: 10px">
                                                            <a href="{{ route('course.edit', $course?->slug) }}"
                                                                class="btn btn-outline-primary btn-sm">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <form action="{{ route('course.destroy', $course?->id) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger btn-sm delete">
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
                                <div class="tab-pane fade" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">                         
                                    <div class="mt-4">
                                        <form action="{{ route('course.store') }}" method="post"
                                            class="form-horizontal">
                                            @csrf
                                            <div class="row form-group mb-3">
                                                <div class="col col-md-2">
                                                    <label for="name" class="form-control-label">Class Name</label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <input type="text" id="name" name="name"
                                                        value="{{ old('name') }}" placeholder="Class Name"
                                                        class="form-control form-control-sm @error('name') is-invalid @enderror" required>
                                                </div>
                                            </div>

                                            <div class="row form-group mb-3">
                                                <div class="col col-md-2">
                                                    <label for="class_type"class=" form-control-label">Class Type</label>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <select name="class_type" class="form-control" id="class_type">
                                                        <option value="" disabled selected>Select Class Type</option>
                                                        <option
                                                            {{ old('class_type') ==  'Primary Education' ? 'selected' : ''}}
                                                            value="Primary Education">Primary Education</option>
                                                        <option
                                                            {{ old('class_type') == 'Junior Secondary Education' ? 'selected' : '' }}
                                                            value="Junior Secondary Education">Junior Secondary Education
                                                        </option>
                                                        <option
                                                            {{ old('class_type') == 'Secondary Education' ? 'selected' : '' }}
                                                            value="Secondary Education">Secondary Education</option>
                                                        <option
                                                            {{ old('class_type') == 'Higher Secondary' ? 'selected' : '' }}
                                                            value="Higher Secondary">Higher Secondary</option>
                                                        <option {{ old('class_type') == 'Undergraduate' ? 'selected' : '' }}
                                                            value="Undergraduate">Undergraduate</option>
                                                        <option {{ old('class_type') == 'Post Graduate' ? 'selected' : '' }}
                                                            value="Post Graduate">Post Graduate</option>
                                                        <option {{ old('class_type') == 'PHD' ? 'selected' : '' }}
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
            </div>
        </div>
    </div>
@endsection

@push('js')

<script>
    $("#class_type").select2();    
</script>
    
@endpush
