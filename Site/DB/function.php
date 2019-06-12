<?php

function checkUserPassword($username,$password){
    global $conn;
    $query="select user_id from Account where username='".$username."' and passw='".$password."';";
    $result=mysqli_query($conn,$query);
    if($rowcount=mysqli_num_rows($result))return 1;
    else return 0;
}

 function query($query){
        global $conn;
        if($result=mysqli_query($conn,$query))return 1; // ritorna 1 se non ci sono errori
        else return 0; // ritorna 0 se ci sono errori
    }
    
/* Con la seguente funzione controllo se l'utente gia esiste */
function checkUsername($username){
        global $conn;
        $result=mysqli_query($conn,"select username from Account where username='".$username."';");
        if($rowcount=mysqli_num_rows($result))return 1;
        else return 0;
}

function checkEmail($email){
    global $conn;
    $result=mysqli_query($conn,"select * from users where email='".$email."';");
    if($rowcount=mysqli_num_rows($result))return 1;
    else return 0;
}

function getUserID($username){
    global $conn;
    $query="select user_id from Account where username='".$username."';"; /* L'username è unico pertanto anche l'user_id sara unico */
    $result=mysqli_query($conn,$query); 
    if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) return $row['user_id'];
    else return -1; /* un valore negativo è errore */
}

function getName($userid){
    global $conn;
    $query="select name from users where user_id=$userid;";
    $result=mysqli_query($conn,$query);
    if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) return $row['name'];
    else return -1;
}

function getSurname($userid){
    global $conn;
    $query="select surname from users where user_id=$userid;";
    $result=mysqli_query($conn,$query);
    if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) return $row['surname'];
    else return -1;
}

function getEmail($userid){
    global $conn;
    $query="select email from users where user_id=$userid;";
    $result=mysqli_query($conn,$query);
    if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) return $row['email'];
    else return -1;
}

function getUrlPhoto($userid){
    global $conn;
    $query="select photo from users where user_id=$userid;";
    $result=mysqli_query($conn,$query);
    if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) return $row['photo'];
    else return -1;
}


function getBirthDate($userid){
    global $conn;
    $query="select birth from users where user_id=$userid;";
    $result=mysqli_query($conn,$query);
    if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) return $row['birth'];
    else return -1;
}


function getCompanyId($company_name,$place){
    global $conn;
    $query="select company_id from company where name='".$company_name."' and place='".$place."';"; // nome e place sono unique
    $result=mysqli_query($conn,$query);
    if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) return $row['company_id'];
    else return -1;
}

function getRoleFromWork($workid){
    global $conn;
    $result=mysqli_query($conn,"select role from work_experience where work_experience_id=".$workid.";");
    if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) return $row['role'];
    else return -1;
}


function getYearFromWork($workid){
    global $conn;
    $result=mysqli_query($conn,"select year from work_experience where work_experience_id=".$workid.";");
    if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) return $row['year'];
    else return -1;   
}

function getYearFromEdu($eduid){
    global $conn;
    $result=mysqli_query($conn,"select year from education_experience where education_experience_id=".$eduid.";");
    if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) return $row['year'];
    else return -1; 
}

function getPlaceFromEdu($eduid){
    global $conn;
    $result=mysqli_query($conn,"select place from education_experience where education_experience_id=".$eduid.";");
    if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) return $row['place'];
    else return -1; 
}

function SendInvite($meeting,$title,$place,$date,$invitati,$invitante){
    global $conn;
    $namecreatore=getName($invitante);
    $surnamecreatore=getSurname($invitante);
    $result=mysqli_query($conn,"select C.phone from meeting M join cards C on M.card_id=C.card_id where M.meeting_id='".$meeting."';");
    if($row=mysqli_fetch_array($result,MYSQLI_ASSOC))$tel=$row['phone'];
    $timestamp=explode("T",$date);
    
    $date=$timestamp[0];
    
    $time=$timestamp[1];
    
    $subject = 'Invite to Meeting';
    $headers = "From: " . "andrealonglg96@gmail.com". "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    foreach($invitati as $i){
        
        $nameinvitato=getName($i);
        $surnameinvitato=getSurname($i);
        $to=getEmail($i); // prendo email dell'invitato
        
        $message="";
        $message = '<html><body>';
        $message .= '<p>Ciao '.$nameinvitato.' '.$surnameinvitato.'</p>';
        $message .='<p>Sei stato invitato al meeting ' .$title .' il quale si svolgera a '.$place.' in data '.$date.' alle ore '.$time.'.<br/>Il meeting &egrave; stato organizzato da '.$namecreatore.' '.$surnamecreatore.' il quale sarebbe contento della tua presenza. Fai sapere una risposta al pi&uacute; presto al creatore dello evento</p>';
    
    // modificare qusto messaggio
        $message.='<a href="http://127.0.0.1/Site/Site/AcceptInvite.php?meeting='.$meeting.'&id='.$i.'">Clicca qui per accettare l invito</a><br/>';
        $message .= 'Ti ricordo che potrai anche contattarmi al numero '.$tel.' per confermare la tua presenza.<br/>Cordiali Saluti.';
        $message .= '</body></html>';
        
        mail($to,$subject,$message,$headers);
    }
}

function sendEmailUpdate($meeting,$title,$date,$place,$id){
    global $conn;
    $result=mysqli_query($conn,"select user_id from Partecipate P where meeting_id='".$id."';") or die ("ERRORE QUI");
    $subject = 'Update Meeting';
    $headers = "From: " . "andrealonglg96@gmail.com". "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
    $result=mysqli_query($conn,"select C.phone from meeting M join cards C on M.card_id=C.card_id where M.meeting_id='".$meeting."';");
    if($row=mysqli_fetch_array($result,MYSQLI_ASSOC))$tel=$row['phone'];
    
    $timestamp=explode("T",$date);
    
    $date=$timestamp[0];
    
    $time=$timestamp[1];
    
    
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $to=getEmail($row['user_id']);
        $name=getName($row['user_id']);
        $surname=getSurname($row['user_id']);
        
        $message="";
        $message = '<html><body>';
        $message .= '<p>Ciao '.$name.' '.$surname.' ,</p>';
        $message .='<p>Sono state aggiornate alcune info in merito al meeting di cui avevi confermato la presenza. Ti riportiamo di seguito le nuove informazioni.</p>';
    
    // modificare qusto messaggio
        $message.='<p><strong>Title: </strong> '.$title."</p>";
        $message.='<p><strong>Place: </strong> '.$place."</p>";
        $message.='<p><strong>Date: </strong> '.$date."</p>";
        $message.='<p><strong>Ora: </strong> '.$time."</p>";
        $message .= '<p>Ci scusiamo per il disagio. Speriamo tu possa confermare la presenza.</p><p>Cordiali saluti. </p></body></html>';
        
        mail($to,$subject,$message,$headers);
    }
    
    // invio email anche a colori i quali non avevano risposto
   $result=mysqli_query($conn,"select user_id from invite P where meeting_id='".$id."' and reply is null;") or die ("ERRORE QUI"); 
    
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $to=getEmail($row['user_id']);
        $name=getName($row['user_id']);
        $surname=getSurname($row['user_id']);
        
        $message="";
        $message = '<html><body>';
        $message .= '<p>Ciao '.$name.' '.$surname.' ,</p>';
        $message .='<p>Sono state aggiornate alcune info in merito al meeting a cui eri stato invitato. Ti riportiamo di seguito le nuove informazioni.</p>';
    
    // modificare qusto messaggio
        $message.='<p><strong>Title: </strong> '.$title."</p>";
        $message.='<p><strong>Place: </strong> '.$place."</p>";
        $message.='<p><strong>Date: </strong> '.$date."</p>";
        $message.='<p><strong>Ora: </strong> '.$time."</p>";
        $message.='<a href="http://127.0.0.1/Site/Site/AcceptInvite.php?meeting='.$meeting.'&id='.$row['user_id'].'">Clicca qui per accettare l invito</a><br/>';
        $message .= 'Ci scusiamo per il disagio. Ti ricordo che potrai anche contattarmi al numero '.$tel.' per confermare la tua presenza.<br/>Cordiali Saluti.';
        mail($to,$subject,$message,$headers);
    }
    
}


function sendDeleteEmail($invitati,$partecipanti,$title,$place,$date){
    global $conn;
    $subject = 'Meeting Delete';
    $headers = "From: " . "andrealonglg96@gmail.com". "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
    $timestamp=explode(" ",$date);
    
    $date=$timestamp[0];
    
    $time=$timestamp[1];
    
    while($row=mysqli_fetch_array($invitati,MYSQLI_ASSOC)){
        $nameinvitato=getName($row['user_id']);
        $surnameinvitato=getSurname($row['user_id']);
        $to=getEmail($row['user_id']); // prendo email dell'invitato
        
        $message="";
        $message = '<html><body>';
        $message .= '<p>Ciao '.$nameinvitato.' '.$surnameinvitato.'</p>';
        $message .='<p>Ci scusiamo per il disagio ma il meeting '.$title .' organizzato in data '.$date.' alle ore '.$time. ' localita '.$place.' a cui eri stato invitato non si terra pi&uacute.<br/>Cordiali Saluti</p>';
    
    // modificare qusto messaggio
        mail($to,$subject,$message,$headers);   
    }
    
    while($row=mysqli_fetch_array($partecipanti,MYSQLI_ASSOC)){
        $nameinvitato=getName($row['user_id']);
        $surnameinvitato=getSurname($row['user_id']);
        $to=getEmail($row['user_id']); // prendo email dell'invitato
        
        $message="";
        $message = '<html><body>';
        $message .= '<p>Ciao '.$nameinvitato.' '.$surnameinvitato.'</p>';
        $message .='<p>Ci scusiamo per il disagio ma il meeting .'.$title .' organizzato in data '.$date.' localita '.$place.' a cui avevi confermato la presenza non si terra pi&uacute.<br/>Cordiali Saluti</p>';
        mail($to,$subject,$message,$headers);   
    }   
}



    
?>