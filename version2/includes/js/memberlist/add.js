$(document).ready(function () {
    $("#addMember").on('submit', function (event) {
        event.preventDefault();
        const data = $("#addMember").serialize();
        $.ajax({
            type: 'POST',
            url: "./api/memberlist/add",
            data: data,
            success: function (response) {
                console.log(response);
                setTimeout(function () {
                    location.reload();
                  }, 2000);
                }
        });
    });
});