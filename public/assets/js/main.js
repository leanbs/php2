/**
 * Manipulate header class when scrolling.
 */
$(window).scroll(function() {
    // cek size browser / layar
    if ($(window).width() > 768) {
        if ($(document).scrollTop() > 50) {
            $('header').addClass('mini-head');
        } else {
            $('header').removeClass('mini-head');
        }
    } else {
        $('header').removeClass('mini-head');
    }
});

/**
 * Apply uppercase on the first letter.
 * (http://stackoverflow.com/a/1026087/3190026)
 *
 * @return {string} Teks hasil uppercase first letter
 */
String.prototype.upperCaseFirst = function () {
    return this.charAt(0).toUpperCase() + this.slice(1);
};

/**
 * Get the GET parameter for current URL.
 * (http://stackoverflow.com/a/21903119/3190026)
 *
 * @return {mixed} Boolean / string if the parameter exist
 */
function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}

/**
 * Tab persistence.
 * (http://stackoverflow.com/a/21443271/3190026)
 *
 * @return {void}
 */
function setupPersistentTabHistory() {
    // Show active tab on reload
    if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');

    // Remember the hash in the URL without jumping
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        if(history.pushState) {
            history.pushState(null, null, '#'+$(e.target).attr('href').substr(1));
        } else {
            location.hash = '#'+$(e.target).attr('href').substr(1);
        }
    });
}

/**
 * jQuery Validator main container.
 *
 * @param  {object} elementForm Object to be validated by jQuery Validator
 * @param  {object} rule        Object containing rules for validation
 * @return {object}             jQuery validator object
 */
function getJqueryValidator(elementForm, rule) {
    var validator = elementForm.validate({
        'rules': rule,
        'errorClass': 'has-error',
        'validClass': 'has-success',
        'highlight': function (element, errorClass, validClass) {
            $(element).closest('.form-group')
                .addClass(errorClass).removeClass(validClass);
        },
        'unhighlight': function (element, errorClass, validClass) {
            $(element).closest('.form-group')
                .removeClass(errorClass).addClass(validClass);
        },
        'errorPlacement': function (error, element) {
            error.insertAfter(
                $(element).closest('.form-group').children(':last-child')
            );
        },
    });

    return validator;
}

/**
 * Start datatables table filtering only on return key pressed.
 * (http://datatables.net/plug-ins/api/fnFilterOnReturn)
 *
 * @param  {object}    oSettings
 * @return {dataTable}
 */
jQuery.fn.dataTableExt.oApi.fnFilterOnReturn = function (oSettings) {
    var _that = this;

    this.each(function (i) {
        $.fn.dataTableExt.iApiIndex = i;
        var $this = this;
        var anControl = $('input', _that.fnSettings().aanFeatures.f);
        anControl
            .unbind('keyup search input')
            .bind('keypress', function (e) {
                if (e.which == 13) {
                    $.fn.dataTableExt.iApiIndex = i;
                    _that.fnFilter(anControl.val());
                }
            });
        return this;
    });
    return this;
};

/**
 * Call DataTable library on elementTable with extra options.
 *
 * @param  {object} elementTable DOM of table element
 * @param  {object} options      Extra options for DataTable
 * @return {object}              Datatable object
 */
function setDataTable(elementTable, options) {
    var defaultOptions = {
        'language': {
            'search' : 'Filter:',
        },
        'dom': '<"row" <"col-xs-12" <"pull-left"l><"pull-right"f>>>' +
                '<"row" <"col-xs-12" <"table-responsive"rt>>>' +
                '<"row" <"col-xs-12" <"pull-left"i><"pull-right"p>>>',
        'bRetrieve': true,
    };

    if (typeof options !== 'undefined') {
        $.extend(defaultOptions, options);
    }

    return elementTable.dataTable(defaultOptions).fnFilterOnReturn().api();
}

/**
 * Global variable for password change rule.
 *
 * @type {object}
 */
var rulePasswordChange = {
    'oldPassword': 'required',
    'password': {
        'required'  : true,
        'minlength' : 6,
    },
    'password_confirmation': {
        'required'  : true,
        'minlength' : 6,
        'equalTo'   : '#password',
    },
};

/**
 * Setup prequisites to enable modal with AJAX.
 *
 * @param  {boolean} needValidate Marks whether jquery validation is needed
 * @return {boolean}              Tells whether go to specified href is needed
 */
function setupModal(needValidate) {
    $.ajaxSetup({ 'cache': false });

    $('a[data-modal]').on('click', function (event) {
        $('#myModalContent').load(this.href, function () {
            var elementModal = $('#myModal');

            // Setup modal options & toggle.
            elementModal.modal({
                'keyboard': true,
                'backdrop': 'static',
            }, 'show');

            // Check if jquery validator is needed.
            if (typeof needValidate === 'undefined' || needValidate !== false) {
                // When modal is hidden, clear any message.
                elementModal.on('hidden.bs.modal', function () {
                    formCleanup();
                });

                var elementContainer = $(this);
console.debug(elementContainer);
                // Get the jquery validator in main.js by providing DOM of the
                // form and the rule declared in the view which includes this file.

                var validator = getJqueryValidator(elementContainer.find('form'), rule);
 
                bindForm(this, validator);
            }
        });

        return false;
    });
}

/**
 * Bind form to modal, handling form submit.
 *
 * @param  {object} dialog    Form container modal
 * @param  {object} validator jQuery validator object for current form
 * @return {void}
 */
function bindForm(dialog, validator) {
    var elementForm = $('form', dialog);
    var elementButtonSubmit = elementForm.find(':submit');
    var elementModalProgress = $('#modal-progress');

    elementForm.submit(function (event) {
        // Disable submit button to prevent submitting another.
        elementButtonSubmit.prop('disabled', true);

        event.preventDefault();

        // Stop action when jQuery validation fails
        if (!elementForm.valid()) {
            elementButtonSubmit.prop('disabled', false);
            return;
        }

        // Cleanup form
        formCleanup();

        elementModalProgress.show();

        $.ajax({
            'url': this.action,
            'type': this.method,
            'data': $(this).serialize(),
        })
        .done(function (response) {
            var modalAlertFail = $('#modal-alert-fail');

            // Check if response contain other type of error (not
            // validation error) and show them in another container
            // (#modal-alert-fail).
            elementModalProgress.hide();
            elementButtonSubmit.prop('disabled', false);

            if (response.hasOwnProperty('error')) {
                modalAlertFail.text(response.error);
                modalAlertFail.show();
                return;
            }

            modalAlertFail.hide();

            // Alternate between show success message on current opened
            // modal, or just reload the page.

            showSuccessMessage(response.success, validator, elementForm);

            setTimeout(function () {
                location.reload();
            }, 800);
        })
        .fail(function (response) {
            showValidationErrors($.parseJSON(response.responseText), validator);
            elementModalProgress.hide();
            elementButtonSubmit.prop('disabled', false);
        });
    });
}

/**
 * Error validation handler.
 *
 * @param  {object} errors    Parsed JSON object containing error message
 * @param  {object} validator jQuery validator object for current form
 * @return {void}
 */
function showValidationErrors(errors, validator) {
    var objectError = {};

    $.each(errors, function(attribute, errorMessages) {
        errorMessages.forEach(function (message) {
            objectError[attribute] = message;

            // Extra error for any attribute is omitted, only shows
            // the first error.
            return;
        });
    });

    // Use jquery validator to show the error right below the input
    // component.
    validator.showErrors(objectError);
}

/**
 * Success validation handler.
 *
 * @param  {object} message     Parsed JSON object containing success message
 * @param  {object} validator   jQuery validator object for current form
 * @param  {object} elementForm DOM of the current form
 * @return {void}
 */
function showSuccessMessage(message, validator, elementForm) {
    validator.resetForm();
    elementForm.trigger('reset');
    elementForm.children('.form-group')
        .removeClass('has-error')
        .removeClass('has-success');

    var modalAlertSuccess = $('#modal-alert-success');

    modalAlertSuccess.append(message);
    modalAlertSuccess.show();
}

/**
 * Clean up form message leftover.
 *
 * @param  {object} modalAlertSuccess DOM object of the modal
 * @return {void}
 */
function formCleanup() {
    var modalAlertSuccess = $('#modal-alert-success');
    var modalAlertFail = $('#modal-alert-fail');

    modalAlertSuccess.hide();
    modalAlertSuccess.html('');

    modalAlertFail.hide();
    modalAlertFail.html('');
}

/**
 * Serialize object from jquery DOM.
 *
 * @return {object}
 */
$.fn.serializeObject = function () {
    var objectResult = {};
    var data = this.serializeArray();

    $.each(data, function() {
        if (objectResult[this.name] !== undefined) {
            if (!objectResult[this.name].push) {
                objectResult[this.name] = [objectResult[this.name]];
            }
            objectResult[this.name].push(this.value || '');
        } else {
            objectResult[this.name] = this.value || '';
        }
    });

    return objectResult;
};

function calculateSum() {

    var sum = 0;
      // iterate through each td based on class and add the values
      $(".price").each(function() {

          var value = $(this).text();
          // add only if the value is number
          if(!isNaN(value) && value.length != 0) {
              sum += parseFloat(value);
          }
      });  
      $('#result').text(sum);  
};
