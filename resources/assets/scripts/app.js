import './dashmix/dashmix.js';

require('./bootstrap');

jQuery('div.alert').not('.alert-important').delay(4000).fadeOut();

jQuery(document).ready(function() {
	jQuery('#wulearnform_open').submit();
});