<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="{{ asset('backend-asset/plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('backend-asset/plugins/jquery-ui/jquery-ui.min.js')}}"> </script>
</head>

<body>
  <div class="container h-100">
      <h1 class="text-center" style="color: #83c31c">Load More Data For Posts</h1>
      @foreach ($posts as $post )
      <div class="row align-items-center h-100"  id="userload">
          <div class="col-6 mx-auto">
              <div class="card h-100 justify-content-center">
                <div class="card mb-3 text-center" style="max-width: 540px;">
                  <div class="row g-0">      
                    <div class="col-md-8">
                      <div class="card-body">
                        <h5 class="card-title">Posts</h5>
                        <p class="card-text">{{$post->description}}</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
      </div>
      @endforeach
  </div>
  <div style="padding-top: 10px;padding-bottom: 10px" class=" text-center">
    <button class="btn btn-info btn-sm" href="#" id="btn2" role="button">Load More </button>
  </div>

  <script>
    let tag = '';
    let lastId = {{ $posts->last()->id }};
    $("#btn2").click(function() {
        let loadmoretag = ''
        $.ajax({
            url: "{{ route('home', '') }}" + "/" + lastId,
            success: function(posts) {
                console.log('posts', posts);
                posts.map(post => {            
                  loadmoretag += '<div class="bg-white p-4 rounded shadow mt-3">'
                  loadmoretag += '<div class="d-flex justify-content-between">'
                  loadmoretag += '< class="d-flex">'
                  loadmoretag += '<img src="{{ setImage('+post.user.profile_img+' ,'user') }}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover" />'
                  loadmoretag += '<div>'
                  loadmoretag += '<p class="m-0 fw-bold">' + post.user.name+' :: '+post.id+' '</p>'
                  loadmoretag += '<span class="text-muted fs-7">' {{setDateTime(+post.created_at)}} '</span>'
                  loadmoretag += '</div>';
                  loadmoretag += '</div>';
                  loadmoretag += '</div>';
                  loadmoretag += '<div class="mt-3">';
                  loadmoretag += '<div>';
                  loadmoretag += ' <p>' + post.description+  '</p>';
                  if (!(post.image==null))
                  {
                  '<img src="{{ setImagepost($post->image}}" alt="post image" style="height: 344px; width:612px;" class="img-fluid rounded" />'
                  }
                  loadmoretag += </div>
                  loadmoretag += </div>
                  loadmoretag += </div>
                  lastId = post.id
                })
                $("#userload").append(loadmoretag);
            }
        });
    });
  </script>
</body>

</html>
