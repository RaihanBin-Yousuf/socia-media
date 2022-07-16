@extends('layouts.app')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <!-- left column -->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-info">
          <div class="card-header">{{ __('My Profile') }}
          </div>
          <!-- /.card-header -->
          <!-- form start -->

          <div class="card-body">
            <div class="row">
              <div class="col-md-12 form-group text-center">
                <label for="profile_image">Profile Picture</label>
                <div class="col-md-12 form-group text-center">
                  <img style="height: 150px; width: 150px; border-radius: 50%;"
                    src="{{ setImage(auth()->user()->profile_img,'') }}" />
                </div>
              </div>
            </div>
            <div class="row">
              <!-- <div class="col-md-4 ">
                            <div class="form-group text-center">
                              <label for="exampleProductName">আমার আইডি নম্বর:</label>
                              <div>
                              {{auth()->user()->id}}
                              </div>
                            </div>
                          </div> -->

              <div class="col-md-4 ">
                <div class="form-group text-center">
                  <label for="exampleProductName">NAME</label>
                  <div>
                    {{auth()->user()->name}}
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group text-center">
                  <label for="exampleProductCategory ">EMAIL</label>
                  <div>{{auth()->user()->email}}</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group text-center">
                  <label for="exampleProductCategory ">PHONE NO</label>
                  <div>{{auth()->user()->mobile}}</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group text-center">
                  <label for="exampleProductCategory ">ADDRESS</label>
                  <div>{{auth()->user()->address}}</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group text-center">
                  <label for="exampleProductCategory ">REGISTRATION DATE</label>
                  <!-- F - A full textual representation of a month (January through December)
                              M - A short textual representation of a month (Jan through Dec) -->
                  <div>{{\Carbon\Carbon::parse(auth()->user()->created_at)->format('d-F-Y')}}</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group text-center">
                  <label for="exampleProductCategory ">LAST UPDATE</label>
                  <div>{{\Carbon\Carbon::parse(auth()->user()->updated_at)->format('d-F-Y')}}</div>
                </div>
              </div>
              <!-- <div class="col-md-4">
                              <div class="form-group text-center">
                                  <label for="nid image">এনআইডি ছবি</label>
                                  <div>
                                      <img style="height: 200px; width: 350px;" class="nidimg" src="{{asset('/storage/nidcard/'.auth()->user()->nid_front_img)}}" alt="nid image" />
                                  </div>
                              </div>
                          </div> -->
            </div>
            <div class="row">
              <div class="col-md-12 text-center">
                <a href="{{route('updateprofile')}}" type="submit" class="btn btn-info">Update Your Profile</a>
              </div>
            </div>
            <div>
            </div>
          </div>
        </div>
</section>
@endsection