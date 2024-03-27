<div class="col-lg-3">
    <div class="card border-0 shadow mb-4 p-3">
        <div class="s-body text-center mt-3">
            <img src="{{ auth()->user()->image == '' ? asset('jobportal-template/assets/images/avatar7.png') : asset('uploads/avatars/' . auth()->user()->image) }}"
                alt="avatar" id="avatarImage" class="rounded-circle img-fluid" style="width: 150px; height: 150px">
            <input type="hidden" id="baseAvatarUrl" value="{{ asset('uploads/avatars/') }}">

            <h5 class="mt-3 pb-0">{{ auth()->user()->name }}</h5>
            <p class="text-muted mb-1 fs-6">{{ auth()->user()->designation }}</p>
            @if (Route::currentRouteName() == 'profile.index')
                <div class="d-flex justify-content-center mb-2">
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"
                        class="btn btn-info text-white">Change Profile Picture</button>
                </div>
            @endif

        </div>
    </div>
    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush ">
                <li class="list-group-item d-flex justify-content-between p-3">
                    <a href="{{ route('profile.index') }}">Account Settings</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('createJob') }}">Post a Job</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('jobs.index') }}">My Jobs</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="job-applied.html">Jobs Applied</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="saved-jobs.html">Saved Jobs</a>
                </li>
            </ul>
        </div>

        <a href="{{ route('logout') }}" class="btn btn-danger text-white">Logout</a>
    </div>
</div>
