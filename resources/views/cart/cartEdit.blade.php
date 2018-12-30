{!! Form::model($model, [
    'route' => ['cart.update', $model->id_cart],
    'method' => 'PUT',
    'class' => 'form-editJumlah-submit',
]) !!}

<div class="form-group">
    {!! Form::label('jumlah', 'Jumlah', ['class' => 'control-label']) !!}
    {!! Form::number('jumlah', null, ['id' => 'jumlah', 'class' => 'form-control']) !!}
</div>

{!! Form::close() !!}

<script>
    $(document).ready(function(){
        $('.btn-save').removeClass('btn-save').addClass('btn-editJumlah');

        $('body').on('click', '.btn-editJumlah', function(e){
            $('.form-editJumlah-submit').submit();
        });

        $('.form-editJumlah-submit').on('submit', function(e){
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
                    $('#total_harga').html('<b> Rp '+ toRupiah(ok) +'</b>')
                                        .attr('data-uang', ok);
                    $('#modal').modal('hide');
                    swal({
                        icon: 'success',
                        title: 'Data telah diubah!',
                    });  
                },
                error: function(xhr)
                {
                    swal({
                        icon: 'error',
                        title: 'Opss.. Something happened',
                    });
                },
            })                
        });
    });
</script>