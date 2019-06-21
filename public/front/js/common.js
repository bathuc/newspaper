
jQuery.extend(jQuery.validator.messages, {
    required: "この項目は必須です。",
    email: "メールアドレスの形式が正しくありません。",
    valid_email: "メールアドレスの形式が正しくありません。",
    number: "半角数字のみで入力して下さい。",
    date: "Please enter a valid date.",
    digits: "Please enter only digits.",
    equalTo: "Please enter the same value again.",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    minlength: jQuery.validator.format("Please enter at least {0} characters."),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});

$(document).ready(function () {
	$.validator.addMethod("valid_email", function (value, element) {
		if(value!="") {
			var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!value.match(regex)) {
				return false;
			}
		}
		return true;
	});

    // japanese character only
    jQuery.validator.addMethod("japanese", function(value, element) {
		return this.optional(element) || value.match(/^[\u3400-\u4DBF\u4E00-\u9FFF\uD840-\uD87F\uDC00-\uDFFF\uF900-\uFAFF\u3040-\u309F\u30A1-\u30FA]+$/);
	}, "漢字、全角ひらがな、全角カタカナのみ入力できます。"
	);

	// japanese and some other expand character
	jQuery.validator.addMethod("japanese_expand", function(value, element) {
			return this.optional(element)
				|| value.match(/^[\u3400-\u4DBF\u4E00-\u9FFF\uD840-\uD87F\uDC00-\uDFFF\uF900-\uFAFF\u3040-\u309F\u30A1-\u30FA]+$/)
				|| value.match(/^[一-龠㐀-㿸﨑々〆あ-んア-ヸa-zA-Zーヽヾ]+$/);
		}, "漢字、全角ひらがな、全角カタカナのみ入力できます。"
	);
	// katakana character only
	jQuery.validator.addMethod("katakana", function(value, element) {
		return this.optional(element) || value.length < 21 && value.match(/^[\u30A1-\u30FA]+$/);
		}, "全角カタカナで入力して下さい。"
	);

	// furigana
    jQuery.validator.addMethod("furigana", function(value, element) {
            return this.optional(element) || value.length < 21 && value.match(/^[a-zA-Z0-9ａ-ｚ０-９ｧ-ﾝﾞﾟァ-ヶーぁ-んァ-ヶーぁ-ん。 s]+$/);
        }, "漢字が入力できません。"
    );

	// numberic hypen: 084-4324-43243
	$.validator.addMethod("numeric_hyphen", function(value, element) {
		return this.optional(element) || /^((\d+-)?\d+)+$/i.test(value);
	}, "半角の数字かハイフンのみで入力して下さい。");

    // telephone number: +084-4324-43243
    $.validator.addMethod("telephone_number", function(value, element) {
        return this.optional(element) || /^(\+)?((\d+-)?\d+)+$/i.test(value);
    }, "半角の数字かハイフンのみで入力して下さい。");

	// use for regex
	$.validator.methods.matches = function( value, element, params ) {
		var regex = new RegExp(params);
		return this.optional( element ) || regex.test( value );
	}
});