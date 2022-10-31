$('#jenis_berkas').select2({
    width: '100%'
})

// Menampilkan alamat hanya jika metode pengambilan = dikirim
$('input[type=radio][name=metode_pengambilan]').change(function() {
    if (this.value == '2') {
        $('#alamat').removeClass('hidden')
    } else if (this.value == '1') {
        $('#alamat').addClass('hidden')
    }
});

//Menentukan Biaya Legalisir berdasarkan jumlah lembar
$('#jumlah_ijazah').on('input', function() {
    var jumlah = $(this).val()
    $('#biaya_ijazah').val(rupiah(jumlah * 10000))
})
$('#jumlah_transkrip').on('input', function() {
    var jumlah = $(this).val()
    $('#biaya_transkrip').val(rupiah(jumlah * 10000))
})
$('#jumlah_akreditasi').on('input', function() {
    var jumlah = $(this).val()
    $('#biaya_akreditasi').val(rupiah(jumlah * 10000))
})

initFormAjax('#form-pengajuan', {
    success: function(response) {
        toastr.success(response.message)
            setTimeout(function() {
                location.href = `${base_url}/riwayat/`
            }, 1500);
    },
    error: function(xhr) {
        const response = xhr.responseJSON
        toastr.error(response.message)
    }
})

$('.jenis_berkas').on('change', function() {
    var berkas_id = $(this).val()
    if ($(this).is(':checked')) {
        if (berkas_id == 1) {
            $.ajax({
                url: `${base_url}/pengajuan/is_ijazah/${session_nim}`,
                success: function(response) {
                    $('#new_berkas_ijazah').addClass('hidden')
                    $('#old_berkas_ijazah').addClass('hidden')
                    $('#radio_berkas_ijazah').removeClass('hidden');
                    $('#jumlah_berkas_ijazah').removeClass('hidden');
                    $('#old_berkas_ijazah').html(`
                        <a href="${base_url}/berkas/${response.data.nama_file}" target="_blank" class="inline-block px-16 py-3.5 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-slate-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-size-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">Lihat Ijazah Tersimpan</a>
                        <input type="hidden" name="new_berkas_ijazah" value="${response.data.nama_file}">
                    `)
                },
                error: function(xhr) {
                    $('#radio_berkas_ijazah').addClass('hidden');
                    $('#new_berkas_ijazah').removeClass('hidden')
                    $('#jumlah_berkas_ijazah').removeClass('hidden');
                    $('#old_berkas_ijazah').addClass('hidden')
                }
            })
        } else if(berkas_id == 2) {
            $.ajax({
                url: `${base_url}/pengajuan/is_transkrip/${session_nim}`,
                success: function(response) {
                    $('#new_berkas_transkrip').addClass('hidden')
                    $('#old_berkas_transkrip').addClass('hidden')
                    $('#radio_berkas_transkrip').removeClass('hidden');
                    $('#jumlah_berkas_transkrip').removeClass('hidden');
                    $('#old_berkas_transkrip').html(`
                        <a href="${base_url}/berkas/${response.data.nama_file}" target="_blank" class="inline-block px-16 py-3.5 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-slate-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-size-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">Lihat Transkrip Tersimpan</a>
                        <input type="hidden" name="new_berkas_transkrip" value="${response.data.nama_file}">
                    `)
                },
                error: function(xhr) {
                    $('#radio_berkas_transkrip').addClass('hidden');
                    $('#new_berkas_transkrip').removeClass('hidden')
                    $('#old_berkas_transkrip').addClass('hidden')
                    $('#jumlah_berkas_transkrip').removeClass('hidden');

                }
            })
        }else{
            $.ajax({
                url: `${base_url}/pengajuan/is_akreditasi/${session_nim}`,
                success: function(response) {
                    $('#new_berkas_akreditasi').addClass('hidden')
                    $('#old_berkas_akreditasi').addClass('hidden')
                    $('#radio_berkas_akreditasi').removeClass('hidden');
                    $('#jumlah_berkas_akreditasi').removeClass('hidden');
                    $('#old_berkas_akreditasi').html(`
                        <a href="${base_url}/berkas/${response.data.nama_file}" target="_blank" class="inline-block px-16 py-3.5 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-slate-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-size-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">Lihat Transkrip Tersimpan</a>
                        <input type="hidden" name="new_berkas_akreditasi" value="${response.data.nama_file}">
                    `)
                },
                error: function(xhr) {
                    $('#radio_berkas_akreditasi').addClass('hidden');
                    $('#new_berkas_akreditasi').removeClass('hidden')
                    $('#old_berkas_akreditasi').addClass('hidden')
                    $('#jumlah_berkas_akreditasi').removeClass('hidden');
                }
            })
        }           
    }else{
        if (berkas_id == 1) {
            $('#new_berkas_ijazah').addClass('hidden')
            $('#old_berkas_ijazah').addClass('hidden')
            $('#radio_berkas_ijazah').addClass('hidden');
            $('#jumlah_berkas_ijazah').addClass('hidden');
            $('#jumlah_ijazah').val('');
            $('#biaya_ijazah').val('');            
        } else if(berkas_id == 2) {
            $('#new_berkas_transkrip').addClass('hidden')
            $('#old_berkas_transkrip').addClass('hidden')
            $('#radio_berkas_transkrip').addClass('hidden');
            $('#jumlah_berkas_transkrip').addClass('hidden');
            $('#jumlah_transkrip').val('');
            $('#biaya_transkrip').val('');            
        }else{
            $('#new_berkas_akreditasi').addClass('hidden')
            $('#old_berkas_akreditasi').addClass('hidden')
            $('#radio_berkas_akreditasi').addClass('hidden');
            $('#jumlah_berkas_akreditasi').addClass('hidden');
            $('#jumlah_akreditasi').val('');
            $('#biaya_akreditasi').val('');            
        }           
    }
})




$('input[type=radio][name=radio_berkas_ijazah]').change(function() {
    if (this.value == '1') {
        $('#new_berkas_ijazah').removeClass('hidden')
        $('#old_berkas_ijazah').addClass('hidden')
    } else if (this.value == '2') {
        $('#old_berkas_ijazah').removeClass('hidden')
        $('#new_berkas_ijazah').addClass('hidden')
    }
});
$('input[type=radio][name=radio_berkas_transkrip]').change(function() {
    if (this.value == '1') {
        $('#new_berkas_transkrip').removeClass('hidden')
        $('#old_berkas_transkrip').addClass('hidden')
    } else if (this.value == '2') {
        $('#old_berkas_transkrip').removeClass('hidden')
        $('#new_berkas_transkrip').addClass('hidden')
    }
});
$('input[type=radio][name=radio_berkas_akreditasi]').change(function() {
    if (this.value == '1') {
        $('#new_berkas_akreditasi').removeClass('hidden')
        $('#old_berkas_akreditasi').addClass('hidden')
    } else if (this.value == '2') {
        $('#old_berkas_akreditasi').removeClass('hidden')
        $('#new_berkas_akreditasi').addClass('hidden')
    }
});