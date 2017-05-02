$(function () {

    var page = {
        // 初始化
        self: this,
        init: function () {
            // 提交表单
            this.postForm();

            //搜索视频
            this.searchElement();
        },

        //提交表单
        postForm: function () {

            //表单校验添加监听
            $('#edit-theme-form').parsley('addListener', {
                //表单提交之后
                onFormSubmit: function (isFormValid, event, ParsleyForm) {
                    //先阻止表单的提交时间
                    event.preventDefault();

                    if (!isFormValid) {
                        return false;
                    }

                    //获取表单
                    var form = $('#edit-theme-form');
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


                    var image_id = $('.upload-file-container input[name=image_id]').val();
                    params.image_id = image_id;

                    $.ajaxFun(url, method, params, function (response) {
                        window.history.go(-1);
                    });
                }
            });
        },

        searchElement: function () {
            //搜索提示
            $('.search-element-group button').click(function () {
                var name = $('.search-element-group input[type=text]').val();
                $.ajaxFun(searchUrl, 'POST', {title: name}, function (response) {
                    var html = '<ul>';
                    $.each(response.data.rows, function (i, item) {
                        if ($('.relation-element tbody tr[data-id=' + item.id + ']').size() <= 0) {
                            var image_url = item.image ? item.image.url : '';
                            html += '<li data-id="' + item.id + '" data-image-id="' + item.image_id + '" data-image-url="' + image_url + '" title="' + item.title + '">' + item.title + '</li>';
                        }
                    });
                    html += '</ul>';
                    $('.search-choice-items').removeClass('hidden').html(html);

                });
            });

            //选择素材
            $(document).on('click', '.search-choice-items li', function () {
                    var _this = $(this);
                    var id = _this.data('id');
                    var image_id = _this.data('image-id');
                    var image_url = _this.data('image-url');
                    var title = _this.html();

                    if ($('.relation-element tbody tr[data-id=' + id + ']').size() <= 0) {
                        var html = '<tr data-id="' + id + '" data-image-id="' + image_id + '" data-image-url="' + image_url + '">' +
                            '<td>' + id + '</td>' +
                            '<td>' + title + '</td>' +
                            '<td>' +
                            '<div class="btn-group">' +
                            '<input type="hidden" name="element_id" value="' + id + '" />' +
                            '<button class="btn btn-default btn-sm">操作</button>' +
                            '<button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>' +
                            '<ul class="dropdown-menu">' +
                            '<li><a href="javascript:void(0)" class="set-cover-btn">设为封面</a></li>' +
                            '<li><a href="javascript:void(0)" class="delete-tr-btn">删除</a></li>' +
                            '</ul>' +
                            '</div>' +
                            '</td>' +
                            '</tr>';
                        $('.relation-element tbody').append(html)
                    }
                    $('.search-choice-items').addClass('hidden').html('');
                }
            );

            //设置封面按钮
            $(document).on('click', '.relation-element .set-cover-btn', function () {
                var tr = $(this).closest('tr');
                $.uploadImg($('.upload-file-container'), {
                    'uploadUrl': uploadUrl,
                    'uploadParams': {
                        _token: $('meta[name=csrf-token]').attr('value')
                    },
                    'defaultId': tr.data('image-id'),
                    'defaultUrl': tr.data('image-url')
                });
            });

            //删除按钮
            $(document).on('click', '.relation-element .delete-tr-btn', function () {
                $(this).closest('tr').remove();
            });
        }
    };

    // 初始化
    page.init();
});
