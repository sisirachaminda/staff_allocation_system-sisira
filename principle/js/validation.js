$(document).ready(function() {
    $('#emailerror').hide();
    $('#nicerror').hide();
    $('#officephoneerror').hide();
    $('#homephoneerror').hide();
    $('#mobilephoneerror').hide();
    $('#ageAsCloseerror').hide();
    $('#serviceAsGraduateerror').hide();
    $('#serviceAsDiplomaerror').hide();
    $('#Grade12error').hide();
    $('#Grade13error').hide();
    $('#student_passerror').hide();
    $('#ass_experinceerror').hide();
    $('#yearAdCheieferror').hide();
    
        // Validation Pattens
        var nicPattern = /^[0-9]{9}[VX]$/;
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var regex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})/;
    
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
                $('#email').val('');
                $('#email').focus();
                return;
            }
        });

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
                    $('#nic').val('');
                    $('#nic').focus();

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
                $('#nic').val('');
                $('#nic').focus();
                return;
            }     
        });

        // Office Phone Validation
        $("#officephone").change(function() {
            $('#officephone').css('color', 'black');
            $('#officephone').css('border', 'black solid 1px');
            var mobile = $('#officephone').val();
            
            if (mobile.trim().length == 10) {
            $('#officephoneerror').hide();
            } else {
                $('#officephoneerror').show();
                $('#officephoneerror').html('<label id="errorText">Invalid Mobile Number</label>');
                $('#officephoneerror').css('color', 'red');
                $('#officephone').val('');
                $('#officephone').css('border', 'red solid 1px');
                $('#officephone').focus();
            }
        });

        // Home Phone Validation
        $("#homephone").change(function() {
            $('#homephone').css('color', 'black');
            $('#homephone').css('border', 'black solid 1px');
            var mobile = $('#homephone').val();
            
            if (mobile.trim().length == 10) {
            $('#homephoneerror').hide();
            } else {
                $('#homephoneerror').show();
                $('#homephoneerror').html('<label id="errorText">Invalid Mobile Number</label>');
                $('#homephoneerror').css('color', 'red');
                $('#homephone').val('');
                $('#homephone').css('border', 'red solid 1px');
                $('#homephone').focus();
            }
        });

        // Mobile Phone Validation
        $("#mobilephone").change(function() {
            $('#mobilephone').css('color', 'black');
            $('#mobilephone').css('border', 'black solid 1px');
            var mobile = $('#mobilephone').val();
            
            if (mobile.trim().length == 10) {
            $('#mobilephoneerror').hide();
            } else {
                $('#mobilephoneerror').show();
                $('#mobilephoneerror').html('<label id="errorText">Invalid Mobile Number</label>');
                $('#mobilephoneerror').css('color', 'red');
                $('#mobilephone').val('');
                $('#mobilephone').css('border', 'red solid 1px');
                $('#mobilephone').focus();
            }
        });

        // Age as at Closing Date Validation
        $("#ageAsClose").change(function() {
            $('#ageAsClose').css('color', 'black');
            $('#ageAsClose').css('border', 'black solid 1px');
            var ageAsClose = $('#ageAsClose').val();
            
            if ((ageAsClose >= 25) && (ageAsClose <= 55)) {
            $('#ageAsCloseerror').hide();
            } else {
                $('#ageAsCloseerror').show();
                $('#ageAsCloseerror').html('<label id="errorText">Age must between 25 - 35</label>');
                $('#ageAsCloseerror').css('color', 'red');
                $('#ageAsClose').val('');
                $('#ageAsClose').css('border', 'red solid 1px');
                $('#ageAsClose').focus();
            }
        });

        // Period of service as a graduate/higher deploma teacher(years) Validation
        $("#serviceAsGraduate").change(function() {
            $('#serviceAsGraduate').css('color', 'black');
            $('#serviceAsGraduate').css('border', 'black solid 1px');
            var serviceAsGraduate = $('#serviceAsGraduate').val();
            
            if (serviceAsGraduate <= 30) {
            $('#serviceAsGraduateerror').hide();
            } else {
                $('#serviceAsGraduateerror').show();
                $('#serviceAsGraduateerror').html('<label id="errorText">Service must be lessthan 30 years</label>');
                $('#serviceAsGraduateerror').css('color', 'red');
                $('#serviceAsGraduate').val('');
                $('#serviceAsGraduate').css('border', 'red solid 1px');
                $('#serviceAsGraduate').focus();
            }
        });

        // Period of service as a graduate/higher deploma teacher(years) Validation
        $("#serviceAsDiploma").change(function() {
            $('#serviceAsDiploma').css('color', 'black');
            $('#serviceAsDiploma').css('border', 'black solid 1px');
            var serviceAsDiploma = $('#serviceAsDiploma').val();
            
            if (serviceAsDiploma <= 30) {
            $('#serviceAsDiplomaerror').hide();
            } else {
                $('#serviceAsDiplomaerror').show();
                $('#serviceAsDiplomaerror').html('<label id="errorText">Service must be lessthan 30 years</label>');
                $('#serviceAsDiplomaerror').css('color', 'red');
                $('#serviceAsDiploma').val('');
                $('#serviceAsDiploma').css('border', 'red solid 1px');
                $('#serviceAsDiploma').focus();
            }
        });

        // Grade 12 Validation
        $("#Grade12").change(function() {
            $('#Grade12').css('color', 'black');
            $('#Grade12').css('border', 'black solid 1px');
            var Grade12 = $('#Grade12').val();
            
            if (Grade12 <= 30) {
            $('#Grade12error').hide();
            } else {
                $('#Grade12error').show();
                $('#Grade12error').html('<label id="errorText">Periods must be lessthan 30</label>');
                $('#Grade12error').css('color', 'red');
                $('#Grade12').val('');
                $('#Grade12').css('border', 'red solid 1px');
                $('#Grade12').focus();
            }
        });

        // Grade 13 Validation
        $("#Grade13").change(function() {
            $('#Grade13').css('color', 'black');
            $('#Grade13').css('border', 'black solid 1px');
            var Grade13 = $('#Grade13').val();
            
            if (Grade13 <= 30) {
            $('#Grade13error').hide();
            } else {
                $('#Grade13error').show();
                $('#Grade13error').html('<label id="errorText">Periods must be lessthan 30</label>');
                $('#Grade13error').css('color', 'red');
                $('#Grade13').val('');
                $('#Grade13').css('border', 'red solid 1px');
                $('#Grade13').focus();
            }
        });

        // Results of school Validation
        $("#student_pass").change(function() {
            $('#student_pass').css('color', 'black');
            $('#student_pass').css('border', 'black solid 1px');
            var student_sat = $('#student_sat').val();
            var student_pass = $('#student_pass').val();
            var x = student_sat - student_pass;
            
            if (x >= 0) {
                $('#student_passerror').hide();
            } else {
                $('#student_passerror').show();
                $('#student_passerror').html('<label id="errorText">Wrong Amount</label>');
                $('#student_passerror').css('color', 'red');
                $('#student_pass').val('');
                $('#student_pass').css('border', 'red solid 1px');
                $('#student_pass').focus();
            }
        });

        // Experince as Assistant Examiner Validation
        $("#ass_experince").change(function() {
            $('#ass_experince').css('color', 'black');
            $('#ass_experince').css('border', 'black solid 1px');
            var ass_experince = $('#ass_experince').val();
            
            if (ass_experince <= 20) {
                $('#ass_experinceerror').hide();
            } else {
                $('#ass_experinceerror').show();
                $('#ass_experinceerror').html('<label id="errorText">Exprince must be lessthan 20</label>');
                $('#ass_experinceerror').css('color', 'red');
                $('#ass_experince').val('');
                $('#ass_experince').css('border', 'red solid 1px');
                $('#ass_experince').focus();
            }
        });

        // Experince as Additional cheief Examiner Validation
        $("#yearAdCheief").change(function() {
            $('#yearAdCheief').css('color', 'black');
            $('#yearAdCheief').css('border', 'black solid 1px');
            var yearAdCheief = $('#yearAdCheief').val();
            
            if (yearAdCheief <= 20) {
                $('#yearAdCheieferror').hide();
            } else {
                $('#yearAdCheieferror').show();
                $('#yearAdCheieferror').html('<label id="errorText">Exprince must be lessthan 20</label>');
                $('#yearAdCheieferror').css('color', 'red');
                $('#yearAdCheief').val('');
                $('#yearAdCheief').css('border', 'red solid 1px');
                $('#yearAdCheief').focus();
            }
        });
                
    });