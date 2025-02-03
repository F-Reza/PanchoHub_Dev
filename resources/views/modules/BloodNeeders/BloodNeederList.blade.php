<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব - রক্তগ্রহীতা সমূহ |</title>
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
                                <h4>রক্তগ্রহীতা সমূহ</h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createNeederModal">Create</a>
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
                                                <th class="align-left">Name</th>
                                                <th class="align-left">Group</th>
                                                <th class="align-left">Amounts</th>
                                                <th class="align-left">Dateline</th>
                                                <th class="align-left">Gender</th>
                                                <th class="align-left">Contact</th>
                                                <th class="align-left">Upazila</th>
                                                <th class="align-left">Added By</th>
                                                <th class="align-left">Entry Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($needers->isNotEmpty())
                                                @foreach ($needers as $key => $needer)
                                                    <tr>
                                                        <td> {{ ++$key }} </td>
                                                        <td class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    class="custom-control-input"
                                                                    id="checkbox-{{ $needer->id }}">
                                                                <label for="checkbox-{{ $needer->id }}"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td class="align-left" style=" max-width: 120px;"> {{ $needer->name }} </td>
                                                        <td class="align-left"> {{ $needer->blood_gorup }} </td>
                                                        <td class="align-left"> {{ $needer->bag_amounts }} </td>
                                                        <td class="align-left"> {{ $needer->dateline }} </td>
                                                        <td class="align-left"> {{ $needer->gender }} </td>
                                                        <td class="align-left"> {{ $needer->contact }} </td>
                                                        <td class="align-left"> {{ $needer->upazila }} </td>
                                                        <td class="align-left"> {{ $needer->user->name ?? 'N/A' }}</td>
                                                        <td class="align-left">
                                                            {{ \Carbon\Carbon::parse($needer->created_at)->format('d M, Y') }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $statusClass = match ($needer->status) {
                                                                    'Approved' => 'badge badge-secondary badge-shadow',
                                                                    'In Review' => 'badge badge-info badge-shadow',
                                                                    'Pending' => 'badge badge-warning badge-shadow',
                                                                    'Denied' => 'badge badge-danger badge-shadow',
                                                                    default => 'badge badge-success badge-shadow',
                                                                };
                                                            @endphp
                                                            <div class="{{ $statusClass }}">
                                                                {{ $needer->status }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <a href="#" class="btn btn-success"
                                                                data-toggle="modal" data-target="#viewNeederModal"
                                                                data-id="{{ $needer->id }}"
                                                                data-user="{{ $needer->user->name }}"
                                                                data-name="{{ $needer->name }}"
                                                                data-blood_gorup="{{ $needer->blood_gorup }}"
                                                                data-bag_amounts="{{ $needer->bag_amounts }}"
                                                                data-dateline="{{ $needer->dateline }}"
                                                                data-contact="{{ $needer->contact }}"
                                                                data-gender="{{ $needer->gender }}"
                                                                data-upazila="{{ $needer->upazila }}"
                                                                data-hp_address="{{ $needer->hp_address}}"
                                                                data-details="{{ $needer->details ?? 'Empty'}}"
                                                                data-gift="{{ $needer->gift ?? 'Empty'}}"
                                                                data-status="{{ $needer->status }}"
                                                                data-entry="{{ \Carbon\Carbon::parse($needer->created_at)->format('d/m/Y') }}">
                                                                View
                                                            </a>

                                                            <a href="#" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#editNeederModal"
                                                                data-id="{{ $needer->id }}"
                                                                data-user="{{ $needer->user->name }}"
                                                                data-name="{{ $needer->name }}"
                                                                data-blood_gorup="{{ $needer->blood_gorup }}"
                                                                data-bag_amounts="{{ $needer->bag_amounts }}"
                                                                data-dateline="{{ $needer->dateline }}"
                                                                data-contact="{{ $needer->contact }}"
                                                                data-gender="{{ $needer->gender }}"
                                                                data-upazila="{{ $needer->upazila }}"
                                                                data-hp_address="{{ $needer->hp_address}}"
                                                                data-details="{{ $needer->details ?? ''}}"
                                                                data-gift="{{ $needer->gift ?? ''}}"
                                                                data-status="{{ $needer->status }}">
                                                                Edit
                                                            </a>

                                                            <a href="javascript:void(0);"
                                                                onclick="deleteNeeder({{ $needer->id }})"
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
    <!-- Create Blood Needer Modal -->
    <div class="modal modalz fade" id="createNeederModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">নতুন রক্তগ্রহীতা যোগ করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Content Goes Here -->
                <form method="POST" action="{{ route('admin.needers.store') }}" id="modalForm" enctype="multipart/form-data">
                @csrf

                    <!-- Name Field -->
                    <div class="form-group">
                        <label for="name"> নাম :* </label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="নাম লিখুন" required>
                    </div>

                    <!-- Blood Group Field -->
                    <div class="form-group">
                        <label for="blood_gorup">রক্তের গ্রুপ :*</label>
                        <select class="form-control" id="blood_gorup" name="blood_gorup" required>
                          <option value="">রক্তের গ্রুপ সিলেক্ট করুন</option>
                          <option value="A+">A+</option>
                          <option value="A-">A-</option>
                          <option value="B+">B+</option>
                          <option value="B-">B-</option>
                          <option value="AB+">AB+</option>
                          <option value="AB-">AB-</option>
                          <option value="O+">O+</option>
                          <option value="O-">O-</option>
                        </select>
                    </div>

                    <!-- Bag of Amounts Field -->
                    <div class="form-group">
                        <label for="bag_amounts"> কত ব্যাগ রক্তের প্রয়োজন :* </label>
                        <input type="text" name="bag_amounts" class="form-control" id="bag_amounts" placeholder="রক্তের পরিমাণ লিখুন" required>
                    </div>

                    <!-- Dateline Field -->
                    <div class="form-group">
                        <label>তারিখ এবং সময় :*</label>
                        <input type="datetime-local" class="form-control" id="dateline" name="dateline" required>
                    </div>

                    <!-- Contact Field -->
                    <div class="form-group">
                        <label for="contact">যোগাযোগ নম্বর :*</label>
                        <input type="text" name="contact" class="form-control" id="contact" placeholder="ফোন নম্বর লিখুন" required>
                    </div>

                    <!-- Gender Field -->
                    <div class="form-group">
                        <label for="gender"> লিঙ্গ :* </label>
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
                        <label for="hp_address">হাসপাতালের ঠিকানা :*</label>
                        <textarea class="form-control" id="hp_address" name="hp_address" rows="3" placeholder="ঠিকানা লিখুন" required> </textarea>
                    </div>

                    <!-- Details Field -->
                    <div class="form-group">
                        <label for="details">বিস্তারিত লিখুন :</label>
                        <textarea class="form-control" id="details" name="details" rows="3" placeholder="বিস্তারিত লিখুন"></textarea>
                    </div>

                    <!-- Gift Field -->
                    <div class="form-group">
                        <label for="gift">উপহার (যদি দিতে চান - বাধ্যতামূলক নয়) :</label>
                        <input type="text" class="form-control" id="gift" name="gift" rows="3" placeholder="উপহার লিখুন">
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

    <!-- Edit Blood Needer Modal -->
    <div class="modal modalz fade" id="editNeederModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

            <!-- Modal Content Goes Here -->
            <form method="POST" action="" id="modalFormX" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">রক্তগ্রহীতার ডাটা পরিবর্তন </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <!-- Name Field -->
                    <div class="form-group">
                        <label for="name"> নাম :* </label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old(key: 'name') }}" placeholder="নাম লিখুন" required>
                    </div>

                    <!-- CBlood Group Field -->
                    <div class="form-group">
                        <label for="blood_gorup">রক্তের গ্রুপ :*</label>
                        <select class="form-control" id="blood_gorup" name="blood_gorup" required>
                          <option value="A+" {{ old('blood_gorup') == 'A+' ? 'selected' : '' }}> A+</option>
                          <option value="A-" {{ old('blood_gorup') == 'A-' ? 'selected' : '' }}> A-</option>
                          <option value="B+" {{ old('blood_gorup') == 'B+' ? 'selected' : '' }}> B+</option>
                          <option value="B-" {{ old('blood_gorup') == 'B-' ? 'selected' : '' }}> B-</option>
                          <option value="AB+" {{ old('blood_gorup') == 'AB+' ? 'selected' : '' }}> AB+</option>
                          <option value="AB-" {{ old('blood_gorup') == 'AB-' ? 'selected' : '' }}> AB-</option>
                          <option value="O+" {{ old('blood_gorup') == 'O+' ? 'selected' : '' }}> O+</option>
                          <option value="O-" {{ old('blood_gorup') == 'O-' ? 'selected' : '' }}> O-</option>
                        </select>
                    </div>

                    <!-- Bag of Amounts Field -->
                    <div class="form-group">
                        <label for="bag_amounts"> কত ব্যাগ রক্তের প্রয়োজন :* </label>
                        <input type="text" name="bag_amounts" class="form-control" id="bag_amounts" value="{{ old(key: 'bag_amounts') }}" placeholder="রক্তের পরিমাণ লিখুন" required>
                    </div>

                    <!-- Dateline Field -->
                    <div class="form-group">
                        <label>তারিখ এবং সময় :*</label>
                        <input type="datetime-local" class="form-control" id="dateline" value="{{ old(key: 'dateline') }}" name="dateline" required>
                    </div>

                    <!-- Contact Field -->
                    <div class="form-group">
                        <label for="contact">যোগাযোগ নম্বর :*</label>
                        <input type="text" name="contact" class="form-control" id="contact" value="{{ old(key: 'contact') }}" placeholder="ফোন নম্বর লিখুন">
                    </div>

                    <!-- Gender Field -->
                    <div class="form-group">
                        <label for="gender"> লিঙ্গ :* </label>
                        <br>
                        <div class="form-check form-check-inline">
                          <input class="" type="radio" name="gender" id="male" value="পুরুষ">
                          <label class="form-check-label" for="male">
                            পুরুষ
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="" type="radio" name="gender" value="মহিলা" id="female">
                          <label class="form-check-label" for="female">
                            মহিলা
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="" type="radio" name="gender" value="অন্যান্য" id="others">
                          <label class="form-check-label" for="others">
                            অন্যান্য
                          </label>
                        </div>
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
                        <label for="hp_address">হাসপাতালের ঠিকানা :*</label>
                        <textarea class="form-control" id="hp_address" name="hp_address" value="{{ old(key: 'hp_address') }}" rows="3" placeholder="ঠিকানা লিখুন"></textarea>
                    </div>

                    <!-- Comment Field -->
                    <div class="form-group">
                        <label for="details">বিস্তারিত লিখুন :</label>
                        <textarea class="form-control" id="details" name="details" value="{{ old(key: 'details') }}" rows="3" placeholder="বিস্তারিত লিখুন"></textarea>
                    </div>

                    <!-- Gift Field -->
                    <div class="form-group">
                        <label for="gift">উপহার (যদি দিতে চান - বাধ্যতামূলক নয়) :</label>
                        <input type="text" class="form-control" id="gift" name="gift" value="{{ old(key: 'gift') }}" rows="3" placeholder="উপহার লিখুন">
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

    <!-- View Blood Needer Modal -->
    <div class="modal modalz fade" id="viewNeederModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">রক্তগ্রহীতা ভিউ ডাটা</h5>
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
                                        <div class="p-2 align-self-center fixed-width" style="width: 100px; flex-shrink: 0;">
                                            <img id="modalImage" src="{{ asset('assets/dashboard/img/users/avatar.png') }}" style="width: 100px; height: 100px;" title="Logo" alt="logo">
                                        </div>
                                        <div class="p-2 flex-grow-1 bd-highlight">
                                            <h4 class="dark-color"> <span id="xName"></span> </h4>
                                            <div><samp class="sampcolor">লিঙ্গ: </samp> <span id="xGender"></span></div>
                                            <div><samp class="sampcolor">রক্তের গ্রুপ: </samp> <span id="xBloodGorup"></span></div>
                                            <div><samp class="sampcolor">রক্তের পরিমাণ: </samp> <span id="xBagAmounts"></span></div>
                                            <div><samp class="sampcolor">তারিখ এবং সময়: </samp> <span id="xDateline"></span></div>
                                            <div><samp class="sampcolor">ফোন: </samp> <span id="xContact"></span></div>
                                            <div><samp class="sampcolor">হাসপাতালের ঠিকানা: </samp> <span id="xHpAddress"></span></div>
                                            <div><samp class="sampcolor">বিস্তারিত: </samp> <span id="xDetails"></span></div>
                                            <div><samp class="sampcolor">উপহার: </samp> <span id="xGift"></span></div>
                                            <div><samp class="sampcolor">উপজেলা: </samp> <span id="xUpazila"></span></div>
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
            //viewNeederModal
            $('#viewNeederModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                // Fetch data from the button
                var id = button.data('id');
                var user = button.data('user');
                var name = button.data('name');
                var blood_gorup = button.data('blood_gorup');
                var bag_amounts = button.data('bag_amounts');
                var dateline = button.data('dateline');
                var contact = button.data('contact');
                var gender = button.data('gender');
                var upazila = button.data('upazila');
                var hp_address = button.data('hp_address');
                var details = button.data('details');
                var gift = button.data('gift');
                var status = button.data('status');
                var entry = button.data('entry');

                var modal = $(this);
                modal.find('#xUser').text(user);
                modal.find('#xName').text(name);
                modal.find('#xBloodGorup').text(blood_gorup);
                modal.find('#xBagAmounts').text(bag_amounts);
                modal.find('#xDateline').text(dateline);
                modal.find('#xContact').text(contact);
                modal.find('#xGender').text(gender);
                modal.find('#xUpazila').text(upazila);
                modal.find('#xHpAddress').text(hp_address);
                modal.find('#xDetails').text(details);
                modal.find('#xGift').text(gift);
                modal.find('#xStatus').text(status);
                modal.find('#xEntry').text(entry);
            });

            // Edit Needer Modal
            $('#editNeederModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);

                // Fetch data from the button
                var id = button.data('id');
                var name = button.data('name');
                var blood_group = button.data('blood_gorup');
                var bag_amounts = button.data('bag_amounts');
                var dateline = button.data('dateline');
                var contact = button.data('contact');
                var gender = button.data('gender');
                var upazila = button.data('upazila');
                var hp_address = button.data('hp_address');
                var details = button.data('details') || '';
                var gift = button.data('gift') || '';
                var status = button.data('status');

                var modal = $(this);

                // Populate form fields
                modal.find('#name').val(name);
                modal.find('#blood_gorup').val(blood_group);
                modal.find('#bag_amounts').val(bag_amounts);
                modal.find('#dateline').val(dateline);
                modal.find('#contact').val(contact);
                modal.find('#upazila').val(upazila);
                modal.find('#hp_address').val(hp_address);
                modal.find('#details').val(details);
                modal.find('#gift').val(gift);
                modal.find('#status').val(status);

                // Handle gender selection
                modal.find('input[name="gender"]').prop('checked', false);
                if (gender) {
                    modal.find('input[name="gender"]').each(function() {
                        if ($(this).val() === gender) {
                            $(this).prop('checked', true);
                        }
                    });
                }

                // Set form action URL dynamically
                modal.find('#modalFormX').attr('action', '/admin/needers/' + id);
            });

            //deleteNeeder
            function deleteNeeder(id) {
                if (confirm('Are you sure you want to delete this needer?')) {
                    $.ajax({
                        url: '{{ route('admin.needers.destroy') }}',
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
                            alert('Failed to delete Blood Needer. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }

        </script>
    </x-slot>


</x-dashboard-app-layout>
