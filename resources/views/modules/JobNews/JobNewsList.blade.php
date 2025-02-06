<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব - চাকরির খবর |</title>
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
                                <h4> চাকরির খবর </h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createJobNewsModal">Create</a>
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
                                                <th>Logo</th>
                                                <th class="align-left">Job Title</th>
                                                <th class="align-left">	Org Name</th>
                                                <th class="align-left">	Vacancy</th>
                                                <th class="align-left">Upazila</th>
                                                <th class="align-left">	Added By</th>
                                                <th class="align-left">Created At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($jobNewses->isNotEmpty())
                                                @foreach ($jobNewses as $key => $jobNews)
                                                    <tr>
                                                        <td> {{ ++$key }} </td>
                                                        <td class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    class="custom-control-input"
                                                                    id="checkbox-{{ $jobNews->id }}">
                                                                <label for="checkbox-{{ $jobNews->id }}"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                                      @if (!empty($jobNews->image))
                                                                <img class="article-image" alt="image" title="News Image"
                                                                    src="{{ asset('uploads/jobNews/' . $jobNews->image) }}"
                                                                    width="50" height="40">
                                                            @else
                                                                <img class="article-image" alt="image" title="News Image"
                                                                    src="{{ asset('assets/dashboard/img/users/avatar.png') }}"
                                                                    width="50" height="40">
                                                            @endif
                                                        </td>
                                                        <td class="align-left" style=" max-width: 240px;"> {{ $jobNews->job_title }} </td>
                                                        <td class="align-left" style=" max-width: 160px;"> {{ $jobNews->org_name }} </td>
                                                        <td class="align-left"> {{ $jobNews->vacancy }} </td>
                                                        <td class="align-left"> {{ $jobNews->upazila }} </td>
                                                        <td class="align-left"> {{ $jobNews->user->name ?? 'N/A' }}</td>
                                                        <td class="align-left">
                                                            {{ \Carbon\Carbon::parse($jobNews->created_at)->format('d M, Y') }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $statusClass = match ($jobNews->status) {
                                                                    'Approved' => 'badge badge-secondary badge-shadow',
                                                                    'In Review' => 'badge badge-info badge-shadow',
                                                                    'Pending' => 'badge badge-warning badge-shadow',
                                                                    'Denied' => 'badge badge-danger badge-shadow',
                                                                    default => 'badge badge-success badge-shadow',
                                                                };
                                                            @endphp
                                                            <div class="{{ $statusClass }}">
                                                                {{ $jobNews->status }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <a href="#" class="btn btn-success"
                                                                data-toggle="modal" data-target="#viewJobNewsModal"
                                                                data-id="{{ $jobNews->id }}"
                                                                data-user="{{ $jobNews->user->name }}"
                                                                data-job_title="{{ $jobNews->job_title }}"
                                                                data-org_name="{{ $jobNews->org_name }}"
                                                                data-position="{{ $jobNews->position }}"
                                                                data-vacancy="{{ $jobNews->vacancy }}"
                                                                data-education_qualify="{{ $jobNews->education_qualify }}"
                                                                data-experience="{{ $jobNews->experience }}"
                                                                data-upazila="{{ $jobNews->upazila }}"
                                                                data-address="{{ $jobNews->address ?? 'Empty' }}"
                                                                data-contact="{{ $jobNews->contact }}"
                                                                data-email="{{ $jobNews->email  ?? 'Empty' }}"
                                                                data-salary="{{ $jobNews->salary }}"
                                                                data-dateline="{{ $jobNews->dateline }}"
                                                                data-others_info="{{ $jobNews->others_info ?? 'Empty' }}"
                                                                data-status="{{ $jobNews->status }}"
                                                                data-image="{{ $jobNews->image ? asset('uploads/jobNews/' . $jobNews->image) : '' }}"
                                                                data-entry="{{ \Carbon\Carbon::parse($jobNews->created_at)->format('d/m/Y') }}">
                                                                View
                                                            </a>

                                                            <a href="#" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#editJobNewsModal"
                                                                data-id="{{ $jobNews->id }}"
                                                                data-job_title="{{ $jobNews->job_title }}"
                                                                data-org_name="{{ $jobNews->org_name }}"
                                                                data-position="{{ $jobNews->position }}"
                                                                data-vacancy="{{ $jobNews->vacancy }}"
                                                                data-education_qualify="{{ $jobNews->education_qualify }}"
                                                                data-experience="{{ $jobNews->experience }}"
                                                                data-upazila="{{ $jobNews->upazila }}"
                                                                data-address="{{ $jobNews->address ?? '' }}"
                                                                data-contact="{{ $jobNews->contact }}"
                                                                data-email="{{ $jobNews->email  ?? '' }}"
                                                                data-salary="{{ $jobNews->salary }}"
                                                                data-dateline="{{ $jobNews->dateline }}"
                                                                data-others_info="{{ $jobNews->others_info ?? '' }}"
                                                                data-status="{{ $jobNews->status }}"
                                                                data-image="{{ $jobNews->image ? asset('uploads/jobNews/' . $jobNews->image) : '' }}">
                                                                Edit
                                                            </a>

                                                            <a href="javascript:void(0);"
                                                                onclick="deleteJobNews({{ $jobNews->id }})"
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
    <!-- Create jobNews Modal -->
    <div class="modal modalz fade" id="createJobNewsModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">চাকরির খবর যোগ করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Content Goes Here -->
                <form method="POST" action="{{ route('admin.jobnews.store') }}" id="modalForm" enctype="multipart/form-data">
                @csrf

                    <!-- Picture Input with Preview -->
                    <div class="form-group">
                        <label class="row justify-content-center" for="image-upload" id="image-label">লোগো যুক্ত করতে পারেন </label>
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

                    <!-- JobTitle Field -->
                    <div class="form-group">
                        <label for="job_title">চাকরির টাইটেল :* </label>
                        <input type="text" class="form-control" id="job_title" name="job_title" value="{{ old('job_title') }}" placeholder="টাইটেল লিখুন" required>
                    </div>

                     <!-- OrgName Field -->
                    <div class="form-group">
                        <label for="org_name">প্রতিষ্ঠানের নাম :*</label>
                        <input type="text" class="form-control" id="org_name" name="org_name" value="{{ old('org_name') }}" placeholder="প্রতিষ্ঠানের নাম লিখুন" required>
                    </div>

                     <!-- Contact Field -->
                    <div class="form-group">
                        <label for="contact">প্রতিষ্ঠানের যোগাযোগ নম্বর :*</label>
                        <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact') }}" placeholder="ফোন নম্বর লিখুন" required>
                    </div>

                     <!-- Email Field -->
                    <div class="form-group">
                        <label for="email">প্রতিষ্ঠানের ইমেইল</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old(key: 'email') }}" placeholder="ইমেইল লিখুন">
                    </div>

                     <!-- Position Field -->
                    <div class="form-group">
                        <label for="position">পদের নাম :*</label>
                        <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}" placeholder="পদের নাম লিখুন" required>
                    </div>

                    <!-- Vacancy Field -->
                    <div class="form-group">
                        <label for="vacancy">পদের সংখ্যা :* </label>
                        <input type="text" class="form-control" id="vacancy" name="vacancy" value="{{ old('vacancy') }}" placeholder="পদের সংখ্যা লিখুন" required>
                    </div>

                    <!-- EducationQualify Field -->
                    <div class="form-group">
                        <label for="education_qualify">শিক্ষাগত যোগ্যতা :*</label>
                        <input type="text" class="form-control" id="education_qualify" name="education_qualify" value="{{ old('education_qualify') }}" placeholder="শিক্ষাগত যোগ্যতা কি? কি?" required>
                    </div>

                    <!-- experience Field -->
                    <div class="form-group">
                        <label for="experience">অভিজ্ঞতা কত বছর :* </label>
                        <input type="text" class="form-control" id="experience" name="experience" value="{{ old('experience') }}" placeholder="কত বছরের অভিজ্ঞতা ?" required>
                    </div>

                    <!-- Dateline Field -->
                    <div class="form-group">
                        <label for="dateline">আবেদনের সর্বশেষ তারিখ :* </label>
                        <input type="text" class="form-control" id="dateline" name="dateline" value="{{ old('dateline') }}" placeholder="সর্বশেষ তারিখ লিখুন" required>
                    </div>

                    <!-- Salary Field -->
                    <div class="form-group ">
                        <label for="salary">বেতন :*</label>
                        <input type="text" class="form-control" id="salary" name="salary" value="{{ old('salary') }}" placeholder="বেতন কত? লিখুন" required>
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
                        <label for="address"> বিস্তারিত ঠিকানা :</label>
                        <textarea class="form-control" id="address" name="address" value="{{ old('address') }}" rows="3" placeholder="ঠিকানা লিখুন"></textarea>
                    </div>

                    <!-- OthersInfo Field -->
                    <div class="form-group ">
                        <label for="others_info">অন্যান্য তথ্য :</label>
                        <textarea class="form-control" id="others_info" name="others_info" value="{{ old('others_info') }}" placeholder="অন্যান্য তথ্য লিখুন"></textarea>
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

    <!-- Edit jobNews Modal -->
    <div class="modal modalz fade" id="editJobNewsModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">

            <!-- Modal Content Goes Here -->
            <form method="POST" action="" id="modalFormX" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">চাকরির খবর ডাটা পরিবর্তন </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                     <!-- Picture Input with Preview -->
                     <div class="form-group">
                        <label class="row justify-content-center" for="image-upload" id="image-label">লোগো যুক্ত করতে পারেন </label>
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

                    <!-- JobTitle Field -->
                    <div class="form-group">
                        <label for="job_title">চাকরির টাইটেল :* </label>
                        <input type="text" class="form-control" id="job_title" name="job_title" value="{{ old('job_title') }}" placeholder="টাইটেল লিখুন" required>
                        {{-- <input type="text" class="form-control" id="job_title" name="job_title" value="{{ old('job_title', $jobNews->job_title) }}" placeholder="টাইটেল লিখুন"> --}}
                    </div>

                    <!-- OrgName Field -->
                    <div class="form-group">
                        <label for="org_name">প্রতিষ্ঠানের নাম :*</label>
                        <input type="text" class="form-control" id="org_name" name="org_name" value="{{ old('org_name') }}" placeholder="প্রতিষ্ঠানের নাম লিখুন" required>
                    </div>

                    <!-- Contact Field -->
                    <div class="form-group">
                        <label for="contact">প্রতিষ্ঠানের যোগাযোগ নম্বর :*</label>
                        <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact') }}" placeholder="ফোন নম্বর লিখুন" required>
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email">প্রতিষ্ঠানের ইমেইল</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old(key: 'email') }}" placeholder="ইমেইল লিখুন">
                    </div>

                    <!-- Position Field -->
                    <div class="form-group">
                        <label for="position">পদের নাম :*</label>
                        <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}" placeholder="পদের নাম লিখুন" required>
                    </div>

                    <!-- Vacancy Field -->
                    <div class="form-group">
                        <label for="vacancy">পদের সংখ্যা :* </label>
                        <input type="text" class="form-control" id="vacancy" name="vacancy" value="{{ old('vacancy') }}" placeholder="পদের সংখ্যা লিখুন" required>
                    </div>

                    <!-- EducationQualify Field -->
                    <div class="form-group">
                        <label for="education_qualify">শিক্ষাগত যোগ্যতা :*</label>
                        <input type="text" class="form-control" id="education_qualify" name="education_qualify" value="{{ old('education_qualify') }}" placeholder="শিক্ষাগত যোগ্যতা কি? কি?" required>
                    </div>

                    <!-- experience Field -->
                    <div class="form-group">
                        <label for="experience">অভিজ্ঞতা কত বছর :* </label>
                        <input type="text" class="form-control" id="experience" name="experience" value="{{ old('experience') }}" placeholder="কত বছরের অভিজ্ঞতা ?" required>
                    </div>

                    <!-- Dateline Field -->
                    <div class="form-group">
                        <label for="dateline">আবেদনের সর্বশেষ তারিখ :* </label>
                        <input type="text" class="form-control" id="dateline" name="dateline" value="{{ old('dateline') }}" placeholder="সর্বশেষ তারিখ লিখুন" required>
                    </div>

                    <!-- Salary Field -->
                    <div class="form-group ">
                        <label for="salary">বেতন :*</label>
                        <input type="text" class="form-control" id="salary" name="salary" value="{{ old('salary') }}" placeholder="বেতন কত? লিখুন" required>
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
                        <label for="address"> বিস্তারিত ঠিকানা :</label>
                        <textarea class="form-control" id="address" name="address" value="{{ old('address') }}" rows="3" placeholder="ঠিকানা লিখুন"></textarea>
                    </div>

                    <!-- OthersInfo Field -->
                    <div class="form-group ">
                        <label for="others_info">অন্যান্য তথ্য :</label>
                        <textarea class="form-control" id="others_info" name="others_info" value="{{ old('others_info') }}" placeholder="অন্যান্য তথ্য লিখুন"></textarea>
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

    <!-- View jobNews Modal -->
    <div class="modal modalz fade" id="viewJobNewsModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">চাকরির খবর ভিউ ডাটা</h5>
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
                                                    <img id="modalImage" src="" style="width: 300px; height: 160px;" title="todayNews Logo" alt="logo">
                                                </div>
                                                <div class="flex-fill bd-highlight align-self-center">
                                                    <div><samp class="sampcolor">স্ট্যাটাস: </samp> <span id="xStatus"></span></div>
                                                    <div><hr/></div>
                                                    <div><samp class="sampcolor">উপজেলা: </samp> <span id="xUpazila"></span></div>
                                                    <div><samp class="sampcolor">বিস্তারিত ঠিকানা: </samp> <span id="xAddress"></span></div>
                                                    <div><samp class="sampcolor">নিবন্ধন তারিখ: </samp> <span id="xEntry"></span></div>
                                                    <div><samp class="sampcolor">যোগ করেছেন: </samp> <span id="xUser"></span></div>
                                                </div>
                                            </div>

                                            <div class="mt-3"><h6><samp class="dark-color">টাইটেল: </samp> <span id="xJobTitle"></span></h6></div>
                                            <div><samp class="sampcolor">প্রতিষ্ঠানের নাম: </samp> <span id="xOrgName"></span></div>
                                            <div><samp class="sampcolor">প্রতিষ্ঠানের নম্বর: </samp> <span id="xContact"></span></div>
                                            <div><samp class="sampcolor">প্রতিষ্ঠানের ইমেইল: </samp> <span id="xEmail"></span></div>
                                            <div><hr/></div>
                                            <div><samp class="sampcolor">পদের নাম: </samp> <span id="xPosition"></span></div>
                                            <div><samp class="sampcolor">পদের সংখ্যা: </samp> <span id="xVacancy"></span></div>
                                            <div><samp class="sampcolor">শিক্ষাগত যোগ্যতা: </samp> <span id="xEduQualify"></span></div>
                                            <div><samp class="sampcolor">অভিজ্ঞতা: </samp> <span id="xExperience"></span></div>
                                            <div><samp class="sampcolor">বেতন: </samp> <span id="xSalary"></span></div>
                                            <div><samp class="sampcolor">আবেদনের সর্বশেষ তারিখ: </samp> <span id="xDateline"></span></div>
                                            <div><samp class="sampcolor">চাকরির বেপারে অন্যান্য তথ্য: </samp> <span id="xOthersInfo"></span></div>
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


            //viewJobNewsModal
            $('#viewJobNewsModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                // Fetch data from the button
                var id = button.data('id');
                var user = button.data('user');
                var job_title = button.data('job_title');
                var org_name = button.data('org_name');
                var position = button.data('position');
                var vacancy = button.data('vacancy');
                var education_qualify = button.data('education_qualify');
                var experience = button.data('experience');
                var upazila = button.data('upazila');
                var address = button.data('address')|| '';
                var contact = button.data('contact');
                var email = button.data('email') || '';
                var salary = button.data('salary');
                var dateline = button.data('dateline');
                var others_info = button.data('others_info') || '';
                var status = button.data('status');
                var entry = button.data('entry');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#xUser').text(user);
                modal.find('#xJobTitle').text(job_title);
                modal.find('#xOrgName').text(org_name);
                modal.find('#xPosition').text(position);
                modal.find('#xVacancy').text(vacancy);
                modal.find('#xEduQualify').text(education_qualify);
                modal.find('#xExperience').text(experience);
                modal.find('#xUpazila').text(upazila);
                modal.find('#xAddress').text(address);
                modal.find('#xContact').text(contact);
                modal.find('#xEmail').text(email);
                modal.find('#xSalary').text(salary);
                modal.find('#xDateline').text(dateline);
                modal.find('#xOthersInfo').text(others_info);
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

            //editJobNewsModal
            $('#editJobNewsModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var job_title = button.data('job_title');
                var org_name = button.data('org_name');
                var position = button.data('position');
                var vacancy = button.data('vacancy');
                var education_qualify = button.data('education_qualify');
                var experience = button.data('experience');
                var upazila = button.data('upazila');
                var address = button.data('address');
                var contact = button.data('contact');
                var email = button.data('email');
                var salary = button.data('salary');
                var dateline = button.data('dateline');
                var others_info = button.data('others_info');
                var status = button.data('status');
                var image = button.data('image');

                var modal = $(this);

                modal.find('#job_title').val(job_title);
                modal.find('#org_name').val(org_name);
                modal.find('#position').val(position);
                modal.find('#vacancy').val(vacancy);
                modal.find('#education_qualify').val(education_qualify);
                modal.find('#experience').val(experience);
                modal.find('#upazila').val(upazila);
                modal.find('#address').val(address);
                modal.find('#contact').val(contact);
                modal.find('#email').val(email);
                modal.find('#salary').val(salary);
                modal.find('#dateline').val(dateline);
                modal.find('#others_info').val(others_info);
                modal.find('#status').val(status);

                var imagePreview = modal.find('#imagePreviewX');
                if (image) {
                    imagePreview.html('<img src="' + image + '" class="img-fluid" />');
                } else {
                    imagePreview.html('<i class="bi bi-image" style="font-size: 60px; color: #ccc;"></i>');
                }

                modal.find('#modalFormX').attr('action', '/admin/jobnews/' + id);


            });

            //deleteJobNews
            function deleteJobNews(id) {
                if (confirm('Are you sure you want to delete this JobNews?')) {
                    $.ajax({
                        url: '{{ route('admin.jobnews.destroy') }}',
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
                            alert('Failed to delete JobNews. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }

        </script>
    </x-slot>


</x-dashboard-app-layout>
