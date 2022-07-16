$(document).ready(function () {
  // console.log(' window.location.origin:>> ', window.location.origin);
  let baseurl= window.location.origin+ '/api';
  let tag = '';
  let lastIdArray = null;
  let commentsIdArray = [];
  let likesIdArray = [];
  let authuser=null;



  // Home Route
  $.ajax({
    url: baseurl+'/post',
    type: "get",
          success: function(response) {
              let posts = response.posts;
              authuser=response.authuser;
              // console.log('authuser :>> ', authuser);
              console.log('posts::> ', posts);
              postAdd(posts);
              lastIdArray = posts.map(post =>  post.id);
          }
  });

  // Add Comment
  $(document).on('click','.newcomment',function(){
    // console.log('authuser :>> ', authuser);
    let newcommentpostID = $(this).data('newcomment-post-id');
    let newcomment = $('#input_comment_'+newcommentpostID).val();
    let authid=authuser.authid;
    let authname=authuser.authname;
    let authimage=authuser.profile_img;
    $.ajax({
        url: baseurl+'/addcomment',
        type:"POST",
        data:{
            post_id: newcommentpostID,
            user_id: authid,
            comment: newcomment,
        },
        success: function(response) {
          authuser=response.authuser;
          $('#input_comment_'+newcommentpostID).val('');
          let loadmoretag = '' 
          loadmoretag += '<div  class="d-flex align-items-center my-1 comment_post_'+newcommentpostID+'" >'
          loadmoretag += '<img src="'+authimage+'" alt="avatar" class="rounded-circle me-2"style=" width: 38px; height: 38px; object-fit: cover; " />'
          loadmoretag += '<div class="p-3 rounded comment__input w-100">'
          loadmoretag += '<p class="fw-bold m-0">'+authname+'</p>'
          loadmoretag += '<p class="m-0 fs-7 p-2 rounded"> '+newcomment+' </p>'
          loadmoretag += '</div>'
          loadmoretag += '</div>'
          $('#comments_list_'+newcommentpostID).append(loadmoretag);
          $('#post_comment_'+newcommentpostID).text(response+' comments');
        }
      });
  });

  // Show Comment
  $(document).on('click', '.showcomments', function () { 
      let commentpostID = $(this).data('comment-post-id');
      let oldcomments = $('.comment_post_'+commentpostID).length;
      if (oldcomments<=0) {
        $.ajax({
                url: baseurl+'/comments/show',
                type:"get",
                data:{
                    post_id: commentpostID,
                },
                success: function(response) {
                  let comments = response.comments;
                  console.log('comments :>> ', comments);
                  commentshow(comments,commentpostID);
                }
          });
        }         
   });

   //Show Likes
   $(document).on('click','.showlikes', function () {
     let likepostId=$(this).data('like-post-id');
     let oldlikes= $('.like_post_'+likepostId).length;
     if (oldlikes<=0) {
     $.ajax({
      url: baseurl+'/showlikes',
       type: "POST",
       data: {
         post_id: likepostId,
         _token: $('meta[name="csrf-token"]').attr('content'),
       },
       success: function (likes) {
         likeshow(likes, likepostId);
         loveshow(likes, likepostId);
         hahashow(likes, likepostId);
       }
     });
    }
   });

  // like button
  $(document).on('click', '#likebtn', function () { 
    let postID = $(this).data('post-id');
    $.ajax({
        url: baseurl+'/likes',
        type:"POST",
        data:{
            post_id: postID,
            emoji:$(this).data('like-type'),
            _token: $('meta[name="csrf-token"]').attr('content'),
          },
        success: function(likescount) {
            $('#post_like_'+postID).text(likescount+' likes');
        }
      });
   });

  //  loadmore Button
  $("#loadmorebtn").click(function() {
    if(lastIdArray) {
      let lastId = lastIdArray = lastIdArray[lastIdArray.length-1];
      // console.log('ud :>> ', ud);
      $.ajax({
          url: baseurl+ '/home/' +lastId,
          success: function(response) {
              console.log('new Posts', response);
              postAdd(response.posts);
          }
      });
    }   
  });

function postAdd(posts) { 
  let loadmoretag = '' 
  posts.map(post => {
        loadmoretag += '<div class="bg-white p-4 rounded shadow mt-3">'
        loadmoretag += '<div class="d-flex justify-content-between">'
        loadmoretag += '<div class="d-flex">'
        loadmoretag +='<img src="'+post.postprofile_img+'" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover" />'
        loadmoretag += '<div>'
        loadmoretag += '<p class="m-0 fw-bold">' + post.user.name+'</p>'
        loadmoretag += '<span class="text-muted fs-7">'+post.created+'</span>'
        loadmoretag += '</div>'
        loadmoretag += '</div>';
        loadmoretag += '</div>';
        loadmoretag += '<div class="mt-3">';
        loadmoretag += '<div>';
        loadmoretag += (post.postdescribe) ? '<p>' +post.postdescribe+ '</p>':'';
        loadmoretag += (post.image) ? '<img src="'+post.image+'" alt="post image" style="height: 344px; width:612px; class="img-fluid rounded" />' : ''
        loadmoretag += '</div>'
        // likes & comments
        loadmoretag += '<div class="post__comment mt-3 position-relative">'
        // likes
        loadmoretag += '<div class=" d-flex align-items-center top-0 start-0 position-absolute " style="height: 50px; z-index: 5">'
        loadmoretag += '<div class="like-stat me-2">'
        loadmoretag += '<span class="like-emo">'
        loadmoretag += '</span>'
        loadmoretag += '<button style="border: none;background: none;" class="showlikes" data-like-post-id="'+post.id+'" data-bs-toggle="modal" data-bs-target="#likesmodel'+post.id+'">'
        loadmoretag += '<span id="post_like_'+post.id+'">'
        loadmoretag += (post.likes.length <1) ? post.likes.length+ 'like': post.likes.length+'likes'
        loadmoretag += '</span>'
        loadmoretag += '</button>' 
        loadmoretag += '</div>'
        loadmoretag += '</div>'
        // End likes

        // Likes Modal
        loadmoretag += '<div class="modal fade" id="likesmodel'+post.id+'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">'
        // loadmoretag += '<div class="modal-dialog modal-dialog-scrollable">'
        loadmoretag += '<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">'
        loadmoretag += '<div class="modal-content">'
        loadmoretag += '<div class="container">'
        loadmoretag += '<div class="row">'
        loadmoretag += '<div class="col-md-10 d-flex justify-content-center">'
        loadmoretag += '<nav style="padding-top:25px">'
        loadmoretag += '<div class="nav" id="nav-tab" role="tablist">'
        loadmoretag += '<button data-bs-toggle="tab" data-bs-target="#nav-like'+post.id+'" type="button" class="btn backnone" ><i class="reaction reaction-like"></i></button>'
        loadmoretag += '<button data-bs-toggle="tab" data-bs-target="#nav-love'+post.id+'" type="button" class="btn backnone"><i class="reaction reaction-love"></i></button>'
        loadmoretag += '<button data-bs-toggle="tab" data-bs-target="#nav-haha'+post.id+'" type="button" class="btn backnone" ><i class="reaction reaction-haha"></i></button>'
        loadmoretag += '<button data-bs-toggle="tab" data-bs-target="#nav-sad'+post.id+'" type="button" class="btn backnone"><i class="reaction reaction-sad"></i></button>'
        loadmoretag += '<button data-bs-toggle="tab" data-bs-target="#nav-angry'+post.id+'" type="button" class="btn backnone"><i class="reaction reaction-angry"></i></button>'
        loadmoretag += '<button data-bs-toggle="tab" data-bs-target="#nav-wow'+post.id+'" type="button" class="btn backnone"><i class="reaction reaction-wow"></i></button>'
        // loadmoretag += '<button data-bs-toggle="tab" data-bs-target="#nav-wow'+post.id+'" type="button" class="backnone"><img class="hu5pjgll bixrwtb6" src="default/wow.png" alt="" style="height: 35px; width: 35px;"></button>'
       
        loadmoretag += '</div>'
        loadmoretag += '</nav>'
        loadmoretag += '</div>'
        loadmoretag += '<div style="padding-top:20px" class="col-md-2 d-flex justify-content-md-center align-items-center">'
        loadmoretag += '<button style="width: 45px; height: 45px;" type="button" class="btn btn-light rounded-circle " data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>'
        loadmoretag += '</div>'
        loadmoretag += '</div>'
        loadmoretag += '</div>'
              
        loadmoretag += '<div class="modal-body">'        
        loadmoretag += '<div class="tab-content" id="nav-tabContent">'

        loadmoretag += '<div class="tab-pane fade show active" id="nav-like'+post.id+'" role="tabpanel" aria-labelledby="nav-like-tab">'
        loadmoretag += '<div class="row">'
        //likeshow function
        loadmoretag += '<div id="likes_list_'+post.id+'">'
        loadmoretag += '</div>'
        //likeshow function end
        loadmoretag += '</div>'
        loadmoretag += '</div>'

        loadmoretag += '<div class="tab-pane fade" id="nav-love'+post.id+'" role="tabpanel" aria-labelledby="nav-like-tab">'
        loadmoretag += '<div class="row">'
        //loveshow function
        loadmoretag += '<div id="loves_list_'+post.id+'">'
        loadmoretag += '</div>'
        //Loveshow function end
        loadmoretag += '</div>'
        loadmoretag += '</div>'

        loadmoretag += '<div class="tab-pane fade" id="nav-haha'+post.id+'" role="tabpanel" aria-labelledby="nav-like-tab">'
        loadmoretag += '<div class="row">'
        //haahashow
        loadmoretag += '<div id="hahas_list_'+post.id+'">'
        loadmoretag += '</div>'
        //hahashow function end
        loadmoretag += '</div>'
        loadmoretag += '</div>'

        loadmoretag += '</div>'
        loadmoretag += '</div>'

        loadmoretag += '</div>'
        loadmoretag += '</div>'
        loadmoretag += '</div>'

        // comments start
        loadmoretag += '<div class="accordion" id="accordionExample">'
        loadmoretag += '<div class="accordion-item border-0">'
        // comment collapse
        loadmoretag += '<h2 class="accordion-header" id="headingTwo">'
        loadmoretag += '<div class=" accordion-button collapsed pointer d-flex justify-content-end " aria-expanded="false">'
        loadmoretag += '<a data-toggle="collapse" class="showcomments" data-comment-post-id="'+post.id+'" data-target="#post_comments_'+post.id+'">'
        loadmoretag += '<span id="post_comment_'+post.id+'">'
        loadmoretag += (post.comments.length <=1) ? post.comments.length+'&nbsp;Comment': post.comments.length+'&nbsp;Comments'
        loadmoretag += '</span>'
        loadmoretag += '</a>'
        loadmoretag += '</div>'
        loadmoretag += '</h2>'
        loadmoretag += '<hr>'

        // comment & like bar
        loadmoretag += '<div class="d-flex justify-content-around">'
        loadmoretag += '<div class="like-btn dropdown-item rounded d-flex justify-content-center align-items-center pointer text-muted p-1">'
            // reaction system
        loadmoretag += '<span class="like-btn">'
        loadmoretag += '<i class="text-primary fas fa-thumbs-up">'
        loadmoretag += '</i>'
        loadmoretag += '<span style="color: black" class="like-btn-text"> Like</span>'
        loadmoretag += '<ul id="reactions" class="reactions-box">'
        loadmoretag += '<a id="likebtn" data-like-type="'+post.like+'" data-post-id="'+post.id+'">'
        loadmoretag += '<li class="reaction reaction-like" data-reaction="Like"></li>'
        loadmoretag += '</a>'
        loadmoretag += '<a id="likebtn" data-like-type="'+post.love+'" data-post-id="'+post.id+'">'
        loadmoretag += '<li class="reaction reaction-love" data-reaction="Love"></li>'
        loadmoretag += '</a>'
        loadmoretag += '<a id="likebtn" data-like-type="'+post.haha+'" data-post-id="'+post.id+'">'
        loadmoretag += '<li class="reaction reaction-haha" data-reaction="HaHa"></li>'
        loadmoretag += '</a>'
        loadmoretag += '<a id="likebtn" data-like-type="'+post.wow+'" data-post-id="'+post.id+'">'
        loadmoretag += '<li class="reaction reaction-wow" data-reaction="Wow"></li>'
        loadmoretag += '</a>'
        loadmoretag += '<a id="likebtn" data-like-type="'+post.sad+'" data-post-id="'+post.id+'">'
        loadmoretag += '<li class="reaction reaction-sad" data-reaction="Sad"></li>'
        loadmoretag += '</a>'
        loadmoretag += '<a id="likebtn" data-like-type="'+post.angry+'" data-post-id="'+post.id+'">'
        loadmoretag += '<li class="reaction reaction-angry" data-reaction="Angry"></li>'
        loadmoretag += '</a>'
        loadmoretag += '</ul>'
        loadmoretag += '</span>'
          //End reaction system
        loadmoretag += '</div>'
        loadmoretag += '<div class=" dropdown-item rounded d-flex justify-content-center align-items-center pointer text-muted p-1" href="#collapsePost1'+post.id +'" data-toggle="collapse">'
        loadmoretag += '<i class="fas fa-comment-alt me-3">' 
        loadmoretag += '</i>'
        loadmoretag += '<a class="showcomments" data-toggle="collapse" data-comment-post-id="'+post.id+'" data-target="#post_comments_'+post.id+'">'
        loadmoretag += 'Comments'
        loadmoretag +=' </a>'
        loadmoretag += '</div>'
        loadmoretag += '</div>'                  
        // comment & like bar End

        // comment expand
        loadmoretag += '<div id="post_comments_'+post.id+'" class="collapse">'
        loadmoretag += '<div id="comments_list_'+post.id+'"></div>'
        loadmoretag += '<hr />'
        loadmoretag += '<div class="d-flex my-1">'
        loadmoretag += '<div>'
        loadmoretag += '<img src="'+authuser.profile_img+'" alt="avatar" class="rounded-circle me-2" style=" width: 45px; height: 45px; object-fit: cover; " />'
        loadmoretag += '</div>'
        loadmoretag += '<input type="text" id="input_comment_'+post.id+'" class="form-control border-0 rounded-pill" name="comment" placeholder="Write a comment" />'
        loadmoretag += '<button data-newcomment-post-id="'+post.id+'" class="btn btn-info newcomment">Submit</button>'
        loadmoretag += '</div>'

        loadmoretag += '</div>'
        // comment expand End
        loadmoretag += '</div>'
        loadmoretag += '</div>'
        // comments End
        loadmoretag += '</div>'
        loadmoretag += '</div>'
        loadmoretag += '</div>'
        lastIdArray = post.id
      });
      $("#load").append(loadmoretag);
}

function commentshow(comments, postID) { 
      let loadmoretag = '' 
      commentsIdArray.push('commentpost_'+postID);
      comments.map(comment =>{
      loadmoretag += '<div  class="d-flex align-items-center my-1 comment_post_'+comment.post_id+'" >'
      loadmoretag += '<img src="'+comment.profile_img+'" alt="avatar" class="rounded-circle me-2"style=" width: 38px; height: 38px; object-fit: cover; " />'
      loadmoretag += '<div class="p-3 rounded comment__input w-100">'
      loadmoretag += '<p class="fw-bold m-0">'+comment.name+'</p>'
      loadmoretag += '<p class="m-0 fs-7 p-2 rounded"> '+comment.comment+' </p>'
      loadmoretag += '</div>'
      loadmoretag += '</div>'
      });
        // console.log('postId :>> ', postID);
      $('#comments_list_'+postID).append(loadmoretag);
}

function likeshow(likes,postID) {
      let loadmoretag = '' 
      likes.map(like =>{ 
        loadmoretag += '<div class="col-md-12  like_post_'+like.post_id+'">'
        loadmoretag += '<div class="row ms-2">'
        loadmoretag += '<div class="col-2 mb-4">'
        loadmoretag += '<img src="'+like.user.likeprofile_img+'" alt="avatar" class="rounded-circle" style="width: 55px; height: 55px; object-fit: cover;" />'
        if (like.emoji==1) {
        loadmoretag += '<img class="hu5pjgll bixrwtb6" src="https://scontent.xx.fbcdn.net/m1/v/t6/An-tsvy1nZCAfjJDq_e9hwhgJ_ouDg6GOHdVQtc31Lh3B13GEFJ0N3wRI6j2_Lz8icCyU4RkVsKbJckG5NMDv5TxxWie8OqB_kcvCNizVjn7sw.png?ccb=10-5&oh=00_AT_1Z9ZH-cQZZJQhLIjMGp377_lQ-MyQ-Acd_RmvplSJzg&oe=6256AEED&_nc_sid=55e238" alt="" style="bottom: 6px; right: 6px; transform: translate(200%, -100%);">' 
        }
        if (like.emoji==2) {
        loadmoretag += '<img class="hu5pjgll bixrwtb6" src="https://scontent.xx.fbcdn.net/m1/v/t6/An8KxJw0TdKA0hIHqkw35xWvBGYLLbtgD5y14_K8iN_zaDhCWgixktWzvqA45BTxHACGktnPMx_lkq1uE66153QNE58NZp59iYz6MDdtqgcTZw.png?ccb=10-5&oh=00_AT_jWRl264YWbDOiltsS38lOPpo92Vv24HS_U9nkttgDsw&oe=62570B55&_nc_sid=55e238" alt="" style="bottom: 6px; right: 6px; transform: translate(200%, -100%);">'
        }
        if (like.emoji==3) {
        loadmoretag += '<img class="hu5pjgll bixrwtb6" src="https://scontent.xx.fbcdn.net/m1/v/t6/An9yRlv3tqyIsDTiKV0WfMgtabNG9VPyvNiv5USdzPe0Cbp2FdNMvbGH1mvTvI8TczUcd9kED-M5Q1z9-fVK3zAMCRSiYtsWTpWSid0DJlPasg.png?ccb=10-5&amp;oh=00_AT9alsqrfki9Z2lvSRyuFUzi1mSogMxYL0ueIT_k0h-cZQ&amp;oe=6256229D&amp;_nc_sid=55e238" alt="" style="bottom: 6px; right: 6px; transform: translate(200%, -100%);">'
        }
        if (like.emoji==4) {
          loadmoretag += '<img class="hu5pjgll bixrwtb6" src="https://scontent.xx.fbcdn.net/m1/v/t6/An9Yzzh8CoEGqeWIfY5w6zR3VdPbG5X1fHXZdMfftnoomx3ObysBj145G99ZhM1T6DcU_ZAH2bEdiOj8sUAQvplVo0cYKS_GprBBJlcwiBHomFx7hQ.png?ccb=10-5&oh=00_AT8grTPvMAwTYNRp7i3GOjVC3w8DWiFVC5Eb_nXikM4zoQ&oe=6255FB4F&_nc_sid=55e238" alt="" style="bottom: 6px; right: 6px; transform: translate(200%, -100%);">'
        }
        if (like.emoji==5) {
          loadmoretag += '<img class="hu5pjgll bixrwtb6" src="https://scontent.xx.fbcdn.net/m1/v/t6/An-mj0uPEZ5b6GVy3OC-_ZMV1AGoboZI3SG9P2r3WElt054OlpAmUSq9QPU0i9RdhF07UwCRHIsC06i-w4_VCrnJnBEent1vmcy8MXOQt0msew.png?ccb=10-5&oh=00_AT-3UoIPbwbJiFlRbSJ2MFKUwp55lcgNJ-hoXs9gxTCiQA&oe=62568D41&_nc_sid=55e238" alt="" style="bottom: 6px; right: 6px; transform: translate(200%, -100%);">'
        }
        if (like.emoji==6) {
          loadmoretag += '<img class="hu5pjgll bixrwtb6" src="https://scontent.xx.fbcdn.net/m1/v/t6/An_f5KryEO3JdbkuRbEs1ixj8HC8itKTXvZ3Hl1c-zaREaiMDPCRTNw6CSwRUjKkq_YXEuxmsqBu06WIeteZ7MBZ2WKuJXvOK6WdOQfGi2Ixg9Sd.png?ccb=10-5&oh=00_AT-tNdXQOfa5TBTl2QDDbAPRenybkjMIQobiEDYhz_hPog&oe=6256A2D4&_nc_sid=55e238" alt="" style="bottom: 6px; right: 6px; transform: translate(200%, -100%);">'
        }
        loadmoretag += '</div>'
        loadmoretag += '<div class="col">'
        loadmoretag += '<p class="m-0 fw-bold">'+like.user.name+'</p>'
        loadmoretag += '<a class="btn btn-info btn-sm" href="#" role="button"> Add Friend</a>'
        loadmoretag += '</div>'
        loadmoretag += '<div class=" col text-right h5 mt-2 me-3">'
        loadmoretag += '<svg fill="currentColor" viewBox="0 0 20 20" width="1em" height="1em" class="a8c37x1j ms05siws l3qrxjdp b7h9ocf4 py1f6qlh jnigpg78 odw8uiq3"><g fill-rule="evenodd" transform="translate(-446 -350)"><path d="M458 360a2 2 0 1 1-4 0 2 2 0 0 1 4 0m6 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0m-12 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0"></path></g></svg>'
        loadmoretag += '</div>'
        loadmoretag += '</div>'
        loadmoretag += '</div>'
        });
          $('#likes_list_'+postID).append(loadmoretag); 
}
function loveshow(likes,postID) {
      let likemoretag = '' 
      let lovemoretag = '' 
      likes.map(like =>{ 
        if (like.emoji==2) {
            likemoretag += '<div class="col-md-12  like_post_'+like.post_id+'">'
            likemoretag += '<div class="row ms-2">'
            likemoretag += '<div class="col-2 mb-4">'
            likemoretag += '<img src="'+like.user.likeprofile_img+'" alt="avatar" class="rounded-circle" style="width: 55px; height: 55px; object-fit: cover;" />'
            likemoretag += '<img class="hu5pjgll bixrwtb6" src="https://scontent.xx.fbcdn.net/m1/v/t6/An8KxJw0TdKA0hIHqkw35xWvBGYLLbtgD5y14_K8iN_zaDhCWgixktWzvqA45BTxHACGktnPMx_lkq1uE66153QNE58NZp59iYz6MDdtqgcTZw.png?ccb=10-5&oh=00_AT_jWRl264YWbDOiltsS38lOPpo92Vv24HS_U9nkttgDsw&oe=62570B55&_nc_sid=55e238" alt="" style="bottom: 6px; right: 6px; transform: translate(200%, -100%);">'
            likemoretag += '</div>'
            likemoretag += '<div class="col">'
            likemoretag += '<p class="m-0 fw-bold">'+like.user.name+'</p>'
            likemoretag += '<a class="btn btn-info btn-sm" href="#" role="button"> Add Friend</a>'
            likemoretag += '</div>'
            likemoretag += '<div class=" col text-right h5 mt-2 me-3">'
            likemoretag += '<svg fill="currentColor" viewBox="0 0 20 20" width="1em" height="1em" class="a8c37x1j ms05siws l3qrxjdp b7h9ocf4 py1f6qlh jnigpg78 odw8uiq3"><g fill-rule="evenodd" transform="translate(-446 -350)"><path d="M458 360a2 2 0 1 1-4 0 2 2 0 0 1 4 0m6 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0m-12 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0"></path></g></svg>'
            likemoretag += '</div>'
            likemoretag += '</div>'
            likemoretag += '</div>'
          }   
          
        else if (like.emoji==3) {
            loadmoretag += '<div class="col-md-12  like_post_'+like.post_id+'">'
            loadmoretag += '<div class="row ms-2">'
            loadmoretag += '<div class="col-2 mb-4">'
            loadmoretag += '<img src="'+like.user.likeprofile_img+'" alt="avatar" class="rounded-circle" style="width: 55px; height: 55px; object-fit: cover;" />'
            loadmoretag += '<img class="hu5pjgll bixrwtb6" src="https://scontent.xx.fbcdn.net/m1/v/t6/An9yRlv3tqyIsDTiKV0WfMgtabNG9VPyvNiv5USdzPe0Cbp2FdNMvbGH1mvTvI8TczUcd9kED-M5Q1z9-fVK3zAMCRSiYtsWTpWSid0DJlPasg.png?ccb=10-5&amp;oh=00_AT9alsqrfki9Z2lvSRyuFUzi1mSogMxYL0ueIT_k0h-cZQ&amp;oe=6256229D&amp;_nc_sid=55e238" alt="" style="bottom: 6px; right: 6px; transform: translate(200%, -100%);">'
            loadmoretag += '</div>'
            loadmoretag += '<div class="col">'
            loadmoretag += '<p class="m-0 fw-bold">'+like.user.name+'</p>'
            loadmoretag += '<a class="btn btn-info btn-sm" href="#" role="button"> Add Friend</a>'
            loadmoretag += '</div>'
            loadmoretag += '<div class=" col text-right h5 mt-2 me-3">'
            loadmoretag += '<svg fill="currentColor" viewBox="0 0 20 20" width="1em" height="1em" class="a8c37x1j ms05siws l3qrxjdp b7h9ocf4 py1f6qlh jnigpg78 odw8uiq3"><g fill-rule="evenodd" transform="translate(-446 -350)"><path d="M458 360a2 2 0 1 1-4 0 2 2 0 0 1 4 0m6 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0m-12 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0"></path></g></svg>'
            loadmoretag += '</div>'
            loadmoretag += '</div>'
            loadmoretag += '</div>'
          }   
        });
        // console.log('postId :>> ', postID);
        $('#loves_list_'+postID).append(loadmoretag); 
}

// function hahashow(likes,postID) {
//       let loadmoretag = '' 
//       likesIdArray.push('likepost_'+postID);
//       likes.map(like =>{ 
//         if (like.emoji==3) {
//         loadmoretag += '<div class="col-md-12  like_post_'+like.post_id+'">'
//         loadmoretag += '<div class="row ms-2">'
//         loadmoretag += '<div class="col-2 mb-4">'
//         loadmoretag += '<img src="'+like.user.likeprofile_img+'" alt="avatar" class="rounded-circle" style="width: 55px; height: 55px; object-fit: cover;" />'
//         loadmoretag += '<img class="hu5pjgll bixrwtb6" src="https://scontent.xx.fbcdn.net/m1/v/t6/An9yRlv3tqyIsDTiKV0WfMgtabNG9VPyvNiv5USdzPe0Cbp2FdNMvbGH1mvTvI8TczUcd9kED-M5Q1z9-fVK3zAMCRSiYtsWTpWSid0DJlPasg.png?ccb=10-5&amp;oh=00_AT9alsqrfki9Z2lvSRyuFUzi1mSogMxYL0ueIT_k0h-cZQ&amp;oe=6256229D&amp;_nc_sid=55e238" alt="" style="bottom: 6px; right: 6px; transform: translate(200%, -100%);">'
//         loadmoretag += '</div>'
//         loadmoretag += '<div class="col">'
//         loadmoretag += '<p class="m-0 fw-bold">'+like.user.name+'</p>'
//         loadmoretag += '<a class="btn btn-info btn-sm" href="#" role="button"> Add Friend</a>'
//         loadmoretag += '</div>'
//         loadmoretag += '<div class=" col text-right h5 mt-2 me-3">'
//         loadmoretag += '<svg fill="currentColor" viewBox="0 0 20 20" width="1em" height="1em" class="a8c37x1j ms05siws l3qrxjdp b7h9ocf4 py1f6qlh jnigpg78 odw8uiq3"><g fill-rule="evenodd" transform="translate(-446 -350)"><path d="M458 360a2 2 0 1 1-4 0 2 2 0 0 1 4 0m6 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0m-12 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0"></path></g></svg>'
//         loadmoretag += '</div>'
//         loadmoretag += '</div>'
//         loadmoretag += '</div>'
//         }   
//         });
//         // console.log('postId :>> ', postID);
//         $('#hahas_list_'+postID).append(loadmoretag); 
// }

});