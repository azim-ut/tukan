angular.module('root')
    .service("ToastService", function () {
            angular.extend(this, {
                isValid: function (res) {
                    try {
                        return this.check(res);
                    } catch (e) {
                        console.log(e.code);
                    }
                    return false;
                },
                check: function (data) {
                    this.show(data.status, data.msg ? data.msg : data.info);
                    if (data.code !== 200) {
                        throw data.code;
                    }
                    if (data.status === "Error") {
                        throw 500;
                    }
                    return true;
                },
                info: function (msg) {
                    this.show("success", undefined, msg);
                },
                show: function (type, title, msg) {
                    type = type.toLowerCase();
                    if (toastr) {
                        toastr.options = {
                            closeButton: true,
                            positionClass: 'toast-bottom-right',
                            onclick: null,
                            showDuration: 1000,
                            hideDuration: 1000,
                            timeOut: 5000,
                            extendedTimeOut: 1000,
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut"
                        };
                        var $toast = null;
                        if (type === "success") {
                            $toast = toastr.success(msg, title);
                        } else if (type === "error") {
                            $toast = toastr.error(msg, title);
                        } else if (type === "warning") {
                            $toast = toastr.warning(msg, title);
                        } else {
                            $toast = toastr.info(msg, title);
                        }

                        var $toastlast = $toast;
                        $('#clearlasttoast').click(function () {
                            toastr.clear($toastlast);
                        });
                    }
                }
            });
        }
    );