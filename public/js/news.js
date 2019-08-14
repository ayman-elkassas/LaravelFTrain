$(function () {

    //actions
    $('#add_news').click(function () {
        var form=$("#news").serialize();
        var url=$('#news').attr('action');

        $.ajax({
            url:url,
            type:'post',
            data:form,
            dataType:'json',
            beforeSend:function () {

                $('#alert_error h2').empty();
                $('.alert_error ul').empty();

            },success:function (data) {
                if(data.status==true)
                {
                    //alert(data.result);
                    //result as html row
                    $('.list_news tbody').append(data.result);
                    // alert(data.result);
                }
            },error:function (error,ex) {
                if(ex=='error')
                {
                    $('#alert_error h2').html(error.responseJSON.message);

                    var error_list='';
                    $.each(error.responseJSON.errors,function (index,v) {
                        error_list+='<li>'+v+'</li>';
                    });
                    $('#alert_error ul').html(error_list);
                }
            }
        });

    });

});