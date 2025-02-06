<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব - স্লাইডার |</title>
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
                                <h4> স্লাইডার সমূহ </h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createSliderModal">Create</a>
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
                                                <th>Slider Image</th>
                                                <th class="align-left">	Category</th>
                                                <th class="align-left">Slider Text</th>
                                                <th class="align-left">	Added By</th>
                                                <th class="align-left">Created At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($sliders->isNotEmpty())
                                                @foreach ($sliders as $key => $slider)
                                                    <tr>
                                                        <td> {{ ++$key }} </td>
                                                        <td class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    class="custom-control-input"
                                                                    id="checkbox-{{ $slider->id }}">
                                                                <label for="checkbox-{{ $slider->id }}"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                                      @if (!empty($slider->image))
                                                                <img class="article-image" alt="image" title="News Image"
                                                                    src="{{ asset('uploads/sliders/' . $slider->image) }}"
                                                                    width="150" height="80">
                                                            @else
                                                                <img class="article-image" alt="image" title="News Image"
                                                                    src="{{ asset('assets/dashboard/img/users/avatar.png') }}"
                                                                    width="150" height="80">
                                                            @endif
                                                        </td>
                                                        <td class="align-left"> {{ $slider->category }} </td>
                                                        <td class="align-left" style=" max-width: 250px;"> {{ $slider->description }} </td>
                                                        <td class="align-left"> {{ $slider->user->name ?? 'N/A' }}</td>
                                                        <td class="align-left">
                                                            {{ \Carbon\Carbon::parse($slider->created_at)->format('d M, Y') }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $statusClass = match ($slider->status) {
                                                                    'Active' => 'badge badge-secondary badge-shadow',
                                                                    'Deactive' => 'badge badge-warning badge-shadow',
                                                                    default => 'badge badge-info badge-shadow',
                                                                };
                                                            @endphp
                                                            <div class="{{ $statusClass }}">
                                                                {{ $slider->status }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <a href="#" class="btn btn-success"
                                                                data-toggle="modal" data-target="#viewSliderModal"
                                                                data-id="{{ $slider->id }}"
                                                                data-user="{{ $slider->user->name }}"
                                                                data-category="{{ $slider->category }}"
                                                                data-description="{{ $slider->description ?? 'Empty' }}"
                                                                data-status="{{ $slider->status }}"
                                                                data-image="{{ $slider->image ? asset('uploads/sliders/' . $slider->image) : '' }}"
                                                                data-entry="{{ \Carbon\Carbon::parse($slider->created_at)->format('d/m/Y') }}">
                                                                View
                                                            </a>

                                                            <a href="#" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#editSliderModal"
                                                                data-id="{{ $slider->id }}"
                                                                data-category="{{ $slider->category }}"
                                                                data-description="{{ $slider->description ?? '' }}"
                                                                data-status="{{ $slider->status }}"
                                                                data-image="{{ $slider->image ? asset('uploads/sliders/' . $slider->image) : '' }}">
                                                                Edit
                                                            </a>

                                                            <a href="javascript:void(0);"
                                                                onclick="deleteSlider({{ $slider->id }})"
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
    <!-- Create Slider Modal -->
    <div class="modal modalz fade" id="createSliderModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">স্লাইডার যোগ করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Content Goes Here -->
                <form method="POST" action="{{ route('admin.sliders.store') }}" id="modalForm" enctype="multipart/form-data">
                @csrf

                    <!-- Category Field -->
                    <div class="form-group">
                        <label for="category">ক্যাটাগরি :* </label>
                        <select class="form-control" id="category" name="category" required>
                            <option value=""> নির্বাচন করুন </option>
                            <option value="ডাক্তারগন">ডাক্তারগন</option>
                            <option value="হাসপাতাল">হাসপাতাল</option>
                            <option value="ডায়াগনস্টিক সেন্টার">ডায়াগনস্টিক সেন্টার</option>
                            <option value="হোস্টেল">হোস্টেল</option>
                            <option value="রেস্টুরেন্ট">রেস্টুরেন্ট</option>
                            <option value="পার্লার-সেলুন">পার্লার-সেলুন</option>
                            <option value="গাড়ি ভাড়া">গাড়ি ভাড়া</option>
                            <option value="বাসা ভাড়া">বাসা ভাড়া</option>
                            <option value="ফ্লাট ও জমি বিক্রয়">ফ্লাট ও জমি বিক্রয়</option>
                            <option value="নার্সারি">নার্সারি</option>
                            <option value="শিক্ষা প্রতিষ্ঠান">শিক্ষা প্রতিষ্ঠান</option>
                            <option value="কুরিয়ার সার্ভিস">কুরিয়ার সার্ভিস</option>
                            <option value="রেস্টুরেন্ট">রেস্টুরেন্ট</option>
                            <option value="অনান্য">অনান্য</option>

                        </select>
                    </div>

                    <!-- Picture Input with Preview -->
                    <div class="form-group">
                        <label class="row justify-content-center" for="image-upload" id="image-label">স্লাইডার ইমেজ *</label>
                        <div class="row justify-content-center">
                            <div class="position-relative">
                                <div class="image-preview" id="imagePreview" style="width: 380px; height: 180px; background-color: #f2f2f2; border-radius: 5px;">
                                    <i class="bi bi-image" style="font-size: 80px; color: #ccc;"></i>
                                </div>
                                <div class="edit-icon position-absolute" id="editIcon" style="bottom: 10px; right: 10px; border-radius: 50%; padding: 5px; cursor: pointer;">
                                    <i class="bi bi-pencil-square"></i>
                                </div>
                                <input type="file" value="{{ old('image') }}" name="image" class="form-control d-none" id="fileInput" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <!-- Description Field -->
                    <div class="form-group">
                        <label for="description"> স্লাইডার টেক্সট :</label>
                        <textarea class="form-control" id="description" name="description" value="{{ old('description') }}" rows="3" placeholder="স্লাইডার টেক্সট লিখুন"></textarea>
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

    <!-- Edit Slider Modal -->
    <div class="modal modalz fade" id="editSliderModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">

            <!-- Modal Content Goes Here -->
            <form method="POST" action="" id="modalFormX" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">স্লাইডার ডাটা পরিবর্তন </h5>
                    <div class="ml-3 custom-switch">
                        <input type="checkbox" checked class="custom-control-input" id="customSwitch"
                            name="status" value="Active">
                        <label class="custom-control-label" for="customSwitch">Status</label>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <!-- Category Field -->
                    <div class="form-group">
                        <label for="category">ক্যাটাগরি :* </label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="ডাক্তারগন" {{ old('category') == 'ডাক্তারগন' ? 'selected' : '' }}> ডাক্তারগন</option>
                            <option value="হাসপাতাল" {{ old('category') == 'হাসপাতাল' ? 'selected' : '' }}> হাসপাতাল</option>
                            <option value="ডায়াগনস্টিক সেন্টার" {{ old('category') == 'ডায়াগনস্টিক সেন্টার' ? 'selected' : '' }}> ডায়াগনস্টিক সেন্টার</option>
                            <option value="হোস্টেল" {{ old('category') == 'হোস্টেল' ? 'selected' : '' }}> হোস্টেল</option>
                            <option value="রেস্টুরেন্ট" {{ old('category') == 'রেস্টুরেন্ট' ? 'selected' : '' }}> রেস্টুরেন্ট</option>
                            <option value="পার্লার-সেলুন" {{ old('category') == 'পার্লার-সেলুন' ? 'selected' : '' }}> পার্লার-সেলুন</option>
                            <option value="গাড়ি ভাড়া" {{ old('category') == 'গাড়ি ভাড়া' ? 'selected' : '' }}> গাড়ি ভাড়া</option>
                            <option value="বাসা ভাড়া" {{ old('category') == 'বাসা ভাড়া' ? 'selected' : '' }}> বাসা ভাড়া</option>
                            <option value="ফ্লাট ও জমি বিক্রয়" {{ old('category') == 'ফ্লাট ও জমি বিক্রয়' ? 'selected' : '' }}> ফ্লাট ও জমি বিক্রয়</option>
                            <option value="নার্সারি" {{ old('category') == 'নার্সারি' ? 'selected' : '' }}> নার্সারি</option>
                            <option value="শিক্ষা প্রতিষ্ঠান" {{ old('category') == 'শিক্ষা প্রতিষ্ঠান' ? 'selected' : '' }}> শিক্ষা প্রতিষ্ঠান</option>
                            <option value="কুরিয়ার সার্ভিস" {{ old('category') == 'কুরিয়ার সার্ভিস' ? 'selected' : '' }}> কুরিয়ার সার্ভিস</option>
                            <option value="রেস্টুরেন্ট" {{ old('category') == 'রেস্টুরেন্ট' ? 'selected' : '' }}> রেস্টুরেন্ট</option>
                            <option value="অনান্য" {{ old('category') == 'অনান্য' ? 'selected' : '' }}> অনান্য</option>
                        </select>
                    </div>

                    <!-- Picture Input with Preview -->
                    <div class="form-group">
                        <label class="row justify-content-center" for="image-upload" id="image-label">স্লাইডার ইমেজ *</label>
                        <div class="row justify-content-center">
                            <div class="position-relative">
                                <div class="image-preview" id="imagePreviewX" style="width: 380px; height: 180px; background-color: #f2f2f2; border-radius: 5px;">
                                    <i class="bi bi-image" style="font-size: 80px; color: #ccc;"></i>
                                </div>
                                <div class="edit-icon position-absolute" id="editIconX" style="bottom: 10px; right: 10px; border-radius: 50%; padding: 5px; cursor: pointer;">
                                    <i class="bi bi-pencil-square"></i>
                                </div>
                                <input type="file" name="image" class="form-control d-none" id="fileInputX" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <!-- Description Field -->
                    <div class="form-group">
                        <label for="description"> স্লাইডার টেক্সট :</label>
                        <textarea class="form-control" id="description" name="description" value="{{ old('description') }}" rows="3" placeholder="স্লাইডার টেক্সট লিখুন"></textarea>
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

    <!-- View Slider Modal -->
    <div class="modal modalz fade" id="viewSliderModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">স্লাইডার ভিউ ডাটা</h5>
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
                                                <div class="flex-fill bd-highlight mb-1">
                                                    <img id="modalImage" src="" style=" height: 250px;" title="slider Logo" alt="logo">
                                                </div>

                                            </div>

                                            <h6 class="dark-color"> <span id="xTitle"></span> </h6>
                                            <div><samp class="sampcolor">স্লাইডার টেক্সট: </samp> <span id="xDescription"></span></div>
                                            <div><hr/></div>
                                            <div><samp class="sampcolor">ক্যাটাগরি: </samp> <span id="xCategory"></span></div>
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


            //viewSliderModal
            $('#viewSliderModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                // Fetch data from the button
                var id = button.data('id');
                var user = button.data('user');
                var category = button.data('category');
                var description = button.data('description') || '';
                var status = button.data('status');
                var entry = button.data('entry');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#xUser').text(user);
                modal.find('#xCategory').text(category);
                modal.find('#xDescription').html(description);
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

            //editSliderModal
            $('#editSliderModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var category = button.data('category');
                var description = button.data('description');
                var status = button.data('status');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#category').val(category);
                modal.find('#description').val(description);
                modal.find('#customSwitch').prop('checked', status === 'Active').val(status);

                var imagePreview = modal.find('#imagePreviewX');
                if (image) {
                    imagePreview.html('<img src="' + image + '" class="img-fluid" />');
                } else {
                    imagePreview.html('<i class="bi bi-image" style="font-size: 60px; color: #ccc;"></i>');
                }

                modal.find('#modalFormX').attr('action', '/admin/sliders/' + id);


            });

            //deleteSlider
            function deleteSlider(id) {
                if (confirm('Are you sure you want to delete this Slider?')) {
                    $.ajax({
                        url: '{{ route('admin.sliders.destroy') }}',
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
                            alert('Failed to delete Slider. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }

        </script>
    </x-slot>


</x-dashboard-app-layout>
