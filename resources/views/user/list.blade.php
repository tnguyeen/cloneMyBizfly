@extends('layouts.main') @section('title') Người dùng @endsection
@section('content')

<div
    style="
        height: 100%;
        width: 90%;
        padding: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: white;
    "
>
    <div class="card" style="width: 100%; padding: 20px">
        <form method="GET" action="/user">
            <div class="card-body">
                <h4 class="card-title">Bộ lọc</h4>
                <div class="row">
                    <div class="col-3">
                        <label class="form-label" for="name"
                            >Tên tài khoản</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            name="name"
                            id="name"
                            placeholder="Vui lòng nhập"
                            value=""
                        />
                    </div>
                    <div class="col-3">
                        <label class="form-label" for="role_id">Chức vụ</label>
                        <select
                            class="form-select form-select-lg"
                            id="role_id"
                            name="role_id"
                            tabindex="-1"
                            aria-hidden="true"
                        >
                            <option value="0" selected>Vui lòng chọn</option>
                            @foreach($roles as $key => $dt)
                            <option value="{{ $dt->id }}">
                                {{ $dt->name }}
                            </option>

                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button
                    type="submit"
                    class="btn btn-primary waves-effect waves-float waves-light"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="14"
                        height="14"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-search"
                    >
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    Tìm kiếm
                </button>
            </div>
        </form>
    </div>
    <div class="card" style="width: 100%; margin-top: 20px">
        <div class="table-responsive-sm" style="width: 100%">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Chức vụ</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody style="border-top: 0 !important">
                    @foreach($users as $key => $dt)
                    <tr>
                        <td>
                            <b>
                                {{ $key + 1 }}
                            </b>
                        </td>
                        <td>
                            {{ $dt->name }}
                        </td>
                        <td class="text-nowrap">
                            {{ $dt->email }}
                        </td>
                        <td class="text-nowrap">
                            {{ $dt->role_id }}
                        </td>
                        <td
                            style="
                                display: flex;
                                justify-content: center;
                                align-items: center;
                            "
                        >
                            <button
                                type="button"
                                class="btn btn-sm js_btn_edit"
                                data-id="{{ $dt->id }}"
                                data-bs-original-title="Thao tác"
                                style="
                                    margin: 0 !important;
                                    margin-right: 40px !important;
                                    height: 30px;
                                "
                            >
                                Sửa
                            </button>
                            <button
                                type="button"
                                class="btn btn-sm js_btn_delete"
                                data-id="{{ $dt->id }}"
                                data-bs-original-title="Thao tác"
                                style="margin: 0 !important; height: 30px"
                            >
                                Xóa
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div
            style="
                width: 100%;
                display: flex;
                justify-content: end;
                padding: 20px;
            "
        >
            <button class="btn btn-primary js_btn_create">
                Thêm người dùng
            </button>
        </div>
    </div>
</div>

@endsection @section('page-script')
<script type="text/javascript">
    $(document).ready(function () {
        $(".js_btn_edit").on("click", function () {
            let id = $(this).data("id");
            location.assign(location.origin + "/user/edit/" + id);
        });
        $(".js_btn_create").on("click", function () {
            location.assign(location.origin + "/user/create/");
        });
        $(".js_btn_delete").on("click", function () {
            let id = $(this).data("id");
            Swal.fire({
                title: "Xác nhận",
                text: "Bạn chắc chắn muốn xóa người dùng này ?",
                // /*icon: 'warning',*/
                showCancelButton: true,
                confirmButtonText: "Xác nhận",
                cancelButtonText: "Bỏ qua",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-outline-danger ms-1",
                },
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                    axios
                        .post("/user/delete/" + id)
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
                }
            });
        });
    });
</script>
@endsection
