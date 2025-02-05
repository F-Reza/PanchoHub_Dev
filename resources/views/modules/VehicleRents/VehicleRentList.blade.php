<x-dashboard-app-layout>

    <!-- Set Page Title -->
    <x-slot name="title">
        <title>| পঞ্চহাব - গাড়িভাড়া সমূহ |</title>
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
                                <h4> গাড়িভাড়া সমূহ </h4>
                                <a href="#" class="btn btn-primary px-4" data-toggle="modal"
                                    data-target="#createVehicleRentModal">Create</a>
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
                                                <th class="align-left">Title</th>
                                                <th class="align-left">Category</th>
                                                <th class="align-left">	Contact</th>
                                                <th class="align-left">Upazila</th>
                                                <th class="align-left">	Added By</th>
                                                <th class="align-left">Created At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($vehicleRents->isNotEmpty())
                                                @foreach ($vehicleRents as $key => $vehicleRent)
                                                    <tr>
                                                        <td> {{ ++$key }} </td>
                                                        <td class="text-center">
                                                            <div class="custom-checkbox custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                    class="custom-control-input"
                                                                    id="checkbox-{{ $vehicleRent->id }}">
                                                                <label for="checkbox-{{ $vehicleRent->id }}"
                                                                    class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if (!empty($vehicleRent->image))
                                                                <img class="article-image" alt="image" title="Image"
                                                                    src="{{ asset('uploads/vehicleRents/' . $vehicleRent->image) }}"
                                                                    width="70" height="40">
                                                            @else
                                                                <img class="article-image" alt="image" title="Image"
                                                                    src="{{ asset('assets/dashboard/img/users/avatar.png') }}"
                                                                    width="70" height="40">
                                                            @endif
                                                        </td>
                                                        <td class="align-left" style=" max-width: 250px;"> {{ $vehicleRent->title }} </td>
                                                        <td class="align-left"> {{ $vehicleRent->category }} </td>
                                                        <td class="align-left"> {{ $vehicleRent->contact }} </td>
                                                        <td class="align-left"> {{ $vehicleRent->upazila }} </td>
                                                        <td class="align-left"> {{ $vehicleRent->user->name ?? 'N/A' }}</td>
                                                        <td class="align-left">
                                                            {{ \Carbon\Carbon::parse($vehicleRent->created_at)->format('d M, Y') }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $statusClass = match ($vehicleRent->status) {
                                                                    'Approved' => 'badge badge-secondary badge-shadow',
                                                                    'In Review' => 'badge badge-info badge-shadow',
                                                                    'Pending' => 'badge badge-warning badge-shadow',
                                                                    'Denied' => 'badge badge-danger badge-shadow',
                                                                    default => 'badge badge-success badge-shadow',
                                                                };
                                                            @endphp
                                                            <div class="{{ $statusClass }}">
                                                                {{ $vehicleRent->status }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <a href="#" class="btn btn-success"
                                                                data-toggle="modal" data-target="#viewVehicleRentModal"
                                                                data-id="{{ $vehicleRent->id }}"
                                                                data-user="{{ $vehicleRent->user->name }}"
                                                                data-category="{{ $vehicleRent->category }}"
                                                                data-title="{{ $vehicleRent->title }}"
                                                                data-capacity="{{ $vehicleRent->capacity?? 'Empty' }}"
                                                                data-seats="{{ $vehicleRent->seats?? 'Empty' }}"
                                                                data-facilities="{{ $vehicleRent->facilities?? 'Empty' }}"
                                                                data-driver_name="{{ $vehicleRent->driver_name?? 'Empty' }}"
                                                                data-contact="{{ $vehicleRent->contact }}"
                                                                data-upazila="{{ $vehicleRent->upazila }}"
                                                                data-address="{{ $vehicleRent->address ?? 'Empty' }}"
                                                                data-others_info="{{ $vehicleRent->others_info?? 'Empty' }}"
                                                                data-status="{{ $vehicleRent->status }}"
                                                                data-image="{{ $vehicleRent->image ? asset('uploads/vehicleRents/' . $vehicleRent->image) : '' }}"
                                                                data-entry="{{ \Carbon\Carbon::parse($vehicleRent->created_at)->format('d/m/Y') }}">
                                                                View
                                                            </a>

                                                            <a href="#" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#editVehicleRentModal"
                                                                data-id="{{ $vehicleRent->id }}"
                                                                data-category="{{ $vehicleRent->category }}"
                                                                data-title="{{ $vehicleRent->title }}"
                                                                data-capacity="{{ $vehicleRent->capacity?? '' }}"
                                                                data-seats="{{ $vehicleRent->seats?? '' }}"
                                                                data-facilities="{{ $vehicleRent->facilities?? '' }}"
                                                                data-driver_name="{{ $vehicleRent->driver_name?? '' }}"
                                                                data-contact="{{ $vehicleRent->contact }}"
                                                                data-upazila="{{ $vehicleRent->upazila }}"
                                                                data-address="{{ $vehicleRent->address ?? '' }}"
                                                                data-others_info="{{ $vehicleRent->others_info?? '' }}"
                                                                data-status="{{ $vehicleRent->status }}"
                                                                data-image="{{ $vehicleRent->image ? asset('uploads/vehicleRents/' . $vehicleRent->image) : '' }}">
                                                                Edit
                                                            </a>

                                                            <a href="javascript:void(0);"
                                                                onclick="deleteVehicleRent({{ $vehicleRent->id }})"
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
    <!-- Create VehicleRent Modal -->
    <div class="modal modalz fade" id="createVehicleRentModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"> গাড়িভাড়া যোগ করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Content Goes Here -->
                <form method="POST" action="{{ route('admin.vehicle_rent.store') }}" id="modalForm" enctype="multipart/form-data">
                @csrf

                    <!-- Title Field -->
                    <div class="form-group">
                        <label for="title"> গাড়ির নাম বা টাইটেল :* </label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" placeholder="টাইটেল লিখুন" required>
                    </div>

                    <!-- Contact Field -->
                    <div class="form-group">
                        <label for="contact"> যোগাযোগ নম্বর :* </label>
                        <input type="text" name="contact" class="form-control" id="contact" value="{{ old(key: 'contact') }}" placeholder="ফোন নম্বর লিখুন" required>
                    </div>

                    <!-- DriverName Field -->
                    <div class="form-group">
                        <label for="driver_name">ড্রাইভারের নাম :</label>
                        <input type="text" class="form-control" id="driver_name" name="driver_name" value="{{ old(key: 'driver_name') }}" placeholder="ড্রাইভারের নাম লিখুন">
                    </div>

                    <!-- Category Field -->
                    <div class="form-group">
                        <label for="category"> ক্যাটাগরি :* </label>
                        <select class="form-control" id="category" name="category" required onchange="toggleFields()">
                            <option value=""> সিলেক্ট করুন </option>
                            <option value="অ্যাম্বুলেন্স">অ্যাম্বুলেন্স</option>
                            <option value="প্রাইভেট কার">প্রাইভেট কার</option>
                            <option value="মাইক্রো বাস">মাইক্রো বাস</option>
                            <option value="পিকাপ">পিকাপ</option>
                            <option value="ট্রাক">ট্রাক</option>
                            <option value="অটো">অটো</option>
                            <option value="সি এন জি">সি এন জি</option>
                            <option value="বাস">বাস</option>
                        </select>
                    </div>

                    <!-- Capacity Field (Hidden by Default) -->
                    <div class="form-group" id="capacityField" style="display: none;">
                        <label for="capacity">গাড়ির ধারণ ক্ষমতা :</label>
                        <input type="text" class="form-control" id="capacity" name="capacity" value="{{ old('capacity') }}" placeholder="ধারণ ক্ষমতা লিখুন">
                    </div>

                    <!-- Seats Field (Hidden by Default) -->
                    <div class="form-group" id="seatsField" style="display: none;">
                        <label for="seats">গাড়ির সিট সংখ্যা :</label>
                        <input type="text" class="form-control" id="seats" name="seats" value="{{ old('seats') }}" placeholder="সিট সংখ্যা লিখুন">
                    </div>

                    <!-- Facilities Field (Hidden by Default) -->
                    <div class="form-group" id="facilitiesField" style="display: none;">
                        <label for="facilities">সার্ভিস :</label>
                        <select class="form-control" id="facilities" name="facilities">
                        <option value="">সিলেক্ট করুন</option>
                        <option value="এসি">এসি</option>
                        <option value="ননএসি">ননএসি</option>
                        </select>
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

                    <!-- OthersInfo Field -->
                    <div class="form-group ">
                        <label for="others_info">গাড়ি ভাড়ার বেপারে বিস্তারিত :</label>
                        <textarea class="form-control" id="others_info" name="others_info" rows="3" value="{{ old(key: 'others_info') }}" placeholder="ভাড়া লিখুন"></textarea>
                    </div>

                    <!-- Address Field -->
                    <div class="form-group">
                        <label for="address"> বিস্তারিত ঠিকানা : </label>
                        <textarea class="form-control" id="address" name="address" value="{{ old('address') }}" rows="3" placeholder="ঠিকানা লিখুন"></textarea>
                    </div>

                    <!-- Picture Input with Preview -->
                    <div class="form-group">
                        <label class="row justify-content-center" for="image-upload" id="image-label"> গাড়ির ছবি যুক্ত করুন </label>
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

    <!-- Edit VhicleRent Modal -->
    <div class="modal modalz fade" id="editVehicleRentModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">

            <!-- Modal Content Goes Here -->
            <form method="POST" action="" id="modalFormX" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">গাড়িভাড়া ডাটা পরিবর্তন </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">


                    <!-- Title Field -->
                    <div class="form-group">
                        <label for="title"> গাড়ির নাম বা টাইটেল :* </label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" placeholder="টাইটেল লিখুন" required>
                    </div>

                    <!-- Contact Field -->
                    <div class="form-group">
                        <label for="contact"> যোগাযোগ নম্বর :* </label>
                        <input type="text" name="contact" class="form-control" id="contact" value="{{ old(key: 'contact') }}" placeholder="ফোন নম্বর লিখুন" required>
                    </div>

                    <!-- DriverName Field -->
                    <div class="form-group">
                        <label for="driver_name">ড্রাইভারের নাম :</label>
                        <input type="text" class="form-control" id="driver_name" name="driver_name" value="{{ old(key: 'driver_name') }}" placeholder="ড্রাইভারের নাম লিখুন">
                    </div>

                    <!-- Category Field -->
                    <div class="form-group">
                        <label for="category"> ক্যাটাগরি :* </label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="অ্যাম্বুলেন্স" {{ old('category') == 'অ্যাম্বুলেন্স' ? 'selected' : '' }}> অ্যাম্বুলেন্স</option>
                            <option value="প্রাইভেট কার" {{ old('category') == 'প্রাইভেট কার' ? 'selected' : '' }}> প্রাইভেট কার</option>
                            <option value="মাইক্রো বাস" {{ old('category') == 'মাইক্রো বাস' ? 'selected' : '' }}> মাইক্রো বাস</option>
                            <option value="পিকাপ" {{ old('category') == 'পিকাপ' ? 'selected' : '' }}> পিকাপ</option>
                            <option value="ট্রাক" {{ old('category') == 'ট্রাক' ? 'selected' : '' }}> ট্রাক</option>
                            <option value="অটো" {{ old('category') == 'অটো' ? 'selected' : '' }}> অটো</option>
                            <option value="সি এন জি" {{ old('category') == 'সি এন জি' ? 'selected' : '' }}> সি এন জি</option>
                            <option value="বাস" {{ old('category') == 'বাস' ? 'selected' : '' }}> বাস</option>
                        </select>
                    </div>

                    <!-- Capacity Field -->
                    <div class="form-group">
                        <span class="theme-color">*(যদি ক্যাটাগরি <samp class="sampcolor"> ট্রাক বা পিকাপ </samp> সিলেক্ট করে থাকেন তাহলে ধারণ ক্ষমতা লিখুন)*</span><br/>
                        <label for="capacity">গাড়ির ধারণ ক্ষমতা :</label>
                        <input type="text" class="form-control" id="capacity" name="capacity" value="{{ old(key: 'capacity') }}" placeholder="ধারণ ক্ষমতা লিখুন">
                    </div>

                     <!-- Seats Field -->
                    <div class="form-group">
                        <span class="theme-color">*(যদি ক্যাটাগরি <samp class="sampcolor"> অ্যাম্বুলেন্স,ট্রাক,পিকাপ </samp> সিলেক্ট করে থাকেন তাহলে এটি খালি রাখুন)*</span><br/>
                        <label for="seats">গাড়ির সিট সংখ্যা :</label>
                        <input type="text" class="form-control" id="seats" name="seats" value="{{ old(key: 'seats') }}" placeholder="সিট সংখ্যা লিখুন">
                    </div>

                    <!--Facilities Field -->
                    <div class="form-group">
                        <span class="theme-color">*(যদি ক্যাটাগরি <samp class="sampcolor"> ট্রাক,পিকাপ,অটো,সি এন জি </samp> সিলেক্ট করে থাকেন তাহলে এটি খালি রাখুন)*</span><br/>
                        <label for="facilities">সার্ভিস :</label>
                        <select class="form-control" id="facilities" name="facilities">
                          <option value="">সিলেক্ট করুন</option>
                          <option value="এসি" {{ old('facilities') == 'এসি' ? 'selected' : '' }}> এসি</option>
                          <option value="ননএসি" {{ old('facilities') == 'ননএসি' ? 'selected' : '' }}> ননএসি</option>
                        </select>
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

                    <!-- OthersInfo Field -->
                    <div class="form-group ">
                        <label for="others_info">গাড়ি ভাড়ার বেপারে বিস্তারিত :</label>
                        <textarea class="form-control" id="others_info" name="others_info" rows="3" value="{{ old(key: 'others_info') }}" placeholder="ভাড়া লিখুন"></textarea>
                    </div>

                    <!-- Address Field -->
                    <div class="form-group">
                        <label for="address"> বিস্তারিত ঠিকানা : </label>
                        <textarea class="form-control" id="address" name="address" value="{{ old('address') }}" rows="3" placeholder="ঠিকানা লিখুন"></textarea>
                    </div>

                    <!-- Picture Input with Preview -->
                    <div class="form-group">
                        <label class="row justify-content-center" for="image-upload" id="image-label"> গাড়ির ছবি যুক্ত করুন </label>
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

    <!-- View VehicleRent Modal -->
    <div class="modal modalz fade" id="viewVehicleRentModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">গাড়িভাড়া ভিউ ডাটা</h5>
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
                                                    <img id="modalImage" src="" style="width: 300px; height: 160px;" title="vehicleRent Logo" alt="logo">
                                                </div>
                                                <div class="flex-fill bd-highlight align-self-center">
                                                    <div><samp class="sampcolor">স্ট্যাটাস: </samp> <span id="xStatus"></span></div>
                                                    <div><hr/></div>
                                                    <div><samp class="sampcolor">উপজেলা: </samp> <span id="xUpazila"></span></div>
                                                    <div><samp class="sampcolor">ঠিকানা: </samp> <span id="xAddress"></span></div>
                                                    <div><samp class="sampcolor">নিবন্ধন তারিখ: </samp> <span id="xEntry"></span></div>
                                                    <div><samp class="sampcolor">যোগ করেছেন: </samp> <span id="xUser"></span></div>
                                                </div>
                                            </div>

                                            <h6 class="dark-color mt-3 mb-2"> <span id="xTitle"></span> </h6>
                                            <div><samp class="sampcolor">ক্যাটাগরি: </samp> <span id="xCategory"> </span></div>
                                            <div><samp class="sampcolor">যোগাযোগ নম্বর: </samp> <span id="xContact"></span></div>
                                            <div><samp class="sampcolor">ড্রাইভারের নাম: </samp> <span id="xDriverName"> </span></div>
                                            <div><samp class="sampcolor">ধারণ ক্ষমতা: </samp> <span id="xCapacity"> </span></div>
                                            <div><samp class="sampcolor">সিট সংখ্যা: </samp> <span id="xSeats"> </span></div>
                                            <div><samp class="sampcolor">সার্ভিস: </samp> <span id="xFacilities"> </span></div>

                                            <div><hr/></div>
                                            <div><samp class="sampcolor">গাড়ি ভাড়ার বেপারে বিস্তারিত: </samp> <br/><span id="xOthersInfo"></span></div>
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

        <!-- JavaScript for Dynamic Field Handling -->
        <script>
            function toggleFields() {
                let category = document.getElementById("category").value;

                // Show Capacity Field if category is 'ট্রাক' or 'পিকাপ'
                document.getElementById("capacityField").style.display =
                    (category === "ট্রাক" || category === "পিকাপ") ? "block" : "none";

                // Show Seats Field if category is 'প্রাইভেট কার', 'মাইক্রো বাস', 'অটো', 'সি এন জি', or 'বাস'
                document.getElementById("seatsField").style.display =
                    (["প্রাইভেট কার", "মাইক্রো বাস", "অটো", "সি এন জি", "বাস"].includes(category)) ? "block" : "none";

                // Show Facilities Field if category is 'অ্যাম্বুলেন্স', 'প্রাইভেট কার', 'মাইক্রো বাস', or 'বাস'
                document.getElementById("facilitiesField").style.display =
                    (["অ্যাম্বুলেন্স", "প্রাইভেট কার", "মাইক্রো বাস", "বাস"].includes(category)) ? "block" : "none";
            }
        </script>

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


            //viewVehicleRentModal
            $('#viewVehicleRentModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                // Fetch data from the button
                var id = button.data('id');
                var user = button.data('user');
                var category = button.data('category');
                var title = button.data('title');
                var capacity = button.data('capacity') || '';
                var seats = button.data('seats') || '';
                var facilities = button.data('facilities') || '';
                var driver_name = button.data('driver_name') || '';
                var contact = button.data('contact');
                var upazila = button.data('upazila');
                var address = button.data('address') || '';
                var others_info = button.data('others_info') || '';
                var status = button.data('status');
                var entry = button.data('entry');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#xUser').text(user);
                modal.find('#xCategory').text(category);
                modal.find('#xTitle').text(title);
                modal.find('#xCapacity').text(capacity);
                modal.find('#xSeats').text(seats);
                modal.find('#xFacilities').text(facilities);
                modal.find('#xDriverName').text(driver_name);
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

            //editVehicleRentModal
            $('#editVehicleRentModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var category = button.data('category');
                var title = button.data('title');
                var capacity = button.data('capacity');
                var seats = button.data('seats');
                var facilities = button.data('facilities');
                var driver_name = button.data('driver_name');
                var contact = button.data('contact');
                var upazila = button.data('upazila');
                var address = button.data('address');
                var others_info = button.data('others_info');
                var status = button.data('status');
                var image = button.data('image');

                var modal = $(this);
                modal.find('#category').val(category);
                modal.find('#title').val(title);
                modal.find('#capacity').val(capacity);
                modal.find('#seats').val(seats);
                modal.find('#facilities').val(facilities);
                modal.find('#driver_name').val(driver_name);
                modal.find('#contact').val(contact);
                modal.find('#upazila').val(upazila);
                modal.find('#address').val(address);
                modal.find('#others_info').val(others_info);
                modal.find('#status').val(status);

                var imagePreview = modal.find('#imagePreviewX');
                if (image) {
                    imagePreview.html('<img src="' + image + '" class="img-fluid" />');
                } else {
                    imagePreview.html('<i class="bi bi-image" style="font-size: 60px; color: #ccc;"></i>');
                }

                modal.find('#modalFormX').attr('action', '/admin/vehicle_rent/' + id);


            });

            //deleteVehicleRent
            function deleteVehicleRent(id) {
                if (confirm('Are you sure you want to delete this VehicleRent?')) {
                    $.ajax({
                        url: '{{ route('admin.vehicle_rent.destroy') }}',
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
                            alert('Failed to delete VehicleRent. Please try again.');
                            console.error(xhr.responseText);
                        },
                    });
                }
            }

        </script>
    </x-slot>


</x-dashboard-app-layout>
