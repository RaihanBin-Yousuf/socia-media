@extends('layouts.app')
@section('content')
<style>
    .profileimg{
  height: 100px;
   width: 100px;
  border-radius: 50%;
  }
  
</style>
<div class="container"> 
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">{{ __('Update Profile') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('UpdateUserprofile') }}" enctype='multipart/form-data'>
                        @csrf
                        @method('PUT')
                        <!-- Profile Image -->
                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label text-center">{{ __('Profile Picture') }}</label>
                            <div class="col-md-12 text-center">
                                <img class="profileimg" id="updateprofileimage" src="{{ setImage(auth()->user()->profile_img,'') }}" alt="your image"/>
                                    <br>
                                    <input type='file' class="@error('profile_img') is-invalid @enderror" name="profile_img" onchange="readupdateprofileimgURL(this);" />
                                    @error('profile_img')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="user-name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? auth()->user()->name }}" autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>  

                            <div class="col-md-6 form-group">
                                <label for="username">User Name</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? auth()->user()->username }}" autofocus>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>      
                        </div>

                        <div class="row">
                            {{-- <div class="col-md-6 form-group">
                                <label for="mobile">Mobile No</label>
                                <input id="phone" type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') ?? auth()->user()->mobile }}" autofocus>
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div> --}}
                            
                            <div class="col-md-12 form-group">
                                <label for="user-name">Email</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? auth()->user()->email }}" autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                
                         <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="address">Address</label>
                                <input id="address" type="address"  class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? auth()->user()->address }}" autofocus>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                         {{-- <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="password">Password</label>
                                    <input id="password-field" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"autocomplete="new-password">
                                    <span toggle="#password-field" class="fa fa-fw fa-eye-slash fa-lg field-icon toggle-password"></span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                        
                        <div class="mb-0 form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Update Your Profile') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
      function readupdateprofileimgURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#updateprofileimage')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
@endsection


