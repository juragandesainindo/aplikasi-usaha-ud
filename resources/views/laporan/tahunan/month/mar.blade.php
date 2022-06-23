<div class="pb-20 pd-20">
    <div class="table-responsive">
        <h6>BULAN MARET</h6>
        <table class="table table-bordered text-center">
            <thead style="background: #DAEEF3;">
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Tanggal</th>
                    <th colspan="2">Total Buah/KG</th>
                    <th rowspan="2">Pembelian</th>
                    <th rowspan="2">Penjualan</th>
                    <th rowspan="2">Pendapatan</th>
                    <th rowspan="2">Operasional+Gaji</th>
                    <th rowspan="2">Total</th>
                    <th rowspan="2">Selisih</th>
                    <th rowspan="2">Terjual Lagi</th>
                    <th rowspan="2">Sortir</th>
                </tr>
                <tr>
                    <th>Pembelian</th>
                    <th>Penjualan</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no=1;
                @endphp
                @foreach($periode->sortBy('tanggal_awal') as $key => $item)
                @if (\Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('MM') == '03')
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD') }} - {{
                        \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD/MM/Y') }}</td>
                    <td>{{ $item->pembelian->sum('total_tonase') }}</td>
                    <td>{{ $item->penjualan->sum('tonase_jual') }}</td>
                    <td>Rp.&nbsp;{{ number_format($item->pembelian->sum('total_biaya')) }}</td>
                    <td>Rp.&nbsp;{{ number_format($item->penjualan->sum('total_jual')) }}</td>
                    <td>Rp.&nbsp;{{
                        number_format($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))
                        }}</td>
                    <td>Rp.&nbsp;{{ number_format($item->biaya->sum('jumlah_biaya') +
                        $item->gaji->sum('gaji')) }}</td>

                    <td>Rp.&nbsp;{{
                        number_format(($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))-($item->biaya->sum('jumlah_biaya')
                        +
                        $item->gaji->sum('gaji'))) }}</td>
                    <td>{{ $item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase') }}
                    </td>
                    <td>{{ $item->sisa->sum('tonase_sisa_terjual') }}</td>
                    <td>{{
                        ($item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase'))+$item->sisa->sum('tonase_sisa_terjual')
                        }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
            <tfoot style="background: #DAEEF3;">
                <tr>
                    <th></th>
                    <th>Total</th>
                    <th>{{ $tonaseBeliMar->sum('tonase_beli') }}</th>
                    <th>{{ $tonaseJualMar->sum('tonase_jual') }}</th>
                    <th>Rp.&nbsp;{{ number_format($totalBeliMar->sum('total_biaya')) }}</th>
                    <th>Rp.&nbsp;{{ number_format($totalJualMar->sum('total_jual')) }}</th>
                    <th>Rp.&nbsp;{{
                        number_format(($totalJualMar->sum('total_jual'))-($totalBeliMar->sum('total_biaya')))
                        }}</th>
                    <th>Rp.&nbsp;{{ number_format($biayaMar->sum('jumlah_biaya')+$gajiMar->sum('upah')) }}
                    </th>
                    <th>Rp.&nbsp;{{
                        number_format(($totalJualMar->sum('total_jual')-$totalBeliMar->sum('total_biaya'))-($biayaMar->sum('jumlah_biaya')+$gajiMar->sum('upah')))
                        }}</th>
                    <th>{{ $tonaseJualMar->sum('tonase_jual')-$tonaseBeliMar->sum('tonase_beli') }}</th>
                    <th>{{ $sisaJualMar->sum('tonase_sisa_terjual') }}</th>
                    <th>{{
                        ($tonaseJualMar->sum('tonase_jual')-$tonaseBeliMar->sum('tonase_beli'))+$sisaJualMar->sum('tonase_sisa_terjual')
                        }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>