/***
@title:
Show Password

@version:
1.0

@author:
Andreas Lagerkvist

@date:
2009-03-11

@url:
http://andreaslagerkvist.com/jquery/show-password/

@license:
http://creativecommons.org/licenses/by/3.0/

@copyright:
2008 Andreas Lagerkvist (andreaslagerkvist.com)

@requires:
jquery

@does:
This little plug inserts a "View password"-checkbox next to inputs of type password that allows the user to toggle the password's visibility. When the checkbox is checked the password is displayed in plain text.

@howto:
jQuery('#my-form').showPassword(); would insert "password togglers" in every input[type=password] within #my-form.

@exampleHTML:
<input type="password" value="oioioi"/>

@exampleJS:
jQuery('#jquery-show-password-example').showPassword();
***/
jQuery.fn.showPassword = function (conf) {
	var config = $.extend({
		str:		'Show password', 
		className:	'password-toggler'
	}, conf);

	return this.each(function () {
		jQuery('input[type=password]', this).each(function () {
			var field		= jQuery(this);
			var fakeField	= jQuery('<input type="text" class="input ' + config.className + '" value="' + field.val() + '" />').insertAfter(field).hide(); // only IE really needs this
			var check		= jQuery('<label style="font-size: 12px; margin-bottom: 4px" class="' + config.className + '"><input type="checkbox" /> ' + config.str + '</label>');
			var parentLabel	= field.parents('label');

			if (parentLabel.length) {
				check.insertAfter(parentLabel);
			}
			else {
				check.insertAfter(fakeField); // field
			}

			check.find('input').click(function() {
				if (jQuery(this).is(':checked')) {
				//	field.attr('type', 'text'); // strange, this threw errors
				//	field[0].type = 'text'; // and this doesn't work in IE
					field.hide();
					fakeField.val(field.val()).show();
				}
				else {
				//	field.attr('type', 'password');
				//	field[0].type = 'password';
					field.show();
					fakeField.hide();
				}
			});

			fakeField.change(function() {
				field.val(fakeField.val());
			});
		});
	});
};