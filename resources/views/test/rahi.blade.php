<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}>
</head>

<body>
    <h1>Hello</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td scope="row">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->api_token }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button id="btn2">Load More</button>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}">
    </script>
    <script>
        let tag = '';
        let lastId = {{ $users->last()->id }};
        $("#btn2").click(function() {
            let loadmoretag = ''
            $.ajax({
                url: "{{ route('loadmore', '') }}" + "/" + lastId,
                success: function(users) {
                    console.log('users', users);
                    users.map(user => {
                        loadmoretag += '<tr>'
                        loadmoretag += '<td>' + user.name + '</td>'
                        loadmoretag += '<td>' + user.email + '</td>'
                        loadmoretag += '<td>' + user.api_token + '</td>'
                        loadmoretag += '</tr>'
                        lastId = user.id
                    })
                    $("tbody").append(loadmoretag);
                }
            });

        });
    </script>
</body>

</html>
