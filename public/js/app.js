$('body').on('click', '.btn-show', function(e){
    e.preventDefault();
    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    me.hasClass('btn-detail') ? $('.btn-save').hide() : $('.btn-save').show();
    $('.modal-title').html(title == '' ? 'Tambah Data' : title);
    $('.btn-save').html(me.hasClass('btn-warning') ? 'Update' : 'Submit');

    $.ajax({
        url: url,
        dataType: 'html',
        success: function(ok)
        {
            $('.modal-body').html(ok);
        }
    });

    $('#modal').modal('show');
});

$('body').on('click', '.btn-save', function(e){
    e.preventDefault();

    var form = $('.form-submit'),
        url = form.attr('action'),
        method = form.attr('method'),
        formData = new FormData(form[0]);

    $.ajax({
        url: url,
        method: method,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(ok)
        {
            $('#datatable').DataTable().ajax.reload();
            $('.form-submit').trigger('reset');
            $('#modal').modal('hide');
            swal({
                title: 'Success!',
                text: 'Data berhasil di simpan!',
                icon: 'success',
                button: 'OK',
            });
        },
        error: function(xhr)
        {
            var err = xhr.responseJSON;
            
            $('.control-label').find('.fa').remove()
                                .prepend('<i class="fa fa-check"></i>');

            $('.form-group').removeClass('has-error')
                            .addClass('has-success')
                            .find('.help-block').remove();                                                      

            if ($.isEmptyObject(err) == false)
            {
                $.each(err.errors, function(key, value) {
                    var div = $('#' + key).closest('.form-group');
    
                    div.addClass('has-error')
                        .append('<span class="help-block">'+ value +'</span>');
                    
                    var isi = div.find('.control-label').text();    
                    div.find('.control-label').html('<i class="fa fa-times-circle-o"></i> '+ isi);    
                        
                });
            }
        }
    })
});

$('body').on('click', '.btn-delete', function(e){
    e.preventDefault();
    var token = $('meta[name="csrf-token"]').attr('content'),
        url = $(this).attr('href');

    swal({
        title: 'Anda yakin ingin menghapus data ini ?',
        text: 'Data tidak bisa dikembalikan setelah dihapus!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    })
    .then((result) => {
        if (result)
        {
            $.ajax({
                url: url,
                type: 'POST',
                data: 
                {
                    '_method': 'DELETE',
                    '_token': token,
                },
                success: function(e)
                {                     
                    swal({
                        icon: 'success',
                        title: 'Data berhasil dihapus!',
                    });
                    $('#datatable').DataTable().ajax.reload();
                },
                error: function(ok)
                {
                    console.log(ok);
                    swal({
                        icon: 'error',
                        title: 'Opss.. something happened!',
                    });
                }
            });
        }
    })   
});

$('#form-tambahBuku').on('submit', function(e) {
    e.preventDefault();
    
    var me = $(this),
        url = me.attr('action'),
        method = me.attr('method');

    $.ajax({
        url: url,
        method: method,
        data: me.serialize(),
        success: function(ok)
        {     
            if(ok.status == false){
                console.log('ea');
                $('#buku').closest('.form-group').addClass('has-error').append('<span class="help-block">Stok buku sudah habis!</span>');
            } else {
                me.find('.has-error').removeClass()
                .find('.help-block').remove();

                $("input[name='jumlahB']").val('');

                $('#datatable').DataTable().ajax.reload();
                $('#total_harga').html('<b>Rp '+ toRupiah(ok) +'</b>');       
                $('#total_harga').attr('data-uang', ok);  
            }
        },
        error: function(xhr)
        {
            var err= xhr.responseJSON;

            console.log(err);             
            
            $('.help-block').remove();

            if ($.isEmptyObject(err) == false)
            {
                $.each(err.errors, function(key, value){
                    var div = $('#'+ key);

                    div.closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+ value +'</span>');
                });
            }
        },
    });       
});

$('#form-single-submit').on('submit', function(e){
    e.preventDefault();

    var me = $(this),
        url = me.attr('action'),
        method = me.attr('method');

    $.ajax({
        url: url,
        method: method,
        data: me.serialize(),
        success: function(ok)
        {
            $('#datatable').DataTable().ajax.reload();
            $('#total_harga').html('Rp 0');
            $('#uang_pelanggan').val('');
            $('#uang_kembali').val('');
            swal({
                title: 'Success!',
                text: 'Pembelian berhasil dilakukan !',
                icon: 'success',
                button: 'OK',
            });
        },
        error: function(xhr)
        {
            swal({
                dangerMode: true,
                icon: 'error',
                title: 'Opss.. something happened!',
            });
        }
    })        
});

$('#btn-clearAll').on('click', function(e){
    e.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        token = $("meta[name=csrf-token]").attr('content');
    
    swal({
        icon: 'warning',
        dangerMode: true,
        title: 'Yakin ingin menghapus semua item dari cart?',
        buttons: true,
        dangerMode: true,
    }).then((result) => {
        if (result) {
            $.ajax({
                url: url,
                method: 'DELETE',
                data: {'_token': token},
                success: function(ok)
                {
                    $('#datatable').DataTable().ajax.reload();
                    swal({
                        icon: 'success',
                        title: 'Cart berhasil dibersihkan!',
                    });
                },
                error: function(xhr)
                {
                    console.log(xhr);
                    swal({
                        icon: 'error',
                        title: 'Opss.. Something bad happened',
                    });
                },
            });
        }
    });
});

$('#form-account').on('submit', function(e){
    e.preventDefault();

    var me = $(this),
        url = me.attr('action'),
        method = me.attr('method');

    $.ajax({
        url: url,
        method: method,
        data: new FormData(me[0]),
        cache: false,
        processData: false,
        contentType: false,
        success: function(ok)
        {
            location.reload();
        },
        error: function(xhr)
        {
            var err = xhr.responseJSON;
            
            me.find('.has-error').removeClass('has-error').addClass('has-success');
            me.find('.help-block').remove();

            if ($.isEmptyObject(err) == false)
            {
                $.each(err.errors, function(key, value){
                    var div = $('#' + key).closest('.form-group');

                    div.addClass('has-error').append('<span class="help-block">'+ value +'</span>');
                });
            }          
        },
    });        
});

// Static
function toRupiah(bilangan)
{	
    var	number_string = bilangan.toString(),
        sisa 	= number_string.length % 3,
        rupiah 	= number_string.substr(0, sisa),
        ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
            
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return rupiah;
}

var rupiah = document.getElementById("uang_pelanggan");
rupiah.addEventListener("keyup", function(e) {
  // tambahkan 'Rp.' pada saat form di ketik
  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  rupiah.value = formatRupiah(this.value);
});

/* Fungsi formatRupiah */
function formatRupiah(angka) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return rupiah;
}