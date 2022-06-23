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
            font-size: 11pt;
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

<body>

    <h1>Laporan Tahunan {{ $usaha->nama_usaha }}</h1>

    {{-- Januari Start --}}
    <div class="judul">Bulan Januari</div>
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
            @php
            $no = 1;
            @endphp
            @foreach($periode->sortBy('bulan') as $item)
            @if (\Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('MM') == '01')
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD') }} - {{
                    \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD/MM/Y') }}</td>
                <td class="text-center">{{ $item->pembelian->sum('total_tonase') }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual') }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->pembelian->sum('total_biaya')) }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->penjualan->sum('total_jual')) }}</td>
                <td class="text-right">Rp.&nbsp;{{
                    number_format($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))
                    }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->biaya->sum('jumlah_biaya') +
                    $item->gaji->sum('gaji')) }}</td>

                <td class="text-right">Rp.&nbsp;{{
                    number_format(($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))-($item->biaya->sum('jumlah_biaya')
                    +
                    $item->gaji->sum('gaji'))) }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase') }}
                </td>
                <td class="text-center">{{ $item->sisa->sum('tonase_sisa_terjual') }}</td>
                <td class="text-center">{{
                    ($item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase'))+$item->sisa->sum('tonase_sisa_terjual')
                    }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-center">Total</th>
                <th class="text-center">{{ $tonaseBeliJan->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $tonaseJualJan->sum('tonase_jual') }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalBeliJan->sum('total_biaya')) }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalJualJan->sum('total_jual')) }}</th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualJan->sum('total_jual'))-($totalBeliJan->sum('total_biaya')))
                    }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($biayaJan->sum('jumlah_biaya')+$gajiJan->sum('upah'))
                    }}
                </th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualJan->sum('total_jual')-$totalBeliJan->sum('total_biaya'))-($biayaJan->sum('jumlah_biaya')+$gajiJan->sum('upah')))
                    }}</th>
                <th class="text-center">{{ $tonaseJualJan->sum('tonase_jual')-$tonaseBeliJan->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $sisaJualJan->sum('tonase_sisa_terjual') }}</th>
                <th class="text-center">{{
                    ($tonaseJualJan->sum('tonase_jual')-$tonaseBeliJan->sum('tonase_beli'))+$sisaJualJan->sum('tonase_sisa_terjual')
                    }}</th>
            </tr>
        </tfoot>
    </table>
    {{-- Januari End --}}
    <br>
    {{-- Februari Start --}}
    <div class="judul">Bulan Februari</div>
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
            @php
            $no = 1;
            @endphp
            @foreach($periode->sortBy('tanggal_awal') as $item)
            @if (\Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('MM') == '02')
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD') }} - {{
                    \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD/MM/Y') }}</td>
                <td class="text-center">{{ $item->pembelian->sum('total_tonase') }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual') }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->pembelian->sum('total_biaya')) }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->penjualan->sum('total_jual')) }}</td>
                <td class="text-right">Rp.&nbsp;{{
                    number_format($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))
                    }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->biaya->sum('jumlah_biaya') +
                    $item->gaji->sum('gaji')) }}</td>

                <td class="text-right">Rp.&nbsp;{{
                    number_format(($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))-($item->biaya->sum('jumlah_biaya')
                    +
                    $item->gaji->sum('gaji'))) }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase') }}
                </td>
                <td class="text-center">{{ $item->sisa->sum('tonase_sisa_terjual') }}</td>
                <td class="text-center">{{
                    ($item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase'))+$item->sisa->sum('tonase_sisa_terjual')
                    }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-center">Total</th>
                <th class="text-center">{{ $tonaseBeliFeb->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $tonaseJualFeb->sum('tonase_jual') }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalBeliFeb->sum('total_biaya')) }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalJualFeb->sum('total_jual')) }}</th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualFeb->sum('total_jual'))-($totalBeliFeb->sum('total_biaya')))
                    }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($biayaFeb->sum('jumlah_biaya')+$gajiFeb->sum('upah'))
                    }}
                </th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualFeb->sum('total_jual')-$totalBeliFeb->sum('total_biaya'))-($biayaFeb->sum('jumlah_biaya')+$gajiFeb->sum('upah')))
                    }}</th>
                <th class="text-center">{{ $tonaseJualFeb->sum('tonase_jual')-$tonaseBeliFeb->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $sisaJualFeb->sum('tonase_sisa_terjual') }}</th>
                <th class="text-center">{{
                    ($tonaseJualFeb->sum('tonase_jual')-$tonaseBeliFeb->sum('tonase_beli'))+$sisaJualFeb->sum('tonase_sisa_terjual')
                    }}</th>
            </tr>
        </tfoot>
    </table>
    {{-- Februari End --}}
    <br>
    {{-- Maret Start --}}
    <div class="judul">Bulan Maret</div>
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
            @php
            $no = 1;
            @endphp
            @foreach($periode->sortBy('tanggal_awal') as $item)
            @if (\Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('MM') == '03')
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD') }} - {{
                    \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD/MM/Y') }}</td>
                <td class="text-center">{{ $item->pembelian->sum('total_tonase') }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual') }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->pembelian->sum('total_biaya')) }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->penjualan->sum('total_jual')) }}</td>
                <td class="text-right">Rp.&nbsp;{{
                    number_format($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))
                    }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->biaya->sum('jumlah_biaya') +
                    $item->gaji->sum('gaji')) }}</td>

                <td class="text-right">Rp.&nbsp;{{
                    number_format(($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))-($item->biaya->sum('jumlah_biaya')
                    +
                    $item->gaji->sum('gaji'))) }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase') }}
                </td>
                <td class="text-center">{{ $item->sisa->sum('tonase_sisa_terjual') }}</td>
                <td class="text-center">{{
                    ($item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase'))+$item->sisa->sum('tonase_sisa_terjual')
                    }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-center">Total</th>
                <th class="text-center">{{ $tonaseBeliMar->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $tonaseJualMar->sum('tonase_jual') }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalBeliMar->sum('total_biaya')) }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalJualMar->sum('total_jual')) }}</th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualMar->sum('total_jual'))-($totalBeliMar->sum('total_biaya')))
                    }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($biayaMar->sum('jumlah_biaya')+$gajiMar->sum('upah'))
                    }}
                </th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualMar->sum('total_jual')-$totalBeliMar->sum('total_biaya'))-($biayaMar->sum('jumlah_biaya')+$gajiMar->sum('upah')))
                    }}</th>
                <th class="text-center">{{ $tonaseJualMar->sum('tonase_jual')-$tonaseBeliMar->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $sisaJualMar->sum('tonase_sisa_terjual') }}</th>
                <th class="text-center">{{
                    ($tonaseJualMar->sum('tonase_jual')-$tonaseBeliMar->sum('tonase_beli'))+$sisaJualMar->sum('tonase_sisa_terjual')
                    }}</th>
            </tr>
        </tfoot>
    </table>
    {{-- Maret End --}}
    <br>
    {{-- April Start --}}
    <div class="judul">Bulan April</div>
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
            @php
            $no = 1;
            @endphp
            @foreach($periode->sortBy('tanggal_awal') as $item)
            @if (\Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('MM') == '04')
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD') }} - {{
                    \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD/MM/Y') }}</td>
                <td class="text-center">{{ $item->pembelian->sum('total_tonase') }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual') }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->pembelian->sum('total_biaya')) }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->penjualan->sum('total_jual')) }}</td>
                <td class="text-right">Rp.&nbsp;{{
                    number_format($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))
                    }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->biaya->sum('jumlah_biaya') +
                    $item->gaji->sum('gaji')) }}</td>

                <td class="text-right">Rp.&nbsp;{{
                    number_format(($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))-($item->biaya->sum('jumlah_biaya')
                    +
                    $item->gaji->sum('gaji'))) }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase') }}
                </td>
                <td class="text-center">{{ $item->sisa->sum('tonase_sisa_terjual') }}</td>
                <td class="text-center">{{
                    ($item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase'))+$item->sisa->sum('tonase_sisa_terjual')
                    }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-center">Total</th>
                <th class="text-center">{{ $tonaseBeliApr->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $tonaseJualApr->sum('tonase_jual') }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalBeliApr->sum('total_biaya')) }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalJualApr->sum('total_jual')) }}</th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualApr->sum('total_jual'))-($totalBeliApr->sum('total_biaya')))
                    }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($biayaApr->sum('jumlah_biaya')+$gajiApr->sum('upah'))
                    }}
                </th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualApr->sum('total_jual')-$totalBeliApr->sum('total_biaya'))-($biayaApr->sum('jumlah_biaya')+$gajiApr->sum('upah')))
                    }}</th>
                <th class="text-center">{{ $tonaseJualApr->sum('tonase_jual')-$tonaseBeliApr->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $sisaJualApr->sum('tonase_sisa_terjual') }}</th>
                <th class="text-center">{{
                    ($tonaseJualApr->sum('tonase_jual')-$tonaseBeliApr->sum('tonase_beli'))+$sisaJualApr->sum('tonase_sisa_terjual')
                    }}</th>
            </tr>
        </tfoot>
    </table>
    {{-- April End --}}
    <br>
    {{-- MEI Start --}}
    <div class="judul">Bulan Mei</div>
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
            @php
            $no = 1;
            @endphp
            @foreach($periode->sortBy('tanggal_awal') as $item)
            @if (\Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('MM') == '05')
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD') }} - {{
                    \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD/MM/Y') }}</td>
                <td class="text-center">{{ $item->pembelian->sum('total_tonase') }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual') }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->pembelian->sum('total_biaya')) }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->penjualan->sum('total_jual')) }}</td>
                <td class="text-right">Rp.&nbsp;{{
                    number_format($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))
                    }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->biaya->sum('jumlah_biaya') +
                    $item->gaji->sum('gaji')) }}</td>

                <td class="text-right">Rp.&nbsp;{{
                    number_format(($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))-($item->biaya->sum('jumlah_biaya')
                    +
                    $item->gaji->sum('gaji'))) }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase') }}
                </td>
                <td class="text-center">{{ $item->sisa->sum('tonase_sisa_terjual') }}</td>
                <td class="text-center">{{
                    ($item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase'))+$item->sisa->sum('tonase_sisa_terjual')
                    }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-center">Total</th>
                <th class="text-center">{{ $tonaseBeliMei->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $tonaseJualMei->sum('tonase_jual') }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalBeliMei->sum('total_biaya')) }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalJualMei->sum('total_jual')) }}</th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualMei->sum('total_jual'))-($totalBeliMei->sum('total_biaya')))
                    }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($biayaMei->sum('jumlah_biaya')+$gajiMei->sum('upah'))
                    }}
                </th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualMei->sum('total_jual')-$totalBeliMei->sum('total_biaya'))-($biayaMei->sum('jumlah_biaya')+$gajiMei->sum('upah')))
                    }}</th>
                <th class="text-center">{{ $tonaseJualMei->sum('tonase_jual')-$tonaseBeliMei->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $sisaJualMei->sum('tonase_sisa_terjual') }}</th>
                <th class="text-center">{{
                    ($tonaseJualMei->sum('tonase_jual')-$tonaseBeliMei->sum('tonase_beli'))+$sisaJualMei->sum('tonase_sisa_terjual')
                    }}</th>
            </tr>
        </tfoot>
    </table>
    {{-- MEI End --}}
    <br>
    {{-- JUNI Start --}}
    <div class="judul">Bulan Juni</div>
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
            @php
            $no = 1;
            @endphp
            @foreach($periode->sortBy('tanggal_awal') as $item)
            @if (\Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('MM') == '06')
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD') }} - {{
                    \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD/MM/Y') }}</td>
                <td class="text-center">{{ $item->pembelian->sum('total_tonase') }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual') }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->pembelian->sum('total_biaya')) }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->penjualan->sum('total_jual')) }}</td>
                <td class="text-right">Rp.&nbsp;{{
                    number_format($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))
                    }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->biaya->sum('jumlah_biaya') +
                    $item->gaji->sum('gaji')) }}</td>

                <td class="text-right">Rp.&nbsp;{{
                    number_format(($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))-($item->biaya->sum('jumlah_biaya')
                    +
                    $item->gaji->sum('gaji'))) }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase') }}
                </td>
                <td class="text-center">{{ $item->sisa->sum('tonase_sisa_terjual') }}</td>
                <td class="text-center">{{
                    ($item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase'))+$item->sisa->sum('tonase_sisa_terjual')
                    }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-center">Total</th>
                <th class="text-center">{{ $tonaseBeliJun->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $tonaseJualJun->sum('tonase_jual') }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalBeliJun->sum('total_biaya')) }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalJualJun->sum('total_jual')) }}</th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualJun->sum('total_jual'))-($totalBeliJun->sum('total_biaya')))
                    }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($biayaJun->sum('jumlah_biaya')+$gajiJun->sum('upah'))
                    }}
                </th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualJun->sum('total_jual')-$totalBeliJun->sum('total_biaya'))-($biayaJun->sum('jumlah_biaya')+$gajiJun->sum('upah')))
                    }}</th>
                <th class="text-center">{{ $tonaseJualJun->sum('tonase_jual')-$tonaseBeliJun->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $sisaJualJun->sum('tonase_sisa_terjual') }}</th>
                <th class="text-center">{{
                    ($tonaseJualJun->sum('tonase_jual')-$tonaseBeliJun->sum('tonase_beli'))+$sisaJualJun->sum('tonase_sisa_terjual')
                    }}</th>
            </tr>
        </tfoot>
    </table>
    {{-- JUNI End --}}
    <br>
    {{-- JULI Start --}}
    <div class="judul">Bulan Juli</div>
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
            @php
            $no = 1;
            @endphp
            @foreach($periode->sortBy('tanggal_awal') as $item)
            @if (\Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('MM') == '07')
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD') }} - {{
                    \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD/MM/Y') }}</td>
                <td class="text-center">{{ $item->pembelian->sum('total_tonase') }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual') }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->pembelian->sum('total_biaya')) }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->penjualan->sum('total_jual')) }}</td>
                <td class="text-right">Rp.&nbsp;{{
                    number_format($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))
                    }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->biaya->sum('jumlah_biaya') +
                    $item->gaji->sum('gaji')) }}</td>

                <td class="text-right">Rp.&nbsp;{{
                    number_format(($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))-($item->biaya->sum('jumlah_biaya')
                    +
                    $item->gaji->sum('gaji'))) }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase') }}
                </td>
                <td class="text-center">{{ $item->sisa->sum('tonase_sisa_terjual') }}</td>
                <td class="text-center">{{
                    ($item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase'))+$item->sisa->sum('tonase_sisa_terjual')
                    }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-center">Total</th>
                <th class="text-center">{{ $tonaseBeliJul->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $tonaseJualJul->sum('tonase_jual') }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalBeliJul->sum('total_biaya')) }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalJualJul->sum('total_jual')) }}</th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualJul->sum('total_jual'))-($totalBeliJul->sum('total_biaya')))
                    }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($biayaJul->sum('jumlah_biaya')+$gajiJul->sum('upah'))
                    }}
                </th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualJul->sum('total_jual')-$totalBeliJul->sum('total_biaya'))-($biayaJul->sum('jumlah_biaya')+$gajiJul->sum('upah')))
                    }}</th>
                <th class="text-center">{{ $tonaseJualJul->sum('tonase_jual')-$tonaseBeliJul->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $sisaJualJul->sum('tonase_sisa_terjual') }}</th>
                <th class="text-center">{{
                    ($tonaseJualJul->sum('tonase_jual')-$tonaseBeliJul->sum('tonase_beli'))+$sisaJualJul->sum('tonase_sisa_terjual')
                    }}</th>
            </tr>
        </tfoot>
    </table>
    {{-- JULI End --}}
    <br>
    {{-- AGUSTUS Start --}}
    <div class="judul">Bulan Agustus</div>
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
            @php
            $no = 1;
            @endphp
            @foreach($periode->sortBy('tanggal_awal') as $item)
            @if (\Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('MM') == '08')
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD') }} - {{
                    \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD/MM/Y') }}</td>
                <td class="text-center">{{ $item->pembelian->sum('total_tonase') }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual') }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->pembelian->sum('total_biaya')) }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->penjualan->sum('total_jual')) }}</td>
                <td class="text-right">Rp.&nbsp;{{
                    number_format($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))
                    }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->biaya->sum('jumlah_biaya') +
                    $item->gaji->sum('gaji')) }}</td>

                <td class="text-right">Rp.&nbsp;{{
                    number_format(($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))-($item->biaya->sum('jumlah_biaya')
                    +
                    $item->gaji->sum('gaji'))) }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase') }}
                </td>
                <td class="text-center">{{ $item->sisa->sum('tonase_sisa_terjual') }}</td>
                <td class="text-center">{{
                    ($item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase'))+$item->sisa->sum('tonase_sisa_terjual')
                    }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-center">Total</th>

                <th class="text-center">{{ $tonaseBeliAug->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $tonaseJualAug->sum('tonase_jual') }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalBeliAug->sum('total_biaya')) }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalJualAug->sum('total_jual')) }}</th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualAug->sum('total_jual'))-($totalBeliAug->sum('total_biaya')))
                    }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($biayaAug->sum('jumlah_biaya')+$gajiAug->sum('upah'))
                    }}
                </th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualAug->sum('total_jual')-$totalBeliAug->sum('total_biaya'))-($biayaAug->sum('jumlah_biaya')+$gajiAug->sum('upah')))
                    }}</th>
                <th class="text-center">{{ $tonaseJualAug->sum('tonase_jual')-$tonaseBeliAug->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $sisaJualAug->sum('tonase_sisa_terjual') }}</th>
                <th class="text-center">{{
                    ($tonaseJualAug->sum('tonase_jual')-$tonaseBeliAug->sum('tonase_beli'))+$sisaJualAug->sum('tonase_sisa_terjual')
                    }}</th>
            </tr>
        </tfoot>
    </table>
    {{-- AGUSTUS End --}}
    <br>
    {{-- SEPTEMBER Start --}}
    <div class="judul">Bulan September</div>
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
            @php
            $no = 1;
            @endphp
            @foreach($periode->sortBy('tanggal_awal') as $item)
            @if (\Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('MM') == '09')
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD') }} - {{
                    \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD/MM/Y') }}</td>
                <td class="text-center">{{ $item->pembelian->sum('total_tonase') }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual') }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->pembelian->sum('total_biaya')) }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->penjualan->sum('total_jual')) }}</td>
                <td class="text-right">Rp.&nbsp;{{
                    number_format($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))
                    }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->biaya->sum('jumlah_biaya') +
                    $item->gaji->sum('gaji')) }}</td>

                <td class="text-right">Rp.&nbsp;{{
                    number_format(($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))-($item->biaya->sum('jumlah_biaya')
                    +
                    $item->gaji->sum('gaji'))) }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase') }}
                </td>
                <td class="text-center">{{ $item->sisa->sum('tonase_sisa_terjual') }}</td>
                <td class="text-center">{{
                    ($item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase'))+$item->sisa->sum('tonase_sisa_terjual')
                    }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-center">Total</th>

                <th class="text-center">{{ $tonaseBeliSep->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $tonaseJualSep->sum('tonase_jual') }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalBeliSep->sum('total_biaya')) }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalJualSep->sum('total_jual')) }}</th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualSep->sum('total_jual'))-($totalBeliSep->sum('total_biaya')))
                    }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($biayaSep->sum('jumlah_biaya')+$gajiSep->sum('upah'))
                    }}
                </th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualSep->sum('total_jual')-$totalBeliSep->sum('total_biaya'))-($biayaSep->sum('jumlah_biaya')+$gajiSep->sum('upah')))
                    }}</th>
                <th class="text-center">{{ $tonaseJualSep->sum('tonase_jual')-$tonaseBeliSep->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $sisaJualSep->sum('tonase_sisa_terjual') }}</th>
                <th class="text-center">{{
                    ($tonaseJualSep->sum('tonase_jual')-$tonaseBeliSep->sum('tonase_beli'))+$sisaJualSep->sum('tonase_sisa_terjual')
                    }}</th>
            </tr>
        </tfoot>
    </table>
    {{-- SEPTEMBER End --}}
    <br>
    {{-- OKTOBER Start --}}
    <div class="judul">Bulan Oktober</div>
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
            @php
            $no = 1;
            @endphp
            @foreach($periode->sortBy('tanggal_awal') as $item)
            @if (\Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('MM') == '10')
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD') }} - {{
                    \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD/MM/Y') }}</td>
                <td class="text-center">{{ $item->pembelian->sum('total_tonase') }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual') }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->pembelian->sum('total_biaya')) }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->penjualan->sum('total_jual')) }}</td>
                <td class="text-right">Rp.&nbsp;{{
                    number_format($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))
                    }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->biaya->sum('jumlah_biaya') +
                    $item->gaji->sum('gaji')) }}</td>

                <td class="text-right">Rp.&nbsp;{{
                    number_format(($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))-($item->biaya->sum('jumlah_biaya')
                    +
                    $item->gaji->sum('gaji'))) }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase') }}
                </td>
                <td class="text-center">{{ $item->sisa->sum('tonase_sisa_terjual') }}</td>
                <td class="text-center">{{
                    ($item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase'))+$item->sisa->sum('tonase_sisa_terjual')
                    }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-center">Total</th>

                <th class="text-center">{{ $tonaseBeliOkt->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $tonaseJualOkt->sum('tonase_jual') }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalBeliOkt->sum('total_biaya')) }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalJualOkt->sum('total_jual')) }}</th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualOkt->sum('total_jual'))-($totalBeliOkt->sum('total_biaya')))
                    }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($biayaOkt->sum('jumlah_biaya')+$gajiOkt->sum('upah'))
                    }}
                </th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualOkt->sum('total_jual')-$totalBeliOkt->sum('total_biaya'))-($biayaOkt->sum('jumlah_biaya')+$gajiOkt->sum('upah')))
                    }}</th>
                <th class="text-center">{{ $tonaseJualOkt->sum('tonase_jual')-$tonaseBeliOkt->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $sisaJualOkt->sum('tonase_sisa_terjual') }}</th>
                <th class="text-center">{{
                    ($tonaseJualOkt->sum('tonase_jual')-$tonaseBeliOkt->sum('tonase_beli'))+$sisaJualOkt->sum('tonase_sisa_terjual')
                    }}</th>
            </tr>
        </tfoot>
    </table>
    {{-- OKTOBER End --}}
    <br>
    {{-- NOVEMBER Start --}}
    <div class="judul">Bulan November</div>
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
            @php
            $no = 1;
            @endphp
            @foreach($periode->sortBy('tanggal_awal') as $item)
            @if (\Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('MM') == '11')
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD') }} - {{
                    \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD/MM/Y') }}</td>
                <td class="text-center">{{ $item->pembelian->sum('total_tonase') }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual') }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->pembelian->sum('total_biaya')) }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->penjualan->sum('total_jual')) }}</td>
                <td class="text-right">Rp.&nbsp;{{
                    number_format($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))
                    }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->biaya->sum('jumlah_biaya') +
                    $item->gaji->sum('gaji')) }}</td>

                <td class="text-right">Rp.&nbsp;{{
                    number_format(($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))-($item->biaya->sum('jumlah_biaya')
                    +
                    $item->gaji->sum('gaji'))) }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase') }}
                </td>
                <td class="text-center">{{ $item->sisa->sum('tonase_sisa_terjual') }}</td>
                <td class="text-center">{{
                    ($item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase'))+$item->sisa->sum('tonase_sisa_terjual')
                    }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-center">Total</th>

                <th class="text-center">{{ $tonaseBeliNov->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $tonaseJualNov->sum('tonase_jual') }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalBeliNov->sum('total_biaya')) }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalJualNov->sum('total_jual')) }}</th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualNov->sum('total_jual'))-($totalBeliNov->sum('total_biaya')))
                    }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($biayaNov->sum('jumlah_biaya')+$gajiNov->sum('upah'))
                    }}
                </th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualNov->sum('total_jual')-$totalBeliNov->sum('total_biaya'))-($biayaNov->sum('jumlah_biaya')+$gajiNov->sum('upah')))
                    }}</th>
                <th class="text-center">{{ $tonaseJualNov->sum('tonase_jual')-$tonaseBeliNov->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $sisaJualNov->sum('tonase_sisa_terjual') }}</th>
                <th class="text-center">{{
                    ($tonaseJualNov->sum('tonase_jual')-$tonaseBeliNov->sum('tonase_beli'))+$sisaJualNov->sum('tonase_sisa_terjual')
                    }}</th>
            </tr>
        </tfoot>
    </table>
    {{-- NOVEMBER End --}}
    <br>
    {{-- DESEMBER Start --}}
    <div class="judul">Bulan Desember</div>
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
            @php
            $no = 1;
            @endphp
            @foreach($periode->sortBy('tanggal_awal') as $item)
            @if (\Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('MM') == '12')
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD') }} - {{
                    \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD/MM/Y') }}</td>
                <td class="text-center">{{ $item->pembelian->sum('total_tonase') }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual') }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->pembelian->sum('total_biaya')) }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->penjualan->sum('total_jual')) }}</td>
                <td class="text-right">Rp.&nbsp;{{
                    number_format($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))
                    }}</td>
                <td class="text-right">Rp.&nbsp;{{ number_format($item->biaya->sum('jumlah_biaya') +
                    $item->gaji->sum('gaji')) }}</td>

                <td class="text-right">Rp.&nbsp;{{
                    number_format(($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))-($item->biaya->sum('jumlah_biaya')
                    +
                    $item->gaji->sum('gaji'))) }}</td>
                <td class="text-center">{{ $item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase') }}
                </td>
                <td class="text-center">{{ $item->sisa->sum('tonase_sisa_terjual') }}</td>
                <td class="text-center">{{
                    ($item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase'))+$item->sisa->sum('tonase_sisa_terjual')
                    }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" class="text-center">Total</th>

                <th class="text-center">{{ $tonaseBeliDes->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $tonaseJualDes->sum('tonase_jual') }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalBeliDes->sum('total_biaya')) }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($totalJualDes->sum('total_jual')) }}</th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualDes->sum('total_jual'))-($totalBeliDes->sum('total_biaya')))
                    }}</th>
                <th class="text-right">Rp.&nbsp;{{ number_format($biayaDes->sum('jumlah_biaya')+$gajiDes->sum('upah'))
                    }}
                </th>
                <th class="text-right">Rp.&nbsp;{{
                    number_format(($totalJualDes->sum('total_jual')-$totalBeliDes->sum('total_biaya'))-($biayaDes->sum('jumlah_biaya')+$gajiDes->sum('upah')))
                    }}</th>
                <th class="text-center">{{ $tonaseJualDes->sum('tonase_jual')-$tonaseBeliDes->sum('tonase_beli') }}</th>
                <th class="text-center">{{ $sisaJualDes->sum('tonase_sisa_terjual') }}</th>
                <th class="text-center">{{
                    ($tonaseJualDes->sum('tonase_jual')-$tonaseBeliDes->sum('tonase_beli'))+$sisaJualDes->sum('tonase_sisa_terjual')
                    }}</th>
            </tr>
        </tfoot>
    </table>
    {{-- DESEMBER End --}}



</body>

</html>