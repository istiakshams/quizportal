@extends( getThemePath() . '.layout.master')

@section('title', 'Profile '. getSetting('tab_separator') .' '. getSetting('system_title'))

@section('header')
@include( getThemePath() . '.partials.header')
@endsection

@section('content')

<div class="qp-fullwidth-container">
    <div class="qp-container">

        <div class="qp-page-title">
            <h1>Profile</h1>
        </div> <!-- qp-page-title -->
        <div class="qp-page-content">

            @include( getThemePath() . '.notifications')

            <div class="qp-row">
                <div class="qp-one-third">
                    <div class="qp-profile-box">
                        <img src="{{ asset('/images/profile-default.jpg') }}" alt="{{ $user->name }}"
                            class="qp-profile-avatar" />
                        <h2>{{ $user->name }}</h2>
                    </div> <!-- qp-one-third -->
                </div> <!-- qp-one-third -->
                <div class="qp-two-third">
                    <h2>Update Profile</h2>
                    <!-- form start -->
                    <form method="POST" action="/profile/update-profile" class="qp-form" role="form">
                        {{ csrf_field() }}
                        <div class="qp-form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                                value="{{ $user->name }}">
                        </div>
                        <div class="qp-form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Email"
                                value="{{ $user->email }}">
                        </div>
                        <div class="qp-form-group">
                            <button type="submit" name="updateProfile" class="qp-btn qp-btn-blue"
                                id="updateProfile">Update Profile</button>
                        </div>
                    </form>

                    <h2>Update Password</h2>
                    <!-- form start -->
                    <form method="POST" action="/profile/update-password" class="qp-form" role="form">
                        {{ csrf_field() }}
                        {{-- <div class="qp-form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" class="form-control" id="current_password"
                                placeholder="Enter current password" value="{{ $user->current_password }}">
                        </div> --}}
                        <div class="qp-form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" class="form-control" id="new_password"
                                placeholder="Enter new password" value="{{ old('new_password') }}">
                        </div>
                        <div class="qp-form-group">
                            <label for="repeat_password">Repeat Password</label>
                            <input type="password" name="repeat_password" class="form-control" id="repeat_password"
                                placeholder="Repeat new password" value="{{ old('new_password') }}">
                        </div>
                        <div class="qp-form-group">
                            <button type="submit" name="updatePassword" class="qp-btn qp-btn-blue"
                                id="updatePassword">Update Password</button>
                        </div>
                    </form>
                </div> <!-- qp-two-third -->
            </div> <!-- qp-row -->

        </div> <!-- qp-page-content -->

    </div> <!-- qp-container -->
</div> <!-- qp-fullwidth-container -->

@endsection

@section('footer')
@include( getThemePath() . '.partials.footer')
@endsection