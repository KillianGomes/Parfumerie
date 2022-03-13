$(function(){
    const stripe = Stripe("pk_test_51Id9wIItUKRFLh1H05Y6ZlS5jA8B4i8BB4zUGDT3ja0DuHrvnSg9aRsHdgmrtLOXHxkXkPhFRN6jghYrXRtHWtk100y73ksq9c");
    const checkoutButton = $('#checkout-button');
    checkoutButton.on('click', function(e){
        e.preventDefault();
        console.log($('#nb').val());
        $.ajax({
            url:'index.php?action=pay',
            method:'post',
            data:{
                id: $('#ref').val(),
                marque: $('#marque').val(),
                modele: $('#modele').val(),
                contenance: $('#contenance').val(),
                prix: $('#prix').val(),
                email: $('#email').val(),
                quantite: $('#quant').val(),
                nb: $('#nb').val()
            },
            datatype: 'json',
            success:function(session){
                console.log(session);
                return stripe.redirectToCheckout({ sessionId: session.id });
            },
            error: function(){
                console.error("fail to send!");
            }
        });
    })
});