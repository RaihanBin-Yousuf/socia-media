<!-- create post -->
<div class="bg-white p-3 mt-3 rounded border shadow">
  <!-- avatar -->
  <div class="d-flex" type="button">
    <div class="p-1">
      <img src="{{ setImage(auth()->user()->profile_img,'') }}" alt="avatar" class="rounded-circle me-2"
        style="width: 38px; height: 38px; object-fit: cover" />
    </div>
    <input type="text" class="form-control rounded-pill border-0 pointer" disabled
      placeholder="What's on your mind, {{auth()->user()->name}}?" data-bs-toggle="modal"
      data-bs-target="#createModal" />
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
                    <img src="{{ setImage(auth()->user()->profile_img,'') }}" alt="from fb" class="rounded-circle"
                      style=" width: 38px; height: 38px; object-fit: cover; " />
                  </div>
                  <div>
                    <p class="m-0 fw-bold"> {{auth()->user()->name}}</p>
                    <select class="form-select border-0 w-76 fs-7" name="status" aria-label="Default select example">
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
                  <input type="file" name="image" id="file" accept="image/*">
                  <label for="file" id="uploadBtn">Choose Photo</label>
                </div>
                <br>
                <div>
                  <a onClick="imagepost('postimage')" class=" fas fa-images fs-5 text-success pointer mx-1">
                    Add Photo</a>
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
</div>