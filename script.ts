/// <reference path="./typings/jquery/jquery" />

class Controller {

    render() {
        $('#form').on('submit', (event:JQueryEventObject)=> {
            setTimeout(()=> {
                this.submit();
            });
            event.preventDefault();
        });
    }

    private submit() {
        var body = {
            password: $('#password').val(),
            recipient: $('#recipient').val(),
            message: $('#message').val(),
            sender: $('#sender').val()
        };
        $.post('index.php/send', JSON.stringify(body), (response) => {
            if (response['status'] === 'ok') {
                alert(response.count + ' SMS wurde(n) versandt');
                $('#message').val('');
            } else {
                alert('Fehler aufgetreten - Mist :(')
            }
        }, 'json');
    }
}


var controller = new Controller();

controller.render();