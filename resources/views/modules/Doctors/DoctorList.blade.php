<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব - ডাক্তারগন |</title>
    </x-slot>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <!-- Button to Open the Modal -->
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>ডাক্তারগন </h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createDoctorModal">Create</a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table table-striped text-center" id="table-2">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center pt-2 pl-4">
                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            data-checkbox-role="dad" class="custom-control-input"
                                                            id="checkbox-all">
                                                        <label for="checkbox-all"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </th>
                                                <th>Image</th>
                                                <th class="align-left">Doctor Name</th>
                                                <th class="align-left">Category</th>
                                                <th class="align-left">Qulification</th>
                                                <th class="align-left">Added</th>
                                                <th class="align-left">Entry Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($doctors->isNotEmpty())
                                                @foreach ($doctors as $key => $doctor)
                                                    <tr>
                                                        <td> {{ ++$key }} </td>
                                                        <td class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    class="custom-control-input"
                                                                    id="checkbox-{{ $doctor->id }}">
                                                                <label for="checkbox-{{ $doctor->id }}"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if (!empty($doctor->image))
                                                                <img class="rounded-circle" alt="image" title="doctor Logo"
                                                                    src="{{ asset('uploads/doctors/' . $doctor->image) }}"
                                                                    width="38" height="38">
                                                            @else
                                                                <img class="rounded-circle" alt="image" title="doctor Logo"
                                                                    src="{{ asset('assets/dashboard/img/users/avatar.png') }}"
                                                                    width="38" height="38">
                                                            @endif
                                                        </td>
                                                        <td class="align-left"> {{ $doctor->dr_name }} </td>
                                                        <td class="align-left"> {{ $doctor->category }} </td>
                                                        <td class="align-left"> {{ $doctor->education_qualify }} </td>
                                                        <td class="align-left"> {{ $doctor->user->name ?? 'N/A' }}</td>
                                                        <td class="align-left">
                                                            {{ \Carbon\Carbon::parse($doctor->created_at)->format('d M, Y') }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $statusClass = match ($doctor->status) {
                                                                    'Approved' => 'badge badge-secondary badge-shadow',
                                                                    'In Review' => 'badge badge-info badge-shadow',
                                                                    'Pending' => 'badge badge-warning badge-shadow',
                                                                    'Denied' => 'badge badge-danger badge-shadow',
                                                                    default => 'badge badge-success badge-shadow',
                                                                };
                                                            @endphp
                                                            <div class="{{ $statusClass }}">
                                                                {{ $doctor->status }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="#" class="btn btn-success"
                                                                data-toggle="modal" data-target="#viewDoctorModal"
                                                                data-id="{{ $doctor->id }}"
                                                                data-user="{{ $doctor->user->name }}"
                                                                data-dr_name="{{ $doctor->dr_name }}"
                                                                data-category="{{ $doctor->category }}"
                                                                data-education_qualify="{{ $doctor->education_qualify }}"
                                                                data-current_servise="{{ $doctor->current_servise }}"
                                                                data-spacialist="{{ $doctor->spacialist }}"
                                                                data-chambers='@json($doctor->chambers)'
                                                                data-status="{{ $doctor->status }}"
                                                                data-image="{{ $doctor->image ? asset('uploads/doctors/' . $doctor->image) : '' }}"
                                                                data-entry="{{ \Carbon\Carbon::parse($doctor->created_at)->format('d/m/Y') }}">
                                                                View
                                                            </a>

                                                            <a href="#" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#editDoctorModal"
                                                                data-id="{{ $doctor->id }}"
                                                                data-dr_name="{{ $doctor->dr_name }}"
                                                                data-category="{{ $doctor->category }}"
                                                                data-education_qualify="{{ $doctor->education_qualify }}"
                                                                data-current_servise="{{ $doctor->current_servise }}"
                                                                data-spacialist="{{ $doctor->spacialist }}"
                                                                data-chambers='@json($doctor->chambers)'
                                                                data-status="{{ $doctor->status }}"
                                                                data-image="{{ $doctor->image ? asset('uploads/doctors/' . $doctor->image) : '' }}">
                                                                Edit
                                                            </a>

                                                            <a href="javascript:void(0);"
                                                                onclick="deleteDoctor({{ $doctor->id }})"
                                                                class="btn btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="settingSidebar">
            <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
            </a>
            <div class="settingSidebar-body ps-container ps-theme-default">
                <div class=" fade show active">
                    <div class="setting-panel-header">Setting Panel
                    </div>
                    <div class="p-15 border-bottom">
                        <h6 class="font-medium m-b-10">Select Layout</h6>
                        <div class="selectgroup layout-color w-50">
                            <label class="selectgroup-item">
                                <input type="radio" name="value" value="1"
                                    class="selectgroup-input-radio select-layout" checked>
                                <span class="selectgroup-button">Light</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="value" value="2"
                                    class="selectgroup-input-radio select-layout">
                                <span class="selectgroup-button">Dark</span>
                            </label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <h6 class="font-medium m-b-10">Sidebar Color</h6>
                        <div class="selectgroup selectgroup-pills sidebar-color">
                            <label class="selectgroup-item">
                                <input type="radio" name="icon-input" value="1"
                                    class="selectgroup-input select-sidebar">
                                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                    data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="icon-input" value="2"
                                    class="selectgroup-input select-sidebar" checked>
                                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                    data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                            </label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <h6 class="font-medium m-b-10">Color Theme</h6>
                        <div class="theme-setting-options">
                            <ul class="choose-theme list-unstyled mb-0">
                                <li title="white" class="active">
                                    <div class="white"></div>
                                </li>
                                <li title="cyan">
                                    <div class="cyan"></div>
                                </li>
                                <li title="black">
                                    <div class="black"></div>
                                </li>
                                <li title="purple">
                                    <div class="purple"></div>
                                </li>
                                <li title="orange">
                                    <div class="orange"></div>
                                </li>
                                <li title="green">
                                    <div class="green"></div>
                                </li>
                                <li title="red">
                                    <div class="red"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <div class="theme-setting-options">
                            <label class="m-b-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                    id="mini_sidebar_setting">
                                <span class="custom-switch-indicator"></span>
                                <span class="control-label p-l-10">Mini Sidebar</span>
                            </label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <div class="theme-setting-options">
                            <label class="m-b-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                    id="sticky_header_setting">
                                <span class="custom-switch-indicator"></span>
                                <span class="control-label p-l-10">Sticky Header</span>
                            </label>
                        </div>
                    </div>
                    <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                        <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                            <i class="fas fa-undo"></i> Restore Default
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <!-- Create Doctor Modal -->
    <div class="modal modalz fade" id="createDoctorModal" tabindex="-1" role="dialog"
        aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">নতুন ডাক্তার যোগ করন </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal Content Goes Here -->
                    <form method="POST" action="{{ route('admin.doctors.store') }}" id="modalForm" enctype="multipart/form-data">
                        @csrf

                        <!-- Picture Input with Preview -->
                        <div class="form-group">
                            <div class="row justify-content-center">
                                <div class="col-md-4 text-center">
                                    <div class="profile-container">
                                        <div class="image-preview" id="imagePreview">
                                            <i class="bi bi-person-circle" style="font-size: 60px; color: #ccc;"></i>
                                        </div>
                                        <div class="edit-icon" id="editIcon">
                                            <i class="bi bi-pencil-square"></i>
                                        </div>
                                        <input type="file" value="{{ old('image') }}" name="image"
                                            class="form-control d-none" id="fileInput" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dr_name">ডাক্তারের নাম :*</label>
                            <input type="text" class="form-control" id="drName" name="dr_name" placeholder="নাম লিখুন" required>
                        </div>

                        <div class="form-group">
                            <label for="itemCategory">কোন রোগের বিশেষজ্ঞ :*</label>
                            <select class="form-control" id="Category" name="category" required>
                                <option value="">নির্বাচন করুন</option>
                                <option value="মেডিসিন বিশেষজ্ঞ">মেডিসিন বিশেষজ্ঞ</option>
                                <option value="মনোরোগ বিশেষজ্ঞ">মনোরোগ বিশেষজ্ঞ</option>
                                <option value="হৃদরোগ বিশেষজ্ঞ">হৃদরোগ বিশেষজ্ঞ</option>
                                <option value="চক্ষু বিশেষজ্ঞ">চক্ষু বিশেষজ্ঞ</option>
                                <option value="নাক, কান ও গলা বিশেষজ্ঞ">নাক, কান ও গলা বিশেষজ্ঞ</option>
                                <option value="চর্ম ও যৌন রোগ বিশেষজ্ঞ">চর্ম ও যৌন রোগ বিশেষজ্ঞ</option>
                                <option value="পাইলস বিশেষজ্ঞ">পাইলস বিশেষজ্ঞ</option>
                                <option value="ডেন্টিষ্ট">ডেন্টিষ্ট</option>
                                <option value="গাইনি বিশেষজ্ঞ">গাইনি বিশেষজ্ঞ</option>
                                <option value="ডায়াবেটিস ও হরমোন">ডায়াবেটিস ও হরমোন</option>
                                <option value="লিভার বিশেষজ্ঞ">লিভার বিশেষজ্ঞ</option>
                                <option value="ইউরোলজি">ইউরোলজি</option>
                                <option value="সার্জারি">সার্জারি</option>
                                <option value="রক্ত বিশেষজ্ঞ">রক্ত বিশেষজ্ঞ</option>
                                <option value="হোমিওপ্যাথী">হোমিওপ্যাথী </option>
                                <option value="লেজার সার্জারি">লেজার সার্জারি</option>
                                <option value="কিডনি রোগ বিশেষজ্ঞ">কিডনি রোগ বিশেষজ্ঞ</option>
                                <option value="নিউরো-সার্জারি">নিউরো-সার্জারি</option>
                                <option value="স্নায়ু রোগ বিশেষজ্ঞ">স্নায়ু রোগ বিশেষজ্ঞ</option>
                                <option value="পুষ্টি বিশেষজ্ঞ">পুষ্টি বিশেষজ্ঞ</option>
                                <option value="ক্যান্সার বিশেষজ্ঞ">ক্যান্সার বিশেষজ্ঞ</option>
                                <option value="অর্থোপেডিক">অর্থোপেডিক</option>
                                <option value="ব্যথা বিশেষজ্ঞ">ব্যথা বিশেষজ্ঞ</option>
                                <option value="শিশু রোগ বিশেষজ্ঞ">শিশু রোগ বিশেষজ্ঞ</option>
                                <option value="ফিজিক্যাল মেডিসিন">ফিজিক্যাল মেডিসিন</option>
                                <option value="ফিজিওথেরাপিস্ট">ফিজিওথেরাপিস্ট</option>
                                <option value="প্লাস্টিক সার্জারি">প্লাস্টিক সার্জারি</option>
                                <option value="যক্ষা, এ্যজমা ও বক্ষব্যাধি বিশেষজ্ঞ">যক্ষা, এ্যজমা ও বক্ষব্যাধি বিশেষজ্ঞ</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="itemName">ডাক্তারের শিক্ষাগত যোগ্যতা :*</label>
                            <input type="text" class="form-control" id="educationQualify" name="education_qualify" placeholder="শিক্ষাগত যোগ্যতা লিখুন" required>
                        </div>

                        <div class="form-group">
                            <label for="itemName">ডাক্তারের বর্তমান কর্মস্থল :*</label>
                            <input type="text" class="form-control" id="currentServise" name="current_servise" placeholder="বর্তমান কর্মস্থল লিখুন" required>
                        </div>

                        <div class="form-group">
                            <label for="spacialist">যেই যেই রোগের চিকিৎসা করেন :*</label>
                            <textarea class="" id="editor" name="spacialist" value="{{ old('spacialist') }}" placeholder="রোগের নাম লিখুন"></textarea>
                        </div>

                        <!-- Chambers Section -->
                        <div id="chamberContainer">
                        </div>

                        <!-- Add Chamber Buttons -->
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-success" id="addChamberBtn">+ Add Chamber</button>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Doctor Modal -->
    <div class="modal modalz fade" id="editDoctorModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">ডাক্তারের ডাটা পরিবর্তন</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal Content Goes Here -->
                    <form method="POST" action="" id="modalForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Picture Input with Preview -->
                        <div class="form-group">
                            <div class="row justify-content-center">
                                <div class="col-md-4 text-center">
                                    <div class="profile-container">
                                        <div class="image-preview" id="imagePreviewX">
                                            <i class="bi bi-person-circle" style="font-size: 60px; color: #ccc;"></i>
                                        </div>
                                        <div class="edit-icon" id="editIconX">
                                            <i class="bi bi-pencil-square"></i>
                                        </div>
                                        <input type="file" name="image" class="form-control d-none"
                                            id="fileInputX" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dr_name">ডাক্তারের নাম :*</label>
                            <input type="text" class="form-control" id="drName" name="dr_name" value="{{ old(key: 'dr_name') }}" placeholder="নাম লিখুন" required>
                        </div>

                        <div class="form-group">
                            <label for="Category">কোন রোগের বিশেষজ্ঞ :*</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="মেডিসিন বিশেষজ্ঞ" {{ old('category') == 'মেডিসিন বিশেষজ্ঞ' ? 'selected' : '' }}> মেডিসিন বিশেষজ্ঞ</option>
                                <option value="মনোরোগ বিশেষজ্ঞ" {{ old('category') == 'মনোরোগ বিশেষজ্ঞ' ? 'selected' : '' }}> মনোরোগ বিশেষজ্ঞ</option>
                                <option value="হৃদরোগ বিশেষজ্ঞ" {{ old('category') == 'হৃদরোগ বিশেষজ্ঞ' ? 'selected' : '' }}> হৃদরোগ বিশেষজ্ঞ</option>
                                <option value="চক্ষু বিশেষজ্ঞ" {{ old('category') == 'চক্ষু বিশেষজ্ঞ' ? 'selected' : '' }}> চক্ষু বিশেষজ্ঞ</option>
                                <option value="নাক, কান ও গলা বিশেষজ্ঞ" {{ old('category') == 'নাক, কান ও গলা বিশেষজ্ঞ' ? 'selected' : '' }}> নাক, কান ও গলা বিশেষজ্ঞ</option>
                                <option value="চর্ম ও যৌন রোগ বিশেষজ্ঞ" {{ old('category') == 'চর্ম ও যৌন রোগ বিশেষজ্ঞ' ? 'selected' : '' }}> চর্ম ও যৌন রোগ বিশেষজ্ঞ</option>
                                <option value="পাইলস বিশেষজ্ঞ" {{ old('category') == 'পাইলস বিশেষজ্ঞ' ? 'selected' : '' }}> পাইলস বিশেষজ্ঞ</option>
                                <option value="ডেন্টিষ্ট" {{ old('category') == 'ডেন্টিষ্ট' ? 'selected' : '' }}> ডেন্টিষ্ট</option>
                                <option value="গাইনি বিশেষজ্ঞ" {{ old('category') == 'গাইনি বিশেষজ্ঞ' ? 'selected' : '' }}> গাইনি বিশেষজ্ঞ</option>
                                <option value="ডায়াবেটিস ও হরমোন" {{ old('category') == 'ডায়াবেটিস ও হরমোন' ? 'selected' : '' }}> ডায়াবেটিস ও হরমোন</option>
                                <option value="লিভার বিশেষজ্ঞ" {{ old('category') == 'লিভার বিশেষজ্ঞ' ? 'selected' : '' }}> লিভার বিশেষজ্ঞ</option>
                                <option value="ইউরোলজি" {{ old('category') == 'ইউরোলজি' ? 'selected' : '' }}> ইউরোলজি</option>
                                <option value="সার্জারি" {{ old('category') == 'সার্জারি' ? 'selected' : '' }}> সার্জারি</option>
                                <option value="রক্ত বিশেষজ্ঞ" {{ old('category') == 'রক্ত বিশেষজ্ঞ' ? 'selected' : '' }}> রক্ত বিশেষজ্ঞ</option>
                                <option value="হোমিওপ্যাথী" {{ old('category') == 'হোমিওপ্যাথী' ? 'selected' : '' }}> হোমিওপ্যাথী</option>
                                <option value="লেজার সার্জারি" {{ old('category') == 'লেজার সার্জারি' ? 'selected' : '' }}> লেজার সার্জারি</option>
                                <option value="কিডনি রোগ বিশেষজ্ঞ" {{ old('category') == 'কিডনি রোগ বিশেষজ্ঞ' ? 'selected' : '' }}> কিডনি রোগ বিশেষজ্ঞ</option>
                                <option value="নিউরো-সার্জারি" {{ old('category') == 'নিউরো-সার্জারি' ? 'selected' : '' }}> নিউরো-সার্জারি</option>
                                <option value="স্নায়ু রোগ বিশেষজ্ঞ" {{ old('category') == 'স্নায়ু রোগ বিশেষজ্ঞ' ? 'selected' : '' }}> স্নায়ু রোগ বিশেষজ্ঞ</option>
                                <option value="পুষ্টি বিশেষজ্ঞ" {{ old('category') == 'পুষ্টি বিশেষজ্ঞ' ? 'selected' : '' }}> পুষ্টি বিশেষজ্ঞ</option>
                                <option value="ক্যান্সার বিশেষজ্ঞ" {{ old('category') == 'ক্যান্সার বিশেষজ্ঞ' ? 'selected' : '' }}> ক্যান্সার বিশেষজ্ঞ</option>
                                <option value="অর্থোপেডিক" {{ old('category') == 'অর্থোপেডিক' ? 'selected' : '' }}> অর্থোপেডিক</option>
                                <option value="ব্যথা বিশেষজ্ঞ" {{ old('category') == 'ব্যথা বিশেষজ্ঞ' ? 'selected' : '' }}> ব্যথা বিশেষজ্ঞ</option>
                                <option value="শিশু রোগ বিশেষজ্ঞ" {{ old('category') == 'শিশু রোগ বিশেষজ্ঞ' ? 'selected' : '' }}> শিশু রোগ বিশেষজ্ঞ</option>
                                <option value="ফিজিক্যাল মেডিসিন" {{ old('category') == 'ফিজিক্যাল মেডিসিন' ? 'selected' : '' }}> ফিজিক্যাল মেডিসিন</option>
                                <option value="ফিজিওথেরাপিস্ট" {{ old('category') == 'ফিজিওথেরাপিস্ট' ? 'selected' : '' }}> ফিজিওথেরাপিস্ট</option>
                                <option value="প্লাস্টিক সার্জারি" {{ old('category') == 'প্লাস্টিক সার্জারি' ? 'selected' : '' }}> প্লাস্টিক সার্জারি</option>
                                <option value="যক্ষা, এ্যজমা ও বক্ষব্যাধি বিশেষজ্ঞ" {{ old('category') == 'যক্ষা, এ্যজমা ও বক্ষব্যাধি বিশেষজ্ঞ' ? 'selected' : '' }}> যক্ষা, এ্যজমা ও বক্ষব্যাধি বিশেষজ্ঞ</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="education_qualify">ডাক্তারের শিক্ষাগত যোগ্যতা :*</label>
                            <input type="text" class="form-control" id="educationQualify" name="education_qualify" value="{{ old(key: 'education_qualify') }}" placeholder="শিক্ষাগত যোগ্যতা লিখুন" required>
                        </div>

                        <div class="form-group">
                            <label for="current_servise">ডাক্তারের বর্তমান কর্মস্থল :*</label>
                            <input type="text" class="form-control" id="currentServise" name="current_servise" value="{{ old(key: 'current_servise') }}" placeholder="বর্তমান কর্মস্থল লিখুন" required>
                        </div>

                        <div class="form-group">
                            <label for="spacialist">যেই যেই রোগের চিকিৎসা করেন :*</label>
                            <textarea class="" id="editorX" name="spacialist" value="{{ old('spacialist') }}" placeholder="রোগের নাম লিখুন"></textarea>
                        </div>

                        <!-- Chambers Section -->
                        <div id="chamberContainerX">
                        </div>

                        <!-- Add Chamber Buttons -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <button type="button" class="btn btn-success" id="addChamberBtnX">+ Add Chamber</button>
                        </div>

                        <!-- Status Field -->
                        <div class="form-group">
                            <label for="status">স্ট্যাটাস </label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}> Pending </option>
                                <option value="In Review" {{ old('status') == 'In Review' ? 'selected' : '' }}> In Review </option>
                                <option value="Approved" {{ old('status') == 'Approved' ? 'selected' : '' }}> Approved </option>
                                <option value="Denied" {{ old('status') == 'Denied' ? 'selected' : '' }}> Denied </option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View Doctor Modal -->
    <div class="modal modalz fade" id="viewDoctorModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">View Doctor Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal Content Goes Here -->
                    <section class="section about-section gray-bg" id="about">
                        <div class="container">
                            <div class="row align-items-center flex-column">
                                <div class="col-lg-11">
                                    <div class="about-text about-list">
                                        <div class="d-flex bd-highlight">
                                            <div class="flex-fill bd-highlight align-self-center">
                                                <div><samp class="sampcolor">স্ট্যাটাস: </samp> <span id="xStatus"></span></div>
                                                <div><hr/></div>
                                                <div><samp class="sampcolor">নিবন্ধন তারিখ: </samp> <span id="xEntry"></span></div>
                                                <div><samp class="sampcolor">যোগ করেছেন: </samp> <span id="xUser"></span></div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-fill bd-highlight about-list">
                                            <div class="align-self-center fixed-width pr-2" style="flex-shrink: 0;">
                                                <img id="modalImage" src="" style="width: 100px; height: 100px;" title="Hospital Logo" alt="logo">
                                            </div>
                                            <div class="p-2 flex-shrink-1 bd-highlight mt-4">
                                                <h5 class="dark-color mb-1 pb-1"><span id="xDrName"></span></h5>
                                                <p class="theme-color lead"><samp class="sampcolor">ধরন: </samp> <span id="xCategory"></span></p>
                                            </div>
                                        </div>
                                        <div class="about-list">
                                            <div class="d-flex flex-column">
                                                <div> <samp class="sampcolor">শিক্ষাগত যোগ্যতা: </samp> <span id="xEducationQualify"> </div>
                                                <div> <samp class="sampcolor">বর্তমান কর্মস্থল: </samp> <span id="xCurrentServise"> </div>
                                                <div> <samp class="sampcolor">বিস্তারিত: </samp> <span id="xSpacialist"> </div>
                                            </div>
                                        </div>

                                        <div class="about-list">
                                            <div class="d-flex flex-column">
                                                <div class="h6 pb-0 mb-0 mt-1">চেম্বারসমূহ</div>
                                                <div><hr/></div>
                                                <div id="chamberContainer"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            </br>
                            <div class="d-flex bd-highlight counter">
                                <div class="p-2 flex-fill bd-highlight">
                                    <div class="col-2 col-lg-3">
                                        <div class="count-data text-center">
                                            <h6 class="count h5" data-to="500" data-speed="500">500</h6>
                                            <p class="m-0px font-w-600">Happy Clients</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 flex-fill bd-highlight">
                                    <div class="col-2 col-lg-3">
                                        <div class="count-data text-center">
                                            <h6 class="count h5" data-to="150" data-speed="150">150</h6>
                                            <p class="m-0px font-w-600">Project Completed</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 flex-fill bd-highlight">
                                    <div class="col-2 col-lg-3">
                                        <div class="count-data text-center">
                                            <h6 class="count h5" data-to="850" data-speed="850">850</h6>
                                            <p class="m-0px font-w-600">Photo Capture</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 flex-fill bd-highlight">
                                    <div class="col-2 col-lg-3">
                                        <div class="count-data text-center">
                                            <h6 class="count h5" data-to="190" data-speed="190">190</h6>
                                            <p class="m-0px font-w-600">Telephonic Talk</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </br>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">

        <script type="text/javascript">

            //CKEditor with Image Upload
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'fontSize', 'fontFamily',
                        'fontColor', 'fontBackgroundColor', 'highlight', 'link',
                        'pageBreak', 'blockQuote', 'codeBlock', 'removeFormat',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'insertTable','alignment', 'horizontalLine', '|',
                        'specialCharacters', 'undo', 'redo'
                    ],

                })
                .catch(error => {
                    console.error(error);
                });

            // Function to initialize CKEditor
            function initializeCKEditor() {
                return ClassicEditor
                    .create(document.querySelector('#editorX'), {
                        toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'underline', 'fontSize', 'fontFamily',
                        'fontColor', 'fontBackgroundColor', 'highlight', 'link',
                        'pageBreak', 'blockQuote', 'codeBlock', 'removeFormat',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'insertTable','alignment', 'horizontalLine', '|',
                        'specialCharacters', 'undo', 'redo'
                    ],

                    });
            }

            // Variable to hold the CKEditor instance
            let editorInstance;

            // Event listener for when the edit modal is hidden
            $('#editDoctorModal').on('hidden.bs.modal', function() {
                if (editorInstance) {
                    editorInstance.destroy();
                    editorInstance = null;
                }
            });


            // Add Chamber
            document.addEventListener("DOMContentLoaded", function () {
                const chamberContainer = document.getElementById("chamberContainer");
                const addChamberBtn = document.getElementById("addChamberBtn");
                const MAX_CHAMBERS = 5;

                function updateChamberNumbers() {
                    const chambers = chamberContainer.getElementsByClassName("chamber-group");
                    for (let i = 0; i < chambers.length; i++) {
                        chambers[i].querySelector("h6").textContent = `চেম্বার ${i + 1}`;
                    }
                }

                addChamberBtn.addEventListener("click", function () {
                    const chamberCount = chamberContainer.getElementsByClassName("chamber-group").length;
                    if (chamberCount >= MAX_CHAMBERS) {
                        alert("আপনি সর্বোচ্চ ৫টি চেম্বার যোগ করতে পারবেন!");
                        return;
                    }

                    const newChamberGroup = document.createElement("div");
                    newChamberGroup.classList.add("chamber-group", "mb-3");
                    newChamberGroup.innerHTML = `
                        <h6>চেম্বার ${chamberCount}</h6>
                        <div class="form-group">
                            <label>চেম্বারের নাম :*</label>
                            <input type="text" class="form-control" name="chambers[${chamberCount}][chamber_name]" placeholder="চেম্বারের নাম লিখুন" required>
                        </div>
                        <div class="form-group">
                            <label>চেম্বারের ঠিকানা :*</label>
                            <input type="text" class="form-control" name="chambers[${chamberCount}][chamber_address]" placeholder="চেম্বারের ঠিকানা লিখুন" required>
                        </div>
                        <div class="form-group">
                            <label>চেম্বারের যোগাযোগ নম্বর :*</label>
                            <input type="text" class="form-control" name="chambers[${chamberCount}][chamber_contact]" placeholder="ফোন নম্বর লিখুন" required>
                        </div>
                        <div class="form-group">
                            <label>কোন কোন দিন খোলা থাকে :*</label>
                            <input type="text" class="form-control" name="chambers[${chamberCount}][chamber_date]" placeholder="দিন লিখুন" required>
                        </div>
                        <div class="form-group">
                            <label>কয়টা থেকে কয়টা পর্যন্ত খোলা থাকে :*</label>
                            <input type="text" class="form-control" name="chambers[${chamberCount}][chamber_time]" placeholder="সময় লিখুন" required>
                        </div>
                        <button type="button" class="btn btn-danger remove-single-chamber">Remove</button>
                    `;

                    chamberContainer.appendChild(newChamberGroup);
                    updateChamberNumbers();
                });

                // Remove Chamber
                chamberContainer.addEventListener("click", function (event) {
                    if (event.target.classList.contains("remove-single-chamber")) {
                        event.target.closest(".chamber-group").remove();
                        updateChamberNumbers();
                    }
                });
            });

            //imagePreview
            document.getElementById('editIcon').addEventListener('click', function() {
                document.getElementById('fileInput').click();
            });

            document.getElementById('fileInput').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const preview = document.getElementById('imagePreview');
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.innerHTML = `<img src="${e.target.result}" alt="Image Preview">`;
                    }
                    reader.readAsDataURL(file);
                }
            });
            //imagePreviewX
            document.getElementById('editIconX').addEventListener('click', function() {
                document.getElementById('fileInputX').click();
            });

            document.getElementById('fileInputX').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const preview = document.getElementById('imagePreviewX');
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.innerHTML = `<img src="${e.target.result}" alt="Image Preview">`;
                    }
                    reader.readAsDataURL(file);
                }
            });

            //viewDoctorModal
            $('#viewDoctorModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            // Fetch data from the button
            var id = button.data('id');
            var user = button.data('user');
            var dr_name = button.data('dr_name');
            var category = button.data('category');
            var education_qualify = button.data('education_qualify');
            var current_servise = button.data('current_servise');
            var spacialist = button.data('spacialist');
            var chambers = button.data('chambers');
            var status = button.data('status');
            var entry = button.data('entry');
            var image = button.data('image');

            var modal = $(this);
            modal.find('#xUser').text(user);
            modal.find('#xDrName').text(dr_name);
            modal.find('#xCategory').text(category);
            modal.find('#xEducationQualify').text(education_qualify);
            modal.find('#xCurrentServise').text(current_servise);
            modal.find('#xSpacialist').html(spacialist);
            modal.find('#xStatus').text(status);
            modal.find('#xEntry').text(entry);

            // Set the image source correctly
            var modalImage = modal.find('#modalImage');
            if (image) {
                modalImage.attr('src', image);
            } else {
                modalImage.attr('src', "{{ asset('assets/dashboard/img/users/avatar.png') }}");
            }

            // Populate chambers dynamically
            var chamberContainer = modal.find('#chamberContainer');
            chamberContainer.empty();  // Clear previous chambers

            if (chambers && Array.isArray(chambers) && chambers.length > 0) {
                chambers.forEach((chamber, index) => {
                    chamberContainer.append(`
                        <div> <samp class="sampcolor">চেম্বারের নাম: </samp> <span>${chamber.chamber_name}</span> </div>
                        <div> <samp class="sampcolor">চেম্বারের ঠিকানা: </samp> <span>${chamber.chamber_address}</span> </div>
                        <div> <samp class="sampcolor">চেম্বারের যোগাযোগ নম্বর: </samp> <span>${chamber.chamber_contact}</span> </div>
                        <div> <samp class="sampcolor">কোন কোন দিন খোলা থাকে: </samp> <span>${chamber.chamber_date}</span> </div>
                        <div> <samp class="sampcolor">কয়টা থেকে কয়টা পর্যন্ত খোলা থাকে: </samp> <span>${chamber.chamber_time}</span> </div>
                        <hr>
                    `);
                });
            } else {
                chamberContainer.append('<p>No chambers available.</p>');
            }
        });


            //editDoctorModal
            $('#editDoctorModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var dr_name = button.data('dr_name');
                var category = button.data('category');
                var education_qualify = button.data('education_qualify');
                var current_servise = button.data('current_servise');
                var spacialist = button.data('spacialist');
                var chambers = button.data('chambers');
                var status = button.data('status');
                var image = button.data('image');

                var modal = $(this);
                // Fill form fields
                modal.find('#drName').val(dr_name);
                modal.find('#category').val(category);
                modal.find('#educationQualify').val(education_qualify);
                modal.find('#currentServise').val(current_servise);
                modal.find('#status').val(status);

                // Initialize CKEditor if it hasn't been initialized yet
                if (!editorInstance) {
                    initializeCKEditor().then(editor => {
                        editorInstance = editor;
                        editorInstance.setData(spacialist);
                    });
                } else {
                    editorInstance.setData(spacialist);
                }

                // Handle image preview
                var imagePreview = modal.find('#imagePreviewX');
                if (image) {
                    imagePreview.html('<img src="' + image + '" class="img-fluid" />');
                } else {
                    imagePreview.html('<i class="bi bi-person-circle" style="font-size: 60px; color: #ccc;"></i>');
                }

                console.log("Chambers raw data:", chambers);
                console.log("Chambers type:", typeof chambers);

                // Clear existing chambers
                // Clear existing chambers
                var chamberContainer = modal.find('#chamberContainerX');
                chamberContainer.empty();

                // Ensure chambers is an array before processing
                var chamberData = Array.isArray(chambers) ? chambers : JSON.parse(chambers || '[]');

                // Debugging: Confirm parsed data
                console.log("Parsed Chamber Data:", chamberData);

                let chamberCount = 1;
                // Populate chambers dynamically
                chamberData.forEach((chamber, index) => {
                    chamberContainer.append(`
                        <div class="chamber-group mb-3">
                            <h6>চেম্বার ${chamberCount}</h6>
                            <div class="form-group">
                                <label>চেম্বারের নাম :*</label>
                                <input type="text" class="form-control" name="chambers[${index}][chamber_name]" value="${chamber.chamber_name || ''}" required>
                            </div>
                            <div class="form-group">
                                <label>চেম্বারের ঠিকানা :*</label>
                                <input type="text" class="form-control" name="chambers[${index}][chamber_address]" value="${chamber.chamber_address || ''}" required>
                            </div>
                            <div class="form-group">
                                <label>চেম্বারের যোগাযোগ নম্বর :*</label>
                                <input type="text" class="form-control" name="chambers[${index}][chamber_contact]" value="${chamber.chamber_contact || ''}" required>
                            </div>
                            <div class="form-group">
                                <label>কোন কোন দিন খোলা থাকে :*</label>
                                <input type="text" class="form-control" name="chambers[${index}][chamber_date]" value="${chamber.chamber_date || ''}" required>
                            </div>
                            <div class="form-group">
                                <label>কয়টা থেকে কয়টা পর্যন্ত খোলা থাকে :*</label>
                                <input type="text" class="form-control" name="chambers[${index}][chamber_time]" value="${chamber.chamber_time || ''}" required>
                            </div>
                            <button type="button" class="btn btn-danger remove-single-chamberX">Remove</button>
                        </div>
                    `);
                    chamberCount++;
                });


                modal.find('#modalForm').attr('action', '/admin/doctors/' + id);

            });

            // Add ChamberX
            document.addEventListener("DOMContentLoaded", function () {
                const chamberContainerX = document.getElementById("chamberContainerX");
                const addChamberBtnX = document.getElementById("addChamberBtnX");
                const MAX_CHAMBERS = 5;

                function updateChamberNumbers() {
                    const chambers = chamberContainerX.getElementsByClassName("chamber-group");
                    for (let i = 0; i < chambers.length; i++) {
                        chambers[i].querySelector("h6").textContent = `চেম্বার ${i + 1}`;
                    }
                }

                addChamberBtnX.addEventListener("click", function () {
                    const chamberCount = chamberContainerX.getElementsByClassName("chamber-group").length;
                    if (chamberCount >= MAX_CHAMBERS) {
                        alert("আপনি সর্বোচ্চ ৫টি চেম্বার যোগ করতে পারবেন!");
                        return;
                    }

                    const newChamberGroup = document.createElement("div");
                    newChamberGroup.classList.add("chamber-group", "mb-3");
                    newChamberGroup.innerHTML = `
                        <h6>চেম্বার ${chamberCount}</h6>
                        <div class="form-group">
                            <label>চেম্বারের নাম :*</label>
                            <input type="text" class="form-control" name="chambers[${chamberCount}][chamber_name]" placeholder="চেম্বারের নাম লিখুন" required>
                        </div>
                        <div class="form-group">
                            <label>চেম্বারের ঠিকানা :*</label>
                            <input type="text" class="form-control" name="chambers[${chamberCount}][chamber_address]" placeholder="চেম্বারের ঠিকানা লিখুন" required>
                        </div>
                        <div class="form-group">
                            <label>চেম্বারের যোগাযোগ নম্বর :*</label>
                            <input type="text" class="form-control" name="chambers[${chamberCount}][chamber_contact]" placeholder="ফোন নম্বর লিখুন" required>
                        </div>
                        <div class="form-group">
                            <label>কোন কোন দিন খোলা থাকে :*</label>
                            <input type="text" class="form-control" name="chambers[${chamberCount}][chamber_date]" placeholder="দিন লিখুন" required>
                        </div>
                        <div class="form-group">
                            <label>কয়টা থেকে কয়টা পর্যন্ত খোলা থাকে :*</label>
                            <input type="text" class="form-control" name="chambers[${chamberCount}][chamber_time]" placeholder="সময় লিখুন" required>
                        </div>
                        <button type="button" class="btn btn-danger remove-single-chamberX">Remove</button>
                    `;

                    chamberContainerX.appendChild(newChamberGroup);
                    updateChamberNumbers();
                });

                // Remove Chamber
                chamberContainerX.addEventListener("click", function (event) {
                    if (event.target.classList.contains("remove-single-chamberX")) {
                        event.target.closest(".chamber-group").remove();
                        updateChamberNumbers();
                    }
                });
            });

            //deleteDoctor
            function deleteDoctor(id) {
                if (confirm('Are you sure you want to delete this doctor?')) {
                    $.ajax({
                        url: '{{ route('admin.doctors.destroy') }}',
                        type: 'DELETE',
                        data: {
                            id: id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.status) {
                                alert(response.message);
                                location.reload();
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr) {
                            alert('Failed to delete Doctor. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }

        </script>
    </x-slot>
</x-dashboard-app-layout>
