<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব - ডাক্তারগন |</title>
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
                                <h4>ডাক্তারগন </h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createDoctorModal">Create</a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-2">
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
                                                <th>Doctor Name</th>
                                                <th>Category</th>
                                                <th>Qulification</th>
                                                <th>Added</th>
                                                <th>Entry Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td class="text-center align-middle">
                                                    <!-- align-middle for vertical centering -->
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            class="custom-control-input" id="checkbox-1">
                                                        <label for="checkbox-1"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img class="rounded-circle" alt="image"
                                                        src="{{ asset('assets/dashboard/img/users/user-5.png') }}"
                                                        width="35">
                                                </td>
                                                <td>Create a mobile app</td>
                                                <td class="align-middle">
                                                    Madicine
                                                </td>
                                                <td class="align-middle">
                                                    Madicine
                                                </td>
                                                <td class="align-middle">
                                                    Mr. Xyz Abcd
                                                </td>
                                                <td>2018-01-20</td>
                                                <td>
                                                    <div class="badge badge-success badge-shadow">Approved</div>
                                                </td>
                                                <td><a href="#" class="btn btn-success" data-toggle="modal"
                                                        data-target="#viewDoctorModal">View</a><a href="#"
                                                        class="btn mx-1 btn-primary" data-toggle="modal"
                                                        data-target="#editDoctorModal">Edit</a><a href="#"
                                                        class="btn btn-danger">Delete</a></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td class="text-center align-middle">
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            class="custom-control-input" id="checkbox-2">
                                                        <label for="checkbox-2"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img class="rounded-circle" alt="image"
                                                        src="{{ asset('assets/dashboard/img/users/user-5.png') }}"
                                                        width="35">
                                                </td>
                                                <td>Redesign homepage</td>
                                                <td class="align-middle">
                                                    Madicine
                                                </td>
                                                <td class="align-middle">
                                                    Madicine
                                                </td>
                                                <td class="align-middle">
                                                    Mr. Xyz Abcd
                                                </td>
                                                <td>2018-04-10</td>
                                                <td>
                                                    <div class="badge badge-info badge-shadow">In Review</div>
                                                </td>
                                                <td><a href="#" class="btn btn-success">View</a><a href="#"
                                                        class="btn mx-1 btn-primary">Edit</a><a href="#"
                                                        class="btn btn-danger">Delete</a></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td class="text-center align-middle">
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            class="custom-control-input" id="checkbox-3">
                                                        <label for="checkbox-3"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img class="rounded-circle" alt="image"
                                                        src="{{ asset('assets/dashboard/img/users/user-5.png') }}"
                                                        width="35">
                                                </td>
                                                <td>Backup database</td>
                                                <td class="align-middle">
                                                    Madicine
                                                </td>
                                                <td class="align-middle">
                                                    Madicine
                                                </td>
                                                <td class="align-middle">
                                                    Mr. Xyz Abcd
                                                </td>
                                                <td>2018-01-29</td>
                                                <td>
                                                    <div class="badge badge-warning badge-shadow">Pending</div>
                                                </td>
                                                <td><a href="#" class="btn btn-success">View</a><a href="#"
                                                        class="btn mx-1 btn-primary">Edit</a><a href="#"
                                                        class="btn btn-danger">Delete</a></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td class="text-center align-middle">
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            class="custom-control-input" id="checkbox-4">
                                                        <label for="checkbox-4"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img class="rounded-circle" alt="image"
                                                        src="{{ asset('assets/dashboard/img/users/user-5.png') }}"
                                                        width="35">
                                                </td>
                                                <td>Input data</td>
                                                <td class="align-middle">
                                                    Madicine
                                                </td>
                                                <td class="align-middle">
                                                    Madicine
                                                </td>
                                                <td class="align-middle">
                                                    Mr. Xyz Abcd
                                                </td>
                                                <td>2018-01-16</td>
                                                <td>
                                                    <div class="badge badge-danger badge-shadow">Denied</div>
                                                </td>
                                                <td><a href="#" class="btn btn-success">View</a><a
                                                        href="#" class="btn mx-1 btn-primary">Edit</a><a
                                                        href="#" class="btn btn-danger">Delete</a></td>
                                            </tr>
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
    <!-- Create Doctor Modal -->
    <div class="modal modalz fade" id="createDoctorModal" tabindex="-1" role="dialog"
        aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">নতুন ডাক্তার যোগ করন </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal Content Goes Here -->

                    <form method="POST" action="{{ route('admin.doctors.store') }}" id="modalForm" enctype="multipart/form-data">
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

                        <div class="form-group">
                            <label for="itemName">ডাক্তারের নাম :*</label>
                            <input type="text" class="form-control" id="itemName"
                                placeholder="নাম লিখুন">
                        </div>

                        <div class="form-group">
                            <label for="itemCategory">কোন রোগের বিশেষজ্ঞ :*</label>
                            <select class="form-control" id="itemCategory">
                                <option value="">নির্বাচন করুন</option>
                                <option value="medicine">মনোরোগ বিশেষজ্ঞ</option>
                                <option value="medicine">হৃদরোগ বিশেষজ্ঞ</option>
                                <option value="medicine">পাইলস বিশেষজ্ঞ</option>
                                <option value="medicine">ডেন্টিষ্ট</option>
                                <option value="medicine">চর্ম ও যৌন রোগ বিশেষজ্ঞ</option>
                                <option value="medicine">ডায়াবেটিস ও হরমোন</option>
                                <option value="medicine">নাক, কান ও গলা বিশেষজ্ঞ</option>
                                <option value="medicine">চক্ষু বিশেষজ্ঞ</option>
                                <option value="medicine">লিভার বিশেষজ্ঞ</option>
                                <option value="medicine">ইউরোলজি</option>
                                <option value="medicine">সার্জারি</option>
                                <option value="medicine">গাইনি বিশেষজ্ঞ</option>
                                <option value="medicine">রক্ত বিশেষজ্ঞ</option>
                                <option value="medicine">হোমিওপ্যাথী </option>
                                <option value="medicine">লেজার সার্জারি</option>
                                <option value="medicine">মেডিসিন বিশেষজ্ঞ</option>
                                <option value="medicine">কিডনি রোগ বিশেষজ্ঞ</option>
                                <option value="medicine">নিউরো-সার্জারি</option>
                                <option value="medicine">স্নায়ু রোগ বিশেষজ্ঞ</option>
                                <option value="medicine">পুষ্টি বিশেষজ্ঞ</option>
                                <option value="medicine">ক্যান্সার বিশেষজ্ঞ</option>
                                <option value="medicine">অর্থোপেডিক</option>
                                <option value="medicine">ব্যথা বিশেষজ্ঞ</option>
                                <option value="medicine">শিশু রোগ বিশেষজ্ঞ</option>
                                <option value="medicine">ফিজিক্যাল মেডিসিন</option>
                                <option value="medicine">ফিজিওথেরাপিস্ট</option>
                                <option value="medicine">প্লাস্টিক সার্জারি</option>
                                <option value="medicine">শিশু রোগ বিশেষজ্ঞ</option>
                                <option value="surgery">যক্ষা, এ্যজমা ও বক্ষব্যাধি বিশেষজ্ঞ</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="itemName">ডাক্তারের শিক্ষাগত যোগ্যতা :*</label>
                            <input type="text" class="form-control" id="itemName"
                                placeholder="শিক্ষাগত যোগ্যতা লিখুন">
                        </div>

                        <div class="form-group">
                            <label for="itemName">ডাক্তারের বর্তমান কর্মস্থল :*</label>
                            <input type="text" class="form-control" id="itemName"
                                placeholder="বর্তমান কর্মস্থল লিখুন">
                        </div>

                        <div class="form-group">
                            <label for="itemDescription">যেই যেই রোগের চিকিৎসা করেন :*</label>
                            <textarea class="form-control" id="itemDescription" rows="3" placeholder="রোগের নাম লিখুন"></textarea>
                        </div>

                        <!-- Chambers Section -->
                        <div id="chamberContainer">
                            <div class="chamber-group mb-3" id="chamberGroup1">
                            </div>
                        </div>

                        <!-- Add Chamber Buttons -->
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-success" id="addChamberBtn">+ Add Chamber</button>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Doctor Modal -->
    <div class="modal modalz fade" id="editDoctorModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Edit Doctor Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal Content Goes Here -->
                    <form id="modalForm">
                        <div class="form-group">
                            <label for="itemName">ডাক্তারের নাম</label>
                            <input type="text" class="form-control" id="itemName"
                                placeholder="Enter Doctor Name">
                        </div>

                        <div class="form-group">
                            <label for="itemCategory">বিভাগ</label>
                            <select class="form-control" id="itemCategory">
                                <option value="">কোন রোগের বিশেষজ্ঞ</option>
                                <option value="medicine">মনোরোগ বিশেষজ্ঞ</option>
                                <option value="medicine">হৃদরোগ বিশেষজ্ঞ</option>
                                <option value="medicine">পাইলস বিশেষজ্ঞ</option>
                                <option value="medicine">ডেন্টিষ্ট</option>
                                <option value="medicine">চর্ম ও যৌন রোগ বিশেষজ্ঞ</option>
                                <option value="medicine">ডায়াবেটিস ও হরমোন</option>
                                <option value="medicine">নাক, কান ও গলা বিশেষজ্ঞ</option>
                                <option value="medicine">চক্ষু বিশেষজ্ঞ</option>
                                <option value="medicine">লিভার বিশেষজ্ঞ</option>
                                <option value="medicine">ইউরোলজি</option>
                                <option value="medicine">সার্জারি</option>
                                <option value="medicine">গাইনি বিশেষজ্ঞ</option>
                                <option value="medicine">রক্ত বিশেষজ্ঞ</option>
                                <option value="medicine">হোমিওপ্যাথী </option>
                                <option value="medicine">লেজার সার্জারি</option>
                                <option value="medicine">মেডিসিন বিশেষজ্ঞ</option>
                                <option value="medicine">কিডনি রোগ বিশেষজ্ঞ</option>
                                <option value="medicine">নিউরো-সার্জারি</option>
                                <option value="medicine">স্নায়ু রোগ বিশেষজ্ঞ</option>
                                <option value="medicine">পুষ্টি বিশেষজ্ঞ</option>
                                <option value="medicine">ক্যান্সার বিশেষজ্ঞ</option>
                                <option value="medicine">অর্থোপেডিক</option>
                                <option value="medicine">ব্যথা বিশেষজ্ঞ</option>
                                <option value="medicine">শিশু রোগ বিশেষজ্ঞ</option>
                                <option value="medicine">ফিজিক্যাল মেডিসিন</option>
                                <option value="medicine">ফিজিওথেরাপিস্ট</option>
                                <option value="medicine">প্লাস্টিক সার্জারি</option>
                                <option value="medicine">শিশু রোগ বিশেষজ্ঞ</option>
                                <option value="surgery">যক্ষা, এ্যজমা ও বক্ষব্যাধি বিশেষজ্ঞ</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="itemName">শিক্ষাগত যোগ্যতা</label>
                            <input type="text" class="form-control" id="itemName"
                                placeholder="Enter Doctor Name">
                        </div>
                        <div class="form-group">
                            <label for="itemName">বর্তমান সেবা</label>
                            <input type="text" class="form-control" id="itemName"
                                placeholder="Enter Doctor Name">
                        </div>

                        <div class="form-group">
                            <label for="itemDescription">যে যে রোগ চিকিৎসা করেন</label>
                            <textarea class="form-control" id="itemDescription" rows="3" placeholder="Enter description"></textarea>
                        </div>

                        <!-- Picture Input with Preview -->
                        <div class="form-group">
                            <label for="itemImage">Item Image</label>
                            <input type="file" class="form-control-file" id="itemImage" accept="image/*">
                            <!-- Image Preview Area -->
                            <div id="imagePreview" class="mt-2" style="display: none;">
                                <img id="previewImg" src="" alt="Image Preview" class="img-fluid"
                                    style="max-width: 200px;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="itemCategory">status</label>
                            <select class="form-control" id="itemCategory">
                                <option value="">Select Category</option>
                                <option value="medicine">In Review</option>
                                <option value="surgery">Pending</option>
                                <option value="dentistry">Approved</option>
                            </select>
                        </div>

                        <!-- Chambers Section -->
                        <div id="chamberContainer">
                            <div class="chamber-group mb-3" id="chamberGroup1">
                                <h5>চেম্বার</h5>
                                <div class="form-group">
                                    <label for="chamberName">চেম্বারের নাম</label>
                                    <input type="text" class="form-control" id="chamberName"
                                        placeholder="Enter chamber name">
                                </div>
                                <div class="form-group">
                                    <label for="chamberAddress">চেম্বারের ঠিকানা</label>
                                    <input type="text" class="form-control" id="chamberAddress"
                                        placeholder="Enter chamber address">
                                </div>
                                <div class="form-group">
                                    <label for="chamberContact">চেম্বারের যোগাযোগ</label>
                                    <input type="text" class="form-control" id="chamberContact"
                                        placeholder="Enter chamber contact">
                                </div>
                                <div class="form-group">
                                    <label for="chamberDate">চেম্বারের তারিখ</label>
                                    <input type="text" class="form-control" id="chamberDate">
                                </div>
                                <div class="form-group">
                                    <label for="chamberTime">চেম্বার সময়</label>
                                    <input type="text" class="form-control" id="chamberTime">
                                </div>
                            </div>
                        </div>

                        <!-- Add More Chambers Button -->
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-success" id="addChamberBtn">+ Add Another
                                Chamber</button>
                            <button type="button" class="btn btn-danger removeChamberBtn" id="removeChamberBtn">-
                                Remove Chamber</button>
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

    <!-- View Doctor Modal -->
    <div class="modal modalz fade" id="viewDoctorModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">View Doctor Data</h5>
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
                                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                                    style="width: 100px; height: 100px;" title=""
                                                    alt="">
                                            </div>
                                            <div class="p-2 flex-shrink-1 bd-highlight mt-4">
                                                <h5 class="dark-color">সহকারী অধ্যাপক ডাঃ মোঃ মাহমুদুল মোর্শেদ</h5>
                                                <h6 class="theme-color lead"><samp class="sampcolor">বিশেষজ্ঞ: </samp>
                                                    নিউরো সার্জন</h6>
                                            </div>

                                        </div>
                                        <!-- <h4 class="dark-color">সহকারী অধ্যাপক ডাঃ মোঃ মাহমুদুল মোর্শেদ</h4> -->
                                        <!-- <h6 class="theme-color lead"><samp class="sampcolor">বিশেষজ্ঞ: </samp> নিউরো সার্জন</h6> -->
                                        <div class="about-list">
                                            <div class="d-flex flex-column">
                                                <div>

                                                    <samp class="sampcolor">শিক্ষাগত যোগ্যতা: </samp>
                                                    এমবিবিএস (ঢাকা), বিএলএস (এইচএ), এমসিপিএস (মেডিসিন), এমসিপিএস (সি),
                                                    সিইসি (ইকো কার্ডিওগ্রাফি), ডি-কার্ড (কার্ডিওলজি)- বঙ্গবন্ধু শেখ
                                                    মুজিব মেডিকেল বিশ্ববিদ্যালয়, ঢাকা।
                                                </div>
                                                <div>
                                                    <samp class="sampcolor">বর্তমান কর্মস্থল: </samp>
                                                    বঙ্গবন্ধু শেখ মুজিব মেডিকেল বিশ্ববিদ্যালয়, ঢাকা
                                                </div>
                                                <div>
                                                    <samp class="sampcolor">চেম্বারসমূহ: </samp>
                                                    মিরপুর হেলথ কেয়ার, কলওয়ালাপাড়া, মিরপুর-১, ঢাকা।
                                                    সন্ধ্যা ৭:০০টা হতে রাত ৯:০০টা পর্যন্ত।

                                                </div>
                                                <div>
                                                    <samp class="sampcolor">বিস্তারিত: </samp>

                                                    হার্ট এ্যাটাক/হার্টব্লক, বুকে ব্যাথা। উচ্চ রক্ত চাপ (হাইপারটেনশন)।
                                                    হাঁটতে হাপিয়ে যাওয়া/হার্ট ফেইলিওর।
                                                    অ্যাঞ্জিওগ্রাম, রিংপ্রেসমেকারওবাইপাসরোগীরপরামর্শ।
                                                    হাঁটতে যেয়ে মাথা ঘুরেপরে যাওয়া।
                                                    শ্বাস কষ্টে রাতে ঘুমাতে না পারা।
                                                    বুক ধড়ফড় করা (প্যালপিটিশন)।
                                                    বাতজ্বর ও বাতজ্বর জনিত হৃদরোগ, জন্মগত হৃদরোগ।
                                                    উচ্চ রক্তচাপ।
                                                    নিম্ন রক্তচাপ।
                                                    বুকে ব্যাথা।
                                                    বুক ধড়ফড় করা।
                                                    পেটে সমস্যা।
                                                    রক্তে অতিরিক্ত চর্বি (Hyperlipidemia)।
                                                    অকারণ দুর্বলতা, ক্ষুধামন্দা, বমিভাব ও বমি হওয়া।
                                                    ঘন ঘন জ্বর আসা/কাঁপুনী দিয়ে জ্বর আসা।
                                                    প্রস্রাবে ইনফেকশন।
                                                    প্রেসার ওঠানামা।
                                                    মেডিসিন জনিত সব ধরনের রোগ বিশেষজ্ঞ।

                                                </div>

                                            </div>

                                        </div>


                                    </div>
                                </div>

                            </div>

                            </br>
                            <div class="d-flex bd-highlight counter">
                                <div class="p-2 flex-fill bd-highlight">
                                    <div class="col-2 col-lg-3">
                                        <div class="count-data text-center">
                                            <h6 class="count h5" data-to="500" data-speed="500">500</h6>
                                            <p class="m-0px font-w-600">Happy Clients</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 flex-fill bd-highlight">
                                    <div class="col-2 col-lg-3">
                                        <div class="count-data text-center">
                                            <h6 class="count h5" data-to="150" data-speed="150">150</h6>
                                            <p class="m-0px font-w-600">Project Completed</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 flex-fill bd-highlight">
                                    <div class="col-2 col-lg-3">
                                        <div class="count-data text-center">
                                            <h6 class="count h5" data-to="850" data-speed="850">850</h6>
                                            <p class="m-0px font-w-600">Photo Capture</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 flex-fill bd-highlight">
                                    <div class="col-2 col-lg-3">
                                        <div class="count-data text-center">
                                            <h6 class="count h5" data-to="190" data-speed="190">190</h6>
                                            <p class="m-0px font-w-600">Telephonic Talk</p>
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

            // document.addEventListener("DOMContentLoaded", function () {
            //     const chamberContainer = document.getElementById("chamberContainer");
            //     const addChamberBtn = document.getElementById("addChamberBtn");
            //     const removeChamberBtn = document.getElementById("removeChamberBtn");

            //     addChamberBtn.addEventListener("click", function () {
            //         const chamberCount = chamberContainer.getElementsByClassName("chamber-group").length;
            //         const newChamberGroup = document.createElement("div");
            //         newChamberGroup.classList.add("chamber-group", "mb-3");
            //         newChamberGroup.innerHTML = `
            //             <h6>চেম্বার ${chamberCount}</h6>
            //             <div class="form-group">
            //                 <label>চেম্বারের নাম :*</label>
            //                 <input type="text" class="form-control" name="chamberName[]" placeholder="চেম্বারের নাম লিখুন">
            //             </div>
            //             <div class="form-group">
            //                 <label>চেম্বারের ঠিকানা :*</label>
            //                 <input type="text" class="form-control" name="chamberAddress[]" placeholder="চেম্বারের ঠিকানা লিখুন">
            //             </div>
            //             <div class="form-group">
            //                 <label>চেম্বারের যোগাযোগ নম্বর :*</label>
            //                 <input type="text" class="form-control" name="chamberContact[]" placeholder="ফোন নম্বর লিখুন">
            //             </div>
            //             <div class="form-group">
            //                 <label>কোন কোন দিন খোলা থাকে :*</label>
            //                 <input type="text" class="form-control" name="chamberDate[]" placeholder="দিন লিখুন">
            //             </div>
            //             <div class="form-group">
            //                 <label>কয়টা থেকে কয়টা পর্যন্ত খোলা থাকে :*</label>
            //                 <input type="text" class="form-control" name="chamberTime[]" placeholder="সময় লিখুন">
            //             </div>
            //             <button type="button" class="btn btn-danger remove-single-chamber">Remove</button>
            //         `;
            //         chamberContainer.appendChild(newChamberGroup);
            //     });

            //     chamberContainer.addEventListener("click", function (event) {
            //         if (event.target.classList.contains("remove-single-chamber")) {
            //             event.target.closest(".chamber-group").remove();
            //         }
            //     });

            //     removeChamberBtn.addEventListener("click", function () {
            //         const chambers = chamberContainer.getElementsByClassName("chamber-group");
            //         if (chambers.length > 0) {
            //             chamberContainer.removeChild(chambers[chambers.length - 1]);
            //         }
            //     });
            // });

            document.addEventListener("DOMContentLoaded", function () {
                const chamberContainer = document.getElementById("chamberContainer");
                const addChamberBtn = document.getElementById("addChamberBtn");
                const removeChamberBtn = document.getElementById("removeChamberBtn");
                const MAX_CHAMBERS = 6;

                function updateChamberNumbers() {
                    const chambers = chamberContainer.getElementsByClassName("chamber-group");
                    for (let i = 0; i < chambers.length; i++) {
                        chambers[i].querySelector("h6").textContent = `চেম্বার ${i}`;
                    }
                }

                addChamberBtn.addEventListener("click", function () {
                    const chamberCount = chamberContainer.getElementsByClassName("chamber-group").length;
                    if (chamberCount >= MAX_CHAMBERS) {
                        alert("আপনি সর্বোচ্চ ৫টি চেম্বার যোগ করতে পারবেন!");
                        return;
                    }

                    const newChamberGroup = document.createElement("div");
                    newChamberGroup.classList.add("chamber-group", "mb-3");
                    newChamberGroup.innerHTML = `
                        <h6>চেম্বার ${chamberCount}</h6>
                        <div class="form-group">
                            <label>চেম্বারের নাম :*</label>
                            <input type="text" class="form-control" id="chamberName" name="chamberName[]" placeholder="চেম্বারের নাম লিখুন">
                        </div>
                        <div class="form-group">
                            <label>চেম্বারের ঠিকানা :*</label>
                            <input type="text" class="form-control" id="chamberAddress" name="chamberAddress[]" placeholder="চেম্বারের ঠিকানা লিখুন">
                        </div>
                        <div class="form-group">
                            <label>চেম্বারের যোগাযোগ নম্বর :*</label>
                            <input type="text" class="form-control" id="chamberContact" name="chamberContact[]" placeholder="ফোন নম্বর লিখুন">
                        </div>
                        <div class="form-group">
                            <label>কোন কোন দিন খোলা থাকে :*</label>
                            <input type="text" class="form-control" id="chamberDate" name="chamberDate[]" placeholder="দিন লিখুন">
                        </div>
                        <div class="form-group">
                            <label>কয়টা থেকে কয়টা পর্যন্ত খোলা থাকে :*</label>
                            <input type="text" class="form-control" id="chamberTime" name="chamberTime[]" placeholder="সময় লিখুন">
                        </div>
                        <button type="button" class="btn btn-danger remove-single-chamber">Remove</button>
                    `;

                    chamberContainer.appendChild(newChamberGroup);
                    updateChamberNumbers();

                    if (chamberContainer.getElementsByClassName("chamber-group").length >= MAX_CHAMBERS) {
                        addChamberBtn.disabled = true;
                    }
                });

                chamberContainer.addEventListener("click", function (event) {
                    if (event.target.classList.contains("remove-single-chamber")) {
                        event.target.closest(".chamber-group").remove();
                        updateChamberNumbers();

                        if (chamberContainer.getElementsByClassName("chamber-group").length < MAX_CHAMBERS) {
                            addChamberBtn.disabled = false;
                        }
                    }
                });

                removeChamberBtn.addEventListener("click", function () {
                    const chambers = chamberContainer.getElementsByClassName("chamber-group");
                    if (chambers.length > 1) {
                        chamberContainer.removeChild(chambers[chambers.length - 1]);
                        updateChamberNumbers();

                        if (chamberContainer.getElementsByClassName("chamber-group").length < MAX_CHAMBERS) {
                            addChamberBtn.disabled = false;
                        }
                    }
                });
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

            //viewHospitaModal
            $('#viewHospitalModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                // Fetch data from the button
                var id = button.data('id');
                var user = button.data('user');
                var hp_name = button.data('hp_name');
                var contact = button.data('contact');
                var upazila = button.data('upazila');
                var address = button.data('address');
                var status = button.data('status');
                var entry = button.data('entry');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#xUser').text(user);
                modal.find('#xHp_name').text(hp_name);
                modal.find('#xContact').text(contact);
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

            //editHospitaModal
            $('#editHospitalModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var hp_name = button.data('hp_name');
                var contact = button.data('contact');
                var upazila = button.data('upazila');
                var address = button.data('address');
                var status = button.data('status');
                var entry = button.data('entry');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#hp_name').val(hp_name);
                modal.find('#contact').val(contact);
                modal.find('#upazila').val(upazila);
                modal.find('#address').val(address);
                modal.find('#status').val(status);

                var imagePreview = modal.find('#imagePreviewX');
                if (image) {
                    imagePreview.html('<img src="' + image + '" class="img-fluid" />');
                } else {
                    imagePreview.html('<i class="bi bi-person-circle" style="font-size: 60px; color: #ccc;"></i>');
                }

                modal.find('#modalFormX').attr('action', '/admin/hospitals/' + id);


            });

            //deleteHospital
            function deleteHospital(id) {
                if (confirm('Are you sure you want to delete this hospital?')) {
                    $.ajax({
                        url: '{{ route('admin.hospitals.destroy') }}',
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
                            alert('Failed to delete Hospital. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }

        </script>
    </x-slot>
</x-dashboard-app-layout>
