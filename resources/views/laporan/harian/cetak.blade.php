<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        * {
            font-family: 'Cambria', sans-serif;
        }

        h1 {
            font-size: 12pt;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }

        .pembelian {
            font-size: 10pt;
        }

        .judul {
            font-size: 11pt;
            font-weight: bold;
            margin-bottom: 5px;
        }

        table {
            table-layout: fixed;
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #FDE9D9;
        }

        thead tr th,
        tbody tr td,
        tfoot tr th {
            font-size: 10pt;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-justify {
            text-align: justify;
        }
    </style>
</head>

<body>

    <h1>Laporan Harian {{ $periode->keterangan }}</h1>
    <div class="judul">A. Pembelian</div>
    <table border="1">
        <thead>
            <tr class="pembelian">
                <th rowspan="2" width="3%">No</th>
                <th rowspan="2">Nama Supplier</th>
                <th colspan="2">Super</th>
                <th colspan="2">Bulat</th>
                <th colspan="2">Sortiran</th>
                <th colspan="3">Total</th>
                <th rowspan="2">Total Biaya</th>
                <th rowspan="2">Total Tonase</th>
            </tr>
            <tr class="pembelian">
                <th style="width: 7%;">Harga</th>
                <th style="width: 7%;">Tonase</th>
                <th style="width: 7%;">Harga</th>
                <th style="width: 7%;">Tonase</th>
                <th style="width: 7%;">Harga</th>
                <th style="width: 7%;">Tonase</th>
                <th>Super</th>
                <th>Bulat</th>
                <th>Sortiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periode->pembelian as $key => $item)
            <tr class="pembelian">
                <td style="text-align: center;">{{ ++$key }}</td>
                <td>{{ $item->nama_supplier }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->harga_super) }}</td>
                <td class="text-center">{{ $item->tonase_super }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->harga_bulat) }}</td>
                <td class="text-center">{{ $item->tonase_bulat }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->harga_sortiran) }}</td>
                <td class="text-center">{{ $item->tonase_sortiran }}</td>
                <td class="text-right">Rp.&nbsp;&nbsp;{{ number_format($item->total_super)
                    }}</td>
                <td class="text-right">Rp.&nbsp;&nbsp;{{ number_format($item->total_bulat)
                    }}</td>
                <td class="text-right">Rp.&nbsp;&nbsp;{{
                    number_format($item->total_sortiran) }}
                </td>
                <td class="text-right">Rp.&nbsp;&nbsp;{{ number_format($item->total_biaya)
                    }}</td>
                <td class="text-center">{{ $item->total_tonase }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="pembelian">
                <th></th>
                <th>Total</th>
                <th></th>
                <th>{{ $tonasesuper }}</th>
                <th></th>
                <th>{{ $tonasebulat }}</th>
                <th></th>
                <th>{{ $tonasesortiran }}</th>
                <th>Rp.&nbsp;{{ number_format($totalsuper) }}</th>
                <th>Rp.&nbsp;{{ number_format($totalbulat) }}</th>
                <th>Rp.&nbsp;{{ number_format($totalsortiran) }}</th>
                <th>Rp.&nbsp;{{ number_format($totalbiaya) }}</th>
                <th>{{ number_format($totaltonase) }}</th>
            </tr>
            <tr class="pembelian">
                <th></th>
                <th>Grand Total</th>
                <th colspan="10" class="text-right">{{ number_format($grandtotalbeli) }}
                </th>
                <th></th>
            </tr>
        </tfoot>
    </table>

    <br>

    <div class="judul">B. Penjualan</div>
    <table border="1">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Nama Penjual</th>
                <th style="width: 10%;">Harga Jual Produksi</th>
                <th style="width: 10%;">Tonase</th>
                <th style="width: 15%;">Total Harga Jual</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periode->penjualan as $key => $item)
            <tr>
                <td class="text-center">{{ ++$key }}</td>
                <td>{{ $item->nama_penjual }}</td>
                <td class="text-center">Rp.&nbsp;&nbsp;{{ number_format($item->harga_jual) }}
                </td>
                <td class="text-center">{{ number_format($item->tonase_jual) }}</td>
                <td class="text-right">Rp.&nbsp;&nbsp;{{ number_format($item->total_jual) }}
                </td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Total</th>
                <th></th>
                <th>{{ $tonasejual }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totaljual) }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>

    <br>

    <div class="judul">C. Pendapatan Produksi</div>
    <table border="1">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 30%;">Title</th>
                <th style="width: 15%;">Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">1</td>
                <td>Harga Rata-Rata Perkilogram</td>
                <td class="text-right">{{ number_format($hargaratarata) }}</td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td>Selisih Tonase</td>
                <td class="text-right">{{ number_format($selisihtonase) }}</td>
                <td>
                    @if ($selisihtonase < 0) <span>Tidak Terjual</span>
                        @else
                        @endif
                </td>
            </tr>
            <tr>
                <td class="text-center">3</td>
                <td>Selisih Harga</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($selisihharga) }}</td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">4</td>
                <td>Pendapatan Kotor Produksi</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($pendapatankotor) }}</td>
                <td>
                    @if ($pendapatankotor < 0) Minus @else @endif </td>
            </tr>
        </tbody>
    </table>

    <br>

    <div class="judul">D. Biaya Produksi</div>
    <table border="1">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">Title Biaya</th>
                <th style="width: 15%;">Jumlah Biaya</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periode->biaya as $key => $bi)
            <tr>
                <td class="text-center">{{ ++$key }}</td>
                <td>{{ $bi->title_biaya }}</td>
                <td class="text-center">Rp.&nbsp;{{ number_format($bi->jumlah_biaya) }}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Total Biaya</th>
                <th class="text-center">Rp.&nbsp;{{ number_format($jumlahbiaya) }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>



</body>

</html>