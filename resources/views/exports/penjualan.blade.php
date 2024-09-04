<table>
    <thead>
        <tr>
            <th style="font-weight: bold; background-color: #fffc61; border: 1px solid #000; text-align: center;">No
            </th>
            <th style="font-weight: bold; background-color: #fffc61; border: 1px solid #000; text-align: center;">Kode
                Barang
            </th>
            <th style="font-weight: bold; background-color: #fffc61; border: 1px solid #000; text-align: center;">Nama
                Barang
            </th>
            <th style="font-weight: bold; background-color: #fffc61; border: 1px solid #000; text-align: center;">Harga
                Jual
            </th>
            <th style="font-weight: bold; background-color: #fffc61; border: 1px solid #000; text-align: center;">Qty
            </th>
            <th style="font-weight: bold; background-color: #fffc61; border: 1px solid #000; text-align: center;">Sub
                Total
            </th>
            <th style="font-weight: bold; background-color: #fffc61; border: 1px solid #000; text-align: center;">Tanggal
                Penjualan
            </th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
            $SubTotal = 0;
        @endphp
        @foreach ($penjualans as $index => $data)
            <tr>
                <td style="font-weight: bold; text-align: center; border: 1px solid #000;">{{ $no++ }}</td>
                <td style="border: 1px solid #000;">{{ $data->product->kode_product }}</td>
                <td style="border: 1px solid #000;">{{ $data->product->nama_product }}</td>
                <td style="border: 1px solid #000;">{{ 'Rp' . number_format($data->harga_jual, 0, ',', '.') }}</td>
                <td style="text-align: left; border: 1px solid #000;">{{ $data->qty }}</td>
                <td style="border: 1px solid #000;">
                    {{ 'Rp' . number_format($data->qty * $data->harga_jual, 0, ',', '.') }}</td>
                <td style="border: 1px solid #000;">
                    {{ Carbon\Carbon::parse($data->created_at)->locale('id')->translatedFormat('l, d-m-Y') }}
                </td>
                @php
                    $SubTotal += $data->qty * $data->harga_jual;
                @endphp
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-weight: bold; text-align: left; border: 1px solid #000; background-color: #61ffea">
                {{ $penjualans->sum('qty') }}</td>
            <td style="font-weight: bold; border: 1px solid #000; background-color: #61ffea">
                {{ 'Rp ' . number_format($SubTotal, 0, ',', '.') }}</td>
            <td></td>
        </tr>
    </tbody>
</table>
