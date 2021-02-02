jQuery(document).ready(function($) {
    new Cleave('#inputAmount', {
        numeral: true,
        numeralDecimalMark: ',',
        delimiter: '.'
    });
    $('#registerForm').submit(function(event) {
        let data = {
            name: $('#inputName').val(),
            email: $('#inputEmail').val(),
            phone: $('#inputPhone').val(),
            amount: $('#inputAmount').val(),
            content: $('#inputContent').val()
        };
        if (validateData(data) == false) {
            alert("Vui lòng nhập đầy đủ thông tin và đúng định dạng!");
            return false;
        }
        sendMailAjax(data);
        return true;
    });
    let sendMailAjax = (data = {}) => {
        jQuery.ajax({
            url: '?action=sendRegisterCompleteMail',
            type: 'POST',
            dataType: 'json',
            data: data,
            complete: function(xhr, textStatus) {
                //called when complete
            },
            success: function(data, textStatus, xhr) {
                //called when successful
            },
            error: function(xhr, textStatus, errorThrown) {
                //called when there is an error
            }
        });
    }
    let validateData = (submitted_data = {}) => {
        let default_data = {
            name: null,
            email: null,
            phone: null,
            amount: null,
            content: null
        };

        let data = Object.assign(default_data, submitted_data);

        const rex = /[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}/igm;
        if (rex.test(data.email) == false) {
            return false;
        }
        if (data.name &&
            data.email &&
            data.phone &&
            data.amount &&
            data.content) {
            return true
        } else {
            return false;
        }
    }
});