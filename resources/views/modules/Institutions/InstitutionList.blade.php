<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব - শিক্ষা প্রতিষ্ঠান |</title>
    </x-slot>
    <style> .ck-editor__editable_inline{  height:240px; } </style>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <!-- Button to Open the Modal -->
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>শিক্ষা প্রতিষ্ঠান</h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createInstitutionModal">Create</a>
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
                                                <th class="align-left">Category</th>
                                                <th class="align-left">Est Year</th>
                                                <th class="align-left">Type</th>
                                                <th class="align-left">	Contact</th>
                                                <th class="align-left">Upazila</th>
                                                <th class="align-left">	Added By</th>
                                                <th class="align-left">Created At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($institutions->isNotEmpty())
                                                @foreach ($institutions as $key => $institution)
                                                    <tr>
                                                        <td> {{ ++$key }} </td>
                                                        <td class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    class="custom-control-input"
                                                                    id="checkbox-{{ $institution->id }}">
                                                                <label for="checkbox-{{ $institution->id }}"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if (!empty($institution->image))
                                                                <img class="article-image" alt="image" title="Image"
                                                                    src="{{ asset('uploads/institutions/' . $institution->image) }}"
                                                                    width="70" height="40">
                                                            @else
                                                                <img class="article-image" alt="image" title="Image"
                                                                    src="{{ asset('assets/dashboard/img/users/avatar.png') }}"
                                                                    width="70" height="40">
                                                            @endif
                                                        </td>
                                                        <td class="align-left"> {{ $institution->category }} </td>
                                                        <td class="align-left"> {{ $institution->est_year }} </td>
                                                        <td class="align-left"> {{ $institution->type }} </td>
                                                        <td class="align-left"> {{ $institution->contact }} </td>
                                                        <td class="align-left"> {{ $institution->upazila }} </td>
                                                        <td class="align-left"> {{ $institution->user->name ?? 'N/A' }}</td>
                                                        <td class="align-left">
                                                            {{ \Carbon\Carbon::parse($institution->created_at)->format('d M, Y') }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $statusClass = match ($institution->status) {
                                                                    'Approved' => 'badge badge-secondary badge-shadow',
                                                                    'In Review' => 'badge badge-info badge-shadow',
                                                                    'Pending' => 'badge badge-warning badge-shadow',
                                                                    'Denied' => 'badge badge-danger badge-shadow',
                                                                    default => 'badge badge-success badge-shadow',
                                                                };
                                                            @endphp
                                                            <div class="{{ $statusClass }}">
                                                                {{ $institution->status }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <a href="#" class="btn btn-success"
                                                                data-toggle="modal" data-target="#viewInstitutionModal"
                                                                data-id="{{ $institution->id }}"
                                                                data-user="{{ $institution->user->name }}"
                                                                data-category="{{ $institution->category }}"
                                                                data-title="{{ $institution->title }}"
                                                                data-est_year="{{ $institution->est_year }}"
                                                                data-details="{{ $institution->details }}"
                                                                data-type="{{ $institution->type }}"
                                                                data-contact="{{ $institution->contact }}"
                                                                data-email="{{ $institution->email?? 'Empty' }}"
                                                                data-upazila="{{ $institution->upazila }}"
                                                                data-address="{{ $institution->address }}"
                                                                data-status="{{ $institution->status }}"
                                                                data-image="{{ $institution->image ? asset('uploads/institutions/' . $institution->image) : '' }}"
                                                                data-entry="{{ \Carbon\Carbon::parse($institution->created_at)->format('d/m/Y') }}">
                                                                View
                                                            </a>

                                                            <a href="#" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#editInstitutionModal"
                                                                data-id="{{ $institution->id }}"
                                                                data-category="{{ $institution->category }}"
                                                                data-title="{{ $institution->title }}"
                                                                data-est_year="{{ $institution->est_year }}"
                                                                data-details="{{ $institution->details }}"
                                                                data-type="{{ $institution->type }}"
                                                                data-contact="{{ $institution->contact }}"
                                                                data-email="{{ $institution->email?? '' }}"
                                                                data-upazila="{{ $institution->upazila }}"
                                                                data-address="{{ $institution->address }}"
                                                                data-status="{{ $institution->status }}"
                                                                data-image="{{ $institution->image ? asset('uploads/institutions/' . $institution->image) : '' }}">
                                                                Edit
                                                            </a>

                                                            <a href="javascript:void(0);"
                                                                onclick="deleteInstitution({{ $institution->id }})"
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
    <!-- Create Institution Modal -->
    <div class="modal modalz fade" id="createInstitutionModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">শিক্ষক যোগ করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Content Goes Here -->
                <form method="POST" action="{{ route('admin.institutions.store') }}" id="modalForm" enctype="multipart/form-data">
                @csrf

                    <!-- Title Field -->
                    <div class="form-group">
                        <label for="title">প্রতিষ্ঠানের নাম/টাইটেল :*</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old(key: 'title') }}" placeholder="নাম/টাইটেল লিখুন" required>
                    </div>

                    <!-- Category Field -->
                    <div class="form-group">
                        <label for="category">ক্যাটাগরি :* </label>
                        <select class="form-control" id="category" name="category" required>
                            <option value=""> নির্বাচন করুন </option>
                            <option value="স্কুল">স্কুল</option>
                            <option value="কলেজ">কলেজ</option>
                            <option value="স্কুল ও কলেজ">স্কুল ও কলেজ</option>
                            <option value="মাদ্রাসা">মাদ্রাসা</option>
                            <option value="মক্তব">মক্তব</option>
                            <option value="কিন্ডারগার্টেন">কিন্ডারগার্টেন</option>
                            <option value="কোচিং সেন্টারের">কোচিং সেন্টারের</option>
                            <option value="অন্যান্য">অন্যান্য</option>
                        </select>
                    </div>

                     <!-- Type Field -->
                     <div class="form-group">
                        <label for="type">প্রতিষ্ঠানের ধরন :* </label>
                        <select class="form-control" id="type" name="type" required>
                            <option value=""> নির্বাচন করুন </option>
                            <option value="সরকারি">সরকারি</option>
                            <option value="আধা সরকারি">আধা সরকারি</option>
                            <option value="বেসরকারি">বেসরকারি</option>
                            <option value="অন্যান্য">অন্যান্য</option>
                        </select>
                    </div>

                    <!-- EstYear Field -->
                    <div class="form-group">
                        <label for="est_year">প্রতিষ্ঠানের স্থাপিত সাল :*</label>
                        <input type="text" class="form-control" id="est_year" name="est_year" value="{{ old(key: 'est_year') }}" placeholder="সাল লিখুন" required>
                    </div>

                    <!-- Details Field -->
                    <div class="form-group ">
                        <label for="details">প্রতিষ্ঠানের বেপারে বিস্তারিত :*</label>
                        <textarea class="" id="editor" name="details" value="{{ old(key: 'details') }}" placeholder="বিস্তারিত লিখুন"></textarea>
                    </div>

                    <!-- Contact Field -->
                    <div class="form-group">
                        <label for="contact">যোগাযোগ নম্বর :*</label>
                        <input type="text" name="contact" class="form-control" id="contact" value="{{ old(key: 'contact') }}" placeholder="ফোন নম্বর লিখুন" required>
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email">প্রতিষ্ঠানের ইমেইল : (যদি থাকে)</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{ old(key: 'email') }}" placeholder="ইমেইল লিখুন">
                    </div>


                    <!-- Upazila Field -->
                    <div class="form-group">
                        <label for="upazila">উপজেলা :* </label>
                        <select class="form-control" id="upazila" name="upazila" required>
                            <option value=""> নির্বাচন করুন </option>
                            <option value="বোদা">বোদা</option>
                            <option value="দেবীগঞ্জ">দেবীগঞ্জ</option>
                            <option value="আটোয়ারী">আটোয়ারী</option>
                            <option value="তেঁতুলিয়া">তেঁতুলিয়া</option>
                            <option value="পঞ্চগড় সদর">পঞ্চগড় সদর</option>
                        </select>
                    </div>

                    <!-- Address Field -->
                    <div class="form-group">
                        <label for="address">বিস্তারিত ঠিকানা :*</label>
                        <textarea class="form-control" id="address" name="address" value="{{ old('address') }}" rows="3" placeholder="ঠিকানা লিখুন" required></textarea>
                    </div>

                    <!-- Picture Input with Preview -->
                    <div class="form-group">
                        <label class="row justify-content-center" for="image-upload" id="image-label">ছবি যুক্ত করুন </label>
                        <div class="row justify-content-center">
                            <div class="position-relative">
                                <div class="image-preview" id="imagePreview" style="width: 280px; height: 160px; background-color: #f2f2f2; border-radius: 5px;">
                                    <i class="bi bi-image" style="font-size: 80px; color: #ccc;"></i>
                                </div>
                                <div class="edit-icon position-absolute" id="editIcon" style="bottom: 10px; right: 10px; border-radius: 50%; padding: 5px; cursor: pointer;">
                                    <i class="bi bi-pencil-square"></i>
                                </div>
                                <input type="file" value="{{ old('image') }}" name="image" class="form-control d-none" id="fileInput" accept="image/*">
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Now</button>
                    </div>

                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Edit Institution Modal -->
    <div class="modal modalz fade" id="editInstitutionModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">

            <!-- Modal Content Goes Here -->
            <form method="POST" action="" id="modalFormX" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">নার্সারি ডাটা পরিবর্তন </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <!-- Title Field -->
                    <div class="form-group">
                        <label for="title">প্রতিষ্ঠানের নাম/টাইটেল :*</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old(key: 'title') }}" placeholder="নাম/টাইটেল লিখুন" required>
                    </div>

                    <!-- Category Field -->
                    <div class="form-group">
                        <label for="category">ক্যাটাগরি :* </label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="স্কুল" {{ old('category') == 'স্কুল' ? 'selected' : '' }}> স্কুল</option>
                            <option value="কলেজ" {{ old('category') == 'কলেজ' ? 'selected' : '' }}>কলেজ</option>
                            <option value="স্কুল ও কলেজ" {{ old('category') == 'স্কুল ও কলেজ' ? 'selected' : '' }}>স্কুল ও কলেজ</option>
                            <option value="মাদ্রাসা" {{ old('category') == 'মাদ্রাসা' ? 'selected' : '' }}>মাদ্রাসা</option>
                            <option value="মক্তব" {{ old('category') == 'মক্তব' ? 'selected' : '' }}>মক্তব</option>
                            <option value="কিন্ডারগার্টেন" {{ old('category') == 'কিন্ডারগার্টেন' ? 'selected' : '' }}>কিন্ডারগার্টেন</option>
                            <option value="কোচিং সেন্টারের" {{ old('category') == 'কোচিং সেন্টারের' ? 'selected' : '' }}>কোচিং সেন্টারের</option>
                            <option value="অন্যান্য" {{ old('category') == 'অন্যান্য' ? 'selected' : '' }}>অন্যান্য</option>
                        </select>
                    </div>

                     <!-- Type Field -->
                     <div class="form-group">
                        <label for="type">প্রতিষ্ঠানের ধরন :* </label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="সরকারি" {{ old('type') == 'সরকারি' ? 'selected' : '' }}> সরকারি</option>
                            <option value="আধা সরকারি" {{ old('type') == 'আধা সরকারি' ? 'selected' : '' }}>আধা সরকারি</option>
                            <option value="বেসরকারি" {{ old('type') == 'বেসরকারি' ? 'selected' : '' }}>বেসরকারি</option>
                            <option value="অন্যান্য" {{ old('type') == 'অন্যান্য' ? 'selected' : '' }}>অন্যান্য</option>
                        </select>
                    </div>

                    <!-- EstYear Field -->
                    <div class="form-group">
                        <label for="est_year">প্রতিষ্ঠানের স্থাপিত সাল :*</label>
                        <input type="text" class="form-control" id="est_year" name="est_year" value="{{ old(key: 'est_year') }}" placeholder="সাল লিখুন" required>
                    </div>

                    <!-- Details Field -->
                    <div class="form-group ">
                        <label for="details">প্রতিষ্ঠানের বেপারে বিস্তারিত :*</label>
                        <textarea class="" id="editorX" name="details" value="{{ old(key: 'details') }}" placeholder="বিস্তারিত লিখুন"></textarea>
                    </div>

                    <!-- Contact Field -->
                    <div class="form-group">
                        <label for="contact">যোগাযোগ নম্বর :*</label>
                        <input type="text" name="contact" class="form-control" id="contact" value="{{ old(key: 'contact') }}" placeholder="ফোন নম্বর লিখুন" required>
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email">প্রতিষ্ঠানের ইমেইল : (যদি থাকে)</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{ old(key: 'email') }}" placeholder="ইমেইল লিখুন">
                    </div>


                    <!-- Upazila Field -->
                    <div class="form-group">
                        <label for="upazila">উপজেলা :* </label>
                        <select class="form-control" id="upazila" name="upazila" required>
                            <option value="বোদা" {{ old('upazila') == 'বোদা' ? 'selected' : '' }}> বোদা</option>
                            <option value="দেবীগঞ্জ" {{ old('upazila') == 'দেবীগঞ্জ' ? 'selected' : '' }}>দেবীগঞ্জ</option>
                            <option value="আটোয়ারী" {{ old('upazila') == 'আটোয়ারী' ? 'selected' : '' }}>আটোয়ারী</option>
                            <option value="তেঁতুলিয়া" {{ old('upazila') == 'তেঁতুলিয়া' ? 'selected' : '' }}>তেঁতুলিয়া</option>
                            <option value="পঞ্চগড় সদর" {{ old('upazila') == 'পঞ্চগড় সদর' ? 'selected' : '' }}>পঞ্চগড় সদর</option>

                        </select>
                    </div>

                    <!-- Address Field -->
                    <div class="form-group">
                        <label for="address">বিস্তারিত ঠিকানা :*</label>
                        <textarea class="form-control" id="address" name="address" value="{{ old('address') }}" rows="3" placeholder="ঠিকানা লিখুন" required></textarea>
                    </div>

                    <!-- Picture Input with Preview -->
                    <div class="form-group">
                        <label class="row justify-content-center" for="image-upload" id="image-label"> ছবি যুক্ত করুন </label>
                        <div class="row justify-content-center">
                            <div class="position-relative">
                                <div class="image-preview" id="imagePreviewX" style="width: 280px; height: 160px; background-color: #f2f2f2; border-radius: 5px;">
                                    <i class="bi bi-image" style="font-size: 80px; color: #ccc;"></i>
                                </div>
                                <div class="edit-icon position-absolute" id="editIconX" style="bottom: 10px; right: 10px; border-radius: 50%; padding: 5px; cursor: pointer;">
                                    <i class="bi bi-pencil-square"></i>
                                </div>
                                <input type="file" name="image" class="form-control d-none" id="fileInputX" accept="image/*">
                            </div>
                        </div>
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
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>

                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- View Institution Modal -->
    <div class="modal modalz fade" id="viewInstitutionModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">শিক্ষক ভিউ ডাটা</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body pb-0">
                    <section class="section about-section gray-bg" id="about">
                        <div class="row align-items-center flex-column">
                            <div class="col-lg-12">
                                <div class="about-text about-list">
                                    <div class="d-flex bd-highlight p-2">
                                        <div class="p-2 flex-grow-1 bd-highlight">

                                            <div class="d-flex bd-highlight">
                                                <div class="flex-fill bd-highlight mr-3">
                                                    <img id="modalImage" src="" style="width: 300px; height: 160px;" title="institution Logo" alt="logo">
                                                </div>
                                                <div class="flex-fill bd-highlight align-self-center">
                                                    <div><samp class="sampcolor">স্ট্যাটাস: </samp> <span id="xStatus"></span></div>
                                                    <div><hr/></div>
                                                    <div><samp class="sampcolor">উপজেলা: </samp> <span id="xUpazila"></span></div>
                                                    <div><samp class="sampcolor">নিবন্ধন তারিখ: </samp> <span id="xEntry"></span></div>
                                                    <div><samp class="sampcolor">যোগ করেছেন: </samp> <span id="xUser"></span></div>
                                                </div>
                                            </div>

                                            <h6 class="dark-color mt-3 mb-2"><span id="xTitle"></span> </h6>
                                            <div><samp class="sampcolor">ক্যাটাগরি: </samp> <span id="xCategory"></span></div>
                                            <div><samp class="sampcolor">প্রতিষ্ঠানের ধরন: </samp> <span id="xType"></span></div>
                                            <div><samp class="sampcolor">প্রতিষ্ঠানের স্থাপিত সাল: </samp> <span id="xEstYear"></span></div>
                                            <div><samp class="sampcolor">বিস্তারিত ঠিকানা: </samp> <span id="xAddress"></span></div>
                                            <div><samp class="sampcolor">যোগাযোগ নম্বর: </samp> <span id="xContact"></span></div>
                                            <div><samp class="sampcolor">প্রতিষ্ঠানের ইমেইল: </samp> <span id="xEmail"></span></div>
                                            <div><hr/></div>
                                            <div><samp class="sampcolor">প্রতিষ্ঠানের বেপারে বিস্তারিত: </samp> <span id="xDetails"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            $('#editInstitutionModal').on('hidden.bs.modal', function() {
                if (editorInstance) {
                    editorInstance.destroy();
                    editorInstance = null;
                }
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


            //viewInstitutionModal
            $('#viewInstitutionModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                // Fetch data from the button
                var id = button.data('id');
                var user = button.data('user');
                var category = button.data('category');
                var title = button.data('title');
                var est_year = button.data('est_year');
                var details = button.data('details');
                var type = button.data('type');
                var contact = button.data('contact');
                var email = button.data('email') || '';
                var upazila = button.data('upazila');
                var address = button.data('address');
                var status = button.data('status');
                var entry = button.data('entry');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#xUser').text(user);
                modal.find('#xCategory').text(category);
                modal.find('#xTitle').text(title);
                modal.find('#xEstYear').text(est_year);
                modal.find('#xDetails').html(details);
                modal.find('#xType').text(type);
                modal.find('#xContact').text(contact);
                modal.find('#xEmail').text(email);
                modal.find('#xUpazila').text(upazila);
                modal.find('#xAddress').text(address);
                modal.find('#xStatus').text(status);
                modal.find('#xEntry').text(entry);

                // Set the image source correctly
                var modalImage = modal.find('#modalImage');
                if (image) {
                    modalImage.attr('src', image);
                } else {
                    modalImage.attr('src', "{{ asset('assets/dashboard/img/users/avatar.png') }}");
                }
            });

            //editInstitutionModal
            $('#editInstitutionModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var category = button.data('category');
                var title = button.data('title');
                var est_year = button.data('est_year');
                var details = button.data('details');
                var type = button.data('type');
                var contact = button.data('contact');
                var email = button.data('email') || '';
                var upazila = button.data('upazila');
                var address = button.data('address');
                var status = button.data('status');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#category').val(category);
                modal.find('#title').val(title);
                modal.find('#est_year').val(est_year);
                modal.find('#type').val(type);
                modal.find('#contact').val(contact);
                modal.find('#email').val(email);
                modal.find('#upazila').val(upazila);
                modal.find('#address').val(address);
                modal.find('#status').val(status);

                // Initialize CKEditor if it hasn't been initialized yet
                if (!editorInstance) {
                    initializeCKEditor().then(editor => {
                        editorInstance = editor;
                        editorInstance.setData(details);
                    });
                } else {
                    editorInstance.setData(details);
                }

                var imagePreview = modal.find('#imagePreviewX');
                if (image) {
                    imagePreview.html('<img src="' + image + '" class="img-fluid" />');
                } else {
                    imagePreview.html('<i class="bi bi-image" style="font-size: 60px; color: #ccc;"></i>');
                }

                modal.find('#modalFormX').attr('action', '/admin/institutions/' + id);


            });

            //deleteInstitution
            function deleteInstitution(id) {
                if (confirm('Are you sure you want to delete this Institution?')) {
                    $.ajax({
                        url: '{{ route('admin.institutions.destroy') }}',
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
                            alert('Failed to delete Institution. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }

        </script>
    </x-slot>


</x-dashboard-app-layout>
