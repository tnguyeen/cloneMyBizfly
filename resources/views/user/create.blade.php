@extends('layouts.main') @section('title') Tạo người dùng @endsection
@section('content')

<div class="card" style="height: 100%; width: 80%; padding: 40px">
    <div style="height: 100%; width: 100%">
        <form>
            <div class="form-group m-b-20">
                <label for="name">Tên</label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    placeholder="Vui lòng nhập tên"
                />
            </div>
            <div class="form-group m-b-20">
                <label for="email">Địa chỉ Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    placeholder="Vui lòng nhập email"
                />
            </div>
            <div class="form-group m-b-20">
                <label for="email">Mật khẩu</label>
                <input
                    type="password"
                    class="form-control"
                    id="password"
                    placeholder="Vui lòng nhập mật khẩu"
                />
            </div>

            <div class="form-group m-b-20">
                <label for="role">Chức vụ</label>
                <select name="role" id="role" class="form-select">
                    <option value="0" disabled selected>Vui lòng chọn</option>
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
        <button class="btn btn-primary js_btn_create">Thêm người dùng</button>
    </div>
</div>

@endsection @section('page-script')
<script type="text/javascript">
    let data = {
        name: "",
        email: "",
        password: "",
        role: 0,
    };
    $(document).ready(function () {
        $(".js_btn_create").on("click", function () {
            if (
                $("#role").val() == 0 ||
                $("#email").val() == "" ||
                $("#name").val() == "" ||
                $("#password").val() == ""
            ) {
                Swal.fire("Vui lòng nhập đủ các trường!");
            }
            data.email = $("#email").val();
            data.name = $("#name").val();
            data.password = $("#password").val();
            data.role = $("#role").val();
            axios({
                method: "post",
                url: "/user/create/",
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
    });
</script>
@endsection
