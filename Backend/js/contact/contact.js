var model = {};
var successModel = {};
function buildApiUrl(subUri){
    return '/CPT_262/Chapter1/Assignment/DB' + subUri;
}


$(function () {
    console.log(HttpAction.READ);
    model = kendo.observable({
        action: HttpAction.CREATE,
        comments: '',
        email: '',
        firstname: '',
        lastname: '',
        phone: '',
        isChecked: false,
        subUri : '/contact/contact.php',
        isValid : false,
        submit : function (e) {
            e.preventDefault();
            var d = new Object({});
            d.firstname = model.firstname;
            d.lastname = model.lastname;
            d.action = model.action;
            d.email = model.email;
            d.phone = model.phone;
            d.comments = model.comments;
            d.mailing = (model.isChecked)? 1 : 0;
            return $.ajax({
                type: "POST",
                url: buildApiUrl(this.subUri),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
                },
                data: $.param(d),
                success: function(response, status, xhr) {
                    console.log(response);
                    console.log(status);
                    console.log(xhr);
                    $('#contactSuccessResponse').html(response.http_code + '<br>Your form form submitted successfully.<br>We will be contacting you shortly.');
                    $('#contactSuccess').modal('show');
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                    console.log(jqXhr);
                }
            })
        }
    });
    kendo.bind($('#contactForm'), model);
    successModel = {
        goHome: function (e) {
            e.preventDefault();
            window.location.assign("http://mrober23.istwebclass.org/CPT_262/Chapter1/Assignment/UI/")
        }
    };
    kendo.bind($('#successHome'), successModel)
});

