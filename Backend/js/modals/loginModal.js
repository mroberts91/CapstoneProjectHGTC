$(function () {
    $('#myModal').modal('show');
});
// var loginModel = {};
//
// $(function () {
//    loginModel = kendo.observable({
//        username: '',
//        password: '',
//        plainObj: function(){
//            return new Object({
//                usernane: loginModel.username,
//                password: loginModel.password
//            });
//        },
//        subUri: '/user/login.php',
//        submit: function (e) {
//            console.log('Submitt');
//            // e.preventDefault();
//            // let d = loginModel.plainObj();
//            // return $.ajax({
//            //     type: "GET",
//            //     url: buildApiUrl(this.subUri),
//            //     headers: {
//            //         'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
//            //     },
//            //     data: $.param(d),
//            //     success: function (response, status, xhr) {
//            //         console.log(response);
//            //         console.log(status);
//            //         console.log(xhr);
//            //     },
//            //     error: function (jqXhr, textStatus, errorThrown) {
//            //         console.log(errorThrown);
//            //         console.log(jqXhr);
//            //     }
//            // });
//        }
//    });
//    kendo.bind($('#myModal'), loginModel);
// });