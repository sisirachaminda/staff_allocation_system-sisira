$(document).ready(function() {
$('#nicerror').hide();
$('#passworderror').hide();
$('#emailerror').hide();
    // Validation Pattens
    var nicPattern = /^[0-9]{9}[VX]$/;
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var regex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})/;

    // NIC Validation
    $("#nic").change(function() {
        $('#nic').css('color', 'black');
        $('#nic').css('border', 'black solid 1px');
        var nic = $('#nic').val();

        if (nic.trim().length == 10) {
            if (nicPattern.test(nic)) {
                $('#nicerror').hide();
            } else {
                $('#nicerror').show();
                $('#nicerror').html('Invalid NIC Number');
                $('#nicerror').css('color', 'red');
                $('#nic').css('border', 'red solid 1px');
                return;
            }
        } else if (nic.trim().length == 12) {
            if (!isNaN(nic) && /^[1-9][0-9]*$/.test(nic)) {
                $('#nicerror').hide();
            } else {
                $('#nicerror').show();
                $('#nicerror').html('Invalid NIC Number');
                $('#nicerror').css('color', 'red');
                $('#nic').css('border', 'red solid 1px');
                return;
            }
        } else {
            $('#nicerror').show();
            $('#nicerror').html('Invalid NIC Number');
            $('#nicerror').css('color', 'red');
            $('#nic').css('border', 'red solid 1px');
            return;
        }     
    });

    // Password Validation
    $("#password").change(function() {
        $('#password').css('color', 'black');
        $('#password').css('border', 'black solid 1px');
        var password = $("#password").val();

        if (password.length < 8) {
            $('#passworderror').show();
            $('#passworderror').html('Password must be at least 8 characters');
            $('#passworderror').css('color', 'red');
            return;
        }
        // Check for at least one number
        else if (!/\d/.test(password)) {
            $('#passworderror').show();
            $('#passworderror').html('Password must contain at least one number');
            $('#passworderror').css('color', 'red');
            return;
        }
        // Check for at least one capital letter
        else if (!/[A-Z]/.test(password)) {
            $('#passworderror').show();
            $('#passworderror').html('Password must contain at least one capital letter');
            $('#passworderror').css('color', 'red');
            return;
        }
        // Check for at least one special character
        else if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(password)) {
            $('#passworderror').show();
            $('#passworderror').html('Password must contain at least one special character');
            $('#passworderror').css('color', 'red');
            return;
        } else {
            $('#passworderror').hide();
        }

    });

    // Email Validation
    $("#email").change(function() {
        $('#email').css('color', 'black');
        $('#email').css('border', 'black solid 1px');
        var email = $('#email').val();
        
        if (emailPattern.test(email)) {
            $('#emailerror').hide();
        } else {
            $('#emailerror').show();
            $('#emailerror').html('Invalid email address');
            $('#emailerror').css('color', 'red');
            $('#email').css('border', 'red solid 1px');
            return;
        }
    });
    
});