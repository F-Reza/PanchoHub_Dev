<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব - ইউজার |</title>
    </x-slot>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4> লোকাল ইউজার লিস্ট </h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createUserModal">যোগ করুন</a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped text-center" id="table-2">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center pt-3 pl-4">
                                                    <div
                                                        class="custom-checkbox custom-checkbox-table custom-control align-middle">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            data-checkbox-role="dad" class="custom-control-input"
                                                            id="checkbox-all">
                                                        <label for="checkbox-all"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Profession</th>
                                                <th>Gender</th>
                                                <th>Upazila</th>
                                                <th>Entry Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($users->isNotEmpty())
                                                @foreach ($users as $key => $user)
                                                    <tr>
                                                        <td> {{ ++$key }} </td>
                                                        <td class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    class="custom-control-input"
                                                                    id="checkbox-{{ $user->id }}">
                                                                <label for="checkbox-{{ $user->id }}"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if (!empty($user->image))
                                                                <img class="rounded-circle" alt="image"
                                                                    src="{{ asset('uploads/users/' . $user->image) }}"
                                                                    width="35" height="35">
                                                            @else
                                                                <img class="rounded-circle" alt="image"
                                                                    src="{{ asset('assets/dashboard/img/users/avatar.png') }}"
                                                                    width="35" height="35">
                                                            @endif
                                                        </td>
                                                        <td class="align-left"> {{ $user->name }} </td>
                                                        <td class="align-left"> {{ $user->phone }} </td>
                                                        <td class="align-left"> {{ $user->profession }} </td>
                                                        <td class="align-left"> {{ $user->gender }} </td>
                                                        <td class="align-left"> {{ $user->upazila }} </td>
                                                        <td class="align-left">
                                                            {{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}
                                                        </td>
                                                        <td>
                                                            <div @if ($user->status == 'Active') class="badge badge-success badge-shadow" @endif
                                                                class="badge badge-danger badge-shadow">
                                                                {{ $user->status }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <a href="#" class="btn btn-success"
                                                                data-toggle="modal" data-target="#viewUserModal"
                                                                data-id="{{ $user->id }}"
                                                                data-name="{{ $user->name }}"
                                                                data-phone="{{ $user->phone }}"
                                                                data-profession="{{ $user->profession }}"
                                                                data-gender="{{ $user->gender }}"
                                                                data-upazila="{{ $user->upazila }}"
                                                                data-status="{{ $user->status }}"
                                                                data-image="{{ $user->image ? asset('uploads/users/' . $user->image) : '' }}"
                                                                data-entry="{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}">
                                                                View
                                                            </a>

                                                            <a href="#" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#editUserModal"
                                                                data-id="{{ $user->id }}"
                                                                data-name="{{ $user->name }}"
                                                                data-phone="{{ $user->phone }}"
                                                                data-profession="{{ $user->profession }}"
                                                                data-gender="{{ $user->gender }}"
                                                                data-upazila="{{ $user->upazila }}"
                                                                data-status="{{ $user->status }}"
                                                                data-image="{{ $user->image ? asset('uploads/users/' . $admin->image) : '' }}">
                                                                Edit
                                                            </a>

                                                            <a href="javascript:void(0);"
                                                                onclick="deleteUser({{ $user->id }})"
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
    <!-- Create User Modal -->
    <div class="modal modalz fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"> নতুন ইউজার তৈরি করুন </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal Content Goes Here -->
                    <form method="POST" action="{{ route('admin.users.store') }}" id="modalForm"
                        enctype="multipart/form-data">
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

                        <!-- Name Field -->
                        <div class="form-group">
                            <label for="name">নাম :*</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="নাম লিখুন" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Profession Field -->
                        <div class="form-group">
                            <label for="profession">পেশা :*</label>
                            <input type="text" class="form-control" id="profession" name="profession"
                                placeholder="আপনার পেশা লিখুন" value="{{ old('profession') }}" required>
                            @error('profession')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="form-group">
                            <label for="phone"> ফোন :* </label>
                            <input type="tel" id="phone" name="phone" class="form-control"
                                placeholder="ফোন নম্বর লিখুন" value="{{ old('phone') }}" required>
                            @error('phone')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                         <!-- Email Field -->
                         <div class="form-group">
                            <label for="email">ইমেইল : (যদি থাকে)</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="ইমেইল লিখুন" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gender Field -->
                        <div class="form-group">
                            <label for="itemDescription"> লিঙ্গ :* </label>
                            <br>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="gender" id="male" value="পুরুষ" checked>
                              <label class="form-check-label" for="male">
                                পুরুষ
                              </label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="gender" value="মহিলা" id="female">
                              <label class="form-check-label" for="female">
                                মহিলা
                              </label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="gender" value="অন্যান্য" id="others">
                              <label class="form-check-label" for="others">
                                অন্যান্য
                              </label>
                            </div>
                          </div>

                        <!-- Gender Field -->
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
                            <label for="address">ঠিকানা :</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="আপনার ঠিকানা লিখুন"></textarea>
                        </div>

                        <!-- Subscription Field -->
                        <div class="form-group">
                            <label for="subscription"> সাবস্ক্রিপশন : </label>
                            <select class="form-control" name="subscription" id="subscription">
                                <option value=""> নির্বাচন করুন </option>
                                <option value="Silver"> সিলভার </option>
                                <option value="Bronze"> ব্রোঞ্জ </option>
                                <option value="Gold"> গোল্ড </option>
                            </select>
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password" required>
                            @error('password')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation"
                                id="password_confirmation" placeholder="Confirm Password" required>
                            @error('password_confirmation')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
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

    <!-- Edit User Modal -->
    <div class="modal modalz fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">ইউজার ডাটা পরিবর্তন </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal Content Goes Here -->
                    <form id="modalForm">
                        <div class="form-group">
                            <label for="itemName">নাম :*</label>
                            <input type="text" class="form-control" id="itemName" placeholder="নাম লিখুন">
                        </div>


                        <div class="form-group">
                            <label for="itemName">পেশা :* </label>
                            <input type="text" class="form-control" id="itemName"
                                placeholder="আপনার পেশা লিখুন">
                        </div>
                        <div class="form-group">
                            <label for="itemName">ইমেইল : (যদি থাকে) </label>
                            <input type="text" class="form-control" id="itemName" placeholder="ইমেইল লিখুন">
                        </div>

                        <div class="form-group">
                            <label for="itemDescription">ফোন :* (পরিবর্তনযোগ্য নয়) </label>
                            <input type="text" class="form-control" id="itemName" placeholder="01830996044"
                                disabled>
                        </div>

                        <div class="form-group">
                            <label for="itemDescription"> লিঙ্গ :* </label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="male" value="" checked>
                                <label class="form-check-label" for="male">
                                    পুরুষ
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="female">
                                <label class="form-check-label" for="female">
                                    মহিলা
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="others">
                                <label class="form-check-label" for="others">
                                    অন্যান্য
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="itemCategory">উপজেলা :* </label>
                            <select class="form-control" id="itemCategory">
                                <option value=""> নির্বাচন করুন </option>
                                <option value="medicine">বোদা</option>
                                <option value="surgery">দেবীগঞ্জ</option>
                                <option value="dentistry">আটোয়ারী</option>
                                <option value="dentistry">তেঁতুলিয়া</option>
                                <option value="dentistry">পঞ্চগড় সদর</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="itemDescription">ঠিকানা :</label>
                            <textarea class="form-control" id="itemDescription" rows="3" placeholder="আপনার ঠিকানা লিখুন"></textarea>
                        </div>

                        <!-- Picture Input with Preview -->
                        <div class="form-group">
                            <label for="itemImage"> প্রফাইল ফটো : </label>
                            <input type="file" class="form-control-file" id="itemImage" accept="image/*">
                            <!-- Image Preview Area -->
                            <div id="imagePreview" class="mt-2" style="display: none;">
                                <img id="previewImg" src="" alt="Image Preview" class="img-fluid"
                                    style="max-width: 200px;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="itemCategory"> সাবস্ক্রিপশন : </label>
                            <select class="form-control" id="itemCategory">
                                <option value="medicine"> নির্বাচন করুন </option>
                                <option value="medicine"> সিলভার </option>
                                <option value="surgery"> ব্রোঞ্জ </option>
                                <option value="dentistry"> গোল্ড </option>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View User Modal -->
    <div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">ইউজার প্রফাইল</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="d-flex bd-highlight">
                                    <div class="p-2 flex-fill bd-highlight">
                                        <div class="about-avatar mt-1 mb-0 p-2 pr-4">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                                style="width: 100px; height: 100px;" alt="">
                                        </div>
                                    </div>
                                    <div class="p-2 flex-fill bd-highlight">
                                        <div class="row about-list">
                                            <div class="d-flex flex-column">
                                                <div>
                                                    <h6><samp class="sampcolor"> ফারহান মর্শেদ</samp> </h6>
                                                </div>
                                                <div>
                                                    <p><samp class="sampcolor"> পেশা : </samp> ছাত্র </p>
                                                </div>
                                                <div>
                                                    <p><samp class="sampcolor"> মোবাইল : </samp> 01830996044</p>
                                                </div>
                                                <div>
                                                    <p><samp class="sampcolor"> ইমাইল : </samp> farhan@gmail.com</p>
                                                </div>
                                                <div>
                                                    <p><samp class="sampcolor"> লিঙ্গ :</samp> পুরুষ </p>
                                                </div>
                                                <div>
                                                    <p><samp class="sampcolor"> উপজেলা : </samp> আটোয়ারী </p>
                                                </div>
                                                <div>
                                                    <p><samp class="sampcolor"> ঠিকানা :</samp> আটোয়ারী, পঞ্চগড় </p>
                                                </div>
                                                <div>
                                                    <p><samp class="sampcolor"> সাবস্ক্রিপশন :</samp> Empty </p>
                                                </div>
                                                <div>
                                                    <p><samp class="sampcolor"> স্ট্যাটাস :</samp> Active </p>
                                                </div>
                                                <div>
                                                    <p><samp class="sampcolor"> নিবন্ধন তারিখ : </samp> 01/01/2025</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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


            //viewStaffModal
            $('#viewStaffModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var email = button.data('email');
                var phone = button.data('phone');
                var role = button.data('role');
                var status = button.data('status');
                var image = button.data('image');
                var entry = button.data('entry');

                var modal = $(this);
                modal.find('#xID').text(id);
                modal.find('#xName').text(name);
                modal.find('#xEmail').text(email);
                modal.find('#xPhone').text(phone);
                modal.find('#xRole').text(role);
                modal.find('#xStatus').text(status);
                modal.find('#xEntry').text(entry);

                // Set the image source
                var modalImage = modal.find('#modalImage');
                if (image) {
                    modalImage.attr('src', image);
                } else {
                    modalImage.attr('src', "{{ asset('assets/dashboard/img/users/avatar.png') }}");
                }

            });
            //editStaffModal
            $('#editUserModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var email = button.data('email');
                var phone = button.data('phone');
                var role = button.data('role');
                var status = button.data('status');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#name').val(name);
                modal.find('#email').val(email);
                modal.find('#phone').val(phone);
                modal.find('#itemCategory').val(role);
                modal.find('#customSwitch1').prop('checked', status === 'Active').val(status);

                var imagePreview = modal.find('#imagePreviewX');
                if (image) {
                    imagePreview.html('<img src="' + image + '" class="img-fluid" />');
                } else {
                    imagePreview.html('<i class="bi bi-person-circle" style="font-size: 60px; color: #ccc;"></i>');
                }

                modal.find('#modalFormX').attr('action', '/admin/users/' + id);

            });
            //deleteAdminStaff
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
