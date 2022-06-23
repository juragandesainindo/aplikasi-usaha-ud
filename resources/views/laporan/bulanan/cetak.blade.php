<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        * {
            font-family: 'Cambria', sans-serif;
        }

        h1 {
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }

        .judul {
            font-weight: bold;
            margin-bottom: 5px;
        }

        table {
            table-layout: fixed;
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #DAEEF3;
        }

        th,
        td,
        p {
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
            padding-right: 2px;
        }
    </style>
</head>

<body onload="window.print()">

    {{-- <h1>Laporan Bulanan </h1> --}}
    <h1>LAPORAN KEUANGAN UNIT {{ $usaha->nama_usaha }} PERBULAN</h1>
    <div class="judul">Periode Bulan {{ $bln }}/{{
        $thn
        }}</div>
    <table border="1">
        <thead>
            <tr>
                <th rowspan="2" style="width: 3%;">No</th>
                <th rowspan="2" style="width: 10%;">Tanggal</th>
                <th colspan="2">Total Buah/KG</th>
                <th rowspan="2">Pembelian</th>
                <th rowspan="2">Penjualan</th>
                <th rowspan="2">Pendapatan</th>
                <th rowspan="2">Operasional + Gaji</th>
                <th rowspan="2">Total</th>
                <th rowspan="2" style="width: 7%;">Selisih</th>
                <th rowspan="2" style="width: 7%;">Terjual Lagi</th>
                <th rowspan="2" style="width: 7%;">Sortir</th>
            </tr>
            <tr>
                <th style="width: 8%;">Pembelian</th>
                <th style="width: 8%;">Penjualan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($periode->sortBy('tanggal_awal') as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD') }} - {{
                    \Carbon\Carbon::parse($item->tanggal_akhir)->isoFormat('DD/MM/Y') }}
                </td>
                <td class="text-center">{{ $item->pembelian->sum('total_tonase') }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual') }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->pembelian->sum('total_biaya')) }}</td>
                <td class="text-right">Rp.&nbsp;{{
                    number_format($item->penjualan->sum('total_jual')) }}</td>
                <td class="text-right">Rp.&nbsp;{{
                    number_format($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))
                    }}
                </td>
                <td class="text-right">Rp.&nbsp;{{
                    number_format($item->biaya->sum('jumlah_biaya') +
                    $item->gaji->sum('gaji')) }}</td>

                <td class="text-right">Rp.&nbsp;{{
                    number_format(($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))-($item->biaya->sum('jumlah_biaya')
                    +
                    $item->gaji->sum('gaji'))) }}</td>
                <td class="text-center">{{
                    $item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase')
                    }}
                </td>
                <td class="text-center">{{ $item->sisa->sum('tonase_sisa_terjual') }}</td>
                <td class="text-center">{{
                    ($item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase'))+$item->sisa->sum('tonase_sisa_terjual')
                    }}</td>
            </tr>
            @empty
            <tr>
                <th colspan="12" class="text-center text-danger">Data tidak di temukan</th>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-center">Total</th>
                <th>{{ $tonaseBeli->sum('tonase_beli') }}</th>
                <th>{{ $tonaseJual->sum('tonase_jual') }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalBeli->sum('total_biaya')) }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalJual->sum('total_jual')) }}</th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJual->sum('total_jual'))-($totalBeli->sum('total_biaya')))
                    }}</th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format($biaya->sum('jumlah_biaya')+$gaji->sum('upah')) }}
                </th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJual->sum('total_jual')-$totalBeli->sum('total_biaya'))-($biaya->sum('jumlah_biaya')+$gaji->sum('upah')))
                    }}</th>
                <th>{{ $tonaseJual->sum('tonase_jual')-$tonaseBeli->sum('tonase_beli') }}
                </th>
                <th>{{ $sisaJual->sum('tonase_sisa_terjual') }}</th>
                <th>{{
                    ($tonaseJual->sum('tonase_jual')-$tonaseBeli->sum('tonase_beli'))+$sisaJual->sum('tonase_sisa_terjual')
                    }}</th>
            </tr>
        </tfoot>
    </table>

    <br><br>
    <table>
        <tr>
            <td><strong>DESA PULAU TAGOR KECAMATAN SERBA JADI KABUPATEN SERDANG BEDAGAI</strong></td>
        </tr>
        <tr>
            <td><strong>{{ \Carbon\Carbon::parse(date(now()))->isoFormat('DD MMMM Y') }}</strong>, dibuat oleh:</td>
        </tr>
        <br><br>
        <tr>
            <td><strong><u>MAULANA SANDI TYAS</u></strong></td>
        </tr>
        <tr>
            <td>MANAJER PRODUKSI</td>
        </tr>
    </table>



</body>

</html>