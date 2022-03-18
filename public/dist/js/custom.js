  let selDiv = "";
let nof = "";
document.addEventListener("DOMContentLoaded", init, false);

function init() {
    if(document.querySelector('#uploaded_files')!==null){
        document.querySelector('#uploaded_files').addEventListener('change', handleFileSelect, false);
        selDiv = document.querySelector("#selected-files");
        nof = document.querySelector('#nof');
    }
}
    
function handleFileSelect(e) {
    if(!e.target.files) return;
    selDiv.innerHTML = "";
    var files = e.target.files;
    var i = 0;
    for(i=0; i<files.length; i++) {
        var f = files[i];
        selDiv.innerHTML += f.name + "<br/>";
    }
    nof.innerHTML = i+" files attached";
}

function downloadFile(file){
    jQuery.ajax({
        url:'/download',
        type:'get',
        data:'file='+file,
        xhrFields: {
            responseType: 'blob'
        },
        success:function(response){
            var blob = new Blob([response]);
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = file;
            link.click();
        },
        error: function(blob){
            console.log(blob);
        }
    });
}


function cancelRequest(case_id){
    // alert('Case ID: '+case_id);
    // console.log($('#'+case_id).text());
    jQuery.ajax({
        url:'/requestCancel',
        type:'get',
        data:'case_id='+case_id,
        success:function(result){
            if(result=='true'){
                icon = 'check';
                alert = 'success';
                message = '<b>Success!</b> Cancellation request for Case '+case_id+' has been submitted.';
            }else{
                icon = 'times';
                alert = 'danger';
                if(result=='false')
                    message = '<b>Failed!</b> Cancellation submission for Case '+case_id+' has been failed.';
                else
                    message = '<b>Already '+result+' </b> Cancellation submission for Case '+case_id+' has been failed.';
            }
            $('.alert').removeClass('alert-danger').removeClass('alert-success').addClass('alert-'+alert);
            $('#response-'+case_id).find('.message').html('<i class="icon fas fa-'+icon+'"></i> '+message);
            $('#response-'+case_id).fadeIn("slow", function(){
                setTimeout(function(){
                    $('#response-'+case_id).fadeOut("slow");
                }, 4000);
            });
        }
    });
}

function declineCaseBySecretary(case_id){
    // alert('Case ID: '+case_id);
    // console.log($('#'+case_id).text());
    jQuery.ajax({
        url:'/decline-case',
        type:'get',
        data:'case_id='+case_id,
        success:function(result){
            if(result=='true'){
                icon = 'check';
                alert = 'info';
                message = '<b>Success!</b> Case with ID '+case_id+' has been declined by ADC Secretary.';
            }else{
                icon = 'times';
                alert = 'danger';
                if(result=='false')
                    message = '<b>Failed!</b> Decline request for Case '+case_id+' has been failed.';
                else
                    message = '<b>Already '+result+'</b>! Decline request for Case '+case_id+' has been failed.';
            }
            $('.alert').removeClass('alert-danger').removeClass('alert-success').addClass('alert-'+alert);
            $('#response-'+case_id).find('.message').html('<i class="icon fas fa-'+icon+'"></i> '+message);
            $('#response-'+case_id).fadeIn("slow", function(){
                setTimeout(function(){
                    $('#response-'+case_id).fadeOut("slow");
                }, 4000);
            });
        }
    });
}

function forwardToADC(case_id){
    // alert('Case ID: '+case_id);
    // console.log($('#'+case_id).text());
    jQuery.ajax({
        url:'/forward-to-adc',
        type:'get',
        data:'case_id='+case_id,
        success:function(result){
            if(result=='true'){
                icon = 'check';
                alert = 'info';
                message = '<b>Success!</b> Case with ID '+case_id+' has been forwarded to ADC..';
            }else{
                icon = 'times';
                alert = 'danger';
                if(result=='false')
                    message = '<b>Failed!</b> Request for Case '+case_id+' has been failed.';
                else
                    message = '<b>Already '+result+'</b>! Request for Case '+case_id+' has been failed.';
            }
            $('.alert').removeClass('alert-danger').removeClass('alert-success').addClass('alert-'+alert);
            $('#response-'+case_id).find('.message').html('<i class="icon fas fa-'+icon+'"></i> '+message);
            $('#response-'+case_id).fadeIn("slow", function(){
                setTimeout(function(){
                    $('#response-'+case_id).fadeOut("slow");
                }, 4000);
            });
        }
    });
}

function declineCase(case_id){
    // alert('Case ID: '+case_id);
    console.log(case_id);
    jQuery.ajax({
        url:'/decline-case',
        type:'get',
        data:'case_id='+case_id+'&remarks='+$('#remarks-'+case_id).val(),
        success:function(result){
            if(result=='true'){
                icon = 'check';
                alert = 'info';
                message = '<b>Success!</b> Case with ID '+case_id+' has been declined';
            }else{
                icon = 'times';
                alert = 'danger';
                if(result=='false')
                    message = '<b>Failed!</b> Decline request for Case '+case_id+' has been failed.';
                else
                    message = '<b>Already '+result+'</b>! Decline request for Case '+case_id+' has been failed.';
            }
            $('.alert').removeClass('alert-danger').removeClass('alert-success').addClass('alert-'+alert);
            $('#response-'+case_id).find('.message').html('<i class="icon fas fa-'+icon+'"></i> '+message);
            $('#response-'+case_id).fadeIn("slow", function(){
                setTimeout(function(){
                    $('#response-'+case_id).fadeOut("slow");
                }, 4000);
            });
        }
    });
}

function approveCase(case_id){
    // alert('Case ID: '+case_id);
    // console.log($('#'+case_id).text());
    // console.log($('#remarks-'+case_id).val());
    jQuery.ajax({
        url:'/approve-case',
        type:'get',
        data:'case_id='+case_id+'&remarks='+$('#remarks-'+case_id).val(),
        success:function(result){
            // console.log(result);
            if(result=='true'){
                icon = 'check';
                alert = 'info';
                message = '<b>Success!</b> Case with ID '+case_id+' has been Approved.';
            }else{
                icon = 'times';
                alert = 'danger';
                if(result=='false')
                    message = '<b>Failed!</b> Case with ID '+case_id+' has been Failed.';
                else
                    message = '<b>Already '+result+'</b>! Request for Case '+case_id+' has been failed.';
            }
            $('.alert').removeClass('alert-danger').removeClass('alert-success').addClass('alert-'+alert);
            $('#response-'+case_id).find('.message').html('<i class="icon fas fa-'+icon+'"></i> '+message);
            $('#response-'+case_id).fadeIn("slow", function(){
                setTimeout(function(){
                    $('#response-'+case_id).fadeOut("slow");
                }, 4000);
            });
        }
    });
}

function generateLink(case_id, case_type){
    var datetime = (new Date($('#meetingdatetime').val()));
    datetime = datetime.toLocaleString();
    var duration = $('#meetingduration').val();
    if($('#meetingdatetime').val()=="" || $('#meetingduration').val()== ""){
        $('#meetingtimeerror').fadeIn("slow", function(){
            setTimeout(function(){
                $('#meetingtimeerror').fadeOut("slow");
            }, 2000);
        });
    }else if($('#meetingduration').val()<=0 ||  $('#meetingduration').val()>40){
        $('#meetingdurationerror').fadeIn("slow", function(){
            setTimeout(function(){
                $('#meetingdurationerror').fadeOut("slow");
            }, 2000);
        });
    }else{
        // console.log(datetime.toISOString());  // 2021-11-15T13:13:00.000Z
        // console.log(datetime.toUTCString());  // Mon, 15 Nov 2021 13:13:00 GMT
        // console.log(datetime.toTimeString()); // 18:13:00 GMT+0500 (Pakistan Standard Time)
        // console.log(datetime.toDateString()); // Mon Nov 15 2021
        // console.log(datetime);
        // console.log(duration);
        
        const meeting_creds = {
            case_id: case_id,
            topic: case_type+" Case with ID "+case_id+" ADC Trail Meeting.",
            start_time: datetime,
            duration: duration,
        };
        
        jQuery.ajax({
            url:'/generate-meeting',
            type:'get',
            data:meeting_creds,
            success:function(result){
                // console.log(JSON.parse(result));
                //console.log("after");
                result = JSON.parse(result);
                // console.log(result);
                var st = new Date(result.start_time);
                st.setHours(st.getHours()-7);
                // console.log(st.toDateString()+ " "+ st.toTimeString());
                // var start_time = new Date(result.start_time);
                // var start_time = moment(new Date(result.start_time)).format('YYYY-MM-DD HH:MM:SS');
                $('#meeting-link').html('<strong><a href="'+result.join_url+'" id="meeting-link">'+result.join_url+'</a></strong>')
                $('#meeting-id').html('Meeting ID: <strong>'+result.meeting_id+'</strong>')
                $('#meeting-pass').html('Meeting Password: <strong>'+result.password+'</strong>')
                $('#meeting-time').html('Start Time: <strong>'+st.toUTCString()+'</strong>')
                $('#meeting-duration').html('Duration: <strong>'+result.duration+'</strong>')
                $('#meeting-topic').html('Topic: <strong>'+result.topic+'</strong>')
                $('#meeting-status').html('Status: <strong>'+result.status+'</strong>')
            }
        });
    }
}

// $('.nav-link').on('click', function() {
//     $(this).addClass('active');
//     var $parent = $(this).parent();
//     $parent.siblings('li a.active').removeClass('active');
//   });

// $('.nav li a').click(function(e){
//     $('.nav-link.active').removeClass('active');

//     $(this).addClass('active');
//     // e.preventDefault();
// });

// const currentLocation = location.href;
// const menuItem = document.querySelectorAll('.nav-link');
// const menuLength = menuItem.length;
// for (let i = 0; i<menuLength; i++){
//     if(menuItem[i].href === currentLocation){
//         menuItem.class += ' active'; 
//     }
// }

//   $(document).ready(function () {
//     $('.nav li a').click(function(e) {

//         $('.nav li.active').removeClass('active');

//         var $parent = $(this).parent();
//         $parent.addClass('active');
//         e.preventDefault();
//     });
// });