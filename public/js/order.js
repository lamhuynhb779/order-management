$(document).ready(function(){
    $('#add-button').click(function (e) {
        e.preventDefault();
        let span = $(this).find('span')[0];
        if (span.innerText === 'Add new order') {
            span.innerText = 'Hide new order';
            $(".box-add").css('opacity', 1);
        } else {
            span.innerText = 'Add new order';
            $(".box-add").css('opacity', 0);
        }
    });

    let closeBtn = $(".close");
    if (closeBtn) {
        closeBtn.click(function (){
            $(".msg").css('display', 'none');
        });
    }

    $(".del").click(function(e){
        e.preventDefault();
        $.ajax({
            url:"/orders/" + $(this).data('id'),
            method:'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res){
                if (res.status === 1) {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            },
            error: function(err){
                console.log(err);
            }
        });
    });

    $(".btn-update").click(function(e){
        e.preventDefault();

        let currentState = parseInt($(this).data('state'));
        let orderId = parseInt($(this).data('id'));

        let tr = $(this).parent().parent();
        let optionSelected = tr.find('#state-options option:selected')
        let valueSelected = parseInt(optionSelected.val());

        if (valueSelected > currentState) {
            $.ajax({
                url:"/order-states/" + orderId,
                method:'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'state_id': valueSelected
                },
                success: function(res){
                    if (res.status === 1) {
                        alert(res.message);
                        location.reload();
                    } else {
                        alert(res.message);
                    }
                },
                error: function(err){
                    console.log(err);
                }
            });
        }

    });
});
