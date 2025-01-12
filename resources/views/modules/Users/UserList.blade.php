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
                                            <tr>
                                                <td>1</td>
                                                <td class="text-center align-middle">
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            class="custom-control-input" id="checkbox-1">
                                                        <label for="checkbox-1"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <img class="rounded-circle" alt="image"
                                                        src="{{ asset('assets/dashboard/img/users/user-3.png') }}"
                                                        width="35">
                                                </td>
                                                <td>User Name</td>
                                                <td>01830996044</td>
                                                <td>Student</td>
                                                <td>Male</td>
                                                <td>Panchagarh</td>
                                                <td>2018-01-20</td>
                                                <td>
                                                    <div class="badge badge-success badge-shadow">Active </div>
                                                </td>
                                                <td><a href="#" class="btn btn-success" data-toggle="modal"
                                                        data-target="#viewUserModal">View</a><a href="#"
                                                        class="btn mx-1 btn-primary" data-toggle="modal"
                                                        data-target="#editUserModal">Edit</a><a href="#"
                                                        class="btn btn-danger">Delete</a></td>
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
                    <form id="modalForm">
                        <div class="form-group">
                            <label for="itemName">নাম :*</label>
                            <input type="text" class="form-control" id="itemName" placeholder="নাম লিখুন">
                        </div>


                        <div class="form-group">
                            <label for="itemName">পেশা :*</label>
                            <input type="text" class="form-control" id="itemName"
                                placeholder="আপনার পেশা লিখুন">
                        </div>
                        <div class="form-group">
                            <label for="itemDescription"> ফোন :* </label>
                            <input type="text" class="form-control" id="itemName" placeholder="ফোন নম্বর লিখুন">
                        </div>
                        <div class="form-group">
                            <label for="itemName">ইমেইল : (যদি থাকে)</label>
                            <input type="text" class="form-control" id="itemName" placeholder="ইমেইল লিখুন">
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

                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation"
                                id="password_confirmation" placeholder="Confirm Password">
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


</x-dashboard-app-layout>
