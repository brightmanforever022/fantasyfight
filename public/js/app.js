var qa = []; //for questions vs. answers array
var global_pickable = true;

$(".pick-item").click(function() {
    if (global_pickable) {
        var pickable = 1;
        $(this).parent().children(".pick-item").each(function() {
            var classnames = $(this).attr("class").split(/\s+/);
            if (classnames.includes('pick-checked')) {
                pickable = 0;
            }
        })
        if (pickable == 1) {
            var picked = false;
            $(this).parent().children(".pick-item").each(function() {
                var classnames = $(this).attr("class").split(/\s+/);
                if (classnames.includes('picked-item')) {
                    picked = true;
                }
            });
            if (picked) { //pop if already selected
                qa.pop();
            }
            var question_id = $(this).children(".question").val();
            var answer_id = $(this).children(".answer").val();
            qa.push({
                question_id: question_id,
                answer_id: answer_id
            });

            $(this).parent().children(".pick-item").css({
                "border-color": "transparent",
                "border-width": "3px",
                "border-style": "solid"
            });
            $(this).parent().children(".pick-item").removeClass("picked-item");
            $(this).css({
                "border-color": "#f2720c",
                "border-width": "3px",
                "border-style": "solid"
            });
            $(this).addClass("picked-item");
        }
    }
});

$("#qa_result").click(function() {
    $("#qa_result").hide();
    var host = $("#global_url").val();
    //alert(window.location.href);
    var current_url = window.location.href;
    var current_url_arr = current_url.split("/");
    var sport_id = current_url_arr[current_url_arr.length - 2];
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: host + '/userpoints/store',
        data: {
            qa: qa,
            sport_id: sport_id
        },
        success: function(msg) {
            $("#qa_result").show();
            global_pickable = false; //make the pickable impossible
            if (msg.success) {
                $('#successModal').modal('show');
            }
            //location.reload();
        },
        error: function(data) {
            $("#qa_result").show();
            if (data.status == 422) {
                $('#selectAnswersModal').modal('show');
            } else if (data.status == 403) {
                $("#paymentModal").modal('show');
            } else {
                $('#myModal').modal('show');
            }
        }
    });
});

$('.redirect-btn').click(function() {
    location.href = location.origin;
})

$(".video-action-link").click(function(e) {
    e.preventDefault();
    var video_url = $(this).parent().children('.video-action-link-value:first').val();
    window.open(
        video_url,
        '_blank' // <- This is what makes it open in a new window.
    );

})

$('#select_sport').on('change', function() {
    var host = $("#global_url").val();
    var sport_id = $('#select_sport').val();
    var period = $('#select_period').val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: host + '/user/leaderboard/show/' + sport_id + '/' + period,
        success: function(arr) {
            //console.log(arr)
            $(".sport-results").empty();
            if (arr.length > 0) {
                for (var i = 0; i < arr.length; i++) {
                    var element = '<tr><th>' + (i + 1) + '</th><td><a style="color: white; text-decoration: none;" href="' + host + "/profile/" + arr[i].name + '">' + arr[i].name + '</a></td><td>' + arr[i].counts + '</td><td>' + arr[i].actual_points + '</td></tr>'
                    $(".sport-results").append(element);
                }
            }
        },
        error: function(data) {
            console.log(data)
        }
    });
});

$('#select_period').on('change', function() {
    var host = $("#global_url").val();
    var sport_id = 'all';
    var period = $('#select_period').val();
    $('#select_sport').val('all');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: host + '/user/leaderboard/show/' + sport_id + '/' + period,
        success: function(arr) {
            //console.log(arr)
            $(".sport-results").empty();
            if (arr.length > 0) {
                for (var i = 0; i < arr.length; i++) {
                    var element = '<tr><th>' + (i + 1) + '</th><td><a style="color: white; text-decoration: none;" href="' + host + "/profile/" + arr[i].name + '">' + arr[i].name + '</a></td><td>' + arr[i].counts + '</td><td>' + arr[i].actual_points + '</td></tr>'
                    $(".sport-results").append(element);
                }
            }
        },
        error: function(data) {
            //alert(data.status);
            console.log(data)
        }
    });
});

$('#select_prize_sport').on('change', function() {
    var host = $("#global_url").val();
    var sport_id = $('#select_prize_sport').val();
    var rank_id = $('#select_prize_rank').val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: host + '/prizes/filter/' + sport_id + '/' + rank_id,
        success: function(arr) {
            //console.log(arr)
            $(".prize-results").empty();
            if (arr.length > 0) {
                for (var i = 0; i < arr.length; i++) {
                    var element = '<tr><th>' + (i + 1) + '</th><td>' + arr[i].sport_id + '</td><td>' + arr[i].rank_id + '</td><td>' + arr[i].prize + '</td></tr>'
                    $(".prize-results").append(element);
                }
            }
        },
        error: function(data) {
            console.log(data)
        }
    });
});

$('#select_prize_rank').on('change', function() {
    var host = $("#global_url").val();
    var sport_id = $('#select_prize_sport').val();
    var rank_id = $('#select_prize_rank').val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: host + '/prizes/filter/' + sport_id + '/' + rank_id,
        success: function(arr) {
            //console.log(arr)
            $(".prize-results").empty();
            if (arr.length > 0) {
                for (var i = 0; i < arr.length; i++) {
                    var element = '<tr><th>' + (i + 1) + '</th><td>' + arr[i].sport_id + '</td><td>' + arr[i].rank_id + '</td><td>' + arr[i].prize + '</td></tr>'
                    $(".prize-results").append(element);
                }
            }
        },
        error: function(data) {
            console.log(data)
        }
    });
});

$(document).ready(function() {
    $('#login-button').click(function() {
        $.ajax({
            url: location.origin + '/gameuser/login',
            method: 'post',
            data: {
                _token: $('.token').val(),
                email: $('.login-email').val(),
                password: $('.login-password').val(),
            },
            success: function(res) {
                if (res === 'error') {
                    $('#loginNotification').modal('show');
                } else {
                    location.href = location.origin;
                }
            }
        })
    });
});