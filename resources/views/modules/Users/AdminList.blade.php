<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব - ইউজার |</title>
    </x-slot>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">

            <!-- Admin Data List -->
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4> এডমিন স্টাফ লিস্ট </h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createStaffModal">যোগ করুন</a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped text-center" id="table-2">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center pt-3 pl-4">
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
                                                <th class="align-left">Role</th>
                                                <th class="align-left">Email</th>
                                                <th class="align-left">Phone</th>
                                                <th class="align-left">Entry Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($admins->isNotEmpty())
                                                @foreach ($admins as $key => $admin)
                                                    <tr>
                                                        <td> {{ ++$key }} </td>
                                                        <td class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    class="custom-control-input"
                                                                    id="checkbox-{{ $admin->id }}">
                                                                <label for="checkbox-{{ $admin->id }}"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if (!empty($admin->image))
                                                                <img class="rounded-circle" alt="image"
                                                                    src="{{ asset('uploads/admins/' . $admin->image) }}"
                                                                    width="35" height="35">
                                                            @else
                                                                <img class="rounded-circle" alt="image"
                                                                    src="{{ asset('assets/dashboard/img/users/avatar.png') }}"
                                                                    width="35" height="35">
                                                            @endif
                                                        </td>
                                                        <td class="align-left"> {{ $admin->name }} </td>
                                                        <td class="align-left"> {{ $admin->role }} </td>
                                                        <td class="align-left"> {{ $admin->email }} </td>
                                                        <td class="align-left"> {{ $admin->phone }} </td>
                                                        <td class="align-left">
                                                            {{ \Carbon\Carbon::parse($admin->created_at)->format('d M, Y') }}
                                                        </td>
                                                        <td>
                                                            <div @if ($admin->status == 'Active') class="badge badge-success badge-shadow" @endif
                                                                class="badge badge-danger badge-shadow">
                                                                {{ $admin->status }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <a href="#" class="btn btn-success"
                                                                data-toggle="modal" data-target="#viewStaffModal"
                                                                data-id="{{ $admin->id }}"
                                                                data-name="{{ $admin->name }}"
                                                                data-email="{{ $admin->email }}"
                                                                data-phone="{{ $admin->phone }}"
                                                                data-role="{{ $admin->role }}"
                                                                data-status="{{ $admin->status }}"
                                                                data-image="{{ $admin->image ? asset('uploads/admins/' . $admin->image) : '' }}"
                                                                data-entry="{{ \Carbon\Carbon::parse($admin->created_at)->format('d/m/Y') }}">
                                                                View
                                                            </a>

                                                            <a href="#" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#editStaffModal"
                                                                data-id="{{ $admin->id }}"
                                                                data-name="{{ $admin->name }}"
                                                                data-email="{{ $admin->email }}"
                                                                data-phone="{{ $admin->phone }}"
                                                                data-role="{{ $admin->role }}"
                                                                data-status="{{ $admin->status }}"
                                                                data-image="{{ $admin->image ? asset('uploads/admins/' . $admin->image) : '' }}">
                                                                Edit
                                                            </a>

                                                            <a href="javascript:void(0);"
                                                                onclick="deleteAdminStaff({{ $admin->id }})"
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

            <!-- Roles and Permissions -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Admin <code>Settings</code></h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item mr-2">
                                    <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3"
                                        role="tab" aria-controls="home" aria-selected="true">Roles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3"
                                        role="tab" aria-controls="profile" aria-selected="false">Permissions</a>
                                </li>
                                <li class="nav-item ml-auto">
                                    <a href="#" class="nav-link active" id="add-link" role="tab"
                                        aria-controls="profile" aria-selected="false" data-target="#createRolesModal"
                                        data-toggle="modal">Create</a>
                                    <a href="#" class="nav-link active d-none" id="create-link" role="tab"
                                        aria-controls="profile" aria-selected="false"
                                        data-target="#createPermissionsModal" data-toggle="modal">Add</a>
                                </li>
                            </ul>
                            <!-- Admin Settings -->
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-content tab-pane fade show active" id="home3" role="tabpanel"
                                    aria-labelledby="home-tab3">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-md">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Role</th>
                                                    <th>Permissions</th>
                                                    <th>Created At</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                @if ($roles->isNotEmpty())
                                                    @foreach ($roles as $key => $role)
                                                        <tr>
                                                            <td> {{ ++$key }} </td>
                                                            <td> {{ $role->name }} </td>
                                                            <td> {{ $role->permissions->pluck('name')->implode(', ') }}
                                                            </td>
                                                            <td> {{ \Carbon\Carbon::parse($role->created_at)->format('d M, Y') }}
                                                            </td>

                                                            <td class="text-center">
                                                                <a href="#" class="btn btn-primary"
                                                                    data-toggle="modal" data-target="#editRolesModal"
                                                                    data-id="{{ $role->id }}"
                                                                    data-name="{{ $role->name }}">
                                                                    Edit
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                    onclick="deleteRole({{ $role->id }})"
                                                                    class="btn btn-danger">Delete</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-content tab-pane fade" id="profile3" role="tabpanel"
                                    aria-labelledby="profile-tab3">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-md">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Permission</th>
                                                    <th>Created At</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                @if ($permissions->isNotEmpty())
                                                    @foreach ($permissions as $key => $permission)
                                                        <tr>
                                                            <td> {{ ++$key }} </td>
                                                            <td> {{ $permission->name }} </td>
                                                            <td> {{ \Carbon\Carbon::parse($permission->created_at)->format('d M, Y') }}
                                                            </td>

                                                            <td class="text-center">
                                                                <a href="#" class="btn btn-primary"
                                                                    data-toggle="modal"
                                                                    data-target="#editPermissionsModal"
                                                                    data-id="{{ $permission->id }}"
                                                                    data-name="{{ $permission->name }}">
                                                                    Edit
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                    onclick="deletePermission({{ $permission->id }})"
                                                                    class="btn btn-danger">Delete</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottoms -->
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="mb-2">Info Message</div>
                            <button class="btn btn-primary" id="toastr-1">Launch</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="mb-2">Success Message</div>
                            <button class="btn btn-primary" id="toastr-2">Launch</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="mb-2">Warning Message</div>
                            <button class="btn btn-primary" id="toastr-3">Launch</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="mb-2">Error Message</div>
                            <button class="btn btn-primary" id="toastr-4">Launch</button>
                        </div>
                    </div>
                </div>
            </div>



        </section>
        <!-- Settings Sidebar -->
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
    <!-- Create Staff Modal -->
    <div class="modal modalz fade" id="createStaffModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Create New Staff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal Content Goes Here -->
                    <form method="POST" action="{{ route('admin.staff.store') }}" id="modalForm"
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
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Name" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email" value="{{ old('email') }}" required>
                            @error('email')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role Field -->
                        <div class="form-group">
                            <select class="form-control" id="itemCategory" name="role" required>
                                <option value="" selected>Select role</option>
                                @if ($roles->isNotEmpty())
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ old('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="">No roles available</option>
                                @endif
                            </select>
                            @error('role')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="form-group">
                            <input type="tel" id="phone" name="phone" class="form-control"
                                placeholder="Phone" value="{{ old('phone') }}">
                            @error('phone')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
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

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Staff Modal -->
    <div class="modal modalz fade" id="editStaffModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                {{-- <!-- Modal Content Goes Here --> action="{{ route('admin.staff.update', $admin->id) }}" --}}
                <form method="POST" action="" id="modalFormX" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Edit Staff</h5>
                        <div class="ml-auto custom-switch">
                            <input type="checkbox" checked class="custom-control-input" id="customSwitch1"
                                name="status" value="Active">
                            <label class="custom-control-label" for="customSwitch1">Status</label>
                        </div>
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

                        <!-- Name Field -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Name" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email" value="{{ old('email') }}" required>
                            @error('email')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role Field -->
                        <div class="form-group">
                            <select class="form-control" id="itemCategory" name="role" required>
                                @if ($roles->isNotEmpty())
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ old('role') == $role->name ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="Empty">No roles available</option>
                                @endif
                            </select>
                            @error('role')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="form-group">
                            <input type="tel" id="phone" name="phone"
                                value="{{ old('phone') }}"class="form-control" placeholder="Phone"
                                value="{{ $admin->phone }}">
                            @error('phone')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Change</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- View Staff Modal -->
    <div class="modal fade" id="viewStaffModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Staff Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="modalFormPass" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="input-group">
                                <div class="d-flex bd-highlight">
                                    <div class="p-2 flex-fill bd-highlight align-self-center">
                                        <div class="about-avatar mt-1  ">
                                            <img id="modalImage" src="" style="width: 148px; height: 186px;"
                                                alt="User Image">
                                        </div>
                                    </div>
                                    <div class="p-2 flex-fill bd-highlight">
                                        <div class="row about-list">
                                            <div class="d-flex flex-column">
                                                <div class="modal-body">
                                                    {{-- <p><samp class="sampcolor">ID: </samp><span id="xID"></span> </p> --}}
                                                    <p><samp class="sampcolor">Name: </samp><span
                                                            id="xName"></span></p>
                                                    <p><samp class="sampcolor">Email: </samp><span
                                                            id="xEmail"></span></p>
                                                    <p><samp class="sampcolor">Phone: </samp><span
                                                            id="xPhone"></span></p>
                                                    <p><samp class="sampcolor">Role: </samp><span
                                                            id="xRole"></span></p>
                                                    <p><samp class="sampcolor">Status: </samp><span
                                                            id="xStatus"></span></p>
                                                    <p><samp class="sampcolor">Entry Date: </samp><span
                                                            id="xEntry"></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="itemCategory">Update Password</label>

                        <!-- New Password Field -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Password" required>
                                @error('password')
                                    <p class="text-danger font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <!-- Confirm Password Field -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="password_confirmation" placeholder="Confirm Password" required>
                                @error('password_confirmation')
                                    <p class="text-danger font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect">Save Change</button>
                        <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Create Role Modal -->
    <div class="modal modalz fade" id="createRolesModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Create New Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal Content Goes Here -->
                    <form method="POST" action="{{ route('admin.roles.store') }}" id="modalForm">
                        @csrf

                        <!-- Role Name Field -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Role Name" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Permissions Field -->
                        <div class="form-group">
                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $permission)
                                    <div>
                                        <input type="checkbox" id="permission-{{ $permission->id }}" class="rounded"
                                            name="permission[]" value="{{ $permission->name }}">
                                        <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Role Modal -->
    <div class="modal modalz fade" id="editRolesModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Edit Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal Content Goes Here -->
                    <form method="POST" action="" id="modalFormR">
                        @csrf
                        @method('PUT')

                        <!-- Role Name Field -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Role Name" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            @foreach ($permissions as $permission)
                                <div>
                                    <input type="checkbox" id="permission-{{ $permission->id }}" class="rounded"
                                        name="permission[]" value="{{ $permission->name }}">
                                    <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Permission Modal -->
    <div class="modal modalz fade" id="createPermissionsModal" tabindex="-1" role="dialog"
        aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Create New Permission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal Content Goes Here -->
                    <form method="POST" action="{{ route('admin.permissions.store') }}" id="modalForm">
                        @csrf
                        <!-- Permission Name Field -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Permission Name" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Permission Modal -->
    <div class="modal modalz fade" id="editPermissionsModal" tabindex="-1" role="dialog"
        aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Edit Permission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal Content Goes Here -->
                    <form method="POST" action="" id="modalFormP">
                        @csrf
                        @method('PUT')

                        <!-- Role Permission Field -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Role Name" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-danger font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Change</button>
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

                modal.find('#modalFormPass').attr('action', '/admin/staff/pass/' + id);

            });
            //editStaffModal
            $('#editStaffModal').on('show.bs.modal', function(event) {
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

                modal.find('#modalFormX').attr('action', '/admin/staff/' + id);

            });
            //deleteAdminStaff
            function deleteAdminStaff(id) {
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: '{{ route('admin.staff.destroy') }}',
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

            //Tab Controler
            document.addEventListener('DOMContentLoaded', function() {
                $('#myTab3 a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    var target = $(e.target).attr("href"); // activated tab
                    if (target === '#home3') {
                        $('#add-link').removeClass('d-none');
                        $('#create-link').addClass('d-none');
                    } else if (target === '#profile3') {
                        $('#add-link').addClass('d-none');
                        $('#create-link').removeClass('d-none');
                    }
                });
            });

            //editRolesModal
            $('#editRolesModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');

                var modal = $(this);
                modal.find('#name').val(name);

                // Fetch the permissions for the role and update the checkboxes
                $.ajax({
                    url: '/admin/roles/' + id + '/permissions',
                    type: 'GET',
                    success: function(data) {
                        var permissions = data.permissions;
                        $('input[name="permission[]"]').each(function() {
                            var permissionName = $(this).val();
                            if (permissions.includes(permissionName)) {
                                $(this).prop('checked', true);
                            } else {
                                $(this).prop('checked', false);
                            }
                        });
                    }
                });

                modal.find('#modalFormR').attr('action', '/admin/roles/' + id);
            });
            //Delete Role
            function deleteRole(id) {
                if (confirm('Are you sure you want to delete this role?')) {
                    $.ajax({
                        url: '{{ route('admin.roles.destroy') }}',
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
                            alert('Failed to delete role. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }

            //editPermissionsModal
            $('#editPermissionsModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');

                var modal = $(this);
                modal.find('#name').val(name);

                modal.find('#modalFormP').attr('action', '/admin/permissions/' + id);
            });
            //Delete Permission
            function deletePermission(id) {
                if (confirm('Are you sure you want to delete this role?')) {
                    $.ajax({
                        url: '{{ route('admin.permissions.destroy') }}',
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
                            alert('Failed to delete role. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }
        </script>
    </x-slot>

</x-dashboard-app-layout>
