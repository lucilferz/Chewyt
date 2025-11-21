<!DOCTYPE html>
<html>
<head>
    <title>Export Catatan ChewytPad</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        h2 { text-align: center; margin-bottom: 20px; color: #444; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; font-weight: bold; color: #000; }
        .meta { font-size: 10px; color: #777; text-align: right; margin-bottom: 5px; }
    </style>
</head>
<body>
    <div class="meta">Dicetak dari ChewytPad pada {{ date('d-m-Y H:i') }}</div>
    <h2>Laporan Catatan Saya</h2>
    
    <table>
        <thead>
            <tr>
                <th width="15%">Tanggal</th>
                <th width="15%">Kategori</th>
                <th width="25%">Judul</th>
                <th width="45%">Isi Ringkas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
            <tr>
                <td>{{ $note->created_at->format('d/m/Y') }}</td>
                <td>{{ $note->category->name }}</td>
                <td><strong>{{ $note->title }}</strong></td>
                <td>{{ Str::limit($note->content, 150) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>