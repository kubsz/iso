$(".button").click(function() {
    var task = $(this).attr('id');

    switch(task) {
        case '3':
            $('.room-booking-sheet').css('display', 'none');
            $('.resource-hire-sheet').css('display', 'block');
            break;
        case '6':
            $('.resource-hire-sheet').css('display', 'none');
            $('.room-booking-sheet').css('display', 'block');
            break;
        default:
            $('.resource-hire-sheet').css('display', 'none');
            $('.room-booking-sheet').css('display', 'none');
            $(".result-text").html('');
            break;
    }

    $(".button").removeClass('active-button');
    $(this).addClass('active-button');


    $.post("query.php", {task: task})
        .done(function (data) {
            $(".result").html(data);
        });
    })

$('#resource-hire').click(function() {
    $('#resource-hire').prop('disabled',true);
    setTimeout(function(){
        $('#resource-hire').prop('disabled',false);
    },5000);

    var staff_id = $('#staff').val();
    var resource_id = $('#resource').val();
    var booking_date = $('#booking-date').val();
    var days_out = $('#days-out').val();

    $.post("resource_hire.php", {staff_id: staff_id, resource_id: resource_id, booking_date: booking_date, days_out: days_out})
        .done(function (data) {
            $(".result-text").html(data);
            $("#3").click();
        });
})

$('#room-booking').click(function() {
    $('#room-booking').prop('disabled',true);
    setTimeout(function(){
        $('#room-booking').prop('disabled',false);
    },5000);

    var staff_id = $('#staff-room').val();
    var room_id = $('#room').val();
    var booking_date = $('#room-booking-date').val();
    var duration = $('#duration').val();

    $.post("room_booking.php", {staff_id: staff_id, room_id: room_id, booking_date: booking_date, duration: duration})
        .done(function (data) {
            $(".result-text").html(data);
            $("#6").click();
        });
})