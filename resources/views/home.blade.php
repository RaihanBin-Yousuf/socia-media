@extends('layouts.app')

@section('content')
<section class="content">
  <!-- ================= Main ================= -->
  <div class="container-fluid">
    <div class="row justify-content-center">
      <!-- ================= Timeline ================= -->
      <div class="col-12 col-lg-6 pb-5">
        <div class="d-flex flex-column justify-content-center w-100 mx-auto" style="max-width: 680px">
          <!-- stories -->
          <div class="d-flex justify-content-between position-relative">
            <!-- s 1 -->
            <div class="mx-1 bg-white rounded story" type="button" style="width: 6em; height: 190px">
              <img src="backend-asset/demo_pic/demo7.jpg" class="card-img-top" alt="story posts"
                style="min-height: 125px; object-fit: cover" />
              <div class=" d-flex align-items-center justify-content-center position-relative "
                style="min-height: 65px">
                <p class="mb-0 text-center fs-7 fw-bold">Create Story</p>
                <div class="position-absolute top-0 start-50 translate-middle">
                  <i class=" fas fa-plus-circle fs-3 text-primary bg-white p-1 rounded-circle "></i>
                </div>
              </div>
            </div>
            <!-- s 2 -->
            <div class="rounded mx-1 story" type="button" style="width: 6em; height: 190px">
              <img src="{{ asset('backend-asset/demo_pic/demo1.jpg')}}" class="card-img-top rounded" alt="story posts"
                style="min-height: 190px; object-fit: cover" />
            </div>
            <!-- s 3 -->
            <div class="rounded mx-1 story" type="button" style="width: 6em; height: 190px">
              <img src="{{ asset('backend-asset/demo_pic/demo2.jpg')}}" class="card-img-top rounded" alt="story posts"
                style="min-height: 190px; object-fit: cover" />
            </div>
            <!-- s 4 -->
            <div class="rounded mx-1 story" type="button" style="width: 6em; height: 190px">
              <img src="{{ asset('backend-asset/demo_pic/demo9.jpg')}}" class="card-img-top rounded" alt="story posts"
                style="min-height: 190px; object-fit: cover" />
            </div>
            <!-- s 5 -->
            <div class="d-none d-lg-block rounded mx-1 story" type="button" style="width: 6em; height: 190px">
              <img src="{{ asset('backend-asset/demo_pic/demo11.jpg')}}" class="card-img-top rounded" alt="story posts"
                style="min-height: 190px; object-fit: cover" />
            </div>
            <!-- s 6 -->
            <div class="d-none d-lg-block rounded mx-1 story" type="button" style="width: 6em; height: 190px">
              <img src="{{ asset('backend-asset/demo_pic/demo5.jpg')}}" class="card-img-top rounded" alt="story posts"
                style="min-height: 190px; object-fit: cover" />
            </div>
            <!-- next icon -->
            <div class=" position-absolute top-50 start-100 translate-middle pointer d-none d-lg-block ">
              <i class=" fas fa-arrow-right p-3 border text-muted bg-white rounded-circle "></i>
            </div>
          </div>

          {{-- create post --}}
         @include('timeline.createpost')
         {{-- End Create Post --}}
         
          {{-- All Posts --}}
         @include('timeline.posts')
         {{-- All Posts End --}}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

<script>
  function imagepost(ele) {
      var srcElement = document.getElementById(ele);
      if (srcElement != null) {
          if (srcElement.style.display == "block") {
              srcElement.style.display = 'none';
          }
          else {
              srcElement.style.display = 'block';
          }
          return false;
      }
  }

  function preview() {
      frame.src = URL.createObjectURL(event.target.files[0]);
  }
</script>

