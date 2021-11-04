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