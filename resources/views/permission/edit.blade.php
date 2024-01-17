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
                    value="{{ $permission->name }}"
                />
            </div>
        </form>
    </div>
    <div
        style="width: 100%; display: flex; justify-content: end; padding: 20px"
    >
        <button
            type="button"
            class="btn btn-primary"
            id="js_btn_delete"
            data-toggle="modal"
            data-target="#exampleModal"
            style="margin-right: 40px"
            data-id="{{ $permission->id }}"
        >
            Xóa
        </button>
        <button
            class="btn btn-primary js_btn_edit"
            data-id="{{ $permission->id }}"
        >
            Xác nhận
        </button>
    </div>
</div>

@endsection @section('page-script')
<script type="text/javascript">
    let data = {
        id: "",
        name: "",
    };
    $(document).ready(function () {
        $(".js_btn_edit").on("click", function () {
            if ($("#name").val() == "") {
                Swal.fire("Vui lòng nhập tên quyền");
            }
            data.name = $("#name").val();
            data.id = String($(this).data("id"));
            axios({
                method: "post",
                url: "/permission/edit/",
                params: data,
            })
                .then(function (response) {
                    const res = response.data;
                    if (res.result) {
                        location.assign(location.origin + "/permission");
                    } else {
                        console.log(res);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
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
                                location.assign(location.origin + "/role");
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
