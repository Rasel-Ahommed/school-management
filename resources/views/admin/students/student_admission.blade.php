@extends('admin.layouts.app')
@section('title', '| Student Admission')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .stepper-wrapper {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            position: relative;
        }

        .stepper-item {
            width: 50%;
            text-align: center;
            position: relative;
        }

        .stepper-item::before {
            content: "";
            position: absolute;
            top: 15px;
            left: 50%;
            width: 100%;
            height: 4px;
            background: #ddd;
            transform: translateX(-50%);
            z-index: -1;
        }

        .stepper-item:first-child::before {
            content: none;
        }

        .stepper-item .step-counter {
            width: 30px;
            height: 30px;
            background: #ccc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin: auto;
            color: white;
        }

        .stepper-item.active .step-counter {
            background: #0d6efd;
        }

        .stepper-item.active::before {
            background: #0d6efd;
        }

        .stepper-item.completed .step-counter {
            background: #28a745;
        }

        .stepper-item.completed::before {
            background: #28a745;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
@endpush

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Student Admission</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="active">Student Admission</li>
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
                            <h5 class="fw-bold">Manage Student Admission</h5>
                        </div>
                        <div class="default-tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link nav-padding active" id="nav-profile-tab" data-toggle="tab"
                                        href="#nav-profile" role="tab" aria-controls="nav-profile"
                                        aria-selected="false"><span class="ti-plus"></span> Admit Student </a>
                                   
                                </div>
                            </nav>

                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <div class="container mt-5">
                                        <!-- Stepper Navigation -->
                                        <div class="stepper-wrapper">
                                            <div class="stepper-item active" data-step="0">
                                                <div class="step-counter">1</div>
                                            </div>
                                            <div class="stepper-item" data-step="1">
                                                <div class="step-counter">2</div>
                                            </div>
                                        </div>

                                        <!-- Form Steps -->
                                        <form action="{{ route('admission.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            @csrf
                                            <div class="tab active" data-form-tab>
                                                <div class="mt-5">
                                                        <div class="row">
                                                            <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                                <label for="name" class="form-control-label">Full Name</label>
                                                                <input type="text" id="name" name="name"
                                                                    value="{{ old('name') }}"
                                                                    placeholder="Subject Name"
                                                                    class="form-control form-control-sm @error('name') is-invalid @enderror"
                                                                    required>
                                                            </div>

                                                            <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                                <label for="name" class="form-control-label">Address</label>
                                                                <input type="text" id="name" name="name"
                                                                    value="{{ old('name') }}"
                                                                    placeholder="Subject Name"
                                                                    class="form-control form-control-sm @error('name') is-invalid @enderror"
                                                                    required>
                                                            </div>
                                                            
                                                            <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                                <label for="name" class="form-control-label">District</label>
                                                                <select name="district" id="district" class="form-control form-control-sm" required>
                                                                    <option value="" selected disabled>Select Gendar</option>
                                                                    @foreach ($districts as $district)
                                                                        <option value="{{$district->id}}" {{ old('district') == $district->id ? 'selected' : '' }}>{{$district->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                                <label for="upozila" class="form-control-label">Upozila</label>
                                                                <select name="upozila" id="upozila" class="form-control form-control-sm" >
                                                                    <option value="" selected disabled>Select upozila</option>
                                                                    
                                                                </select>
                                                            </div>

                                                            <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                                <label for="name" class="form-control-label">Gendar</label>
                                                                <select name="gendar" id="gender" class="form-control form-control-sm" required>
                                                                    <option value="" selected disabled>Select Gendar</option>
                                                                    <option value="male" {{ old('gendar') == 'male' ? 'selected' : '' }}>Male</option>
                                                                    <option value="female" {{ old('gendar') == 'female' ? 'selected' : '' }}>Female</option>
                                                                    <option value="other" {{ old('gendar') == 'other' ? 'selected' : '' }}>Other</option>
                                                                </select>
                                                            </div>

                                                            <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                                <label for="dob" class="form-control-label">Date of Birth</label>
                                                                <input type="date" id="dob" name="dob"
                                                                    value="{{ old('dob') }}"
                                                                    placeholder="Subject Name"
                                                                    class="form-control form-control-sm @error('dob') is-invalid @enderror"
                                                                    required>
                                                            </div>
                                                            
                                                            <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                                <label for="age" class="form-control-label">Age</label>
                                                                <input type="date" id="age" name="age"
                                                                    value="{{ old('age') }}"
                                                                    placeholder="Subject Name"
                                                                    class="form-control form-control-sm @error('age') is-invalid @enderror"
                                                                    required>
                                                            </div>

                                                            <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                                <label for="class_id" class="form-control-label">Class</label>
                                                                <select name="class_id" id="class_id" class="form-control form-control-sm" required>
                                                                    <option value="" selected disabled>Select Course</option>
                                                                    @foreach ($courses as $course)
                                                                        <option value="{{$course->id}}" {{ old('class_id') == $course->id ? 'selected' : '' }}>{{$course->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                                <label for="section_id" class="form-control-label">Section</label>
                                                                <select name="section_id" id="section_id" class="form-control form-control-sm" required>
                                                                    <option value="" selected disabled>Select Section</option>
                                                                    @foreach ($courses as $course)
                                                                        <option value="{{$course->id}}" {{ old('section_id') == $course->id ? 'selected' : '' }}>{{$course->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                                <label for="" class="form-control-label">Optional Subject</label>
                                                                <select name="class_id" id="class_id" class="form-control form-control-sm">
                                                                    <option value="" selected disabled>Select Optional Subject</option>
                                                                    
                                                                </select>
                                                            </div>

                                                            <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                                <label for="roll" class="form-control-label">Class Roll</label>
                                                                <input type="number" id="roll" name="roll"
                                                                    value="{{ old('roll') }}"
                                                                    placeholder="Class Roll"
                                                                    class="form-control form-control-sm @error('roll') is-invalid @enderror"
                                                                    required>
                                                            </div>

                                                            <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                                <label for="nationality" class="form-control-label">Nationality</label>
                                                                <select name="nationality" id="nationality" class="form-control form-control-sm" required>
                                                                   
                                                                    @foreach ($nationalities as $value)
                                                                        <option value="{{$value}}" {{  $value == old('nationality','Bangladeshi') ? 'selected' : '' }}>{{$value}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="btn-container mt-4 d-flex justify-content-end gap-2">
                                                            <button type="button" class="btn btn-primary " data-btn-next>Next</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab" data-form-tab>
                                                <div class="row mt-5">
                                                    <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                        <label for="" class="form-control-label">Accademic Year</label>
                                                        <select name="accademic_year" id="accademic_year" class="form-control form-control-sm">
                                                            <option value="" selected disabled>Accademic Year</option>
                                                        </select>
                                                    </div>

                                                    <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                        <label for="" class="form-control-label">Date of Admission</label>
                                                        <input type="date" id="date_of_admission" name="date_of_admission"
                                                            value="{{ old('date_of_admission') }}" placeholder="Date of Admission"
                                                            class="form-control form-control-sm @error('date_of_admission') is-invalid @enderror">
                                                    </div>

                                                    <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                        <label for="" class="form-control-label">Blood Group</label>
                                                        <select name="blood_group" id="blood_group" class="form-control form-control-sm" required>
                                                            <option value="" selected disabled>Select Blood Group</option>
                                                            <option value="A+">A+</option>
                                                            <option value="A-">A-</option>
                                                            <option value="B+">B+</option>
                                                            <option value="B-">B-</option>
                                                            <option value="AB+">AB+</option>
                                                            <option value="AB-">AB-</option>
                                                            <option value="O+">O+</option>
                                                            <option value="O-">O-</option>
                                                        </select>
                                                    </div>

                                                    <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                        <label for="" class="form-control-label">Father's Name</label>
                                                        <input type="text" id="father_name" name="father_name"
                                                            value="{{ old('father_name') }}" placeholder="Father's Name"
                                                            class="form-control form-control-sm @error('father_name') is-invalid @enderror">
                                                    </div>

                                                    <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                        <label for="" class="form-control-label">Mother's Name</label>
                                                        <input type="text" id="mother_name" name="mother_name"
                                                            value="{{ old('mother_name') }}" placeholder="Mother's Name"
                                                            class="form-control form-control-sm @error('mother_name') is-invalid @enderror">
                                                    </div>

                                                    <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                        <label for="" class="form-control-label">Geardian Phone</label>
                                                        <input type="text" id="geardian_phone" name="geardian_phone"
                                                            value="{{ old('geardian_phone') }}" placeholder="Geardian Phone"
                                                            class="form-control form-control-sm @error('geardian_phone') is-invalid @enderror">
                                                    </div>

                                                    <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                        <label for="" class="form-control-label">Registration No</label>
                                                        <input type="number" id="registration_no" name="registration_no"
                                                            value="{{ old('registration_no') }}" placeholder="Registration No"
                                                            class="form-control form-control-sm @error('registration_no') is-invalid @enderror">
                                                    </div>

                                                    <div class="col col-lg-4 col-md-6 col-sm-12 form-group mb-4">
                                                        <label for="" class="form-control-label">Image</label>
                                                        <input type="file" id="image" name="image" accept="image/*"
                                                            value="{{ old('image') }}" placeholder="Upload Image"
                                                            class="form-control form-control-sm @error('image') is-invalid @enderror">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Buttons -->
                                            <div class="btn-container mt-4 d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-secondary" data-btn-previous>Previous</button>
                                                <button type="submit" id="submit" class="btn btn-success" data-btn-submit style="display:none">Submit</button>
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

    <!--year -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const selectElement = document.getElementById("accademic_year");
            const currentYear = new Date().getFullYear();
    
            for (let i = currentYear - 2; i <= currentYear + 2; i++) {
                let option = document.createElement("option");
                option.value = i;
                option.textContent = i;
                selectElement.appendChild(option);
            }
        });
    </script>


    <script>
        let currentTab = 0;
        showTab(currentTab);

        function showTab(n) {
            let tabs = document.querySelectorAll("[data-form-tab]");
            let stepperItems = document.querySelectorAll(".stepper-item");

            tabs.forEach((tab, index) => {
                tab.style.display = index === n ? "block" : "none";
                stepperItems[index].classList.toggle("active", index === n);
                stepperItems[index].classList.toggle("completed", index < n);
            });

            document.querySelector("[data-btn-previous]").style.display = n === 0 ? "none" : "block";
            document.querySelector("[data-btn-submit ]").style.display = n === 0 ? "none" : "block";
        }

        function nextPrev(n) {
            let tabs = document.querySelectorAll("[data-form-tab]");
            if (n === 1 && !validateForm()) return false;

            currentTab += n;
            // if (currentTab >= tabs.length) {
            //     document.querySelector("[data-btn-next]").style.display = "none";
            //     document.querySelector("[data-btn-previous]")..classList.add("d-none")
            //     document.querySelector("[data-btn-submit]").classList.remove("d-none");
            // }

            showTab(currentTab);
        }

        function validateForm() {
            let valid = true;
            let inputs = document.querySelectorAll("[data-form-tab]")[currentTab].querySelectorAll("[data-form-input]");

            inputs.forEach(input => {
                if (input.value.trim() === "") {
                    input.classList.add("is-invalid");
                    valid = false;
                } else {
                    input.classList.remove("is-invalid");
                }
            });

            return valid;
        }

        document.querySelector("[data-btn-previous]").addEventListener("click", () => nextPrev(-1));
        document.querySelector("[data-btn-next]").addEventListener("click", () => nextPrev(1));
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
