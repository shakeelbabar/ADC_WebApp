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