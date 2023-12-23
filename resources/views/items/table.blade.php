<div class="table">
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Code</th>
                <th>EAN</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><img src="{{ $item->photo }}" alt="{{ $item->name }}" width="100"></td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->ean }}</td>
                <td>{{ $item->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
<div class="table">

