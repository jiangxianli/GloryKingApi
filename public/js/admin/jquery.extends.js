$(function () {

    //加载中
    var loading = false;

    $.extend({

        //Ajax请求函数
        ajaxFun: function (url, method, params, success_fun, error_fun) {
            if (loading) {
                return false;
            }

            //开启加载中动画
            $('#loading-box').fadeIn();

            //添加CSRF Token
            var _token = $('meta[name=csrf-token]').attr('value');
            params._token = _token;

            $.ajax({
                url: url,
                method: method,
                data: params,
                success: function (response) {

                    if (response.code != 0) {
                        $.toast({
                            text: "" + response.msg + "",
                            position: 'bottom-right',
                            allowToastClose: false,
                            bgColor: '#f05050'
                        });
                        if (error_fun) {
                            error_fun(response)
                        }
                    } else {
                        if (success_fun) {
                            success_fun(response)
                        }
                    }

                    $('#loading-box').fadeOut();
                    loading = false;
                },
                error: function (response) {
                    if (error_fun) {
                        error_fun(response)
                    }

                    $.toast({
                        text: "网络错误，请重试!",
                        position: 'bottom-right',
                        allowToastClose: false,
                        bgColor: '#f05050'
                    });

                    $('#loading-box').fadeOut();
                    loading = false;
                }
            });

        },

        //上传图片
        uploadImg: function (element, options) {
            //默认配置
            var _default = {
                uploadUrl: '',
                uploadParams: {},
                uploadExtensions: ['jpg', 'png', 'gif'],
                defaultUrl: '',
                defaultId: 0,
            };

            _default = $.extend(_default, options);

            var version = 'upload-' + (new Date()).getTime();
            //上传器元素添加到对应容器中
            var html = $('<div class="upload-container ' + version + '">' +
                '<div class="upload-image">' +
                ( _default.defaultUrl ? ('<img src="' + _default.defaultUrl + '" />') : '' ) +
                '</div>' +
                '<input type="hidden" name="image_id" value="' + _default.defaultId + '" /> ' +
                '<div class="upload-tool">' +
                '<button class="btn btn-success pull-left col-sm-12 upload-btn"><input type="file" name="file">上传</input></button>' +
                // '<button class="btn btn-danger pull-right col-sm-6 hidden delete-btn">删除</button>'+
                '</div>' +
                '</div>');
            element.html(html);

            //上传监听
            html.find('.upload-btn input[type=file]').ajaxfileupload({
                action: _default.uploadUrl,
                valid_extensions: _default.uploadExtensions,
                params: _default.uploadParams,
                onComplete: function (response) {
                    // response = JSON.stringify(response);
                    console.log(response)
                    if (response.code == 0) {
                        console.log('test')
                        html.find('.upload-image').html('<img src="' + response.data.url + '" />');
                        html.find('input[name=image_id]').val(response.data.id);
                        // html.find('.delete-btn').removeClass('hidden');
                        // html.find('.upload-btn').removeClass('col-sm-12').addClass('col-sm-6');
                    }
                },
                onStart: function () {

                },
                onCancel: function () {
                    console.log('no file selected');
                }
            });


        },

        formatDurationTime: function (duration) {
            var duration = parseInt(duration);
            var minutes = parseInt(duration / 60);
            var seconds = parseInt(duration % 60);
            return (minutes < 10 ? '0' + minutes : minutes ) + ':' + (seconds < 10 ? '0' + seconds : seconds);
        }
    });
});