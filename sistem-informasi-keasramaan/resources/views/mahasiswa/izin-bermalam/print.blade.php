<style>
    * {box-sizing: border-box;}
    .all-columns{
        float: left;
        width: 32.33%;
        padding: 1px;
        text-align: center;
    }

    .all-rows:after{
        content: "";
        display: table;
        clear: both;
    }

    .text-name {
        padding-top: 45px;
    }

    .text-info{
        line-height: 0.1;
    }

    .text-realisasi{
        line-height: 1.7;
    }
</style>

@foreach ($dataIB as $item)
    <h3 style="font-size: 18px"><u>Surat Izin Bermalam Mahasiswa</h3></u><br><br><br>



    <p>DIBERIKAN IZIN BERMALAM KEPADA:</p>
    <p class="text-nama">Nama: {{ $item->nama }}</p><br>
    
    <p><b>Rencana IB</b></p>
    <p class="text-info">Tanggal Berangkat: {{ \Carbon\Carbon::parse($item->rencana_berangkat)->isoFormat('DD MMMM YYYY') }}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span>Pukul: {{ \Carbon\Carbon::parse($item->rencana_berangkat)->isoFormat('H:mm:ss') }}</span>
    </p>
    <p class="text-info">Keperluan: {{ $item->keperluan_ib }}</p>
    <p class="text-info">Tanggal Kembali: {{ \Carbon\Carbon::parse($item->rencana_kembali)->isoFormat('DD MMMM YYYY') }}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span>Pukul: {{ \Carbon\Carbon::parse($item->rencana_kembali)->isoFormat('H:mm:ss') }}</span>
    </p>
    <p class="text-info">Tujuan: {{ $item->tempat_tujuan }}</p>

    <br>
    {{-- <p style="margin-bottom: 40px;"></p> --}}

    <div class="all-rows">
        <div class="all-columns">
            <p>Pemohon</p>
            <p class="text-name">({{ $item->nama }})</p>
        </div>
        <div class="all-columns">
            <p>Menyetujui, petugas</p>
            <p class="text-name">({{ $item->petugas->nama }})</p>
        </div>
        <div class="all-columns">
            <p>Diketahui, orangtua/wali</p>
            <p class="text-name">(.........................................)</p>
        </div>
    </div>

    <p style="color: #fc3003; text-align: justify; font-size: 11px;">* Sebelum meninggalkan asrama untuk IB, mahasiswa/i
        dianjurkan untuk permisi kepada Bapak/Ibu asrama atau Abang/Kakak asrama.</p>
    <hr>
    <p class="text-realisasi"><b>Realisasi IB (diisi oleh petugas)</b></p>
    Tanggal kembali: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Pukul:
    </span>

    <p>Petugas</p><br><br>

    (.........................................)
@endforeach
