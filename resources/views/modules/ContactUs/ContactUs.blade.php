<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব -  যোগাযোগ |</title>
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
                                <h4> যোগাযোগ:</h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createContactUsModal">Create</a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    @if ($contacts->isNotEmpty())
                                        @foreach ($contacts as $contact)
                                            <div class="h5 p-2 flex-fill bd-highlight">Email: {{ $contact->email }}</div>
                                            <div class="h5 p-2 flex-fill bd-highlight">Phone: {{ $contact->phone }}</div>
                                            <div class="h5 p-2 flex-fill bd-highlight">Address: {{ $contact->address }}</div>
                                            <div class="h5 p-2 flex-fill bd-highlight">Facebook Page Link: {{ $contact->fb_page }}</div>
                                            <div class="h5 p-2 flex-fill bd-highlight">Facebook Group Link: {{ $contact->fb_group }}</div>
                                            <div class="h5 p-2 flex-fill bd-highlight">Youtube Channel Link:{{ $contact->youtube }}</div>
                                            <div class="h5 p-2 flex-fill bd-highlight">About: {!! $contact->about !!}</div>
                                            <div class="h5 p-2 flex-fill bd-highlight">Services: {!! $contact->services !!}</div>
                                            <div class="d-flex bd-highlight">
                                                <div class="p-2 flex-fill bd-highlight"></div>
                                                <div class="p-2 flex-fill bd-highlight" style=" max-width: 100px;">
                                                    <a href="#" class="btn btn-primary"
                                                        data-toggle="modal" data-target="#editContactUsModal"
                                                        data-id="{{ $contact->id }}"
                                                        data-email="{{ $contact->email }}"
                                                        data-phone="{{ $contact->phone }}"
                                                        data-address="{{ $contact->address }}"
                                                        data-about="{{ $contact->about }}"
                                                        data-services="{{ $contact->services }}"
                                                        data-fb_page="{{ $contact->fb_page }}"
                                                        data-fb_group="{{ $contact->fb_group }}"
                                                        data-youtube="{{ $contact->youtube }}">
                                                        Edit
                                                    </a>
                                                </div>
                                                <div class="p-2 flex-fill bd-highlight" style=" max-width: 100px;">
                                                    <a href="javascript:void(0);"
                                                    onclick="deleteContactUs({{ $contact->id }})"
                                                    class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                      @endforeach
                                    @endif
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
    <!-- Create ContactUs Modal -->
    <div class="modal modalz fade" id="createContactUsModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"> যোগাযোগ যোগ করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Content Goes Here -->
                <form method="POST" action="{{ route('admin.contact_us.store') }}" id="modalForm" enctype="multipart/form-data">
                @csrf

                    <!-- Terms Description Field -->
                    <div class="form-group ">
                        <label for="description"> যোগাযোগ :*</label>
                        <textarea class="" id="editor" name="description" value="{{ old('description') }}" placeholder="বিস্তারিত লিখুন"></textarea>
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

    <!-- Edit ContactUs Modal -->
    <div class="modal modalz fade" id="editContactUsModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">

            <!-- Modal Content Goes Here -->
            <form method="POST" action="" id="modalFormX" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"> যোগাযোগ ডাটা পরিবর্তন </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <!-- Terms Description Field -->
                    <div class="form-group ">
                        <label for="description"> যোগাযোগ :*</label>
                        <textarea class="" id="editorX" name="description" value="{{ old('description') }}" placeholder="বিস্তারিত লিখুন"></textarea>
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

    <x-slot name="script">

        <script type="text/javascript">

            //CKEditor with Image Upload
            ClassicEditor
                .create(document.querySelector('#about'), {
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

                ClassicEditor
                .create(document.querySelector('#services'), {
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
                    .create(document.querySelector('#aboutX'), {
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

            function initializeCKEditor() {
                return ClassicEditor
                    .create(document.querySelector('#servicesX'), {
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
            $('#editContactUsModal').on('hidden.bs.modal', function() {
                if (editorInstance) {
                    editorInstance.destroy();
                    editorInstance = null;
                }
            });

            //editContactUsModal
            $('#editContactUsModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var services = button.data('services');

                var modal = $(this);
                // Initialize CKEditor if it hasn't been initialized yet
                if (!editorInstance) {
                    initializeCKEditor().then(editor => {
                        editorInstance = editor;
                        editorInstance.setData(services);
                    });
                } else {
                    editorInstance.setData(services);
                }

                modal.find('#modalFormX').attr('action', '/admin/contact_us/' + id);

            });

            //deleteContactUs
            function deleteContactUs(id) {
                if (confirm('Are you sure you want to delete this Terms?')) {
                    $.ajax({
                        url: '{{ route('admin.contact_us.destroy') }}',
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
                            alert('Failed to delete Terms. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }

        </script>
    </x-slot>


</x-dashboard-app-layout>
