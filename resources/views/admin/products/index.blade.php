@extends('layouts.admin.admin_layout')


@section('content')

<!-- Row start -->
<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="row gutters content-center">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <h4>Products</h4>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="btn-alignment">
                            <button id="add_btn" class="btn btn-info add-btn float-right" data-toggle="modal" data-target=".product-add">
                                <i class="icon-plus"></i> Add
                            </button>
                        </div>
                        <div class="custom-search">
                            <form method="GET" action="">
                                <input type="text" id="product_search" name="search" class="search-query" placeholder="Search Here..." value="">
                                <button type="button" id="product_search_btn" class="btn-light"><i class="icon-search1"></i></button>
                                <span id="clearSearch" class="clear-icon">&times;</span>
                            </form>
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
                            <th>Amount (Rs)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productList">

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
<div class="modal fade product-add" id="productModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-scrolls">
                <form id="productForm">
                    @csrf
                    <input type="hidden" id="product_id" name="product_id">
                    <section>

                        <div class="row gutters">
                            <div class="col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="cate">Category</label>
                                    <select class="form-control selectpicker" name="category_id" id="category_id" data-live-search="true">
                                    </select>
                                    <span class="error-text text-danger" id="category_idError"></span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control required" name="name" id="name" placeholder="">
                                    <span class="error-text text-danger" id="nameError"></span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="" readonly>
                                    <span class="error-text text-danger" id="slugError"></span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="product_price">Product Price</label>
                                    <input type="text" class="form-control" name="product_price" id="product_price" placeholder="">
                                    <span class="error-text text-danger" id="product_priceError"></span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="sale_price">Sale Price</label>
                                    <input type="text" class="form-control" name="sale_price" id="sale_price" placeholder="">
                                    <span class="error-text text-danger" id="sale_priceError"></span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" class="form-control" id="tags" name="tags" value="" data-role="tagsinput" placeholder="type and press enter">
                                    <span class="error-text text-danger" id="tagsError"></span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="name">Product Weight (KG)</label>
                                    <input type="text" class="form-control" name="product_weight" id="product_weight" placeholder="">
                                    <span class="error-text text-danger" id="product_weightError"></span>
                                </div>
                            </div>
                            <div class="col-xl-12 col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="new_arrivals" id="new_arrivals" value="1">
                                        <label class="custom-control-label" for="new_arrivals">New Arrivals</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="featured" id="featured" value="1">
                                        <label class="custom-control-label" for="featured">Featured Products</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-12">
                                <div class="form-group">
                                    <label for="description">Short Description</label>
                                    <textarea class="form-control summernote" id="short_description" name="short_description"></textarea>
                                    <span class="error-text text-danger" id="short_descriptionError"></span>
                                </div>
                            </div>
                            <div class="col-xl-12 col-12">
                                <div class="form-group">
                                    <label for="description">Long Description</label>
                                    <textarea class="form-control summernote" id="long_description" name="long_description"></textarea>
                                    <span class="error-text text-danger" id="long_descriptionError"></span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="image_1">Product Image 1</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image_1" id="image_1" onchange="previewImage(this, 'imagePreview_1', 'removeImage_1')">
                                            <label class="custom-file-label" for="image_1">Choose file</label>
                                        </div>
                                    </div>
                                    <span class="error-text text-danger" id="image_1Error"></span>
                                </div>
                                <div id="imagePreviewContainer_1" style="margin-top: 10px;">
                                    <label class="pro-image-delete"><span id="removeImage_1" class="icon-delete hidden" onclick="removeImage('image_1', 'imagePreview_1', 'removeImage_1')"></span></label>
                                    <img id="imagePreview_1" class="imagePreview hidden" src="" alt="Image Preview">
                                </div>
                            </div>

                            <div class="col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="image_2">Product Image 2</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image_2" id="image_2" onchange="previewImage(this, 'imagePreview_2', 'removeImage_2')">
                                            <label class="custom-file-label" for="image_2">Choose file</label>
                                        </div>
                                    </div>
                                    <span class="error-text text-danger" id="image_2Error"></span>
                                </div>
                                <div id="imagePreviewContainer_2" style="margin-top: 10px;">
                                    <label class="pro-image-delete"><span id="removeImage_2" class="icon-delete hidden" onclick="removeImage('image_2', 'imagePreview_2', 'removeImage_2')"></span></label>
                                    <img id="imagePreview_2" class="imagePreview hidden" src="" alt="Image Preview">
                                </div>
                            </div>

                            <div class="col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="image_3">Product Image 3</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image_3" id="image_3" onchange="previewImage(this, 'imagePreview_3', 'removeImage_3')">
                                            <label class="custom-file-label" for="image_3">Choose file</label>
                                        </div>
                                    </div>
                                    <span class="error-text text-danger" id="image_3Error"></span>
                                </div>
                                <div id="imagePreviewContainer_3" style="margin-top: 10px;">
                                    <label class="pro-image-delete"><span id="removeImage_3" class="icon-delete hidden" onclick="removeImage('image_3', 'imagePreview_3', 'removeImage_3')"></span></label>
                                    <img id="imagePreview_3" class="imagePreview hidden" src="" alt="Image Preview">
                                </div>
                            </div>

                            <div class="col-xl-6 col-12">
                                <div class="form-group">
                                    <label for="image_4">Product Image 4</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image_4" id="image_4" onchange="previewImage(this, 'imagePreview_4', 'removeImage_4')">
                                            <label class="custom-file-label" for="image_4">Choose file</label>
                                        </div>
                                    </div>
                                    <span class="error-text text-danger" id="image_4Error"></span>
                                </div>
                                <div id="imagePreviewContainer_4" style="margin-top: 10px;">
                                    <label class="pro-image-delete"><span id="removeImage_4" class="icon-delete hidden" onclick="removeImage('image_4', 'imagePreview_4', 'removeImage_4')"></span></label>
                                    <img id="imagePreview_4" class="imagePreview hidden" src="" alt="Image Preview">
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
                    </section>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
<!-- customer add Modal end  -->

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
        $(document).on('keyup', '.bs-searchbox input', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                let newCategory = $(this).val().trim();
                if (newCategory !== "") {
                    let slug = generateSlug(newCategory);
                    if ($('#category_id option').filter(function() {
                            return $(this).text().toLowerCase() === newCategory.toLowerCase();
                        }).length === 0) {

                        $(this).val('');
                        $.ajax({
                            url: '/admin/add_new_category',
                            method: 'POST',
                            data: {
                                name: newCategory,
                                slug: slug,
                                status: 1,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.errors) {
                                    for (let field in response.errors) {
                                        if (response.errors.hasOwnProperty(field)) {
                                            toastr.error(response.errors[field][0].charAt(0).toUpperCase() + response.errors[field][0].slice(1) + '\n Category may be Inactive');
                                        }
                                    }
                                }
                                if (response.success && response.new_category_id > 0) {
                                    let categoryList = document.getElementById('category_id');
                                    categoryList.innerHTML = '';
                                    getCategorylist();
                                    let newCategoryId = response.new_category_id;
                                    $('#category_id').append(new Option(newCategory, newCategoryId)).selectpicker('refresh');
                                    $('#category_id').selectpicker('val', newCategoryId);
                                    $('.bs-searchbox').val('');
                                    $('.selectpicker').selectpicker('toggle');
                                    $('.bs-searchbox input').val('');
                                    toastr.success('New category added successfully!');
                                }
                            },
                            error: function(error) {
                                toastr.error('Failed to added new category');
                            }
                        });
                    } else {
                        alert('Category already exists!');
                    }
                }
            }
        });

        fetchProducts();

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

        $('#productForm').on('submit', function(e) {
            e.preventDefault();
            $('.error-text').text('');

            let formElement = document.getElementById('productForm');
            let formData = new FormData(formElement);

            let productId = $('#product_id').val();
            let url = productId ? '/admin/products/' + productId : '/admin/products';
            let method = productId ? 'post' : 'POST';
            let msg_res = productId ? 'edited' : 'created';

            $.ajax({
                url: url,
                type: method,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.errors) {
                        for (let field in response.errors) {
                            if (response.errors.hasOwnProperty(field)) {
                                $('#' + field + 'Error').html(
                                    response.errors[field][0].charAt(0).toUpperCase() + response.errors[field][0].slice(1)
                                );
                            }
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
                    } else {
                        $('#productForm')[0].reset();
                        $('.product-add').modal('hide');
                        toastr.success('Product ' + msg_res + ' successfully');
                        fetchProducts();
                    }
                },
                error: function(response) {
                    toastr.error('Failed to create product');
                }
            });
        });

        $('.summernote').summernote({
            height: 200,
        });

        $('#tags').tagsinput({
            maxTags: 5,
            trimValue: true,
        });

        $('#tags').on('blur', function() {
            if ($(this).val() === '') {
                $(this).attr('placeholder', 'Type and press enter');
            }
        });

        $('#tags').on('focus', function() {
            $(this).attr('placeholder', '');
        });

        $('#tags').on('itemAdded', function(event) {
            var tagCount = $('#tags').tagsinput('items').length;
            if (tagCount > 20) {
                $('#tags').tagsinput('remove', event.item);
                $('#tagsError').text('You can only add up to 20 tags.');

            }
            setTimeout(() => {
                $('#tagsError').text('');
            }, 4000);
        });

    });

    $('#add_btn').on('click', function(e) {
        modalScrollTop();
        $('#submitBtn').text('Add');
        $('#myExtraLargeModalLabel').text('Add Product');
        $('.error-text').text('');
        $('#productForm')[0].reset();
        $('#short_description').summernote('code', '');
        $('#long_description').summernote('code', '');
        $("#imagePreview_1,#imagePreview_2,#imagePreview_3,#imagePreview_4").attr("src", "").removeClass("show-image-preview");
        $("#removeImage_1,#removeImage_2,#removeImage_3,#removeImage_4").addClass("hidden");
        getCategorylist();

    });

    function editProduct(productId) {
        modalScrollTop();
        getCategorylist();
        $("#imagePreview_1,#imagePreview_2,#imagePreview_3,#imagePreview_4").attr("src", "").removeClass("show-image-preview");
        $("#removeImage_1,#removeImage_2,#removeImage_3,#removeImage_4").addClass("hidden");
        $('.error-text').text('');
        $.ajax({
            url: '/admin/products/' + 'edit/' + productId,
            method: 'GET',
            success: function(data) {
                setTimeout(function() {
                $('#category_id').val(data.product.category_id).trigger('change');
                $('#name').val(data.product.name);
                $('#slug').val(data.product.slug);
                $('#product_price').val(data.product.product_price);
                $('#sale_price').val(data.product.sale_price);
                $('#tags').val(data.product.tags);
                $('#product_weight').val(data.product.product_weight);
                $('#short_description').summernote('code', data.product.short_description);
                $('#long_description').summernote('code', data.product.long_description);
                $('#status').val(data.product.status);
                $('#meta_title').val(data.product.meta_title);
                $('#meta_description').val(data.product.meta_description);
                $('#focus_keywords').val(data.product.focus_keywords);

                const images = ['image_1', 'image_2', 'image_3', 'image_4'];
                images.forEach((image, index) => {
                    if (data.product[image] != null) {
                        $('#imagePreview_' + (index + 1)).attr('src', '/uploads/products/' + data.product[image])
                            .removeClass('hidden')
                            .addClass('show-image-preview');
                        $('#removeImage_' + (index + 1)).removeClass('hidden');
                    }
                });
                $('#new_arrivals').prop('checked', false);
                if (data.product.new_arrivals) {
                    $('#new_arrivals').prop('checked', true);
                }
                $('#featured').prop('checked', false);
                if (data.product.featured) {
                    $('#featured').prop('checked', true);
                }
                $('#submitBtn').text('Update');
                $('#myExtraLargeModalLabel').text('Edit Product');
                $('#productForm').attr('action', '/products/' + productId);
                $('#product_id').val(productId);
            }, 100);
            }
        });
    }

    function getCategorylist() {
        let categoryList = document.getElementById('category_id');
        categoryList.innerHTML = '';
        fetch('/admin/category_list')
            .then(response => response.json())
            .then(data => {
                let categoryList = document.getElementById('category_id');
                let defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = 'Select One';
                categoryList.appendChild(defaultOption);
                data.forEach(category => {
                    let option = document.createElement('option');
                    option.value = category.id;
                    option.text = category.name;
                    categoryList.appendChild(option);
                });
                $('.selectpicker').selectpicker('refresh');
            })
            .catch(error => console.error('Error loading categories:', error));

    };

    function fetchProducts(page = 1) {
        const search = $('#product_search').val();
        $.ajax({
            url: '/admin/products/getdata?page=' + page,
            method: 'GET',
            data: {
                search: search
            },
            success: function(data) {
                let productList = '';
                if (data.products.data.length == 0) {
                    productList += `<tr><td class='text-danger text-center' colspan="6"><b>No products found for your search.</b></td></tr>`;
                } else {
                    data.products.data.forEach(product => {
                        const formattedDate = formatDate(product.created_at);
                        productList += `
                <tr>
                    <td><img src="${product.image_1 != null ? '/uploads/products/' + product.image_1 : '/assets/admin/img/default_image.jpg'}" class="pro-img" alt="${product.name}"></td>
                    <td>${product.name}</td>
                    <td>${formattedDate}</td>
                    <td>Admin</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" ${product.status == 1 ? 'checked' : ''} id="customSwitch${product.id}" onchange="toggleStatus(${product.id}, this.checked)">
                            <label class="custom-control-label" for="customSwitch${product.id}"></label>
                        </div>
                    </td>
                    <td>${product.product_price == null ? '':product.product_price}</td>
                    <td>
                        <div class="task-list">
                            <div class="task-block">
                                <li class="dropdown">
                                    <a href="#" id="task-actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-dots-three-horizontal action-icon"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="task-actions">
                                        <a href="#" data-toggle="modal" data-target=".product-add" onclick="editProduct(${product.id})">
                                            <i class="icon-edit1"></i> Edit
                                        </a>
                                        <a href="#" onclick="deleteProduct(${product.id})">
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
                $('#productList').html(productList);

                let paginationLinks = '';
                if (data.products.total > 10) {
                    data.products.links.forEach(link => {
                        if (link.url) {
                            let page = link.url.split('=')[1];
                            let activeClass = link.active ? 'active' : '';
                            paginationLinks += `<button class="btn btn-secondary btn-sm ${activeClass}" onclick="fetchProducts(${page})">${link.label}</button>`;
                        } else {
                            paginationLinks += `<button class="btn btn-secondary btn-sm disabled">${link.label}</button>`;
                        }
                    });
                }
                $('#paginationLinks').html(paginationLinks);
            }
        });
    }

    function deleteProduct(productId) {
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
                    url: '/admin/products/' + productId,
                    method: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        toastr.success('Product deleted successfully');
                        fetchProducts();
                    }
                });
            }
        });
    }
    $('#product_search_btn').on('click', function(e) {
        e.preventDefault();
        fetchProducts();
    });

    $('#product_search').on('keyup', function() {
        fetchProducts();
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

    function toggleStatus(productId, status) {
        $.ajax({
            url: '/admin/products/update-status',
            method: 'patch',
            data: {
                id: productId,
                status: status ? 1 : 0,
                _token: $('meta[name="csrf-token"]').attr('content')
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

    function previewImage(input, previewId, removeId) {
        var file = input.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#" + previewId).attr('src', e.target.result).addClass('show-image-preview');
                $("#" + removeId).removeClass('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    function removeImage(inputId, previewId, removeButtonId) {
        $("#" + inputId).val("");
        $("#" + previewId).attr("src", "").removeClass("show-image-preview");
        $("#" + removeButtonId).addClass("hidden");
    }

    function modalScrollTop() {
        let modalBody = $('.modal-body');
        modalBody.animate({
            scrollTop: modalBody.offset().top + modalBody.scrollTop()
        }, 500);
    }

    $('#productModal').on('hidden.bs.modal', function() {
        $('#productForm')[0].reset();
        $('#product_id').val('');
    });

    $('#product_search').on('input', function() {
        if ($(this).val()) {
            $('#clearSearch').show();
        } else {
            $('#clearSearch').hide();
        }
    });

    $('#clearSearch').on('click', function() {
        $('#product_search').val('').focus();
        $(this).hide();
        fetchProducts();
    });
</script>

@endpush