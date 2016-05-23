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
			$this.bind('keyup blur validate', function () {
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
		path: "sph/ajax/validation/default.php",
		delay: 500,
		show: 2000,
		content: 'This is the popper!'
	};


	/**
	 * sets the clienside validation for the form input
	 * 
	 * @memberOf jQuery.fn#
	 * @method   requiredField
	 * @param    {Object} options {content: String the content of the popper,
	 *                           delay: int visibility time (default 3000 ms)}
	 * @returns  {jQuery.fn} object for method chaining
	 */
	$.fn.requiredField = function ($url) {
		return this.each(function () {
			var $this = $(this),
					$name = $this.attr("name"),
					$form = $this.parents("form"),
					$validate = true;

			console.log("requiredField: '" + $name + "'");
			//console.log(sphp.getHttpRoot());
			//$this.setValidationWrapper();
			function getPostData() {
				var postData = {
					op: "require",
					value: $this.val(),
					validate: $this.attr("name")
				};
				console.log("postData:");
				console.log(postData);
				return postData;
			}
			//$errMenu = $form.find(".ErrMenu .Content");
			$this.bind('keyup blur validate', function (event) {
				$validate = true;
				console.log("validating input: '" + $this.attr("name") + "'");
				$.get($url, getPostData(), function (data) {
					//console.log("errormessage data:");
					//alert(data);
				}).done(function (data) {
					console.log("errormessage data:");
					console.log(data);
					if ($validate) {
						console.log("input: '" + $this.attr("name") + "' validated");
						if (data.valid === false) {
							$this.addClass("sphp-invalid").removeClass("sphp-valid");
						} else {
							$this.addClass("sphp-valid").removeClass("sphp-invalid");
						}
						$form.trigger("sphp.validated", [$name]);
						$this.trigger("sphp.validated", [$name]);
					} else {
						console.log("input: '" + $this.attr("name") + "' not validated");
						$validate = true;
					}
				});
				console.log("daa");
			});
			$form.bind("reset", function () {
				$validate = false;
				//$("div." + $name + "ErrorBox").detach();
				$this.removeClass("sphp-error sphp-correct");
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
	 * class implemments ValidableInput
	 *
	 * <b>Notes:</b>
	 *
	 * This class handdles error informing about userinputs
	 *
	 * @author   Sami Holck
	 * @since    2015-05-01
	 * @requires jQuery (1.9)
	 * @see      <a href="http://jquery.com/">jQuery</a>
	 * @class    ValidableInput
	 * @param    {String} $input form's identifier (usually id-attribute)
	 */
	function ValidableInput($input) {
		console.log("new ValidableInput()");
		this.url = "http://sphp.samiholck.com/sph/ajax/validation/default.php";
		this.input = $($input);
		this.form = this.input.parents("form");
		this.initQtip().initForm();
		this.validate = true;
		this.input.bind('keyup blur validate', $.proxy(this.doValidation, this));
	}

	ValidableInput.prototype = {
		/**
		 * 
		 * @returns ValidableInput
		 */
		initQtip: function () {
			console.log("ValidableInput.setQtip()");
			var $input = this.input;
			this.input.qtip({
				content: {
					title: "Errors",
					text: ""},
				position: {
					my: 'bottom center',
					at: 'top center',
					target: $input
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
						if ($input.is(":focus") && event.originalEvent.type !== "mousedown") {
							event.preventDefault();
						}
					}
				}
			});
			this.qtipApi = this.input.qtip('api');
			this.qtipApi.disable(true);
			return this;
		},
		/**
		 * Unsets the component validation 
		 * 
		 * @returns ValidableInput
		 */
		resetValidation: function () {
			console.log("ValidableInput.resetValidation()");
			this.validate = false;
			this.input.removeClass("sphp-invalid sphp-valid");
			return this;
		},
		/**
		 * Initializes the form that includes the input component
		 * 
		 * @returns ValidableInput
		 */
		initForm: function () {
			console.log("ValidableInput.initForm()");
			this.form = this.input.parents("form");
			this.form.bind("reset", $.proxy(this.resetValidation, this));
			return this;
		},
		/**
		 * Unsets the component validation 
		 * 
		 * @returns {data}
		 */
		parseQuery: function () {
			console.log("ValidableInput.parseQuery():");
			var queryData = {
				op: "require",
				value: this.input.val(),
				validate: this.input.attr("name")
			};
			console.log(queryData);
			return queryData;
		},
		/**
		 * Unsets the component validation 
		 * 
		 * @returns {data}
		 */
		loadJson: function () {
			console.log("ValidableInput.loadJson()");
			var $data = {};
			$.get(this.url, this.parseQuery())
					.done(function (data) {
						if (jQuery.type(data) === "object") {
							console.log("\tjson data:");
							console.log(data);
							$data = data;
						} else {
							console.log("\tError loading json data");
						}
					});
			return $data;
		},
		doValidation: function () {
			console.log("ValidableInput.validate()");
			var $data = this.loadJson(), $name = this.input.attr("name");
			this.validate = true;
			if (this.validate) {
				console.log("input: '" + $name + "' validated");
				if ($data.valid === false) {
					console.log("input: '" + $name + "' validated");
					this.input.addClass("sphp-invalid").removeClass("sphp-valid");
				} else {
					this.input.addClass("sphp-valid").removeClass("sphp-invalid");
				}
				this.form.trigger("sphp.validated", [$name]);
				this.input.trigger("sphp.validated", [$name]);
			} else {
				console.log("input: '" + $name + "' not validated");
				this.validate = true;
			}
			return this;
		}
	};

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

		console.log("sphp.ValidableForm: " + this.form.find('[sphp-data-required]'));
		//this.form.find('input[name], select[name], textarea[name]').validable("http://samiholck.com/sph/ajax/validation/default.php");

		//this.form.find('[data-sphp-required]').requiredField("http://sphp.samiholck.com/sph/ajax/validation/default.php");
		this.initRequired();
	};
	/**
	 * Updates forms validity
	 */
	sphp.ValidableForm.prototype.initRequired = function () {
		//this.form.find('[data-sphp-required]').requiredField("http://sphp.samiholck.com/sph/ajax/validation/default.php");
		new ValidableInput(this.form.find('[data-sphp-required]'));
		return this;
	};
	/**
	 * Updates forms errormenu
	 */
	sphp.ValidableForm.prototype.updateAllErrorsMenu = function () {
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
		this.form.removeClass("Error Correct");
		this.errMenu.fadeOut(300);
	};

}(window.sphp = window.sphp || {}, jQuery));


