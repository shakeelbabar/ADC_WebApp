let selDiv = "";
let nof = "";
document.addEventListener("DOMContentLoaded", init, false);

function init() {
    document.querySelector('#uploaded_files').addEventListener('change', handleFileSelect, false);
    selDiv = document.querySelector("#selected-files");
    nof = document.querySelector('#nof');
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