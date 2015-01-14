/// <reference path="./typings/jquery/jquery" />
var Controller = (function () {
    function Controller() {
    }
    Controller.prototype.render = function () {
        var _this = this;
        $('#form').on('submit', function (event) {
            setTimeout(function () {
                _this.submit();
            });
            event.preventDefault();
        });
    };
    Controller.prototype.submit = function () {
        var body = {
            password: $('#password').val(),
            recipient: $('#recipient').val(),
            message: $('#message').val(),
            sender: $('#sender').val()
        };
        $.post('index.php/send', JSON.stringify(body), function (response) {
            if (response['status'] === 'ok') {
                alert(response.count + ' SMS wurde(n) versandt');
                $('#message').val('');
            }
            else {
                alert('Fehler aufgetreten - Mist :(');
            }
        }, 'json');
    };
    return Controller;
})();
var controller = new Controller();
controller.render();
//# sourceMappingURL=script.js.map