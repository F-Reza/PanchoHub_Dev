<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব - স্ক্রল সমূহ |</title>
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
                                <h4> স্ক্রল সমূহ </h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createScrollModal">Create</a>
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
                                                <th class="align-left">Scroll Text</th>
                                                <th class="align-left">	Category</th>
                                                <th class="align-left">	Added By</th>
                                                <th class="align-left">Created At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($scrolls->isNotEmpty())
                                                @foreach ($scrolls as $key => $scroll)
                                                    <tr>
                                                        <td> {{ ++$key }} </td>
                                                        <td class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    class="custom-control-input"
                                                                    id="checkbox-{{ $scroll->id }}">
                                                                <label for="checkbox-{{ $scroll->id }}"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td class="align-left" style=" max-width: 450px;"> {{ $scroll->text }} </td>
                                                        <td class="align-left"> {{ $scroll->category }} </td>
                                                        <td class="align-left"> {{ $scroll->user->name ?? 'N/A' }}</td>
                                                        <td class="align-left">
                                                            {{ \Carbon\Carbon::parse($scroll->created_at)->format('d M, Y') }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $statusClass = match ($scroll->status) {
                                                                    'Active' => 'badge badge-secondary badge-shadow',
                                                                    'Deactive' => 'badge badge-warning badge-shadow',
                                                                    default => 'badge badge-info badge-shadow',
                                                                };
                                                            @endphp
                                                            <div class="{{ $statusClass }}">
                                                                {{ $scroll->status }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <a href="#" class="btn btn-success"
                                                                data-toggle="modal" data-target="#viewScrollModal"
                                                                data-id="{{ $scroll->id }}"
                                                                data-user="{{ $scroll->user->name }}"
                                                                data-category="{{ $scroll->category }}"
                                                                data-text="{{ $scroll->text }}"
                                                                data-status="{{ $scroll->status }}"
                                                                data-entry="{{ \Carbon\Carbon::parse($scroll->created_at)->format('d/m/Y') }}">
                                                                View
                                                            </a>

                                                            <a href="#" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#editScrollModal"
                                                                data-id="{{ $scroll->id }}"
                                                                data-category="{{ $scroll->category }}"
                                                                data-text="{{ $scroll->text }}"
                                                                data-status="{{ $scroll->status }}">
                                                                Edit
                                                            </a>

                                                            <a href="javascript:void(0);"
                                                                onclick="deleteScroll({{ $scroll->id }})"
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
    <!-- Create Scroll Modal -->
    <div class="modal modalz fade" id="createScrollModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">স্ক্রল যোগ করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Content Goes Here -->
                <form method="POST" action="{{ route('admin.scrolls.store') }}" id="modalForm" enctype="multipart/form-data">
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

                    <!-- text Field -->
                    <div class="form-group">
                        <label for="text"> স্ক্রল টেক্সট :*</label>
                        <textarea class="form-control" id="text" name="text" value="{{ old('text') }}" rows="3" placeholder="স্ক্রল টেক্সট লিখুন"></textarea>
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

    <!-- Edit Scroll Modal -->
    <div class="modal modalz fade" id="editScrollModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">

            <!-- Modal Content Goes Here -->
            <form method="POST" action="" id="modalFormX" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">স্ক্রল ডাটা পরিবর্তন </h5>
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


                    <!-- text Field -->
                    <div class="form-group">
                        <label for="text"> স্ক্রল টেক্সট :*</label>
                        <textarea class="form-control" id="text" name="text" value="{{ old(key: 'text') }}" rows="3" placeholder="স্ক্রল টেক্সট লিখুন"></textarea>
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

    <!-- View Scroll Modal -->
    <div class="modal modalz fade" id="viewScrollModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">স্ক্রল ভিউ ডাটা</h5>
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

                                            <h6 class="dark-color"> <span id="xTitle"></span> </h6>
                                            <div><samp class="sampcolor">স্ক্রল টেক্সট: </samp> <span id="xText"></span></div>
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
            //viewScrollModal
            $('#viewScrollModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                // Fetch data from the button
                var id = button.data('id');
                var user = button.data('user');
                var category = button.data('category');
                var text = button.data('text');
                var status = button.data('status');
                var entry = button.data('entry');

                var modal = $(this);
                modal.find('#xUser').text(user);
                modal.find('#xCategory').text(category);
                modal.find('#xText').html(text);
                modal.find('#xStatus').text(status);
                modal.find('#xEntry').text(entry);

            });

            //editScrollModal
            $('#editScrollModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var category = button.data('category');
                var text = button.data('text');
                var status = button.data('status');

                var modal = $(this);
                modal.find('#category').val(category);
                modal.find('#text').val(text);
                modal.find('#customSwitch').prop('checked', status === 'Active').val(status);

                modal.find('#modalFormX').attr('action', '/admin/scrolls/' + id);


            });

            //deleteScroll
            function deleteScroll(id) {
                if (confirm('Are you sure you want to delete this Scroll?')) {
                    $.ajax({
                        url: '{{ route('admin.scrolls.destroy') }}',
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
                            alert('Failed to delete Scroll. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }

        </script>
    </x-slot>


</x-dashboard-app-layout>
