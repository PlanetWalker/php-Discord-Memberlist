$(document).ready(function () {
    $("#login").on('submit', function (event) {
        event.preventDefault();
        const data = $("#login").serialize();
        $.ajax({
            type: 'POST',
            url: "./api/login",
            data: data,
            success: function (response) {
                console.log(response);
                const info = JSON.parse(response);
                if (info.code === "true") {
                    document.getElementById("info").innerHTML = "Welcome";
                    document.getElementById("header").style.cssText = 'background-color:green !important';
                    document.getElementById("button").disabled = true;

                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } 
                if (info.code === "false") {
                    document.getElementById("info").innerHTML = "Wrong Password";
                    document.getElementById("header").style.cssText = 'background-color:red !important';
                    document.getElementById("button").disabled = true;

                    setTimeout(function () {
                        document.getElementById("info").innerHTML = "";
                        document.getElementById("header").style.backgroundColor = '';
                        document.getElementById("button").disabled = false;
                    }, 2500);
                }
                if(info.message === "delay") {
                    document.getElementById("info").innerHTML = "Pleace wait " + info.code + " seconds";
                    document.getElementById("header").style.cssText = 'background-color:red !important';
                    document.getElementById("button").disabled = true;

                    setTimeout(function () {
                        document.getElementById("info").innerHTML = "";
                        document.getElementById("header").style.backgroundColor = '';
                        document.getElementById("button").disabled = false;
                    }, 2500); 
                }
                if (info.message === "lockedout") {
                    document.getElementById("info").innerHTML = "Lockedout";
                    document.getElementById("header").style.cssText = 'background-color:red !important';
                    document.getElementById("button").disabled = true;

                    setTimeout(function () {
                        document.getElementById("info").innerHTML = "";
                        document.getElementById("header").style.backgroundColor = '';
                        document.getElementById("button").disabled = false;
                    }, 2500);
                }
            }
        });
    });
});