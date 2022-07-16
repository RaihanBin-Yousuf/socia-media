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
  <div class="container">
    <h1 class="text-center" style="color: #83c31c">Load More Data For Users</h1>
    @empty($users)
    <h1>Nothing to show</h1>

    @else
    <table class="table text-center">
      <thead>
        <th>Id</th>
        <th>Name</th>
        <th>UserName</th>
        <th>Email</th>
      </thead>
      <tbody id="userload">
        @foreach ($users as $user )
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endempty
    <div class="text-center">
      <button class="btn btn-info" type="button" id="btn2">Load More</button>
    </div>
  </div>

  <script>
    let tag = '';
    let lastId = {{ $users->last()->id }};
    $("#btn2").click(function() {
        let loadmoretag = ''
        $.ajax({
            url: "{{ route('loadmore', '') }}" + "/" + lastId,
            success: function(user) {
                console.log('user', user);
                user.map(user => {
                    loadmoretag += '<tr>'
                    loadmoretag += '<td>' + user.id + '</td>'
                    loadmoretag += '<td>' + user.name + '</td>'
                    loadmoretag += '<td>' + user.username + '</td>'
                    loadmoretag += '<td>' + user.email + '</td>'
                    loadmoretag += '</tr>'
                    lastId = user.id
                })
                $("#userload").append(loadmoretag);
            }
        });
    });
  </script>

</body>

</html>