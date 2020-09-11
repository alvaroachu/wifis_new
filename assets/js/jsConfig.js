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
    xhttp.open('POST','validator.php',true);
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4) {
            var obj = JSON.parse(this.response);
            console.log(obj.status);
            if(obj.status == 'success'){
                alert('success');
            } else{
                alert('Error');
            }
            $('ul.setup-panel li:eq(1)').removeClass('disabled');
            $('ul.setup-panel li a[href="#step-2"]').trigger('click');
            // $('#activate-step-2').remove();
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
                alert('success');
            } else{
                alert('Error');
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