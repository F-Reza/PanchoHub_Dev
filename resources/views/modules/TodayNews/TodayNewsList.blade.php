<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব - আজকের খবর |</title>
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
                                <h4> আজকের খবর </h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createTodayNewsModal">Create</a>
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
                                                <th class="align-left">Title</th>
                                                <th class="align-left">Upazila</th>
                                                <th class="align-left">	Added By</th>
                                                <th class="align-left">Created At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($newsToday->isNotEmpty())
                                                @foreach ($newsToday as $key => $todayNews)
                                                    <tr>
                                                        <td> {{ ++$key }} </td>
                                                        <td class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    class="custom-control-input"
                                                                    id="checkbox-{{ $todayNews->id }}">
                                                                <label for="checkbox-{{ $todayNews->id }}"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                                      @if (!empty($todayNews->image))
                                                                <img class="article-image" alt="image" title="News Image"
                                                                    src="{{ asset('uploads/todayNews/' . $todayNews->image) }}"
                                                                    width="70" height="40">
                                                            @else
                                                                <img class="article-image" alt="image" title="News Image"
                                                                    src="{{ asset('assets/dashboard/img/users/avatar.png') }}"
                                                                    width="70" height="40">
                                                            @endif
                                                        </td>
                                                        <td class="align-left"> {{ $todayNews->title }} </td>
                                                        <td class="align-left"> {{ $todayNews->upazila }} </td>
                                                        <td class="align-left"> {{ $todayNews->user->name ?? 'N/A' }}</td>
                                                        <td class="align-left">
                                                            {{ \Carbon\Carbon::parse($todayNews->created_at)->format('d M, Y') }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $statusClass = match ($todayNews->status) {
                                                                    'Approved' => 'badge badge-secondary badge-shadow',
                                                                    'In Review' => 'badge badge-info badge-shadow',
                                                                    'Pending' => 'badge badge-warning badge-shadow',
                                                                    'Denied' => 'badge badge-danger badge-shadow',
                                                                    default => 'badge badge-success badge-shadow',
                                                                };
                                                            @endphp
                                                            <div class="{{ $statusClass }}">
                                                                {{ $todayNews->status }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <a href="#" class="btn btn-success"
                                                                data-toggle="modal" data-target="#viewTodayNewsModal"
                                                                data-id="{{ $todayNews->id }}"
                                                                data-user="{{ $todayNews->user->name }}"
                                                                data-title="{{ $todayNews->title }}"
                                                                data-description="{{ $todayNews->description }}"
                                                                data-upazila="{{ $todayNews->upazila }}"
                                                                data-address="{{ $todayNews->address ?? 'Empty' }}"
                                                                data-status="{{ $todayNews->status }}"
                                                                data-image="{{ $todayNews->image ? asset('uploads/todayNews/' . $todayNews->image) : '' }}"
                                                                data-entry="{{ \Carbon\Carbon::parse($todayNews->created_at)->format('d/m/Y') }}">
                                                                View
                                                            </a>

                                                            <a href="#" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#editTodayNewsModal"
                                                                data-id="{{ $todayNews->id }}"
                                                                data-title="{{ $todayNews->title }}"
                                                                data-description="{{ $todayNews->description }}"
                                                                data-upazila="{{ $todayNews->upazila }}"
                                                                data-address="{{ $todayNews->address ?? 'Empty' }}"
                                                                data-status="{{ $todayNews->status }}"
                                                                data-image="{{ $todayNews->image ? asset('uploads/todayNews/' . $todayNews->image) : '' }}">
                                                                Edit
                                                            </a>

                                                            <a href="javascript:void(0);"
                                                                onclick="deleteTodayNews({{ $todayNews->id }})"
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
    <!-- Create TodayNews Modal -->
    <div class="modal modalz fade" id="createTodayNewsModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">আজকের খবর যোগ করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Content Goes Here -->
                <form method="POST" action="{{ route('admin.todaynews.store') }}" id="modalForm" enctype="multipart/form-data">
                @csrf

                    <!-- Title Field -->
                    <div class="form-group">
                        <label for="title">খবরের শিরোনাম :* </label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" placeholder="টাইটেল লিখুন">
                    </div>

                    <!-- Description Field -->
                    <div class="form-group ">
                        <label for="itemName">বিস্তারিত খবর :*</label>
                        <textarea class="" id="editor" name="description" value="{{ old('description') }}" placeholder="বিস্তারিত খবর"></textarea>
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
                        <label for="address"> বিস্তারিত ঠিকানা :*</label>
                        <textarea class="form-control" id="address" name="address" value="{{ old('address') }}" rows="3" placeholder="ঠিকানা লিখুন"></textarea>
                    </div>

                    <!-- Picture Input with Preview -->
                    <div class="form-group">
                        <label class="row justify-content-center" for="image-upload" id="image-label">থাম্বনেইল</label>
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

    <!-- Edit TodayNews Modal -->
    <div class="modal modalz fade" id="editTodayNewsModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">

            <!-- Modal Content Goes Here -->
            <form method="POST" action="" id="modalFormX" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">আজকের খবর ডাটা পরিবর্তন </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <!-- Title Field -->
                    <div class="form-group">
                        <label for="title">খবরের শিরোনাম :* </label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" placeholder="টাইটেল লিখুন">
                    </div>

                    <!-- Description Field -->
                    <div class="form-group ">
                        <label for="itemName">বিস্তারিত খবর :*</label>
                        <textarea class="" id="editorX" name="description" value="{{ old('description') }}" placeholder="বিস্তারিত খবর"></textarea>
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
                        <label for="address"> বিস্তারিত ঠিকানা :*</label>
                        <textarea class="form-control" id="address" name="address" value="{{ old('address') }}" rows="3" placeholder="ঠিকানা লিখুন"></textarea>
                    </div>

                    <!-- Picture Input with Preview -->
                    <div class="form-group">
                        <label class="row justify-content-center" for="image-upload" id="image-label">থাম্বনেইল</label>
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

    <!-- View TodayNews Modal -->
    <div class="modal modalz fade" id="viewTodayNewsModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">আজকের খবর ভিউ ডাটা</h5>
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
                                                <div class="flex-fill bd-highlight mb-3 mr-3">
                                                    <img id="modalImage" src="" style="width: 300px; height: 160px;" title="todayNews Logo" alt="logo">
                                                </div>
                                                <div class="flex-fill bd-highlight align-self-center">
                                                    <div><samp class="sampcolor">উপজেলা: </samp> <span id="xUpazila"></span></div>
                                                    <div><samp class="sampcolor">বিস্তারিত ঠিকানা: </samp> <span id="xAddress"></span></div>
                                                    <div><samp class="sampcolor">নিবন্ধন তারিখ: </samp> <span id="xEntry"></span></div>
                                                    <div><samp class="sampcolor">যোগ করেছেন: </samp> <span id="xUser"></span></div>
                                                    <div><samp class="sampcolor">স্ট্যাটাস: </samp> <span id="xStatus"></span></div>
                                                </div>
                                            </div>

                                            <h6 class="dark-color"> <span id="xTitle"></span> </h6>
                                            <div><samp class="sampcolor">বিস্তারিত খবর: </samp> <span id="xDescription"></span></div>
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
                        'imageUpload', 'imageStyle:alignLeft', 'imageStyle:full',
                        'imageStyle:alignCenter', 'imageStyle:alignRight', 'resizeImage',
                        'insertTable', 'mediaEmbed', 'alignment', 'horizontalLine', '|',
                        'specialCharacters', 'indent', 'undo', 'redo'
                    ],
                    ckfinder: {
                        uploadUrl: '{{ route('admin.todaynews.upload').'?_token='.csrf_token() }}'
                    }
                })
                .catch(error => {
                    console.error(error);
                });

            // Function to initialize CKEditor
            function initializeCKEditor() {
                return ClassicEditor
                    .create(document.querySelector('#editorX'), {
                        ckfinder: {
                            uploadUrl: '{{ route('admin.todaynews.upload').'?_token='.csrf_token() }}'
                        }
                    });
            }

            // Variable to hold the CKEditor instance
            let editorInstance;

            // Event listener for when the edit modal is hidden
            $('#editTodayNewsModal').on('hidden.bs.modal', function() {
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


            //viewTodayNewsModal
            $('#viewTodayNewsModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                // Fetch data from the button
                var id = button.data('id');
                var user = button.data('user');
                var title = button.data('title');
                var description = button.data('description');
                var upazila = button.data('upazila');
                var address = button.data('address') || '';
                var status = button.data('status');
                var entry = button.data('entry');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#xUser').text(user);
                modal.find('#xTitle').text(title);
                modal.find('#xDescription').html(description);
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

            //editTodayNewsModal
            $('#editTodayNewsModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var title = button.data('title');
                var description = button.data('description');
                var upazila = button.data('upazila');
                var address = button.data('address');
                var status = button.data('status');
                var entry = button.data('entry');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#title').val(title);
                modal.find('#upazila').val(upazila);
                modal.find('#address').val(address);
                modal.find('#status').val(status);

                // Initialize CKEditor if it hasn't been initialized yet
                if (!editorInstance) {
                    initializeCKEditor().then(editor => {
                        editorInstance = editor;
                        editorInstance.setData(description);
                    });
                } else {
                    editorInstance.setData(description);
                }

                var imagePreview = modal.find('#imagePreviewX');
                if (image) {
                    imagePreview.html('<img src="' + image + '" class="img-fluid" />');
                } else {
                    imagePreview.html('<i class="bi bi-image" style="font-size: 60px; color: #ccc;"></i>');
                }

                modal.find('#modalFormX').attr('action', '/admin/todaynews/' + id);


            });

            //deleteTodayNews
            function deleteTodayNews(id) {
                if (confirm('Are you sure you want to delete this TodayNews?')) {
                    $.ajax({
                        url: '{{ route('admin.todaynews.destroy') }}',
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
                            alert('Failed to delete TodayNews. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }

        </script>
    </x-slot>


</x-dashboard-app-layout>
