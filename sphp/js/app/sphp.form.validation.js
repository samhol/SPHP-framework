
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
	 * @author   Sami Holck
	 * @since    2015-05-01
	 * @requires jQuery (1.9)
	 * @see      <a href="http://jquery.com/">jQuery</a>
	 * @class    sphp.ValidableInput
	 * @param    {String} $input form's identifier (usually id-attribute)
	 */
	sphp.ValidableInput = function ($input) {
		console.log("new sphp.ValidableInput()");
		this.url = "http://sphp.samiholck.com/sph/ajax/validation/default.php";
		this.input = $($input);
		this.form = this.input.parents("form");
		this.initQtip().initForm();
		this.validate = true;
		this.input.bind('keyup blur validate', $.proxy(this.runValidation, this));
	};

	sphp.ValidableInput.prototype = {
		/**
		 * 
		 * @returns ValidableInput
		 */
		initQtip: function () {
			console.log("ValidableInput.setQtip()");
			var $input = this.input;
			this.tip = this.input.qtip({
				content: {
					//title: "Errors",
					text: ""},
				position: {
					my: 'bottom center',
					at: 'top center',
					target: $input
				},
				style: {
					classes: 'validator-qtip qtip-red qtip-shadow qtip-rounded'
				}, show: {
					event: 'focus'
				},
				hide: {
					event: 'unfocus'
				}, events: {
					hide: function (event, api) {
						//console.log("event.originalEvent.type:" + event.originalEvent.type);
						//console.log("event.type:" + event.type);
						/*if ($input.is(":focus") && event.originalEvent.type !== "mousedown") {
						 event.preventDefault();
						 }*/
					}
				}
			});
			this.qtipApi = this.tip.qtip('api');
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
			this.qtipApi.disable(true);
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
		 * Parses the query from the input data fields
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
			if (this.input.has("[data-sphp-pattern]"))  {
				queryData.pattern = this.input.attr("data-sphp-pattern");
			}
			console.log(queryData);
			return queryData;
		},
		/**
		 * Unsets the component validation 
		 * 
		 * @returns {data}
		 */
		runValidation: function () {
			console.log("ValidableInput.runValidation()");
			var $this = this;
			$.get(this.url, this.parseQuery())
					.done(function (data) {
						if (jQuery.type(data) === "object") {
							console.log("\tjson data:");
							console.log(data);
							$this.doValidation(data);
						} else {
							console.log("\tError loading json data");
						}
					});
			return this;
		},
		/**
		 * 
		 * @returns ValidableInput
		 */
		doValidation: function ($data) {
			console.log("ValidableInput.doValidation()");
			var $name = this.input.attr("name");
			function buildErrorList(messages) {
				var $ul = $('<div>').addClass("errors");
				$.each(messages, function (key, val) {
					var li = $('<div>').addClass("error").append(val);
					$ul.append(li);
				});
				return $ul.outerHTML();
			}
			if (jQuery.type($data) !== "object") {
				console.log("Error loading validation data for input: '" + $name + "'");
				return this;
			}
			this.validate = true;
			if (this.validate) {
				console.log("\tinput: '" + $name + "'");
				if ($data.valid === false) {
					console.log("\tis invalid");
					this.input.addClass("sphp-invalid").removeClass("sphp-valid").trigger("sphp-invalid", $data);
					//this.qtipApi.set('content.title', $data.title);
					this.qtipApi.set('content.text', buildErrorList($data.errors));
					this.input.qtip('disable', false);
					if (this.input.is(":focus")) {
						this.input.qtip("show");
					}
					//this.qtipApi.disable(false);
				} else {
					console.log("\tis valid");
					this.input.addClass("sphp-valid").removeClass("sphp-invalid");
					this.input.trigger("sphp-valid", $data);
					//this.input.qtip('disable');
					this.input.qtip('hide').qtip('disable');
					//this.qtipApi.hide();
				}
			} else {
				console.log("input: '" + $name + "' not validated");
				this.validate = true;
			}
			return this;
		},
		/**
		 * 
		 * @param   {type} data
		 * @returns ValidableInput
		 
		 renderQtip: function (data) {
		 //console.log("ValidableInput.renderQtip()");
		 function buildErrorList(messages) {
		 var $ul = $('<ul>');
		 $.each(messages, function (key, val) {
		 $ul.append("<li>" + val + "</li>");
		 });
		 //console.log("error html:" + $ul.html());
		 return $ul.outerHTML();
		 }
		 if (data.valid === false) {
		 console.log("ValidableInput.renderQtip():invalid");
		 this.qtipApi.set('content.title', data.title);
		 this.qtipApi.set('content.text', buildErrorList(data.errors));
		 //this.qtipApi.disable(false);
		 this.input.qtip('disable', false);
		 } else {
		 console.log("ValidableInput.renderQtip():valid");
		 this.qtipApi.set('content.title', " ");
		 this.qtipApi.set('content.text', " ");
		 this.input.qtip('disable');
		 //this.qtipApi.disable(true);
		 this.qtipApi.hide();
		 console.log(data.valid);
		 }
		 
		 return this;
		 }*/
	};

	/**
	 * 
	 *
	 * @author   Sami Holck
	 * @since    2015-05-03
	 * @requires jQuery (1.9)
	 * @see      <a href="http://jquery.com/">jQuery</a>
	 * @class    ValidableForm
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
	sphp.ValidableForm.prototype = {
		/**
		 * Intializes the required fields
		 */
		initRequired: function () {
			var $items = $('[data-sphp-required], [data-sphp-pattern]');
			if ($items.length > 0) {
				$items.each(function (index) {
					console.log("required field: " + index + ". " + $(this).attr("name"));
					new sphp.ValidableInput($(this));
				});
			}
			return this;
		},
		/**
		 * Updates forms errormenu
		 */
		updateAllErrorsMenu: function () {
			var $errMenuCont = this.errMenu.find(".Nfo"), $errCount = this.errMenu.find(".ErrCount");
			$.post(this.path + "?updateAllErrorsMenu", this.form.serialize(), function (data) {
				$errMenuCont.html(data);
			});
			$.post(this.path + "?errCount", this.form.serialize(), function (data) {
				$errCount.html(data);
			});
			return this;
		},
		/**
		 * Resets the form
		 */
		reset: function () {
			this.form.removeClass("Error Correct");
			this.errMenu.fadeOut(300);
			return this;
		}
	};
}(window.sphp = window.sphp || {}, jQuery));


