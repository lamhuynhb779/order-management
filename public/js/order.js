$(document).ready(function(){
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
                alert(res.message);
                location.reload();
            },
            error: function(err){
                console.log(err);
            }
        });
    });
});
