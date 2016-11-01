'use strict';

var EnglishCalculator = EnglishCalculator || {};

EnglishCalculator.Core = EnglishCalculator.Core || {};

/**
 * @param $ Local jQuery Reference
 * @param form The DOM form to send
 * @param result The DOM element where to display the result
 * @constructor
 */
EnglishCalculator.Core.SendForm = function ($, form, result) {
    var $form,
        $result;

    function sendForm(event) {
        event.preventDefault();
        console.log($form.serialize());
        $.ajax({
            url     : $form.attr('action'),
            type    : $form.attr('method'),
            dataType: 'json',
            data    : $form.serialize(),
            success : function( data ) {
                displayResult(data.result);
            },
            error   : function( xhr, err ) {
                displayResult('There was an error!');
            }
        });
        return false;
    }

    function displayResult(result) {

        $result.html(result);
    }

    function initForm() {
        $form = $(form);
        $result = $(result);
        $form.on('submit', sendForm);
        $(document)
            .ajaxStart(function () {
                $form.find('#submit-button').val('Adding up...');
            })
            .ajaxStop(function () {
                $form.find('#submit-button').val('Add!');
            })
    }

    return {
        init: initForm
    }
};

$(document).ready(function(){
    var Module = EnglishCalculator.Core.SendForm(
        $,
        document.getElementById('sum-form'),
        document.getElementById('result')
    );
    Module.init();
});