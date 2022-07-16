{{-- Update Modal --}}
<form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
    {{ method_field('patch') }}
    {{ csrf_field() }}
    <div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1" aria-labelledby="createModalLabel"
      aria-hidden="true" data-bs-backdrop="false">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <!-- head -->
          <div class="modal-header align-items-center">
            <h5 class="text-dark text-center w-100 m-0" id="exampleModalLabel">update Post</h5>
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
                    name="description" id="exampleFormControlTextarea1">  {{ $post->description }} </textarea>
                  @error('description')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div><br>
                {{-- <div>
                  <img src="backend-asset/profilepic/image.jpg" style="height: 300px;width: 455px;">

                </div> --}}
                <div>
                  <input class="form-control" type="file" name="image">
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
        </div>
      </div>
    </div>
  </form>