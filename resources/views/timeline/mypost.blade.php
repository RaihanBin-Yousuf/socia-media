@extends('layouts.app')

@section('content')
<section class="content">
  <!-- ================= Main ================= -->
  <div class="container-fluid">
    <div class="row justify-content-evenly">
      <!-- ================= Sidebar ================= -->
      <div class="col-12 col-lg-3">
        <div class="d-none d-xxl-block h-100 fixed-top overflow-hidden scrollbar"
          style="max-width: 360px; width: 100%; z-index: 4">
          <ul class="navbar-nav mt-4 ms-3 d-flex flex-column pb-5 mb-5" style="padding-top: 56px">
        </div>
      </div>
      <!-- ================= Timeline ================= -->
      <div class="col-12 col-lg-6 pb-5">
        <div class="d-flex flex-column justify-content-center w-100 mx-auto" style="max-width: 680px">
          <!-- create post -->
          <div class="bg-white p-3 mt-3 rounded border shadow">
            <!-- avatar -->
            <div class="d-flex" type="button">
              <div class="p-1">
                <img src="backend-asset/demo_pic/demo1.jpg" alt="avatar" class="rounded-circle me-2"
                  style="width: 38px; height: 38px; object-fit: cover" />
              </div>
              <input type="text" class="form-control rounded-pill border-0 pointer" disabled
                placeholder="What's on your mind, John?" data-bs-toggle="modal" data-bs-target="#createModal" />
            </div>
            <!-- create modal -->
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true"
              data-bs-backdrop="false">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form method="POST" action="{{ route('posts.store') }}" enctype='multipart/form-data'>
                    @csrf
                    <!-- head -->
                    <div class="modal-header align-items-center">
                      <h5 class="text-dark text-center w-100 m-0" id="exampleModalLabel">Create Post</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- body -->
                    <div class="modal-body">
                      <div class="my-1 p-1">
                        <div class="d-flex flex-column">
                          <!-- name -->
                          <div class="d-flex align-items-center">
                            <div class="p-2">
                              <img src="{{ setImage(auth()->user()->profile_img,'') }}" alt="from fb"
                                class="rounded-circle" style=" width: 38px; height: 38px; object-fit: cover; " />
                            </div>
                            <div>
                              <p class="m-0 fw-bold"> {{auth()->user()->name}}</p>
                              <select class="form-select border-0 w-76 fs-7" name="status"
                                aria-label="Default select example">
                                <option selected value="{{App\Models\Post::ONLYPUBLIC}}">Public</option>
                                <option value="{{App\Models\Post::ONLYFRIEND}}">Friend</option>
                                <option value="{{App\Models\Post::ONLYME}}">Only Me</option>
                              </select>
                            </div>
                          </div>
                          <!-- text -->
                          <div>
                            <textarea cols="30" rows="5" class="form-control @error('description') is-invalid @enderror"
                              name="description" id="exampleFormControlTextarea1"></textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div><br>
                          <div id="postimage" class="profile-pic-div" style="display:none">
                            <img src="backend-asset/profilepic/image.jpg" id="photo">
                            <input type="file" name="image" id="file">
                            <label for="file" id="uploadBtn">Choose Photo</label>
                          </div>

                          <!-- emoji  -->
                          <div class=" d-flex justify-content-between align-items-center ">
                            <img src="{{ asset('backend-asset/demo_pic/SATP_Aa_square-2x.png')}}" class="pointer"
                              alt="fb text" style=" width: 30px; height: 30px; object-fit: cover; " />
                            <i class="far fa-laugh-wink fs-5 text-muted pointer"></i>
                          </div>
                          <!-- options -->
                          <div class=" d-flex justify-content-between border border-1 border-light rounded p-3 mt-3 ">
                            <div class="rounded d-flex align-items-center">
                              {{-- <i type="button" class="fas fa-photo-video me-2 text-success"></i> --}}
                              {{-- <a class="fas fa-photo-video me-2 text-info">
                                Photo/Video</a> --}}
                            </div>
                            <div>
                              <a onClick="imagepost('postimage')" class=" fas fa-images fs-5 text-success pointer mx-1">
                                Photo</a>
                              <i class=" fas fa-user-check fs-5 text-primary pointer mx-1 "></i>
                              <i class=" far fa-smile fs-5 text-warning pointer mx-1 "></i>
                              <i class=" fas fa-map-marker-alt fs-5 text-info pointer mx-1"></i>
                              <i class=" fas fa-microphone fs-5 text-danger pointer mx-1 "></i>
                              <i class=" fas fa-ellipsis-h fs-5 text-muted pointer mx-1 "></i>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- end -->
                    </div>
                    <!-- footer -->
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary w-100">
                        Post
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <hr />
          </div>
          <!-- posts -->
          <!-- p 1 -->
          @foreach ($mypost as $post )

          <div class="bg-white p-4 rounded shadow mt-3">
            <!-- author -->
            <div class="d-flex justify-content-between">
              <!-- avatar -->
              <div class="d-flex">
                <img src="{{ setImage(auth()->user()->profile_img,'') }}" alt="avatar" class="rounded-circle me-2"
                  style="width: 38px; height: 38px; object-fit: cover" />
                <div>
                  <p class="m-0 fw-bold">{{ auth()->user()->name }}</p>
                  <span class="text-muted fs-7">{{setDateTime($post->created_at)}}</span>
                  {{-- <span
                    class="text-muted fs-7">{{\Carbon\Carbon::parse($post->created_at)->format('d-M-Y')}}</span> --}}
                </div>
              </div>
              <!-- edit -->
              <i class="fas fa-ellipsis-h" type="button" id="post1Menu" data-bs-toggle="dropdown"
                aria-expanded="false"></i>
              <!-- edit menu -->
              <ul class="dropdown-menu border-0 shadow" aria-labelledby="post1Menu">
                <li class="d-flex align-items-center">
                  {{-- {{dd($post)}} --}}
                  <a class="dropdown-item  d-flex  justify-content-around  align-items-center  fs-7 "
                    href="#editPostModal{{ $post->id }}" data-toggle="modal">Edit
                    Post</a>
                </li>
                <li class="d-flex align-items-center">
                  <a href={{'deleteUserPost/'.$post->id }} class=" dropdown-item d-flex justify-content-around
                    align-items-center fs-7 " href="#"> Delete
                    Post</a>
                </li>
              </ul>
            </div>
            <!-- post content -->
            <div class="mt-3">
              <!-- content -->
              <div>
                <p>
                  {{ $post->description }}
                </p>
                @if ($post->image==null)


                @else
                <img src="{{ setImage($post->image, '/public/posts') }}" alt="post image"
                  style="height: 344px; width:612px;" class="img-fluid rounded" />
                @endif
              </div>
              <!-- likes & comments -->
              <div class="post__comment mt-3 position-relative">
                <!-- likes -->
                <div class="
                    d-flex
                    align-items-center
                    top-0
                    start-0
                    position-absolute
                  " style="height: 50px; z-index: 5">
                  <div class="me-2">
                    <i class="text-primary fas fa-thumbs-up"></i>
                    <i class="text-danger fab fa-gratipay"></i>
                    <i class="text-warning fas fa-grin-squint"></i>
                  </div>
                  <p class="m-0 text-muted fs-7">Phu, Tuan, and 3 others</p>
                </div>
                <!-- comments start-->
                <div class="accordion" id="accordionExample">
                  <div class="accordion-item border-0">
                    <!-- comment collapse -->
                    <h2 class="accordion-header" id="headingTwo">
                      <div class="
                          accordion-button
                          collapsed
                          pointer
                          d-flex
                          justify-content-end
                        " data-bs-toggle="collapse" data-bs-target="#collapsePost1" aria-expanded="false"
                        aria-controls="collapsePost1">
                        <a href="#collapsePost1{{ $post->id }}" data-toggle="collapse" class="m-0">Comment</a>
                      </div>
                    </h2>
                    <hr />
                    <!-- comment & like bar -->
                    <div class="d-flex justify-content-around">
                      <div class="
                          dropdown-item
                          rounded
                          d-flex
                          justify-content-center
                          align-items-center
                          pointer
                          text-muted
                          p-1
                        ">
                        <i class="fas fa-thumbs-up me-3"></i>
                        <p class="m-0">Like</p>
                      </div>
                      <div class="
                          dropdown-item
                          rounded
                          d-flex
                          justify-content-center
                          align-items-center
                          pointer
                          text-muted
                          p-1
                        " data-bs-toggle="collapse" data-bs-target="#collapsePost1" aria-expanded="false"
                        aria-controls="collapsePost1">
                        <i class="fas fa-comment-alt me-3"></i>
                        <a href="#collapsePost1{{ $post->id }}" data-toggle="collapse" class="m-0">Comment</a>
                      </div>
                    </div>
                    <!-- comment expand -->
                    <!-- comment expand -->
                    <div id="collapsePost1{{ $post->id }}" class="accordion-collapse collapse"
                      aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                      <hr />
                      <div class="accordion-body">
                        <!-- comment 2 -->
                        @foreach ($post->comments as $comment )
                        <div class="d-flex align-items-center my-1">
                          <!-- avatar -->
                          <img src="https://source.unsplash.com/random/2" alt="avatar" class="rounded-circle me-2"
                            style="
                                width: 38px;
                                height: 38px;
                                object-fit: cover;
                              " />
                          <!-- comment text -->
                          <div class="p-3 rounded comment__input w-100">
                            <p class="fw-bold m-0">Jerry</p>
                            <p class="m-0 fs-7 p-2 rounded">
                              {{ $comment->comment }}
                            </p>
                          </div>
                        </div>
                        @endforeach

                        <!-- create comment -->
                        <form class="d-flex my-1">
                          <!-- avatar -->
                          <div>
                            <img src="https://source.unsplash.com/collection/happy-people" alt="avatar"
                              class="rounded-circle me-2" style="
                                  width: 38px;
                                  height: 38px;
                                  object-fit: cover;
                                " />
                          </div>
                          <!-- input -->
                          <input type="text" class="form-control border-0 rounded-pill" placeholder="Write a comment" />
                        </form>
                        <!-- end -->
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end -->
              </div>
            </div>
          </div>
          @include('timeline.updatepostmodal')
          @endforeach
        </div>
      </div>
      <div class="col-12 col-lg-3"></div>
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