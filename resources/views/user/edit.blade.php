@extends('layouts.main') @section('title') Sửa @endsection @section('content')

<div class="card" style="height: 100%; width: 80%; padding: 40px">
    <div style="height: 100%; width: 100%; padding: 20px">
        <form>
            <div class="form-group m-b-20">
                <label for="name">Tên</label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    value="{{ $user->name }}"
                />
            </div>
            <div class="form-group m-b-20">
                <label for="email">Địa chỉ Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    value="{{ $user->email }}"
                />
            </div>

            <div class="form-group m-b-20">
                <label for="role">Chức vụ</label>
                <select
                    name="role"
                    id="role"
                    class="form-select"
                    data-id="{{ $user->role_id }}"
                >
                    @foreach($roles as $key => $dt)
                    <option value="{{ $dt->id }}">{{ $dt->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
    <div
        style="width: 100%; display: flex; justify-content: end; padding: 20px"
    >
        <button
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#exampleModal"
            style="margin-right: 40px"
        >
            Đổi mật khẩu
        </button>
        <button class="btn btn-primary js_btn_edit" data-id="{{ $user->id }}">
            Sửa người dùng
        </button>
    </div>
</div>

<div class="modal" id="exampleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Đổi mật khẩu</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group m-b-20">
                    <label for="password">Nhập mật khẩu cũ</label>
                    <input type="text" class="form-control" id="password" />
                </div>
                <div class="form-group m-b-20">
                    <label for="password">Nhập mật khẩu mới</label>
                    <input type="text" class="form-control" id="newPassword" />
                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-primary js_btn_editPassword"
                    data-id="{{ $user->id }}"
                >
                    Đổi
                </button>
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                >
                    Hủy
                </button>
            </div>
        </div>
    </div>
</div>

@endsection @section('page-script')
<script type="text/javascript">
    let data = {
        id: "",
        email: "",
        name: "",
        role: 0,
    };
    $(document).ready(function () {
        $("#role").val(String($("#role").data("id")));

        $(".js_btn_edit").on("click", function () {
            data.id = String($(this).data("id"));
            data.email = $("#email").val();
            data.name = $("#name").val();
            data.role = $("#role").val();
            axios({
                method: "post",
                url: "/user/edit/",
                params: data,
            })
                .then(function (response) {
                    const res = response.data;
                    if (res.result) {
                        location.assign(location.origin + "/user");
                    } else {
                        console.log(res);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
        $(".js_btn_editPassword").on("click", function () {
            axios({
                method: "post",
                url: "/user/editPassword",
                params: {
                    id: String($(this).data("id")),
                    password: $("#password").val(),
                    newPassword: $("#newPassword").val(),
                },
            })
                .then(function (response) {
                    const res = response.data;
                    if (res.result) {
                        location.assign(location.origin + "/user");
                    } else {
                        Swal.fire(res.message);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
    });
</script>
@endsection
