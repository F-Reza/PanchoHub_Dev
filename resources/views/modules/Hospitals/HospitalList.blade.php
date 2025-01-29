<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব - হাসপাতাল সমূহ |</title>
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
                                <h4>Multi Select</h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createHospitalModal">Create</a>
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
                                                <th class="align-left">Hospital Name</th>
                                                <th class="align-left">Contact</th>
                                                <th class="align-left">Upazila</th>
                                                <th class="align-left">Added By</th>
                                                <th class="align-left">Entry Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($hospitals->isNotEmpty())
                                                @foreach ($hospitals as $key => $hospital)
                                                    <tr>
                                                        <td> {{ ++$key }} </td>
                                                        <td class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    class="custom-control-input"
                                                                    id="checkbox-{{ $hospital->id }}">
                                                                <label for="checkbox-{{ $hospital->id }}"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if (!empty($hospital->image))
                                                                <img class="rounded-circle" alt="image"
                                                                    src="{{ asset('uploads/hospitals/' . $hospital->image) }}"
                                                                    width="35" height="35">
                                                            @else
                                                                <img class="rounded-circle" alt="image"
                                                                    src="{{ asset('assets/dashboard/img/hospitals/avatar.png') }}"
                                                                    width="35" height="35">
                                                            @endif
                                                        </td>
                                                        <td class="align-left"> {{ $hospital->hp_name }} </td>
                                                        <td class="align-left"> {{ $hospital->contact }} </td>
                                                        <td class="align-left"> {{ $hospital->upazila }} </td>
                                                        <td class="align-left"> {{ $hospital->user_id }} </td>
                                                        <td class="align-left">
                                                            {{ \Carbon\Carbon::parse($hospital->created_at)->format('d M, Y') }}
                                                        </td>
                                                        <td>
                                                            <div @if ($hospital->status == 'Active') class="badge badge-success badge-shadow" @endif
                                                                class="badge badge-danger badge-shadow">
                                                                {{ $hospital->status }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <a href="#" class="btn btn-success"
                                                                data-toggle="modal" data-target="#viewHospitalModal"
                                                                data-id="{{ $hospital->id }}"
                                                                data-id="{{ $hospital->user_id }}"
                                                                data-name="{{ $hospital->hp_name }}"
                                                                data-phone="{{ $hospital->contact }}"
                                                                data-upazila="{{ $hospital->upazila }}"
                                                                data-address="{{ $hospital->address }}"
                                                                data-status="{{ $hospital->status }}"
                                                                data-image="{{ $hospital->image ? asset('uploads/hospitals/' . $hospital->image) : '' }}"
                                                                data-entry="{{ \Carbon\Carbon::parse($hospital->created_at)->format('d/m/Y') }}">
                                                                View
                                                            </a>

                                                            <a href="#" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#editHospitalModal"
                                                                data-id="{{ $hospital->id }}"
                                                                data-id="{{ $hospital->user_id }}"
                                                                data-name="{{ $hospital->hp_name }}"
                                                                data-phone="{{ $hospital->contact }}"
                                                                data-upazila="{{ $hospital->upazila }}"
                                                                data-address="{{ $hospital->address }}"
                                                                data-status="{{ $hospital->status }}"
                                                                data-image="{{ $hospital->image ? asset('uploads/hospitals/' . $hospital->image) : '' }}">
                                                                Edit
                                                            </a>

                                                            <a href="javascript:void(0);"
                                                                onclick="deletehospital({{ $hospital->id }})"
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
    <!-- Create Hospita Modal -->
    <div class="modal modalz fade" id="createHospitalModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">নতুন হাসপাতাল যোগ করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Content Goes Here -->
                <form method="POST" action="{{ route('admin.hospitals.store') }}" id="modalForm" enctype="multipart/form-data">
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

                    <!-- HospitalName Field -->
                    <div class="form-group">
                        <label for="HospitalName">হাসপাতালের নাম :* </label>
                        <input type="text" name="hp_name" class="form-control" id="hospitalName" placeholder="নাম লিখুন">
                    </div>
                    <!-- HospitalContact Field -->
                    <div class="form-group">
                        <label for="hospitalontact">হাসপাতালের যোগাযোগ নম্বর :*</label>
                        <input type="text" name="contact" class="form-control" id="hospitalontact" placeholder="ফোন নম্বর লিখুন">
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

                    <!-- HospitalAddress Field -->
                    <div class="form-group">
                        <label for="address">হাসপাতালের সম্পূৰ্ণ ঠিকানা :*</label>
                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="ঠিকানা লিখুন"></textarea>
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

    <!-- Edit Hospita Modal -->
    <div class="modal modalz fade" id="editHospitalModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
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


                <!-- HospitalName Field -->
                <div class="form-group">
                    <label for="HospitalName">হাসপাতালের নাম :* </label>
                    <input type="text" name="hp_name" class="form-control" id="hospitalName" value="{{ old(key: 'hp_name') }}" placeholder="নাম লিখুন">
                </div>

                <!-- HospitalContact Field -->
                <div class="form-group">
                    <label for="hospitalContact">হাসপাতালের যোগাযোগ নম্বর :*</label>
                    <input type="text" name="contact" class="form-control" id="hospitalontact" value="{{ old(key: 'contact') }}" placeholder="ফোন নম্বর লিখুন">
                </div>

                <!-- Upazila Field -->
                <div class="form-group">
                    <label for="upazila">উপজেলা :* </label>
                    <select class="form-control" id="upazila" name="upazila" required>
                        <option value=""> নির্বাচন করুন </option>
                        <option value="বোদা" {{ old('upazila') == 'বোদা' ? 'selected' : '' }}> বোদা</option>
                        <option value="দেবীগঞ্জ" {{ old('upazila') == 'দেবীগঞ্জ' ? 'selected' : '' }}>দেবীগঞ্জ</option>
                        <option value="আটোয়ারী" {{ old('upazila') == 'আটোয়ারী' ? 'selected' : '' }}>আটোয়ারী</option>
                        <option value="তেঁতুলিয়া" {{ old('upazila') == 'তেঁতুলিয়া' ? 'selected' : '' }}>তেঁতুলিয়া</option>
                        <option value="পঞ্চগড় সদর" {{ old('upazila') == 'পঞ্চগড় সদর' ? 'selected' : '' }}>পঞ্চগড় সদর</option>

                    </select>
                </div>

                <!-- HospitalAddress Field -->
                <div class="form-group">
                    <label for="address">হাসপাতালের সম্পূৰ্ণ ঠিকানা :*</label>
                    <textarea class="form-control" id="address" name="address" value="{{ old(key: 'address') }}" rows="3" placeholder="ঠিকানা লিখুন"></textarea>
                </div>

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

    <!-- View Hospita Modal -->
    <div class="modal modalz fade" id="viewHospitalModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document" >
        <div class="modal-content" >
        <div class="modal-header">
            <h5 class="modal-title" id="modalTitle">হাসপাতাল ভিউ ডাটা</h5>
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
                            <div class="d-flex flex-fill bd-highlight about-list">

                            <div class="about-avatar mt-1 mb-0 p-2 ">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" style="width: 100px; height: 100px;" title="" alt="">
                            </div>
                            <div class="p-2 flex-shrink-1 bd-highlight mt-4">
                                <h6 class="dark-color">ঢাকা মেডিকেল কলেজ</h6>
                                <div > <samp class="sampcolor">ফোন: </samp> 0123456789 </div>
                                <div > <samp class="sampcolor">উপজেলা: </samp>  আটোয়ারী </div>
                            </div>
                            </div>
                            <div class="row about-list">
                                <div class="d-flex flex-column">
                                    <div >
                                        <samp class="sampcolor">বিস্তারিত ঠিকানা: </samp>
                                        সেক্রেটারিয়েট রোড, ঢাকা, বাংলাদেশ
                                    </div>
                                    <div > <samp class="sampcolor">নিবন্ধন তারিখ: </samp> 15/01/2025 </div>
                                    <div > <samp class="sampcolor">যোগ করেছেন: </samp> ফারহান মোর্শেদ </div>
                                    <div > <samp class="sampcolor">স্ট্যাটাস: </samp> Approved </div>

                                </div>

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


            //viewUserModal
            $('#viewUserModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var profession = button.data('profession');
                var email = button.data('email');
                var phone = button.data('phone');
                var gender = button.data('gender');
                var upazila = button.data('upazila');
                var address = button.data('address');
                var status = button.data('status');
                var subscription = button.data('subscription');
                var image = button.data('image');
                var entry = button.data('entry');

                var modal = $(this);
                modal.find('#xName').text(name);
                modal.find('#xProfession').text(profession);
                modal.find('#xEmail').text(email);
                modal.find('#xPhone').text(phone);
                modal.find('#xGender').text(gender);
                modal.find('#xUpazila').text(upazila);
                modal.find('#xAddress').text(address);
                modal.find('#xStatus').text(status);
                modal.find('#xSubscription').text(subscription);
                modal.find('#xEntry').text(entry);

                // Set the image source correctly
                var modalImage = modal.find('#modalImage');
                if (image) {
                    modalImage.attr('src', image);
                } else {
                    modalImage.attr('src', "{{ asset('assets/dashboard/img/users/avatar.png') }}");
                }
            });

            //editUserModal
            $('#editUserModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var profession = button.data('profession');
                var email = button.data('email');
                var phone = button.data('phone');
                var gender = button.data('gender');
                var upazila = button.data('upazila');
                var address = button.data('address');
                var status = button.data('status');
                var subscription = button.data('subscription') || '';
                var image = button.data('image');

                var modal = $(this);
                modal.find('#name').val(name);
                modal.find('#email').val(email);
                modal.find('#phone').val(phone);
                modal.find('#profession').val(profession);
                modal.find('#upazila').val(upazila);
                modal.find('#address').val(address);
                modal.find('#customSwitch1').prop('checked', status === 'Active').val(status);
                modal.find('#subscription').val(subscription);

                modal.find('input[name="gender"]').prop('checked', false);
                if (gender) {
                    modal.find('input[name="gender"]').each(function() {
                        if ($(this).val() === gender) {
                            $(this).prop('checked', true);
                        }
                    });
                }
                modal.find('input[name="gender"]').off('change').on('change', function() {
                    gender = $(this).val();
                });

                var imagePreview = modal.find('#imagePreviewX');
                if (image) {
                    imagePreview.html('<img src="' + image + '" class="img-fluid" />');
                } else {
                    imagePreview.html('<i class="bi bi-person-circle" style="font-size: 60px; color: #ccc;"></i>');
                }

                modal.find('#modalFormX').attr('action', '/admin/users/' + id);

            });

            //deleteUser
            function deleteUser(id) {
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: '{{ route('admin.users.destroy') }}',
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
                            alert('Failed to delete User. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }

        </script>
    </x-slot>


</x-dashboard-app-layout>
