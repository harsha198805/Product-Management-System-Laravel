@extends('layouts.admin.admin_layout')


@section('content')

<!-- Row start -->
<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="row gutters content-center">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <h4>Category</h4>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="btn-alignment">
                            <button id="add_btn" class="btn btn-info add-btn float-right" data-toggle="modal" data-target=".product-add">
                                <i class="icon-plus"></i> Add
                            </button>
                        </div>
                        <div class="custom-search">
                            <input type="text" id="category_search" name="search" class="search-query" placeholder="Search Here..." value="">
                            <button type="button" id="category_search_btn" class="btn-light"><i class="icon-search1"></i></button>
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
                    <tbody id="categoryList">
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
<div class="modal fade product-add" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-scrolls">
                <section>
                    <form id="categoryForm">
                        @csrf
                        <input type="hidden" id="category_id" name="category_id">
                        <div class="row gutters">
                            <div class="col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="">
                                    <span class="error-text text-danger" id="nameError"></span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="" readonly>
                                    <span class="error-text text-danger" id="slugError"></span>
                                </div>
                            </div>
                            <div class="col-xl-12 col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control summernote" id="description" name="description"></textarea>
                                    <span class="error-text text-danger" id="descriptionError"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="image">Add Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="category_image" name="image">
                                            <label class="custom-file-label" for="category_image">Choose file</label>
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

        fetchCategories();

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

        $('#categoryForm').on('submit', function(e) {
            e.preventDefault();
            $('#nameError').text('');
            $('#slugError').text('');
            $('#descriptionError').text('');
            $('#imageError').text('');
            $('#statusError').text('');

            let formElement = document.getElementById('categoryForm');
            let formData = new FormData(formElement);

            let categoryId = $('#category_id').val();
            let url = categoryId ? '/admin/categories/' + categoryId : '/admin/categories';
            let method = categoryId ? 'post' : 'POST';
            let msg_res = categoryId ? 'edited' : 'created';

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
                        $('#categoryForm')[0].reset();
                        $('.product-add').modal('hide');
                        toastr.success('Category ' + msg_res + ' successfully');
                        fetchCategories();
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
                    toastr.error('Failed to create category');
                }
            });
        });

        $('.summernote').summernote({
            height: 200,
        });
    });

    $('#add_btn').on('click', function(e) {
        $('#submitBtn').text('Add');
        $('#myExtraLargeModalLabel').text('Add Category');
        modalScrollTop();
        $('.error-text').text('');
        $('#categoryForm')[0].reset();
        $('#category_id').val('');
        $('#description').summernote('code', '');
        $("#imagePreview").attr("src", "").removeClass("show-image-preview");
        $("#removeImage").addClass("hidden");
    });

    function editCategory(categoryId) {
        $('.error-text').text('');
        modalScrollTop();
        $.ajax({
            url: '/admin/categories/' + 'edit/' + categoryId,
            method: 'GET',
            success: function(data) {
                $('#name').val(data.category.name);
                $('#slug').val(data.category.slug);
                $('#description').summernote('code', data.category.description);
                $('#status').val(data.category.status);
                if (data.category.image != null) {
                    $('#imagePreview').attr('src', '/uploads/category/' + data.category.image).removeClass('hidden');
                    $("#imagePreview").addClass("show-image-preview");
                    $("#removeImage").removeClass("hidden");
                }
                $('#submitBtn').text('Update');
                $('#myExtraLargeModalLabel').text('Edit Category');
                $('#categoryForm').attr('action', '/categories/' + categoryId);
                $('#category_id').val(categoryId);
            }
        });
    }

    function fetchCategories(page = 1) {
        const search = $('#category_search').val();
        $.ajax({
            url: '/admin/categories/getdata?page=' + page,
            method: 'GET',
            data: {
                search: search
            },
            success: function(data) {
                let categoryList = '';
                if (data.categories.data.length == 0) {
                    categoryList += `<tr><td class='text-danger text-center' colspan="6"><b>No categories found for your search.</b></td></tr>`;
                } else {
                data.categories.data.forEach(category => {
                    const formattedDate = formatDate(category.created_at);
                    categoryList += `
                <tr>
                    <td><img src="${category.image != null ? '/uploads/category/' + category.image : '/assets/admin/img/default_image.jpg'}" class="pro-img" alt="${category.name}"></td>
                    <td>${category.name}</td>
                    <td>${formattedDate}</td>
                    <td>Admin</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" ${category.status == 1 ? 'checked' : ''} id="customSwitch${category.id}" onchange="toggleStatus(${category.id}, this.checked)">
                            <label class="custom-control-label" for="customSwitch${category.id}"></label>
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
                                        <a href="#" data-toggle="modal" data-target=".product-add" onclick="editCategory(${category.id})">
                                            <i class="icon-edit1"></i> Edit
                                        </a>
                                        <a href="#" onclick="deleteCategory(${category.id})">
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
                $('#categoryList').html(categoryList);

                let paginationLinks = '';
                if (data.categories.total > 10) {
                    data.categories.links.forEach(link => {
                        if (link.url) {
                            let page = link.url.split('=')[1];
                            let activeClass = link.active ? 'active' : '';
                            paginationLinks += `<button class="btn btn-secondary btn-sm ${activeClass}" onclick="fetchCategories(${page})">${link.label}</button>`;
                        } else {
                            paginationLinks += `<button class="btn btn-secondary btn-sm disabled">${link.label}</button>`;
                        }
                    });
                }
                $('#paginationLinks').html(paginationLinks);
            }
        });
    }

    function deleteCategory(categoryId) {

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
                    url: '/admin/categories/' + categoryId,
                    method: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        toastr.success(data.success);
                        fetchCategories();
                    }
                });
            }
        });
    }
    $('#category_search_btn').on('click', function(e) {
        e.preventDefault();
        fetchCategories();
    });

    $('#category_search').on('keyup', function() {
        fetchCategories();
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

    function toggleStatus(categoryId, status) {
        $.ajax({
            url: '/admin/categories/update-status',
            method: 'patch',
            data: {
                id: categoryId,
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
    $("#category_image").change(function(event) {
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
        $("#category_image").val("");
        $("#imagePreview").attr("src", "").removeClass("show-image-preview");
        $("#removeImage").addClass("hidden");
    });

    function modalScrollTop() {
        let modalBody = $('.modal-body');
        modalBody.animate({
            scrollTop: modalBody.offset().top + modalBody.scrollTop()
        }, 500);
    }
    $('#categoryModal').on('hidden.bs.modal', function() {
        $('#categoryForm')[0].reset();
        $('#category_id').val('');
    });

    $('#category_search').on('input', function() {
        if ($(this).val()) {
            $('#clearSearch').show();
        } else {
            $('#clearSearch').hide();
        }
    });

    $('#clearSearch').on('click', function() {
        $('#category_search').val('').focus();
        $(this).hide();
        fetchCategories();
    });
</script>
@endpush