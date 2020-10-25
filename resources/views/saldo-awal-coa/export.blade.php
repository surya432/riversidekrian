<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode</th>
            <th>Deskripsi</th>
            <th>Total</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; ?>
        @foreach($data as $result)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $result->code }}</td>
                <td>{{ $result->desc }}</td>
                <td>Rp.{{ number_format($result->total,0,'.','.') }}</td>
                <td>{{ date('d-m-Y',strtotime($result->date)) }}</td>
                <td>{{ $result->keterangan }}</td>
                <td>{{ ucfirst($result->status) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>