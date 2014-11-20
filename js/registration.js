/**
 * Created by Faisal on 11/11/2014.
 */

function cancel_form(){
    window.location.href = '<?=base_url()?>dashboard';
}

function back_form(){
    window.location.href = '<?=base_url()?>dashboard';
}

// Form validation
jQuery(document).ready(function(){
    jQuery('form').validationEngine();

});

function checkpassword(){
    var password=jQuery('#password').val();
    var confirm_Password=jQuery('#confirm_Password').val();
    if(password!=confirm_Password){
        jQuery('form').validationEngine();
        jQuery( "#password" ).removeClass( "input validate[required]" );
        jQuery( "#password" ).addClass( "input validate[equals]" );
        return false;
    }else{
        jQuery('#form-login').submit();
        jQuery('form').validationEngine();
        jQuery( "#password" ).removeClass( "input validate[required]" );
        jQuery( "#password" ).removeClass( "input validate[equals]" );
        jQuery( ".passwordformError" ).removeClass( "formError" );
        jQuery( "#password" ).addClass( "input" );
    }

}
function zipcodechange(){
    var country=jQuery('#validation-select').val();
    var zipcode='Zip Code';
    if(country=='USA'){
        jQuery('#postalcodelabel').hide();
        jQuery('#zipcodelabel').show();
        jQuery('.zipcodes').attr('id', 'zip_code');
        jQuery('#usa_state').show();
        jQuery('#canadian_state').hide();
    }else{
        jQuery('#postalcodelabel').show();
        jQuery('#zipcodelabel').hide();
        jQuery('.zipcodes').attr('id', 'post_code');
        jQuery('#canadian_state').show();
        jQuery('#usa_state').hide();
    }
}

function changeupper(){
    jQuery("#post_code").val((jQuery("#post_code").val()).toUpperCase());
}
