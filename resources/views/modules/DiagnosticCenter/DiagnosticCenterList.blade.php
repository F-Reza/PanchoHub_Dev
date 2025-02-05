<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব - ডায়াগনস্টিক সেন্টার সমূহ |</title>
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
                                <h4>ডায়াগনস্টিক সেন্টার সমূহ</h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createDiagnosticModal">Create</a>
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
                                                <th class="align-left" style=" max-width: 250px;">Title</th>
                                                <th class="align-left">Contact</th>
                                                <th class="align-left">Upazila</th>
                                                <th class="align-left">Added By</th>
                                                <th class="align-left">Entry Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($diagnostics->isNotEmpty())
                                                @foreach ($diagnostics as $key => $diagnostic)
                                                    <tr>
                                                        <td> {{ ++$key }} </td>
                                                        <td class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    class="custom-control-input"
                                                                    id="checkbox-{{ $diagnostic->id }}">
                                                                <label for="checkbox-{{ $diagnostic->id }}"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if (!empty($diagnostic->image))
                                                                <img class="user-img-radious-style" alt="image" title="Logo"
                                                                    src="{{ asset('uploads/diagnostics/' . $diagnostic->image) }}"
                                                                    width="70" height="40">
                                                            @else
                                                                <img class="user-img-radious-style" alt="image" title="Logo"
                                                                    src="{{ asset('assets/dashboard/img/users/avatar.png') }}"
                                                                    width="70" height="40">
                                                            @endif
                                                        </td>
                                                        <td class="align-left"> {{ $diagnostic->title }} </td>
                                                        <td class="align-left"> {{ $diagnostic->contact }} </td>
                                                        <td class="align-left"> {{ $diagnostic->upazila }} </td>
                                                        <td class="align-left"> {{ $diagnostic->user->name ?? 'N/A' }}</td>
                                                        <td class="align-left">
                                                            {{ \Carbon\Carbon::parse($diagnostic->created_at)->format('d M, Y') }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $statusClass = match ($diagnostic->status) {
                                                                    'Approved' => 'badge badge-secondary badge-shadow',
                                                                    'In Review' => 'badge badge-info badge-shadow',
                                                                    'Pending' => 'badge badge-warning badge-shadow',
                                                                    'Denied' => 'badge badge-danger badge-shadow',
                                                                    default => 'badge badge-success badge-shadow',
                                                                };
                                                            @endphp
                                                            <div class="{{ $statusClass }}">
                                                                {{ $diagnostic->status }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <a href="#" class="btn btn-success"
                                                                data-toggle="modal" data-target="#viewDiagnosticModal"
                                                                data-id="{{ $diagnostic->id }}"
                                                                data-user="{{ $diagnostic->user->name }}"
                                                                data-title="{{ $diagnostic->title }}"
                                                                data-contact="{{ $diagnostic->contact }}"
                                                                data-upazila="{{ $diagnostic->upazila }}"
                                                                data-address="{{ $diagnostic->address }}"
                                                                data-facilities="{{ $diagnostic->facilities }}"
                                                                data-status="{{ $diagnostic->status }}"
                                                                data-image="{{ $diagnostic->image ? asset('uploads/diagnostics/' . $diagnostic->image) : '' }}"
                                                                data-entry="{{ \Carbon\Carbon::parse($diagnostic->created_at)->format('d/m/Y') }}">
                                                                View
                                                            </a>

                                                            <a href="#" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#editDiagnosticModal"
                                                                data-id="{{ $diagnostic->id }}"
                                                                data-user="{{ $diagnostic->user->name }}"
                                                                data-title="{{ $diagnostic->title }}"
                                                                data-contact="{{ $diagnostic->contact }}"
                                                                data-upazila="{{ $diagnostic->upazila }}"
                                                                data-address="{{ $diagnostic->address }}"
                                                                data-facilities="{{ $diagnostic->facilities }}"
                                                                data-status="{{ $diagnostic->status }}"
                                                                data-image="{{ $diagnostic->image ? asset('uploads/diagnostics/' . $diagnostic->image) : '' }}">
                                                                Edit
                                                            </a>

                                                            <a href="javascript:void(0);"
                                                                onclick="deleteDiagnostic({{ $diagnostic->id }})"
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
    <!-- Create Diagnostic Center Modal -->
    <div class="modal modalz fade" id="createDiagnosticModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">নতুন ডায়াগনস্টিক সেন্টার যোগ করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Content Goes Here -->
                <form method="POST" action="{{ route('admin.diagnostics.store') }}" id="modalForm" enctype="multipart/form-data">
                @csrf

                    <!-- DiagnosticCenterName Field -->
                    <div class="form-group">
                        <label for="title">ডায়াগনস্টিক সেন্টারের নাম :* </label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="নাম লিখুন">
                    </div>

                    <!-- Contact Field -->
                    <div class="form-group">
                        <label for="contact">ডায়াগনস্টিক সেন্টারের যোগাযোগ নম্বর :*</label>
                        <input type="text" name="contact" class="form-control" id="contact" placeholder="ফোন নম্বর লিখুন">
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
                        <label for="address">ডায়াগনস্টিক সেন্টারের সম্পূৰ্ণ ঠিকানা :*</label>
                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="ঠিকানা লিখুন"></textarea>
                    </div>

                    <!-- Facilities Field -->
                    <div class="form-group">
                        <label for="facilities">ডায়াগনস্টিক সেন্টারের সুযোগ-সুবিধা :*</label>
                        <textarea class="" id="editor" name="facilities" value="{{ old('facilities') }}" placeholder="বিস্তারিত লিখুন"></textarea>
                    </div>

                    <!-- Picture Input with Preview -->
                    <div class="form-group">
                        <label class="row justify-content-center" for="image-upload" id="image-label">ছবি যুক্ত করুন</label>
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

    <!-- Edit Diagnostic Center Modal -->
    <div class="modal modalz fade" id="editDiagnosticModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

            <!-- Modal Content Goes Here -->
            <form method="POST" action="" id="modalFormX" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">হাসপাতালের ডাটা পরিবর্তন </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <!-- DiagnosticCenterName Field -->
                    <div class="form-group">
                        <label for="title">ডায়াগনস্টিক সেন্টারের নাম :* </label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ old(key: 'title') }}" placeholder="নাম লিখুন">
                    </div>

                    <!-- Contact Field -->
                    <div class="form-group">
                        <label for="contact">ডায়াগনস্টিক সেন্টারের যোগাযোগ নম্বর :*</label>
                        <input type="text" name="contact" class="form-control" id="contact" value="{{ old(key: 'contact') }}" placeholder="ফোন নম্বর লিখুন">
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
                        <label for="address">ডায়াগনস্টিক সেন্টারের সম্পূৰ্ণ ঠিকানা :*</label>
                        <textarea class="form-control" id="address" name="address" value="{{ old(key: 'address') }}" rows="3" placeholder="ঠিকানা লিখুন"></textarea>
                    </div>

                    <!-- Facilities Field -->
                    <div class="form-group">
                        <label for="facilities">ডায়াগনস্টিক সেন্টারের সুযোগ-সুবিধা :*</label>
                        <textarea class="" id="editorX" name="facilities" value="{{ old('facilities') }}" placeholder="বিস্তারিত লিখুন"></textarea>
                    </div>

                    <!-- Picture Input with Preview -->
                    <div class="form-group">
                        <label class="row justify-content-center" for="image-upload" id="image-label">ছবি যুক্ত করুন</label>
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

                    <!-- Picture Input with Preview -->
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


    <!-- View Diagnostic Center Modal -->
    <div class="modal modalz fade" id="viewDiagnosticModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">ডায়াগনস্টিক সেন্টার ভিউ ডাটা</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <section class="section about-section gray-bg" id="about">
                        <div class="row align-items-center flex-column">
                            <div class="col-lg-12">
                                <div class="about-text about-list">
                                    <div class="d-flex bd-highlight">
                                        <div class="p-2 align-self-center fixed-width" style="width: 200px; flex-shrink: 0;">
                                            <img id="modalImage" src="" style="width: 200px; height: 160px;" title="Hospital Logo" alt="logo">
                                        </div>
                                        <div class="p-2 flex-grow-1 bd-highlight">
                                            <h4 class="dark-color"> <span id="xTitle"></span> </h4>
                                            <div><samp class="sampcolor">ফোন: </samp> <span id="xContact"></span></div>
                                            <div><samp class="sampcolor">সুযোগ-সুবিধা: </samp> <span id="xFacilities"></span></div>
                                            <div><samp class="sampcolor">উপজেলা: </samp> <span id="xUpazila"></span></div>
                                            <div><samp class="sampcolor">বিস্তারিত ঠিকানা: </samp> <span id="xAddress"></span></div>
                                            <div><samp class="sampcolor">নিবন্ধন তারিখ: </samp> <span id="xEntry"></span></div>
                                            <div><samp class="sampcolor">যোগ করেছেন: </samp> <span id="xUser"></span></div>
                                            <div><samp class="sampcolor">স্ট্যাটাস: </samp> <span id="xStatus"></span></div>

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


            //viewDiagnosticModal
            $('#viewDiagnosticModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                // Fetch data from the button
                var id = button.data('id');
                var user = button.data('user');
                var title = button.data('title');
                var contact = button.data('contact');
                var upazila = button.data('upazila');
                var address = button.data('address');
                var facilities = button.data('facilities');
                var status = button.data('status');
                var entry = button.data('entry');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#xUser').text(user);
                modal.find('#xTitle').text(title);
                modal.find('#xContact').text(contact);
                modal.find('#xUpazila').text(upazila);
                modal.find('#xAddress').text(address);
                modal.find('#xFacilities').html(facilities);
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

            //editDiagnosticModal
            $('#editDiagnosticModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var title = button.data('title');
                var contact = button.data('contact');
                var upazila = button.data('upazila');
                var address = button.data('address');
                var facilities = button.data('facilities');
                var status = button.data('status');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#title').val(title);
                modal.find('#contact').val(contact);
                modal.find('#upazila').val(upazila);
                modal.find('#address').val(address);
                modal.find('#status').val(status);

                // Initialize CKEditor if it hasn't been initialized yet
                if (!editorInstance) {
                    initializeCKEditor().then(editor => {
                        editorInstance = editor;
                        editorInstance.setData(facilities);
                    });
                } else {
                    editorInstance.setData(facilities);
                }

                var imagePreview = modal.find('#imagePreviewX');
                if (image) {
                    imagePreview.html('<img src="' + image + '" class="img-fluid" />');
                } else {
                    imagePreview.html('<i class="bi bi-person-circle" style="font-size: 60px; color: #ccc;"></i>');
                }

                modal.find('#modalFormX').attr('action', '/admin/diagnostics/' + id);


            });

            //deleteDiagnostic
            function deleteDiagnostic(id) {
                if (confirm('Are you sure you want to delete this diagnostic center?')) {
                    $.ajax({
                        url: '{{ route('admin.diagnostics.destroy') }}',
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
                            alert('Failed to delete Diagnostics Center. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }

        </script>
    </x-slot>


</x-dashboard-app-layout>
