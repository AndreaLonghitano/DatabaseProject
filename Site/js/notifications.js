setInterval(notifications,2000);

    

function notifications(){
    $.ajax({
        url:"../Site/json/Inviti.php",
        success:function(data){
            $("#notifiche").empty();
            var dati=$.parseJSON(data);
            if(dati.length==0){
                if ($('#beep').hasClass('beep'))$('#beep').removeClass('beep');
            }
            else{
                if (!($('#beep').hasClass('beep')))$('#beep').addClass('beep');
                $.each(dati,function(index,elemento){
                 $("#notifiche").append('<a href="../Site/AcceptInvite.php?meeting='+elemento.id+'&id='+elemento.userid+'" class="dropdown-item"><img alt="image" src="../Site/'+elemento.photo+'" class="rounded-circle dropdown-item-img"><div class="dropdown-item-desc"><b>'+elemento.utente+'</b> ti ha invitato all evento <b>'+elemento.title+'</b></div></a>');
            })
            }
        }   
    })
}
    