@extends('client.layouts.app')

@section('header')
@endsection


@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="d-flex justify-content-between align-items-center">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
                        </ol>
                    </nav>
                    <a href="{{ route('employers.view', auth()->user()->id) }}" class="btn btn-sm btn-info text-white mb-4">View as</a>
                </div>
            </div>
            <div class="row">
                @include('client.sidebar')
                <div class="col-lg-9">
                    @include('client.alert')
                    <form action="{{ route('profile.update') }}" method="POST" class="card border-0 shadow mb-4"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row p-4">
                            <h3 class="fs-4 mb-1">My Profile</h3>
                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Name*</label>
                                <input type="text" name="name" value="{{ auth()->user()->name }}"
                                    placeholder="Enter Name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Email*</label>
                                <input type="email" placeholder="Enter Email" name="email"
                                    value="{{ auth()->user()->email }}" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Designation*</label>
                                <input type="text" placeholder="Designation" name="designation"
                                    value="{{ auth()->user()->designation }}" value="{{ old('designation') }}"
                                    class="form-control @error('designation') is-invalid @enderror">
                                @error('designation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Mobile* <span class="text-info "
                                        style="font-size: 13px">(start with country code)</span></label>
                                <input type="number" placeholder="+880 1743433433" name="mobile"
                                    value="{{ auth()->user()->mobile }}" value="{{ old('mobile') }}"
                                    class="form-control @error('mobile') is-invalid @enderror">
                                @error('mobile')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            @if (auth()->user()->banner_image)
                                <div class="mb-2">
                                    <img src="{{ asset('uploads/banners/' . auth()->user()->banner_image) }}"
                                        alt="{{ auth()->user()->name }}">
                                </div>
                            @endif
                            <div class="mb-4">
                                <label for="" class="mb-2">Banner Image <span class="text-danger"
                                        style="font-size: 13px">Required size 900x300</span></label>
                                <input type="file" name="banner_image"
                                    class="form-control @error('banner_image') is-invalid @enderror">
                                @error('banner_image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">About*</label>
                                <textarea type="text" placeholder="Enter About Yourself" name="about"
                                    class="form-control @error('about') is-invalid @enderror" style="height: 120px">{{ auth()->user()->about }}</textarea>
                                @error('about')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Education*</label>
                                <input type="text" placeholder="Education" name="education"
                                    value="{{ auth()->user()->education }}"
                                    class="form-control @error('education') is-invalid @enderror">
                                @error('education')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Experience*</label>
                                <input type="text" placeholder="Experience" name="experience"
                                    value="{{ auth()->user()->experience }}"
                                    class="form-control @error('experience') is-invalid @enderror">
                                @error('experience')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <br>
                            <h5>Social info</h5>
                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Website*</label>
                                <input type="url" placeholder="Website" name="website"
                                    value="{{ auth()->user()->website }}"
                                    class="form-control @error('website') is-invalid @enderror">
                                @error('website')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Facebook*</label>
                                <input type="url" placeholder="Facebook" name="facebook"
                                    value="{{ auth()->user()->facebook }}"
                                    class="form-control @error('facebook') is-invalid @enderror">
                                @error('facebook')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Linkedin*</label>
                                <input type="url" placeholder="Linkedin" name="linkedin"
                                    value="{{ auth()->user()->linkedin }}"
                                    class="form-control @error('linkedin') is-invalid @enderror">
                                @error('linkedin')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Github*</label>
                                <input type="url" placeholder="Github" name="github"
                                    value="{{ auth()->user()->github }}"
                                    class="form-control @error('github') is-invalid @enderror">
                                @error('facebook')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Twitter*</label>
                                <input type="url" placeholder="twitter" name="twitter"
                                    value="{{ auth()->user()->twitter }}"
                                    class="form-control @error('twitter') is-invalid @enderror">
                                @error('twitter')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="" class="mb-2">Whatsapp*</label>
                                <input type="url" placeholder="Whatsapp" name="whatsapp"
                                    value="{{ auth()->user()->whatsapp }}"
                                    class="form-control @error('whatsapp') is-invalid @enderror">
                                @error('whatsapp')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-info text-white">Update</button>
                        </div>
                    </form>

                    <form action="{{ route('profile.updatePassword') }}" method="POST"
                        class="card border-0 shadow mb-4">
                        @csrf

                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">Change Password</h3>
                            <div class="mb-4">
                                <label for="" class="mb-2">Old Password*</label>
                                <input type="password" name="old_password" placeholder="Old Password"
                                    class="form-control @error('old_password') is-invalid @enderror">
                                @error('old_password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">New Password*</label>
                                <input type="password" name="new_password" placeholder="New Password"
                                    class="form-control @error('new_password') is-invalid @enderror">
                                @error('new_password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Confirm Password*</label>
                                <input type="password" name="confirm_password" placeholder="Confirm Password"
                                    class="form-control @error('confirm_password') is-invalid @enderror">
                                @error('confirm_password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-info text-white">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="UpdateImageForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <p id="imageErr" class="hide text-danger"></p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-info text-white mx-3">Update</button>
                            <button type="button" id="DismissBtn" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('#UpdateImageForm').on('submit', function(e) {
            e.preventDefault();


            const formData = new FormData(this);

            $.ajax({
                url: "{{ route('profile.updateAvatar') }}",
                type: 'post',
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    if (response.status == false) {
                        $('#image').addClass('is-invalid');
                        $('#imageErr').addClass('show').html(response.error);
                    } else {

                        $('#image').removeClass('is-invalid');
                        $('#imageErr').removeClass('show').html('');

                        $('#image').val('');

                        if (response.status == true) {
                            const baseUrl = $('#baseAvatarUrl').val();
                            $('#avatarImage').attr('src', baseUrl + '/' + response.image);
                            $('#DismissBtn').click();
                        }

                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        })
    </script>
@endsection
