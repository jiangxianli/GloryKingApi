$(function () {

    var page = {
        // 初始化
        self: this,
        init: function () {
            // 提交表单
            this.postForm();

            //视频地址解析
            this.parseUrl();

            //解析视频长度
            this.parseDuration();
        },

        //提交表单
        postForm: function () {

            //表单校验添加监听
            $('#add-element-form').parsley('addListener', {
                //表单提交之后
                onFormSubmit: function (isFormValid, event, ParsleyForm) {
                    //先阻止表单的提交时间
                    event.preventDefault();

                    if (!isFormValid) {
                        return false;
                    }

                    //获取表单
                    var form = $('#add-element-form');
                    //请求URL
                    var url = form.attr('action');
                    //请求方式
                    var method = form.attr('method');
                    //请求参数
                    var params = {};
                    $.each(form.serializeArray(), function () {
                        params[this.name] = this.value;
                    });
                    params.disabled = params.disabled == 'on' ? 0 : 1; //disabled参数值转换

                    //关联的英雄
                    var hero_id = $('.chosen-select option:selected').val();
                    params.hero_id = hero_id;

                    var image_id = $('.upload-file-container input[name=image_id]').val();
                    params.image_id = image_id;

                    $.ajaxFun(url, method, params, function (response) {
                        window.history.go(-1);
                    });
                }
            });
        },

        parseUrl: function () {

            $('.parse-url-group button').click(function () {
                var from_url = $('.parse-url-group input').val();
                var params = {from_url: from_url};

                $.ajaxFun(parseUrl, 'POST', params, function (response) {
                    $('input[name=url]').val(response.data.url);

                    $('.video-player').removeClass('hidden').find('video').attr('src', response.data.url);
                    var image = response.data.image;
                    if (image) {
                        $('.video-player video').attr('poster', image.url).attr('preload', 'load');
                        $.uploadImg($('.upload-file-container'), {
                            'uploadUrl': uploadUrl,
                            'uploadParams': {
                                _token: $('meta[name=csrf-token]').attr('value')
                            },
                            'defaultUrl': image.url,
                            'defaultId': image.id,
                        });
                    }

                    if (response.data.title) {
                        $('input[name=title]').val(response.data.title)
                    }
                });
            });

        },
        parseDuration: function () {

            $('video').change(function () {
                var video = document.getElementById('element-video');//获取video元素
                var duration = video.duration;
                if (duration > 0) {
                    $('.parse-duration-group input[type=text]').val($.formatDurationTime(duration));
                    $('.parse-duration-group input[type=hidden]').val(duration)
                }
            });

            $('.parse-duration-group button').click(function () {
                var video = document.getElementById('element-video');//获取video元素
                var duration = video.duration;
                if (duration > 0) {
                    $('.parse-duration-group input[type=text]').val($.formatDurationTime(duration));
                    $('.parse-duration-group input[type=hidden]').val(duration)
                }
            })
        }
    };

    // 初始化
    page.init();
});
