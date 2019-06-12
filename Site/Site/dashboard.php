<?php
session_start(); 
include('../DB/database.php');
include("../DB/function.php");
if(isset($_SESSION['username'])){
    $userid=getUserId($_SESSION['username']);
    $name=getName($userid);
    $surname=getSurname($userid);
    $photo=getUrlPhoto($userid);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>DashBoard</title>

  <link rel="stylesheet" href="../dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/modules/ionicons/css/ionicons.min.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

  <link rel="stylesheet" href="../dist/css/demo.css">
  <link rel="stylesheet" href="../dist/css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
      <link rel="stylesheet" href="css/personalized.css">
    
  <link href='Calendar/fullcalendar.min.css' rel='stylesheet' />
<link href='Calendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <?php include('navbar.php'); ?>
      <?php include('sidebar.php'); ?>
      <div class="main-content">
        <section class="section">
          <h1 class="section-header">
            <div class="titlecenter">Dashboard</div>
          </h1>

          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <div class="alert alert-info mb-0" style="text-align:center;">
                  In questa sezione potrai visualizzare alcune statistiche ed info in merito ai meetings.
                </div>
              </div>
            </div>
              
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4 style="text-align:center">Table</h4>
                  </div>
                  <div class="card-body">
                    <table id="meetingTable" class="table table-striped table-responsive-lg table-responsive-sm table-responsive-md table-responsive-xs">
				<thead>
			  	<tr>
						<th scope="col">Role</th>
						<th scope="col">Title</th>
						<th scope="col">Partecipate</th>
						<th scope="col">Place</th>
                        <th scope="col">Evaluation</th>
					</tr>
			     </thead>
				<tbody>
                    
				</tbody>
                    </table>
                  </div>
                </div>
              </div>
              </div>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4 style="text-align:center">Meetings</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4 style="text-align:center">Info Last Meeting Created</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart2"></canvas>
                  </div>
                </div>
              </div>
            </div>
              <div class="row">
              <div class="col-12 col-md-10 col-lg-10 offset-lg-1 offset-md-1">
                <div class="card">
                  <div class="card-header">
                    <h4 style="text-align:center">Calendar</h4>
                  </div>
                  <div class="card-body">
                    <div id='calendar'></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
     
<?php
    include("footer.php");
?>
    </div>
  </div>

  <script src="../dist/modules/jquery.min.js"></script>
  <script src="../dist/modules/popper.js"></script>
  <script src="../dist/modules/tooltip.js"></script>
  <script src="../dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="../dist/js/sa-functions.js"></script>
  <script src="../dist/modules/chart.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
  <script src='Calendar/moment.min.js'></script>
  <script src='Calendar/fullcalendar.min.js'></script>
  <script>
       $(document).ready(function(){
           
         var count=-1;
         var meetingtable=$("#meetingTable").DataTable({
                "searching": false,
                "info": false,
                "bLengthChange": false,
                "processing": true,
                "responsive":true,
                "columnDefs": [
                { "orderable": false, "targets": 0 }],
     
                "ajax": {
				url: "json/MeetingDates.php",
				error: function (xhr, error, thrown) {
					alert( error ); 
                    alert("Errore nel caricaemtno della tabella");
				    },
			     },
     
                "aoColumns": [
				{ "mData": "role","bSortable": false},
				{ "mData": "title","bSortable":true},
				{ "mData": "partecipanti","bSortable": true,},
				{ "mData": "place", "bSortable": true},
                {"mData":"valutazione","bSortable":false,
                 "mRender":function(data,type,row){
                     count++;
                     return '<div id="'+count+'"><div class="rateYo"></div></div>';
                 }
                }
                ],
     
                "oLanguage":{
                    "sZeroRecords":"Nessun elemento trovato",
                    "oPaginate": {
				    "sPrevious": "Previous",
				    "sNext": "Next",
			     },				
                },
     
                "initComplete":function(index,data){
                    var dati=data.data;
                    $.each(dati,function(index,x){
                       if(x.valutazione==0 || x.valutazione==null)rating(index,0);
                       else rating(index,x.valutazione);
                    });
                    },    
        });
            
         
            
        function rating(index,valutazione){
            $("#"+index+" .rateYo").rateYo({
            starWidth:'20px',
            numStars: 5,
            readOnly:true,
            rating:valutazione,
        });    
        }
             
           
    var ctx = document.getElementById("myChart").getContext('2d');
         var myChart = new Chart(ctx, {
                type: 'bar',
                animationEnabled: true,
                responsive:true,
                data: {
                    labels: ["January", "February", "March", "April", "May", "June","July","August","September","October","November","December"],
                    datasets: [{
                        label: 'Organized Meeting',
                        data: [0,0,0,0,0,0,0,0,0,0,0,0],// si prende solo i primi 12
                        backgroundColor: "rgba(255, 159, 64, 1)",   
                        borderColor:"rgba(255, 159, 64, 1)",
                        borderWidth: 2
                    },
                        {
                        label: 'Partecipated Meeting',
                        data: [0,0,0,0,0,0,0,0,0,0,0,0],// si prende solo i primi 12
                        backgroundColor: 'rgb(87,75,144)',
                        borderColor: 'rgb(87,75,144)',
                        borderWidth: 2
                        }]
                    },
                options: {
                responsive:true,
                    scales: {
                        xAxes: [{
                        scaleLabel: {
                        display: true,
                            labelString: "Month",
                            fontColor: "rgb(87,75,144)",
                        }
                    }],
                        
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: "Number Of Meetings",
                            fontColor: "green"
                    },
                        ticks: {
                            reverse: false,
                            stepSize: 1, // definisce lo step con cui una tabella deve essere mostrata
                        },
                    }]
                },
                title: {
                    display: true,
                    text:"Meetings",
                },
            legend:{
                position:'right',
            },
            tooltips: {
                mode: 'point'
            }  
            }
        });
           
         $.ajax({
            url:"json/OrganizedMeeting.php",
            success:function(data){
                var dati=$.parseJSON(data);
                $.each(dati,function(index,valore){
                     $.each(valore,function(chiave,value){
                         myChart.data.datasets[0].data[chiave-1]=value;
                     });
                myChart.update();
                });
            },
            });
           
           $.ajax({
            url:"json/PartecipatedMeeting.php",
            success:function(data){
                var dati=$.parseJSON(data);
                $.each(dati,function(index,valore){
                     $.each(valore,function(chiave,value){
                         myChart.data.datasets[1].data[chiave-1]=value;
                     });
                myChart.update();
                });
            },
         });
           
           
    var ctx2 = document.getElementById("myChart2").getContext('2d');
    var myChart2 = new Chart(ctx2, {
                type: 'pie',
                responsive:true,
                data: {
                    labels: ["Rifiutati", "Accettati","In Attesa"],
                    datasets: [{
                        label: 'Organized Meeting',
                        backgroundColor: [
                            "#ee4035",
                            "#009688",
                            "#ffcc5c",
                            ],
                        data: []
                    }],
                },
                options: {
                    legend:{
                position:'bottom',
                },
                    animation:{ 
                        animateScale:true,
                    },
                title: {
                    display: true,
                    text:"",
                },
                },
            });
        
    $.ajax({
           url:"json/InfoLastMeeting.php", 
           success:function(data){
                var dati=$.parseJSON(data);
                $.each(dati,function(index,elem){
                       myChart2.options.title.text ="Meeting: " + elem.title;
                       myChart2.data.datasets[0].data[0]=elem.rifiuti;
                       myChart2.data.datasets[0].data[1]=elem.partecipanti;
                       myChart2.data.datasets[0].data[2]=elem.attesa;
                    });
               myChart2.update();
               myChart2.render();
        },  
        });
           
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month',
      },
      buttonText: {
        today:"Oggi",
        },
      defaultDate: moment().format("YYYY-MM-DD"), // settarlo alla data corrente
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: function(start, end, timezone, callback) {
        $.ajax({
            url:'json/IncomingMeeting.php',
            success: function(data) {
                var events = [];
                var data=$.parseJSON(data);
                
                $.each(data,function(index,element) {
                    if(element.partecipante){
                    events.push({
                        title: element.title,
                        start: element.date, // will be parsed
                        backgroundColor:"green",
                    });
                    }
                    else {
                        var meeting=element.meeting;
                        var URL='AcceptInvite.php?meeting='+meeting+"&id="+<?php echo $userid; ?>;
                        events.push({
                        title: element.title,
                        start: element.date, // will be parsed
                        backgroundColor:"red",
                        url: URL,
                    });
                    }
                    });
                callback(events);
                },
            });
        },
        
        eventRender: function(event, element) {
            $(element).tooltip({title: event.title,container: "body",
                               });             //è una proprieta di bootstrap
        },
        eventStartEditable: false, // disabilita il drag and drop
        selectable:true,
      });
        
           
    });
  </script>
  <script src="../dist/js/scripts.js"></script>
  <script src="../dist/js/custom.js"></script>
  <script src="../dist/js/demo.js"></script>
  <script src="../js/notifications.js"></script>
    <script src="../js/closemodal.js"></script>
</body>
</html>

<?php
}
else header("Location:../error.html");
?>