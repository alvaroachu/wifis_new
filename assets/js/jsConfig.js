$(document).ready(function() {
    
    var navListItems = $('ul.setup-panel li a'),
        allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function(e)
    {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this).closest('li');
        
        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
    });
    
    $('ul.setup-panel li.active a').trigger('click');
});

function validation(){
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var servidorsmtp = document.getElementById('servidorsmtp').value;
    var security = document.getElementById('security').value;
    var puerto = document.getElementById('puerto').value;
    var xhttp = new XMLHttpRequest();
    security_string = (security==1)?'TLS':((security==2)?'SSL':'NINGUNO')
    xhttp.open('POST','validator.php',true);
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4) {
            var obj = JSON.parse(this.response);
            console.log(obj.status);
            if(obj.status == 'success'){
                document.getElementById('validacion').innerHTML = `<th colspan="2" id="validacion"> Todos sus datos estan correctos</th>`;
                document.getElementById('email_val').innerHTML = `<td id="email_val"> ${email} </td>`;
                document.getElementById('server_val').innerHTML = `<td id="email_val"> ${servidorsmtp} </td>`
                document.getElementById('port_val').innerHTML = `<td id="email_val"> ${puerto} </td>`
                document.getElementById('security_val').innerHTML = `<td id="email_val"> ${security_string} </td>`
            } else{
                document.getElementById('validacion').innerHTML = `<th colspan="2" id="validacion"> Debe revisar sus datos de acceso.</th>`;
                document.getElementById('email_val').innerHTML = `<td id="email_val"> ${email} </td>`;
                document.getElementById('server_val').innerHTML = `<td id="email_val"> ${servidorsmtp} </td>`
                document.getElementById('port_val').innerHTML = `<td id="email_val"> ${puerto} </td>`
                document.getElementById('security_val').innerHTML = `<td id="email_val"> ${security_string} </td>`
            }
            $('ul.setup-panel li:eq(1)').removeClass('disabled');
            $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        }else{
            // Mensaje de error 
        }
    }
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(
        'email='+email+
        '&password='+password+
        '&servidorsmtp='+servidorsmtp+
        '&security='+security+
        '&puerto='+puerto
    );
}
function save(){
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var servidorsmtp = document.getElementById('servidorsmtp').value;
    var security = document.getElementById('security').value;
    var puerto = document.getElementById('puerto').value;
    var xhttp = new XMLHttpRequest();
    xhttp.open('POST','savedb.php',true);
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4) {
            var obj = JSON.parse(this.response);
            console.log(obj.status);
            if(obj.status == 'error'){
                alert('Error');
            }else if(obj.status == 'success'){
                document.getElementById('email_val').innerHTML = `<td id="email_val"> ${email} </td>`;
                document.getElementById('server_val').innerHTML = `<td id="email_val"> ${servidorsmtp} </td>`
                document.getElementById('port_val').innerHTML = `<td id="email_val"> ${puerto} </td>`
                document.getElementById('security_val').innerHTML = `<td id="email_val"> ${security_string} </td>`
            } else{
                document.getElementById('email_val').innerHTML = `<td id="email_val"> ${email} </td>`;
                document.getElementById('server_val').innerHTML = `<td id="email_val"> ${servidorsmtp} </td>`
                document.getElementById('port_val').innerHTML = `<td id="email_val"> ${puerto} </td>`
                document.getElementById('security_val').innerHTML = `<td id="email_val"> ${security_string} </td>`
            }
            $('ul.setup-panel li:eq(2)').removeClass('disabled');
            $('ul.setup-panel li a[href="#step-3"]').trigger('click');
            // $('#activate-step-3').remove();
        }
    }
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(
        'email='+email+
        '&password='+password+
        '&servidorsmtp='+servidorsmtp+
        '&security='+security+
        '&puerto='+puerto
    );
}

function  borrar(){
    var xhttp = new XMLHttpRequest();
    xhttp.open('POST','deletedb.php',true);
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4) {
            var obj = JSON.parse(this.response);
            console.log(obj.status);
            if(obj.status == 'error'){
                alert('Error');
            }else if(obj.status == 'success'){
                alert('Sus datos fueron eliminados correctamente.');
                location.reload();
            } else{
                alert('Error no se ha podido eliminar.');
            }
        }
    }
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send();
}