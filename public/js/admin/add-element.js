$(function () {

    var page = {
        // 初始化
        self: this,
        init: function () {
            // 提交表单
            this.postForm();

            //视频预览
           // this.videoPreview();
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

        videoPreview: function () {
            $('input[name=from_url]').on('change', function () {

                var from_url = $(this).val();


                var title = $('input[name=title]').val();
                var post = $('.upload-file-container img').attr('src');
                $("#video-player").jPlayer({
                    ready: function () {
                        $(this).jPlayer("setMedia", {
                            title: title,
                            mp4: "http://153.37.232.144/vhot2.qqvideo.tc.qq.com/b0113x7xx0m.mp4?vkey=DFB525AE6D0E723BC57819F1167C87AF9DB56C4365A8EEF223026C8D080EB1A74949883FE254DE857A450751EC0A26F7D359679F4BDBD0B02C122667DC7414D034E10C7FECFF7F4100659DCF3CBAF9183CD750A41230510D062DA9D854609DB9&br=76376&platform=1&fmt=mp4&level=0&type=mp4",
                            poster: post
                        });
                    },
                    swfPath: "js",
                    supplied: "mp4",
                    size: {
                        width: "100%",
                        height: "auto",
                        cssClass: "jp-video-360p"
                    },
                    globalVolume: true,
                    smoothPlayBar: true,
                    keyEnabled: true
                });
            });
        }
    };

    // 初始化
    page.init();
});
