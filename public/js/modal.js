// $(document).ready(function(){
//     var within_first_modal = false;
//
//     $(".btn-modal").click(function(){
//         $firstModal='#'+$(this).next('.modal').attr('id');
//         console.log($firstModal);
//         $secondModal='#'+$($firstModal).find(".modal").attr("id");
//         console.log($secondModal);
//     })
//     $('.btn-second-modal').on('click', function() {
//         if ($(this).hasClass('within-first-modal')) {
//             within_first_modal = true;
//             $('#first-modal').modal('hide');
//         }
//         $('#second-modal').modal('show');
//     });
//
//     $('.btn-second-modal-close').on('click', function() {
//         $('#second-modal').modal('hide');
//         if (within_first_modal) {
//             $('#first-modal').modal('show');
//             within_first_modal = false;
//         }
//     });
//
//     $('.btn-toggle-fade').on('click', function() {
//         if ($('.modal').hasClass('fade')) {
//             $('.modal').removeClass('fade');
//             $(this).removeClass('btn-success');
//         } else {
//             $('.modal').addClass('fade');
//             $(this).addClass('btn-success');
//         }
//     });
// })
//
