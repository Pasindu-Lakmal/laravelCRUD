<!-- resources/views/add-like.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Like</title>
</head>

<body>


    <form action="{{ route('add.like', ['post_id' => 2]) }}" method="post">
        @csrf
        <button type="submit">Add Like</button>
    </form>

</body>

</html>