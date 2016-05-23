/**
 * @description	ItemForm-lomake-elementin ominaisuuksien asettaja
 *
 * @author   Sami Petteri Holck
 * @since    14.05.2012
 * @memberOf jQuery.fn
 * @requires jQuery (1.7.2)
 * @see      <a href="http://jquery.com/">jQuery</a>
 * @function formItem
 */
(function ($) {
	'use strict';

	/**
	 * sets the clienside validation for the form input
	 * 
	 * @memberOf jQuery.fn#
	 * @method   sphpPopper
	 * @param    {Object} options {content: String the content of the popper,
	 *                           delay: int visibility time (default 3000 ms)}
	 * @returns  {jQuery.fn} object for method chaining
	 */
	$.fn.validable = function (options) {
		var opts = $.extend({}, $.fn.validable.defaults, options);
		return this.each(function () {
			var $this = $(this),
					$id, $labels, $styledComponents,
					$name = $this.attr("name"),
					$o = $.meta ? $.extend({}, opts, $this.data()) : opts,
					$form = $this.parents("form"),
					$validate = true,
					$tooltip = $this.qtip({
						content: {
							title: "Errors",
							text: ""},
						position: {
							my: 'bottom center',
							at: 'top center',
							target: $this
						},
						style: {
							classes: 'validator-qtip qtip-red qtip-shadow qtip-rounded'
						}, show: {
							event: 'focus mouseenter'
						},
						hide: {
							event: 'unfocus mouseleave'
						}, events: {
							hide: function (event, api) {
								//console.log("event.originalEvent.type:" + event.originalEvent.type);
								//console.log("event.type:" + event.type);
								if ($this.is(":focus") && event.originalEvent.type !== "mousedown") {
									event.preventDefault();
								}
							}
						}
					}),
					$api = $tooltip.qtip('api');
			$api.disable(true);

			console.log("validable input:" + $this.attr("name"));
			if ($this.is("[id]")) {
				$id = $this.attr("id");
			}
			$labels = $();
			$labels = $('label[for="' + $this.attr('id') + '"]');
			$styledComponents = $labels.add($(this));
			console.log("label[for='" + $id + "']" + $styledComponents.outerHTML());

			//console.log(sphp.getHttpRoot());
			//$this.setValidationWrapper();
			function getPostData() {
				var postData = {
					formData: $form.serialize(),
					validate: $name
				};
				if ($this.is("[required]") || $this.is("[data-sphp-required]")) {
					postData.required = "true";
				}
				if ($this.is("[pattern]")) {
					postData.pattern = $this.attr("pattern");
				}
				if ($this.is("[data-sphp-type]")) {
					postData.objectType = $this.attr("data-sphp-type");
				}
				//console.log(postData);
				return postData;
			}
			function buildErrorList(messages) {
				var $ul = $('<ul>');
				$.each(messages, function (key, val) {
					$ul.append("<li>" + val + "</li>");
				});
				//console.log("error html:" + $ul.html());
				return $ul.outerHTML();
			}
			//$errMenu = $form.find(".ErrMenu .Content");
			$this.bind('keyup blur validate', function (event) {
				$validate = true;
				console.log("validating input: '" + $this.attr("name") + "'");
				$.post($o.path, getPostData(), function (data) {
					console.log("errormessage data:" + data["messages"]);
					if ($validate) {
						//$("div." + $name + "ErrorBox").detach();
						if (data.messages.length > 0) {
							$api.set('content.title', data.title);
							$api.set('content.text', buildErrorList(data.messages));
							$api.disable(false);
							//$row.append(data);
							$styledComponents.removeClass("sphp-correct").addClass("sphp-error");
						} else {
							$styledComponents.removeClass("sphp-error").addClass("sphp-correct");
							$api.disable(true);
						}
					}
				}, "json").done(function () {
					if ($validate) {
						console.log("input: '" + $this.attr("name") + "' validated");
						$form.trigger("validated", [$name]);
						$this.trigger("validated", [$name]);
					} else {
						$validate = true;
					}
				});
			});
			$form.bind("reset", function () {
				$validate = false;
				//$("div." + $name + "ErrorBox").detach();
				$this.removeClass("sphp-error sphp-correct");
			});
		});
	};
	$.fn.validable.defaults = {
		path: sphp.getHttpRoot() + "/sph/ajax/validation/default.php",
		delay: 500,
		show: 2000,
		content: 'This is the popper!'
	};

	$.fn.setValidationWrapper = function () {
		return this.each(function () {
			var $this = $(this),
					$labels, $toWrap;
			$toWrap = $this;
			if (!$toWrap.parent().hasClass("sphp-input-wrapper")) {
				if ($this.is("[id]")) {
					$labels = $this.siblings('label[id=' + $this.attr("id") + ']');
					$toWrap.add($labels);
				}
				$toWrap.wrap($('<span class="sphp-input-wrapper input-error">'));
			}
		});
	};


	/**
	 * ItemForm-lomakkeen rivi
	 *
	 * @author   Sami Petteri Holck
	 * @since    2012-05-12
	 * @memberOf jQuery.fn
	 * @requires jQuery (1.7.2)
	 * @see      <a href="http://jquery.com/">jQuery</a>
	 * @function setItemFormRow
	 */
	$.fn.setItemFormRow = function () {
		return this.each(function () {
			var $this = $(this), $form = $this.parent("form");
			$this.find('input, select, textarea').formItem(HTTP_ROOT + "ajaxPHP/FormValidation.php");
			$this.bind("__VALIDATED__", function () {
				if ($this.find(".Error").length === 0) {
					$this.removeClass("Error").addClass("Correct");
				} else {
					$this.removeClass("Correct").addClass("Error");
				}
			});
			$form.bind("reset", function () {
				$this.removeClass("Error Correct");
			});
		});
	};
}(jQuery));

/**
 * Contains all sph functionality.
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @name sphp
 * @namespace sphp
 */
(function (sphp, $, undefined) {
	"use strict";

	/**
	 * ItemForm HTML-form's JavaScript functionality
	 *
	 * <b>Notes:</b>
	 *
	 * This class handdles error informing about userinputs, and it also positions
	 * ItemForms HTML-elements using ItemFormVisualizer class.
	 *
	 * @author   Sami Petteri Holck
	 * @since    2012-05-12
	 * @requires jQuery (1.7.2)
	 * @see      <a href="http://jquery.com/">jQuery</a>
	 * @class    ItemForm
	 * @param    {String} theForm form's identifier (usually id-attribute)
	 */
	sphp.ValidableForm = function (theForm) {
		'use strict';
		this.form = $(theForm);
		this.rows = this.form.find("input[name] select[name] textarea[name]");

		console.log("ItemForm: " + theForm.attr("id"));
		this.form.find('input[name], select[name], textarea[name]').validable("http://samiholck.com/sph/ajax/validation/default.php");
		this.path = sphp.getHttpRoot() + "ajaxPHP/FormValidation.php";
		//this.rows.setItemFormRow(HTTP_ROOT + "ajaxPHP/FormValidation.php");
		this.rows.bind("__VALIDATED__", $.proxy(this.updateForm, this));
		this.errMenu = this.form.find("div.ErrMenu");
		//this.visualizer = new ItemFormVisualizer(theForm);
		//this.visualizer.visualize();
	};
	/**
	 * Updates forms validity
	 */
	sphp.ValidableForm.prototype.updateForm = function () {
		'use strict';
		if (this.form.find("div.Row .Error").length === 0) {
			this.form.removeClass("Error").addClass("Correct");
			this.errMenu.fadeOut(300);
		} else {
			this.form.removeClass("Correct").addClass("Error");
			this.updateAllErrorsMenu();
			if (this.errMenu.css("display") !== "block") {
				this.errMenu.fadeIn(300);
			}
		}
	};
	/**
	 * Updates forms errormenu
	 */
	sphp.ValidableForm.prototype.updateAllErrorsMenu = function () {
		'use strict';
		var $errMenuCont = this.errMenu.find(".Nfo"), $errCount = this.errMenu.find(".ErrCount");
		$.post(this.path + "?updateAllErrorsMenu", this.form.serialize(), function (data) {
			$errMenuCont.html(data);
		});
		$.post(this.path + "?errCount", this.form.serialize(), function (data) {
			$errCount.html(data);
		});
	};

	/**
	 * Resets the form
	 */
	sphp.ValidableForm.prototype.reset = function () {
		'use strict';
		this.form.removeClass("Error Correct");
		this.errMenu.fadeOut(300);
	};

}(window.sphp = window.sphp || {}, jQuery));


