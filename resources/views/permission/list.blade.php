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
    <div class="card" style="width: 100%; margin-top: 20px">
        <div class="table-responsive-sm" style="width: 100%">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody style="border-top: 0 !important">
                    @foreach($permissions as $key => $dt)
                    <tr>
                        <td>
                            <b>
                                {{ $key + 1 }}
                            </b>
                        </td>
                        <td>
                            {{ $dt->name }}
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
            <button class="btn btn-primary js_btn_create">Thêm quyền</button>
        </div>
    </div>
</div>

@endsection @section('page-script')
<script type="text/javascript">
    $(document).ready(function () {
        $(".js_btn_edit").on("click", function () {
            let id = $(this).data("id");
            location.assign(location.origin + "/permission/edit/" + id);
        });
        $(".js_btn_create").on("click", function () {
            location.assign(location.origin + "/permission/create/");
        });
        $(".js_btn_delete").on("click", function () {
            let id = $(this).data("id");
            Swal.fire({
                title: "Xác nhận",
                text: "Bạn chắc chắn muốn xóa quyền này ?",
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
                        .post("/permission/delete/" + id)
                        .then(function (response) {
                            const res = response.data;
                            if (res.result) {
                                location.assign(
                                    location.origin + "/permission"
                                );
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
