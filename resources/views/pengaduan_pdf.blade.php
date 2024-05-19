<!DOCTYPE html>
<html>
<head>
    <title>Pengaduan Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Pengaduan Report</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Category</th>
                <th>Status</th>
                <th>Title</th>
                <th>Description</th>
                <th>Location</th>
                <th>Image</th>
                <th>Tanggapan Description</th>
                <th>Tanggapan Image</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengaduan as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->pengaduanCategory->name }}</td>
                <td>{{ $item->pengaduanStatus->name }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->location }}</td>
                <td>{{ $item->image }}</td>
                <td>{{ $item->tanggapan_description }}</td>
                <td>{{ $item->tanggapan_image }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
