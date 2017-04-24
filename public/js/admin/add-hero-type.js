$(function () {

    var page = {
        // 初始化
        self: this,
        init: function () {
            // 提交表单
            this.postForm();
        },

        //提交表单
        postForm: function () {

            //表单校验添加监听
            $('#add-hero-type-form').parsley('addListener', {

                //表单提交之后
                onFormSubmit: function (isFormValid, event, ParsleyForm) {
                    //先阻止表单的提交时间
                    event.preventDefault();

                    if (!isFormValid) {
                        return false;
                    }

                    //获取表单
                    var form = $('#add-hero-type-form');
                    //请求URL
                    var url = form.attr('action');
                    //请求方式
                    var method = form.attr('method');
                    //请求参数
                    var params = {};
                    $.each(form.serializeArray(), function () {
                        params[this.name] = this.value;
                    });
                    params.disabled = params.disabled == 'on' ? 1 : 0; //disabled参数值转换

                    $.ajaxFun(url, method, params, function (response) {

                    });
                }
            });
        }
    };

    // 初始化
    page.init();
});
