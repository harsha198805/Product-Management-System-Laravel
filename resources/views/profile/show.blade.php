@extends('layouts.admin.admin_layout')

@section('content')

<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- Edit Contact Modal -->
        <div class="modal fade" id="editContact" tabindex="-1" role="dialog" aria-labelledby="editContactLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editContactLabel">Edit Contact</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="myProfileForm" class="row gutters">
                            @csrf
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="upload-photo-container">
                                    <img id="user_image" src="{{ URL::to( $user->image != null ? '/uploads/user_image/' . $user->image : 'assets/admin/img/user-default.png') }}" class="user-thumb" alt="Upload" />
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image">
                                                <label class="custom-file-label" for="uploadPhoto" aria-describedby="uploadPhotoAddon">Choose file</label>
                                                <span class="error-text text-danger" id="imageError"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Full Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="">
                                    <span class="error-text text-danger" id="nameError"></span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="">
                                    <span class="error-text text-danger" id="emailError"></span>
                                </div>
                                <div class="form-group">
                                    <label for="old_password">Old Password</label>
                                    <input type="password" class="form-control" id="old_password" name="old_password" value="">
                                    <span class="error-text text-danger" id="old_passwordError"></span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="nik_name">Nick Name:</label>
                                    <input type="text" class="form-control" id="nik_name" name="nik_name" value="">
                                    <span class="error-text text-danger" id="nik_nameError"></span>
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Phone Number:</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" value="">
                                    <span class="error-text text-danger" id="mobileError"></span>
                                </div>
                                <div class="form-group">
                                    <label for="birthday">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="">
                                    <span class="error-text text-danger" id="passwordError"></span>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group mb-0">
                                    <label for="">Access</label>
                                    <select class="form-control" id="role" name="role" disabled>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                    <span class="error-text text-danger" id="roleError"></span>
                                </div>
                            </div>

                            <div class="modal-footer custom">
                                <div class="left-side">
                                    <button type="button" class="btn btn-link danger btn-block" data-dismiss="modal">Cancel</button>
                                </div>
                                <div class="divider"></div>
                                <div class="right-side">
                                    <button type="submit" class="btn btn-link success btn-block">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
        <figure class="user-card">
            <figcaption>
                <a href="#" class="edit-card" data-toggle="modal" data-target="#editContact">
                    <i class="icon-mode_edit" id="icon_mode_edit"></i>
                </a>
                <a href="#" class="" data-toggle="modal" data-target="#editContact">
                    <img id="profile_user_image" src="{{ URL::to( $user->image != null ? '/uploads/user_image/' . $user->image : 'assets/admin/img/user-default.png') }}" alt="Admin" class="profile">
                    <h5 id="profile_user_name">{{ $user->name ?? ''}}</h5>
                </a>
                <ul class="list-group">
                    <li class="list-group-item" id="profile_user_email">{{ $user->email ?? ''}}</li>
                    <li class="list-group-item" id="profile_user_mobile">{{ $user->mobile ?? ''}}</li>
                </ul>
            </figcaption>
        </figure>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $('#myProfileForm').on('submit', function(e) {
            e.preventDefault();
            $('#nameError').text('');
            $('#emailError').text('');
            $('#old_passwordError').text('');
            $('#passwordError').text('');
            $('#nik_nameError').text('');
            $('#mobileError').text('');
            $('#imageError').text('');
            $('#roleError').text('');

            let formElement = document.getElementById('myProfileForm');
            let formData = new FormData(formElement);

            let url = '/admin/profile/edit';
            let method = 'POST';
            let msg_res = 'edited';

            $.ajax({
                url: url,
                type: method,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.errors) {
                        $('#nameError').text(response.errors.name);
                        $('#emailError').text(response.errors.email);
                        $('#old_passwordError').text(response.errors.old_password);
                        $('#passwordError').text(response.errors.password);
                        $('#nik_nameError').text(response.errors.nik_name);
                        $('#mobileError').text(response.errors.mobile);
                        $('#imageError').text(response.errors.image);
                        $('#roleError').text(response.errors.role);
                    } else {
                        $('#myProfileForm')[0].reset();
                        $('#editContact').modal('hide');
                        $('#profile_user_name').text(response.user.name);
                        $('#profile_user_email').text(response.user.email);
                        $('#profile_user_mobile').text(response.user.mobile);
                        $('#profile_user_image').attr('src', '/uploads/user_image/' + response.user.image);
                        toastr.success('Profile ' + msg_res + ' successfully');
                    }

                },
                error: function(response) {
                    toastr.error('Failed to update user');
                }
            });
        });
    });

    $('#icon_mode_edit, #profile_user_name').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/admin/profile/' + 'edit',
            method: 'GET',
            success: function(data) {
                $('#name').val(data.user.name);
                $('#email').val(data.user.email);
                $('#nik_name').val(data.user.nik_name);
                $('#mobile').val(data.user.mobile);
                $('#role').val(data.user.role);
                if (data.user.image != null) {
                    $('#user_image').attr('src', '/uploads/user_image/' + data.user.image);
                }
            }
        });
    });

    $("#image").change(function(event) {
        let file = event.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#user_image').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush