@extends('layouts.admin.admin_layout')


@section('content')

<!-- Row start -->
<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="row gutters content-center">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <h4>Blog</h4>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="btn-alignment">
                            <button id="add_btn" class="btn btn-info add-btn float-right" data-toggle="modal" data-target=".product-add">
                                <i class="icon-plus"></i> Add
                            </button>
                        </div>
                        <div class="custom-search">
                            <input type="text" id="blog_search" name="search" class="search-query" placeholder="Search Here..." value="">
                            <button type="button" id="blog_search_btn" class="btn-light"><i class="icon-search1"></i></button>
                            <span id="clearSearch" class="clear-icon">&times;</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row end -->

<!-- Row start -->
<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="table-container">
            <div class="table-responsive">
                <table class="table custom-table m-0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Created Date</th>
                            <th>Created By</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="blogList">
                    </tbody>
                </table>
                <div class="pagination_admin" id="paginationLinks">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row end -->
<!-- customer add Modal start  -->
<div class="modal fade product-add" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Add Blog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-scrolls">
                <section>
                    <form id="blogForm">
                        @csrf
                        <input type="hidden" id="blog_id" name="blog_id">
                        <div class="row gutters">
                            <div class="col-xl-12 col-12">
                                <div class="form-group">
                                    <label for="name">Blog Heading</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="">
                                    <span class="error-text text-danger" id="nameError"></span>
                                </div>
                            </div>
                            <div class="col-xl-12 col-12">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="" readonly>
                                    <span class="error-text text-danger" id="slugError"></span>
                                </div>
                            </div>
                            <div class="col-xl-12 col-12">
                                <div class="form-group">
                                    <label for="description">Long Description</label>
                                    <textarea class="form-control summernote" id="description" name="description"></textarea>
                                    <span class="error-text text-danger" id="descriptionError"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="image">Blog Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="blog_image" name="image">
                                            <label class="custom-file-label" for="blog_image">Choose file</label>
                                        </div>
                                    </div>
                                    <span class="error-text text-danger" id="imageError"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="imagePreviewContainer" style="margin-top: 10px;">
                                    <label class="pro-image-delete"><span id="removeImage" class="icon-delete hidden"></span></label>
                                    <img id="imagePreview" class="imagePreview image-preview hidden" src="" alt="Image Preview">
                                </div>
                            </div>

                            <div class="col-xl-12 col-12">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <span class="error-text text-danger" id="statusError"></span>
                                </div>
                            </div>
                            <div class="col-xl-12 col-12">
                                <div class="form-group">
                                    <label for="name">Meta Title</label>
                                    <textarea class="form-control" id="meta_title" name="meta_title"></textarea>
                                    <span class="error-text text-danger" id="meta_titleError"></span>
                                </div>
                            </div>
                            <div class="col-xl-12 col-12">
                                <div class="form-group">
                                    <label for="name">Meta Description</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description"></textarea>
                                    <span class="error-text text-danger" id="meta_descriptionError"></span>
                                </div>
                            </div>
                            <div class="col-xl-12 col-12">
                                <div class="form-group">
                                    <label for="name">Focus Keywords</label>
                                    <textarea class="form-control" id="focus_keywords" name="focus_keywords"></textarea>
                                    <span class="error-text text-danger" id="focus_keywordsError"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info" id="submitBtn">Add</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>

<!-- customer add Modal end  -->
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        fetchBlogs();

        $('#name').on('keyup', function() {
            var name = $(this).val();
            var slug = generateSlug(name);
            $('#slug').val(slug);
        });

        function generateSlug(text) {
            return text.toString()
                .toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');
        }

        $('#blogForm').on('submit', function(e) {
            e.preventDefault();
            $('#nameError').text('');
            $('#slugError').text('');
            $('#descriptionError').text('');
            $('#imageError').text('');
            $('#statusError').text('');

            let formElement = document.getElementById('blogForm');
            let formData = new FormData(formElement);

            let blogId = $('#blog_id').val();
            let url = blogId ? '/admin/blogs/' + blogId : '/admin/blogs';
            let method = blogId ? 'post' : 'POST';
            let msg_res = blogId ? 'edited' : 'created';

            $.ajax({
                url: url,
                type: method,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.errors) {
                        $('#nameError').text(response.errors.name);
                        $('#slugError').text(response.errors.slug);
                        $('#descriptionError').text(response.errors.description);
                        $('#imageError').text(response.errors.image);
                        $('#statusError').text(response.errors.status);
                    } else {
                        $('#blogForm')[0].reset();
                        $('.product-add').modal('hide');
                        toastr.success('Blog ' + msg_res + ' successfully');
                        fetchBlogs();
                    }

                    let firstErrorField = $('.error-text').filter(function() {
                        return $(this).text().trim() !== '';
                    }).first();

                    if (firstErrorField.length) {
                        let errorFieldId = firstErrorField.attr('id').replace('Error', '');
                        let errorField = $('#' + errorFieldId);
                        let modalBody = $('.modal-body');
                        let errorOffsetTop = errorField.offset().top;

                        modalBody.animate({
                            scrollTop: errorOffsetTop - 150 - modalBody.offset().top + modalBody.scrollTop()
                        }, 500);
                    }
                },
                error: function(response) {
                    toastr.error('Failed to create blog');
                }
            });
        });

        $('.summernote').summernote({
            height: 200,
        });
    });

    $('#add_btn').on('click', function(e) {
        $('#submitBtn').text('Add');
        $('#myExtraLargeModalLabel').text('Add Blog');
        modalScrollTop();
        $('.error-text').text('');
        $('#blogForm')[0].reset();
        $('#blog_id').val('');
        $('#description').summernote('code', '');
        $("#imagePreview").attr("src", "").removeClass("show-image-preview");
        $("#removeImage").addClass("hidden");
    });

    function editBlog(blogId) {
        $('.error-text').text('');
        modalScrollTop();
        $.ajax({
            url: '/admin/blogs/' + 'edit/' + blogId,
            method: 'GET',
            success: function(data) {
                $('#name').val(data.blog.name);
                $('#slug').val(data.blog.slug);
                $('#description').summernote('code', data.blog.description);
                $('#status').val(data.blog.status);
                $('#meta_title').val(data.blog.meta_title);
                $('#meta_description').val(data.blog.meta_description);
                $('#focus_keywords').val(data.blog.focus_keywords);
                if (data.blog.image != null) {
                    $('#imagePreview').attr('src', '/uploads/blog/' + data.blog.image).removeClass('hidden');
                    $("#imagePreview").addClass("show-image-preview");
                    $("#removeImage").removeClass("hidden");
                }
                $('#submitBtn').text('Update');
                $('#myExtraLargeModalLabel').text('Edit Blog');
                $('#blogForm').attr('action', '/blogs/' + blogId);
                $('#blog_id').val(blogId);
            }
        });
    }

    function fetchBlogs(page = 1) {
        const search = $('#blog_search').val();
        $.ajax({
            url: '/admin/blogs/getdata?page=' + page,
            method: 'GET',
            data: {
                search: search
            },
            success: function(data) {
                let blogList = '';
                if (data.blogs.data.length == 0) {
                    blogList += `<tr><td class='text-danger text-center' colspan="6"><b>No blogs found for your search.</b></td></tr>`;
                } else {
                    data.blogs.data.forEach(blog => {
                        const formattedDate = formatDate(blog.created_at);
                        blogList += `
                <tr>
                    <td><img src="${blog.image != null ? '/uploads/blog/' + blog.image : '/assets/admin/img/default_image.jpg'}" class="pro-img" alt="${blog.name}"></td>
                    <td>${blog.name}</td>
                    <td>${formattedDate}</td>
                    <td>Admin</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" ${blog.status == 1 ? 'checked' : ''} id="customSwitch${blog.id}" onchange="toggleStatus(${blog.id}, this.checked)">
                            <label class="custom-control-label" for="customSwitch${blog.id}"></label>
                        </div>
                    </td>
                    <td>
                        <div class="task-list">
                            <div class="task-block">
                                <li class="dropdown">
                                    <a href="#" id="task-actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-dots-three-horizontal action-icon"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="task-actions">
                                        <a href="#" data-toggle="modal" data-target=".product-add" onclick="editBlog(${blog.id})">
                                            <i class="icon-edit1"></i> Edit
                                        </a>
                                        <a href="#" onclick="deleteBlog(${blog.id})">
                                            <i class="icon-delete"></i> Delete
                                        </a>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </td>
                </tr>
                `;
                    });
                }
                $('#blogList').html(blogList);

                let paginationLinks = '';
                if (data.blogs.total > 10) {
                    data.blogs.links.forEach(link => {
                        if (link.url) {
                            let page = link.url.split('=')[1];
                            let activeClass = link.active ? 'active' : '';
                            paginationLinks += `<button class="btn btn-secondary btn-sm ${activeClass}" onclick="fetchBlogs(${page})">${link.label}</button>`;
                        } else {
                            paginationLinks += `<button class="btn btn-secondary btn-sm disabled">${link.label}</button>`;
                        }
                    });
                }
                $('#paginationLinks').html(paginationLinks);

            }
        });
    }

    function deleteBlog(blogId) {

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/blogs/' + blogId,
                    method: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        toastr.success(data.success);
                        fetchBlogs();
                    }
                });
            }
        });
    }
    $('#blog_search_btn').on('click', function(e) {
        e.preventDefault();
        fetchBlogs();
    });

    $('#blog_search').on('keyup', function() {
        fetchBlogs();
    });

    function formatDate(dateString) {
        if (!dateString) {
            return 'N/A';
        }

        const date = new Date(dateString);
        return date.toLocaleString('en-US', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            hour12: true,
            timeZone: 'UTC'
        }).replace(',', '');
    }

    function toggleStatus(blogId, status) {
        $.ajax({
            url: '/admin/blogs/update-status',
            method: 'patch',
            data: {
                id: blogId,
                status: status ? 1 : 0,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Status updated successfully.');
                } else {
                    toastr.error('Failed to update status.');
                }
            },
            error: function(xhr) {
                toastr.error('An error occurred while updating the status.');
            }
        });
    }
    $("#blog_image").change(function(event) {
        let file = event.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $("#imagePreview").attr("src", e.target.result).addClass("show-image-preview");
                $("#removeImage").removeClass("hidden");
            };
            reader.readAsDataURL(file);
        }
    });

    $("#removeImage").click(function() {
        $("#blog_image").val("");
        $("#imagePreview").attr("src", "").removeClass("show-image-preview");
        $("#removeImage").addClass("hidden");
    });

    function modalScrollTop() {
        let modalBody = $('.modal-body');
        modalBody.animate({
            scrollTop: modalBody.offset().top + modalBody.scrollTop()
        }, 500);
    }
    $('#blogModal').on('hidden.bs.modal', function() {
        $('#blogForm')[0].reset();
        $('#blog_id').val('');
    });

    $('#blog_search').on('input', function() {
        if ($(this).val()) {
            $('#clearSearch').show();
        } else {
            $('#clearSearch').hide();
        }
    });

    $('#clearSearch').on('click', function() {
        $('#blog_search').val('').focus();
        $(this).hide();
        fetchBlogs();
    });
</script>
@endpush