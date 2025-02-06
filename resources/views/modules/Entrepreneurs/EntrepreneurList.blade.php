<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব - উদ্যোক্তা |</title>
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
                                <h4>উদ্যোক্তা সমূহ</h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createEntrepreneurModal">Create</a>
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
                                                <th class="align-left">Name</th>
                                                <th class="align-left">	Contact</th>
                                                <th class="align-left">Upazila</th>
                                                <th class="align-left">	Added By</th>
                                                <th class="align-left">Created At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($entrepreneurs->isNotEmpty())
                                                @foreach ($entrepreneurs as $key => $entrepreneur)
                                                    <tr>
                                                        <td> {{ ++$key }} </td>
                                                        <td class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    class="custom-control-input"
                                                                    id="checkbox-{{ $entrepreneur->id }}">
                                                                <label for="checkbox-{{ $entrepreneur->id }}"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if (!empty($entrepreneur->image))
                                                                <img class="article-image" alt="image" title="Image"
                                                                    src="{{ asset('uploads/entrepreneurs/' . $entrepreneur->image) }}"
                                                                    width="70" height="40">
                                                            @else
                                                                <img class="article-image" alt="image" title="Image"
                                                                    src="{{ asset('assets/dashboard/img/users/avatar.png') }}"
                                                                    width="70" height="40">
                                                            @endif
                                                        </td>
                                                        <td class="align-left" style=" max-width: 250px;"> {{ $entrepreneur->name }} </td>
                                                        <td class="align-left"> {{ $entrepreneur->contact }} </td>
                                                        <td class="align-left"> {{ $entrepreneur->upazila }} </td>
                                                        <td class="align-left"> {{ $entrepreneur->user->name ?? 'N/A' }}</td>
                                                        <td class="align-left">
                                                            {{ \Carbon\Carbon::parse($entrepreneur->created_at)->format('d M, Y') }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $statusClass = match ($entrepreneur->status) {
                                                                    'Approved' => 'badge badge-secondary badge-shadow',
                                                                    'In Review' => 'badge badge-info badge-shadow',
                                                                    'Pending' => 'badge badge-warning badge-shadow',
                                                                    'Denied' => 'badge badge-danger badge-shadow',
                                                                    default => 'badge badge-success badge-shadow',
                                                                };
                                                            @endphp
                                                            <div class="{{ $statusClass }}">
                                                                {{ $entrepreneur->status }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <a href="#" class="btn btn-success"
                                                                data-toggle="modal" data-target="#viewEntrepreneurModal"
                                                                data-id="{{ $entrepreneur->id }}"
                                                                data-user="{{ $entrepreneur->user->name }}"
                                                                data-name="{{ $entrepreneur->name }}"
                                                                data-contact="{{ $entrepreneur->contact ?? 'Empty' }}"
                                                                data-fb_page_name="{{ $entrepreneur->fb_page_name ?? 'Empty' }}"
                                                                data-page_link="{{ $entrepreneur->page_link ?? 'Empty' }}"
                                                                data-email="{{ $entrepreneur->email ?? 'Empty' }}"
                                                                data-servies="{{ $entrepreneur->servies }}"
                                                                data-upazila="{{ $entrepreneur->upazila }}"
                                                                data-address="{{ $entrepreneur->address?? 'Empty' }}"
                                                                data-status="{{ $entrepreneur->status }}"
                                                                data-image="{{ $entrepreneur->image ? asset('uploads/entrepreneurs/' . $entrepreneur->image) : '' }}"
                                                                data-entry="{{ \Carbon\Carbon::parse($entrepreneur->created_at)->format('d/m/Y') }}">
                                                                View
                                                            </a>

                                                            <a href="#" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#editEntrepreneurModal"
                                                                data-id="{{ $entrepreneur->id }}"
                                                                data-name="{{ $entrepreneur->name }}"
                                                                data-contact="{{ $entrepreneur->contact ?? '' }}"
                                                                data-fb_page_name="{{ $entrepreneur->fb_page_name ?? '' }}"
                                                                data-page_link="{{ $entrepreneur->page_link ?? '' }}"
                                                                data-email="{{ $entrepreneur->email ?? '' }}"
                                                                data-servies="{{ $entrepreneur->servies }}"
                                                                data-upazila="{{ $entrepreneur->upazila }}"
                                                                data-address="{{ $entrepreneur->address?? '' }}"
                                                                data-status="{{ $entrepreneur->status }}"
                                                                data-image="{{ $entrepreneur->image ? asset('uploads/entrepreneurs/' . $entrepreneur->image) : '' }}">
                                                                Edit
                                                            </a>

                                                            <a href="javascript:void(0);"
                                                                onclick="deleteEntrepreneur({{ $entrepreneur->id }})"
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
    <!-- Create Entrepreneur Modal -->
    <div class="modal modalz fade" id="createEntrepreneurModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">উদ্যোক্তা যোগ করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Content Goes Here -->
                <form method="POST" action="{{ route('admin.entrepreneurs.store') }}" id="modalForm" enctype="multipart/form-data">
                @csrf

                    <!-- Name Field -->
                    <div class="form-group">
                        <label for="name">উদ্যোক্তার নাম :*</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old(key: 'name') }}" placeholder="নাম লিখুন" required>
                    </div>

                    <!-- Servies Field -->
                    <div class="form-group ">
                        <label for="servies">উপকরণ/পণ্য বা সেবা সম্পর্কিত তথ্য :*</label>
                        <textarea class="" id="editor" name="servies" value="{{ old('servies') }}" placeholder="বিস্তারিত লিখুন"></textarea>
                    </div>

                    <!-- Contact Field -->
                    <div class="form-group">
                        <label for="contact">যোগাযোগ নম্বর :</label>
                        <input type="text" name="contact" class="form-control" id="contact" value="{{ old(key: 'contact') }}" placeholder="ফোন নম্বর লিখুন">
                    </div>

                    <!-- FB_PageName Field -->
                    <div class="form-group">
                        <label for="fb_page_name">ফেসবুক পেজের নাম :</label>
                        <input type="text" name="fb_page_name" class="form-control" id="fb_page_name" value="{{ old(key: 'fb_page_name') }}" placeholder="পেজের নাম লিখুন">
                    </div>

                    <!-- PageLink Field -->
                    <div class="form-group">
                        <label for="page_link">পেজের লিংক :</label>
                        <input type="text" name="page_link" class="form-control" id="page_link" value="{{ old(key: 'page_link') }}" placeholder="লিংক লিখুন">
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email">ইমেল : (যদিন থাকে)</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{ old(key: 'email') }}" placeholder="ইমেল লিখুন">
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
                        <label for="address">বিস্তারিত ঠিকানা :</label>
                        <textarea class="form-control" id="address" name="address" value="{{ old('address') }}" rows="3" placeholder="ঠিকানা লিখুন"></textarea>
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

    <!-- Edit Entrepreneur Modal -->
    <div class="modal modalz fade" id="editEntrepreneurModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">

            <!-- Modal Content Goes Here -->
            <form method="POST" action="" id="modalFormX" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">উদ্যোক্তা ডাটা পরিবর্তন </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <!-- Name Field -->
                    <div class="form-group">
                        <label for="name">উদ্যোক্তার নাম :*</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old(key: 'name') }}" placeholder="নাম লিখুন" required>
                    </div>

                    <!-- Servies Field -->
                    <div class="form-group ">
                        <label for="servies">উপকরণ/পণ্য বা সেবা সম্পর্কিত তথ্য :*</label>
                        <textarea class="" id="editorX" name="servies" value="{{ old('servies') }}" placeholder="বিস্তারিত লিখুন"></textarea>
                    </div>

                    <!-- Contact Field -->
                    <div class="form-group">
                        <label for="contact">যোগাযোগ নম্বর :</label>
                        <input type="text" name="contact" class="form-control" id="contact" value="{{ old(key: 'contact') }}" placeholder="ফোন নম্বর লিখুন">
                    </div>

                    <!-- FB_PageName Field -->
                    <div class="form-group">
                        <label for="fb_page_name">ফেসবুক পেজের নাম :</label>
                        <input type="text" name="fb_page_name" class="form-control" id="fb_page_name" value="{{ old(key: 'fb_page_name') }}" placeholder="পেজের নাম লিখুন">
                    </div>

                    <!-- PageLink Field -->
                    <div class="form-group">
                        <label for="page_link">পেজের লিংক :</label>
                        <input type="text" name="page_link" class="form-control" id="page_link" value="{{ old(key: 'page_link') }}" placeholder="লিংক লিখুন">
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email">ইমেল : (যদিন থাকে)</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{ old(key: 'email') }}" placeholder="ইমেল লিখুন">
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
                        <label for="address">বিস্তারিত ঠিকানা :</label>
                        <textarea class="form-control" id="address" name="address" value="{{ old('address') }}" rows="3" placeholder="ঠিকানা লিখুন"></textarea>
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

    <!-- View Entrepreneur Modal -->
    <div class="modal modalz fade" id="viewEntrepreneurModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">উদ্যোক্তা ভিউ ডাটা</h5>
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
                                                    <img id="modalImage" src="" style="width: 300px; height: 160px;" title="entrepreneur Logo" alt="logo">
                                                </div>
                                                <div class="flex-fill bd-highlight align-self-center">
                                                    <div><samp class="sampcolor">স্ট্যাটাস: </samp> <span id="xStatus"></span></div>
                                                    <div><hr/></div>
                                                    <div><samp class="sampcolor">উপজেলা: </samp> <span id="xUpazila"></span></div>
                                                    <div><samp class="sampcolor">নিবন্ধন তারিখ: </samp> <span id="xEntry"></span></div>
                                                    <div><samp class="sampcolor">যোগ করেছেন: </samp> <span id="xUser"></span></div>
                                                </div>
                                            </div>

                                            <h6 class="dark-color mt-3 mb-2">নাম: <span id="xName"></span> </h6>
                                            <div><samp class="sampcolor">পেজের নাম: </samp> <span id="xFbPageName"></span></div>
                                            <div><samp class="sampcolor">পেজের লিংক: </samp> <span id="xPageLink"></span></div>
                                            <div><samp class="sampcolor">যোগাযোগ নম্বর: </samp> <span id="xContact"></span></div>
                                            <div><samp class="sampcolor">ইমেল: </samp> <span id="xEmail"></span></div>
                                            <div><samp class="sampcolor">বিস্তারিত ঠিকানা: </samp> <span id="xAddress"></span></div>
                                            <div><hr/></div>
                                            <div><samp class="sampcolor">উপকরণ/পণ্য বা সেবা সম্পর্কিত তথ্য: </samp> <br/><span id="xServies"></span></div>
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
            $('#editshoppingModal').on('hidden.bs.modal', function() {
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


            //viewEntrepreneurModal
            $('#viewEntrepreneurModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                // Fetch data from the button
                var id = button.data('id');
                var user = button.data('user');
                var name = button.data('name');
                var contact = button.data('contact') || '';
                var fb_page_name = button.data('fb_page_name') || '';
                var page_link = button.data('page_link') || '';
                var email = button.data('email') || '';
                var servies = button.data('servies');
                var upazila = button.data('upazila');
                var address = button.data('address') || '';
                var status = button.data('status');
                var entry = button.data('entry');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#xUser').text(user);
                modal.find('#xName').text(name);
                modal.find('#xContact').text(contact);
                modal.find('#xFbPageName').text(fb_page_name);
                modal.find('#xPageLink').text(page_link);
                modal.find('#xEmail').text(email);
                modal.find('#xServies').html(servies);
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

            //editEntrepreneurModal
            $('#editEntrepreneurModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var contact = button.data('contact');
                var fb_page_name = button.data('fb_page_name');
                var page_link = button.data('page_link');
                var email = button.data('email');
                var servies = button.data('servies');
                var upazila = button.data('upazila');
                var address = button.data('address');
                var status = button.data('status');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#name').val(name);
                modal.find('#contact').val(contact);
                modal.find('#fb_page_name').val(fb_page_name);
                modal.find('#page_link').val(page_link);
                modal.find('#email').val(email);
                modal.find('#upazila').val(upazila);
                modal.find('#address').val(address);
                modal.find('#status').val(status);

                // Initialize CKEditor if it hasn't been initialized yet
                if (!editorInstance) {
                    initializeCKEditor().then(editor => {
                        editorInstance = editor;
                        editorInstance.setData(servies);
                    });
                } else {
                    editorInstance.setData(servies);
                }

                var imagePreview = modal.find('#imagePreviewX');
                if (image) {
                    imagePreview.html('<img src="' + image + '" class="img-fluid" />');
                } else {
                    imagePreview.html('<i class="bi bi-image" style="font-size: 60px; color: #ccc;"></i>');
                }

                modal.find('#modalFormX').attr('action', '/admin/entrepreneurs/' + id);


            });

            //deleteEntrepreneur
            function deleteEntrepreneur(id) {
                if (confirm('Are you sure you want to delete this Entrepreneur?')) {
                    $.ajax({
                        url: '{{ route('admin.entrepreneurs.destroy') }}',
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
                            alert('Failed to delete Entrepreneur. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }

        </script>
    </x-slot>


</x-dashboard-app-layout>
