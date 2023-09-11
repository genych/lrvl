<!DOCTYPE html>
<html lang="en">
<head>
    <title>Personal Hackernews feed</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script>
        function drop(id) {
            fetch(`/api/story/${id}`, {
                method: "DELETE",
            }).then(_ => document.getElementById(id).style.textDecoration='line-through');
        }
    </script>
</head>
<body>
<div class="container mt-5">
    <table class="table table-bordered mb-5">
        <thead>
        <tr class="table-success">
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Points</th>
            <th scope="col">Created At</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($feed as $row)
        <tr id="{{ $row->id }}">
            <th scope="row"><a href="https://news.ycombinator.com/item?id={{ $row->hn_id }}"> {{ $row->hn_id }} </a></th>
            @if($row->url)
                <td><a href="{{ $row->url }}"> {{ $row->title }} </a></td>
            @else
                <td>{{ $row->title }}</td>
            @endif
            <td>{{ $row->points }}</td>
            <td>{{ $row->created_at }}</td>
            <td><button onclick="drop({{ $row->id }})">Delete</button></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center"> {!! $feed->links() !!}</div>
</div>
</body>
</html>
