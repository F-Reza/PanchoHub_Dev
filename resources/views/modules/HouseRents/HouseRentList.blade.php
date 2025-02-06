<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব - বাড়িভাড়া |</title>
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
                                <h4> বাড়িভাড়া সমূহ </h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createHouseRentModal">Create</a>
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
                                                <th>Image</th>
                                                <th class="align-left">Category</th>
                                                <th class="align-left">Available</th>
                                                <th class="align-left">	Contact</th>
                                                <th class="align-left">Upazila</th>
                                                <th class="align-left">	Added By</th>
                                                <th class="align-left">Created At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($houseRents->isNotEmpty())
                                                @foreach ($houseRents as $key => $houseRent)
                                                    <tr>
                                                        <td> {{ ++$key }} </td>
                                                        <td class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    class="custom-control-input"
                                                                    id="checkbox-{{ $houseRent->id }}">
                                                                <label for="checkbox-{{ $houseRent->id }}"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if (!empty($houseRent->image))
                                                                <img class="article-image" alt="image" title="Image"
                                                                    src="{{ asset('uploads/houseRents/' . $houseRent->image) }}"
                                                                    width="70" height="40">
                                                            @else
                                                                <img class="article-image" alt="image" title="Image"
                                                                    src="{{ asset('assets/dashboard/img/users/avatar.png') }}"
                                                                    width="70" height="40">
                                                            @endif
                                                        </td>
                                                        <td class="align-left"> {{ $houseRent->category }} </td>
                                                        <td class="align-left" style=" max-width: 250px;"> {{ $houseRent->rent_available }} </td>
                                                        <td class="align-left"> {{ $houseRent->contact }} </td>
                                                        <td class="align-left"> {{ $houseRent->upazila }} </td>
                                                        <td class="align-left"> {{ $houseRent->user->name ?? 'N/A' }}</td>
                                                        <td class="align-left">
                                                            {{ \Carbon\Carbon::parse($houseRent->created_at)->format('d M, Y') }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $statusClass = match ($houseRent->status) {
                                                                    'Approved' => 'badge badge-secondary badge-shadow',
                                                                    'In Review' => 'badge badge-info badge-shadow',
                                                                    'Pending' => 'badge badge-warning badge-shadow',
                                                                    'Denied' => 'badge badge-danger badge-shadow',
                                                                    default => 'badge badge-success badge-shadow',
                                                                };
                                                            @endphp
                                                            <div class="{{ $statusClass }}">
                                                                {{ $houseRent->status }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <a href="#" class="btn btn-success"
                                                                data-toggle="modal" data-target="#viewHouseRentModal"
                                                                data-id="{{ $houseRent->id }}"
                                                                data-user="{{ $houseRent->user->name }}"
                                                                data-category="{{ $houseRent->category }}"
                                                                data-area="{{ $houseRent->area }}"
                                                                data-number_of_rooms="{{ $houseRent->number_of_rooms }}"
                                                                data-number_of_bath="{{ $houseRent->number_of_bath }}"
                                                                data-rent_amount="{{ $houseRent->rent_amount }}"
                                                                data-facilities="{{ $houseRent->facilities }}"
                                                                data-rent_available="{{ $houseRent->rent_available }}"
                                                                data-contact="{{ $houseRent->contact }}"
                                                                data-upazila="{{ $houseRent->upazila }}"
                                                                data-address="{{ $houseRent->address}}"
                                                                data-others_info="{{ $houseRent->others_info?? 'Empty' }}"
                                                                data-status="{{ $houseRent->status }}"
                                                                data-image="{{ $houseRent->image ? asset('uploads/houseRents/' . $houseRent->image) : '' }}"
                                                                data-entry="{{ \Carbon\Carbon::parse($houseRent->created_at)->format('d/m/Y') }}">
                                                                View
                                                            </a>

                                                            <a href="#" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#editHouseRentModal"
                                                                data-id="{{ $houseRent->id }}"
                                                                data-category="{{ $houseRent->category }}"
                                                                data-area="{{ $houseRent->area }}"
                                                                data-number_of_rooms="{{ $houseRent->number_of_rooms }}"
                                                                data-number_of_bath="{{ $houseRent->number_of_bath }}"
                                                                data-rent_amount="{{ $houseRent->rent_amount }}"
                                                                data-facilities="{{ $houseRent->facilities }}"
                                                                data-rent_available="{{ $houseRent->rent_available }}"
                                                                data-contact="{{ $houseRent->contact }}"
                                                                data-upazila="{{ $houseRent->upazila }}"
                                                                data-address="{{ $houseRent->address}}"
                                                                data-others_info="{{ $houseRent->others_info?? '' }}"
                                                                data-status="{{ $houseRent->status }}"
                                                                data-image="{{ $houseRent->image ? asset('uploads/houseRents/' . $houseRent->image) : '' }}">
                                                                Edit
                                                            </a>

                                                            <a href="javascript:void(0);"
                                                                onclick="deleteHouseRent({{ $houseRent->id }})"
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
    <!-- Create HouseRent Modal -->
    <div class="modal modalz fade" id="createHouseRentModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"> বাড়িভাড়া যোগ করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Content Goes Here -->
                <form method="POST" action="{{ route('admin.house_rent.store') }}" id="modalForm" enctype="multipart/form-data">
                @csrf

                    <!-- Category Field -->
                    <div class="form-group">
                        <label for="category"> বাসার ধরণ :* </label>
                        <select class="form-control" id="category" name="category" required>
                            <option value=""> নির্বাচন করুন </option>
                            <option value="ফ্লাট বাসা">ফ্লাট বাসা</option>
                            <option value="এপার্টমেন্ট">এপার্টমেন্ট </option>
                            <option value="অফিস ">অফিস </option>
                            <option value="সাবলেট">সাবলেট </option>
                            <option value="হোস্টেল">হোস্টেল </option>
                            <option value="মেস">মেস </option>
                            <option value="গ্যারেজ">গ্যারেজ</option>
                        </select>
                    </div>

                    <!-- RentAvailable Field -->
                    <div class="form-group">
                        <label for="rent_available">কোন মাস থেকে ভাড়া হবে :*</label>
                        <input type="text" class="form-control" id="rent_available" name="rent_available" value="{{ old(key: 'rent_available') }}" placeholder="মাস লিখুন" required>
                    </div>


                    <!-- Area Field -->
                    <div class="form-group">
                        <label for="area"> আয়তন :* </label>
                        <input type="text" name="area" class="form-control" id="area" value="{{ old('area') }}" placeholder="আয়তন লিখুন" required>
                    </div>

                    <!-- NumberOfRooms Field -->
                    <div class="form-group">
                        <label for="number_of_rooms"> রুম সংখ্যা :* </label>
                        <input type="text" name="number_of_rooms" class="form-control" id="number_of_rooms" value="{{ old('number_of_rooms') }}" placeholder="রুম সংখ্যা লিখুন" required>
                    </div>

                    <!-- NumberOfBath Field -->
                    <div class="form-group">
                        <label for="number_of_bath"> বাথরুম সংখ্যা :* </label>
                        <input type="text" class="form-control" name="number_of_bath" id="number_of_bath" value="{{ old('number_of_bath') }}" placeholder="বাথরুম সংখ্যা লিখুন" required>
                    </div>


                    <!-- RentAmount Field -->
                    <div class="form-group">
                        <label for="rent_amount">ভাড়ার পরিমান :*</label>
                        <input type="text" class="form-control" id="rent_amount" name="rent_amount" value="{{ old(key: 'rent_amount') }}" placeholder="ভাড়ার পরিমান লিখুন" required>
                    </div>

                    <!-- Facilities Field -->
                    <div class="form-group">
                        <label for="facilities">সুযোগ-সুবিধা :*</label>
                        <textarea class="" id="editor" name="facilities" value="{{ old('facilities') }}" placeholder="বিস্তারিত লিখুন"></textarea>
                    </div>

                    <!-- Contact Field -->
                    <div class="form-group">
                        <label for="contact"> যোগাযোগ নম্বর :* </label>
                        <input type="text" name="contact" class="form-control" id="contact" value="{{ old(key: 'contact') }}" placeholder="ফোন নম্বর লিখুন" required>
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
                        <label for="address"> বিস্তারিত ঠিকানা :* </label>
                        <textarea class="form-control" id="address" name="address" value="{{ old('address') }}" rows="3" placeholder="ঠিকানা লিখুন" required></textarea>
                    </div>

                    <!-- OthersInfo Field -->
                    <div class="form-group ">
                        <label for="others_info">অন্যান তথ্য : (যদি থাকে)</label>
                        <textarea class="form-control" id="others_info" name="others_info" rows="3" value="{{ old(key: 'others_info') }}" placeholder="অন্যান তথ্য লিখুন"></textarea>
                    </div>

                    <!-- Picture Input with Preview -->
                    <div class="form-group">
                        <label class="row justify-content-center" for="image-upload" id="image-label"> ছবি যুক্ত করুন </label>
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

    <!-- Edit HouseRent Modal -->
    <div class="modal modalz fade" id="editHouseRentModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">

            <!-- Modal Content Goes Here -->
            <form method="POST" action="" id="modalFormX" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">বাড়িভাড়া ডাটা পরিবর্তন </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <!-- Category Field -->
                    <div class="form-group">
                        <label for="category"> বাসার ধরণ :* </label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="ফ্লাট বাসা" {{ old('category') == 'ফ্লাট বাসা' ? 'selected' : '' }}>ফ্লাট বাসা</option>
                            <option value="এপার্টমেন্ট" {{ old('category') == 'এপার্টমেন্ট' ? 'selected' : '' }}>এপার্টমেন্ট </option>
                            <option value="অফিস " {{ old('category') == 'অফিস ' ? 'selected' : '' }}>অফিস </option>
                            <option value="সাবলেট" {{ old('category') == 'সাবলেট' ? 'selected' : '' }}>সাবলেট </option>
                            <option value="হোস্টেল" {{ old('category') == 'হোস্টেল' ? 'selected' : '' }}>হোস্টেল </option>
                            <option value="মেস" {{ old('category') == 'মেস' ? 'selected' : '' }}>মেস </option>
                            <option value="গ্যারেজ" {{ old('category') == 'গ্যারেজ' ? 'selected' : '' }}>গ্যারেজ</option>
                        </select>
                    </div>

                    <!-- RentAvailable Field -->
                    <div class="form-group">
                        <label for="rent_available">কোন মাস থেকে ভাড়া হবে :*</label>
                        <input type="text" class="form-control" id="rent_available" name="rent_available" value="{{ old(key: 'rent_available') }}" placeholder="মাস লিখুন" required>
                    </div>


                    <!-- Area Field -->
                    <div class="form-group">
                        <label for="area"> আয়তন :* </label>
                        <input type="text" name="area" class="form-control" id="area" value="{{ old('area') }}" placeholder="আয়তন লিখুন" required>
                    </div>

                    <!-- NumberOfRooms Field -->
                    <div class="form-group">
                        <label for="number_of_rooms"> রুম সংখ্যা :* </label>
                        <input type="text" name="number_of_rooms" class="form-control" id="number_of_rooms" value="{{ old('number_of_rooms') }}" placeholder="রুম সংখ্যা লিখুন" required>
                    </div>

                    <!-- NumberOfBath Field -->
                    <div class="form-group">
                        <label for="number_of_bath"> বাথরুম সংখ্যা :* </label>
                        <input type="text" class="form-control" name="number_of_bath" id="number_of_bath" value="{{ old('number_of_bath') }}" placeholder="বাথরুম সংখ্যা লিখুন" required>
                    </div>


                    <!-- RentAmount Field -->
                    <div class="form-group">
                        <label for="rent_amount">ভাড়ার পরিমান :*</label>
                        <input type="text" class="form-control" id="rent_amount" name="rent_amount" value="{{ old(key: 'rent_amount') }}" placeholder="ভাড়ার পরিমান লিখুন" required>
                    </div>

                    <!-- Facilities Field -->
                    <div class="form-group">
                        <label for="facilities">সুযোগ-সুবিধা :*</label>
                        <textarea class="" id="editorX" name="facilities" value="{{ old('facilities') }}" placeholder="বিস্তারিত লিখুন"></textarea>
                    </div>

                    <!-- Contact Field -->
                    <div class="form-group">
                        <label for="contact"> যোগাযোগ নম্বর :* </label>
                        <input type="text" name="contact" class="form-control" id="contact" value="{{ old(key: 'contact') }}" placeholder="ফোন নম্বর লিখুন" required>
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
                        <label for="address"> বিস্তারিত ঠিকানা :* </label>
                        <textarea class="form-control" id="address" name="address" value="{{ old('address') }}" rows="3" placeholder="ঠিকানা লিখুন" required></textarea>
                    </div>

                    <!-- OthersInfo Field -->
                    <div class="form-group ">
                        <label for="others_info">অন্যান তথ্য : (যদি থাকে)</label>
                        <textarea class="form-control" id="others_info" name="others_info" rows="3" value="{{ old(key: 'others_info') }}" placeholder="অন্যান তথ্য লিখুন"></textarea>
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

                    <!-- Status Field -->
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

    <!-- View HouseRent Modal -->
    <div class="modal modalz fade" id="viewHouseRentModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">বাড়িভাড়া ভিউ ডাটা</h5>
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
                                                <div class="flex-fill bd-highlight mr-3">
                                                    <img id="modalImage" src="" style="width: 300px; height: 160px;" title="houseRent Logo" alt="logo">
                                                </div>
                                                <div class="flex-fill bd-highlight align-self-center">
                                                    <div><samp class="sampcolor">স্ট্যাটাস: </samp> <span id="xStatus"></span></div>
                                                    <div><hr/></div>
                                                    <div><samp class="sampcolor">যোগাযোগ নম্বর: </samp> <span id="xContact"></span></div>
                                                    <div><samp class="sampcolor">উপজেলা: </samp> <span id="xUpazila"></span></div>
                                                    <div><samp class="sampcolor">নিবন্ধন তারিখ: </samp> <span id="xEntry"></span></div>
                                                    <div><samp class="sampcolor">যোগ করেছেন: </samp> <span id="xUser"></span></div>
                                                </div>
                                            </div>

                                            <h6 class="dark-color mt-3 mb-2"> ভাড়ার পরিমান: <span id="xRentAmount"></span> </h6>
                                            <div><samp class="sampcolor">বিস্তারিত ঠিকানা: </samp> <span id="xAddress"></span></div>
                                            <div><samp class="sampcolor">বাসার ধরণ: </samp> <span id="xCategory"> </span></div>
                                            <div><samp class="sampcolor">কোন মাস থেকে ভাড়া হবে: </samp> <span id="xRentAvailable"> </span></div>
                                            <div><samp class="sampcolor">আয়তন: </samp> <span id="xArea"> </span></div>
                                            <div><samp class="sampcolor">রুম সংখ্যা: </samp> <span id="xNoOfRooms"> </span></div>
                                            <div><samp class="sampcolor">বাথরুম সংখ্যা: </samp> <span id="xNoOfBath"> </span></div>
                                            <div><hr/></div>
                                            <div><samp class="sampcolor">সুযোগ-সুবিধা: </samp> <br/><span id="xFacilities"> </span></div>
                                            <div><hr/></div>
                                            <div><samp class="sampcolor">অন্যান তথ্য: </samp> <br/><span id="xOthersInfo"></span></div>
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
            $('#editHouseRentModal').on('hidden.bs.modal', function() {
                if (editorInstance) {
                    editorInstance.destroy();
                    editorInstance = null;
                }
            });


            // Event listener for when the edit modal is hidden
            $('#editTodayNewsModal').on('hidden.bs.modal', function() {
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


            //viewHouseRentModal
            $('#viewHouseRentModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                // Fetch data from the button
                var id = button.data('id');
                var user = button.data('user');
                var category = button.data('category');
                var area = button.data('area');
                var number_of_rooms = button.data('number_of_rooms');
                var number_of_bath = button.data('number_of_bath');
                var rent_amount = button.data('rent_amount');
                var facilities = button.data('facilities');
                var rent_available = button.data('rent_available');
                var contact = button.data('contact');
                var upazila = button.data('upazila');
                var address = button.data('address');
                var others_info = button.data('others_info') || '';
                var status = button.data('status');
                var entry = button.data('entry');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#xUser').text(user);
                modal.find('#xCategory').text(category);
                modal.find('#xArea').text(area);
                modal.find('#xNoOfRooms').text(number_of_rooms);
                modal.find('#xNoOfBath').text(number_of_bath);
                modal.find('#xRentAmount').text(rent_amount);
                modal.find('#xFacilities').html(facilities);
                modal.find('#xRentAvailable').text(rent_available);
                modal.find('#xContact').text(contact);
                modal.find('#xUpazila').text(upazila);
                modal.find('#xAddress').text(address);
                modal.find('#xOthersInfo').text(others_info);
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

            //editHouseRentModal
            $('#editHouseRentModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var category = button.data('category');
                var area = button.data('area');
                var number_of_rooms = button.data('number_of_rooms');
                var number_of_bath = button.data('number_of_bath');
                var rent_amount = button.data('rent_amount');
                var facilities = button.data('facilities');
                var rent_available = button.data('rent_available');
                var contact = button.data('contact');
                var upazila = button.data('upazila');
                var address = button.data('address');
                var others_info = button.data('others_info');
                var status = button.data('status');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#category').val(category);
                modal.find('#area').val(area);
                modal.find('#number_of_rooms').val(number_of_rooms);
                modal.find('#number_of_bath').val(number_of_bath);
                modal.find('#rent_amount').val(rent_amount);
                modal.find('#rent_available').val(rent_available);
                modal.find('#contact').val(contact);
                modal.find('#upazila').val(upazila);
                modal.find('#address').val(address);
                modal.find('#others_info').val(others_info);
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
                    imagePreview.html('<i class="bi bi-image" style="font-size: 60px; color: #ccc;"></i>');
                }

                modal.find('#modalFormX').attr('action', '/admin/house_rent/' + id);


            });

            //deleteHouseRent
            function deleteHouseRent(id) {
                if (confirm('Are you sure you want to delete this HouseRent?')) {
                    $.ajax({
                        url: '{{ route('admin.house_rent.destroy') }}',
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
                            alert('Failed to delete HouseRent. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }

        </script>
    </x-slot>


</x-dashboard-app-layout>
