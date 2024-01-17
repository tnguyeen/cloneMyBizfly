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
                    value="{{ $role->name }}"
                />
            </div>
            @foreach($permissions as $key => $dt)
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    value="{{ $dt->id }}"
                    id="{{ $dt->name }}"
                    data-id="{{ in_array($dt->id, $result) }}"
                    checked
                />
                <label class="form-check-label" for="{{ $dt->name }}">
                    {{ $dt->name }}
                </label>
            </div>
            @endforeach
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
            data-id="{{ $role->id }}"
        >
            Xóa
        </button>
        <button class="btn btn-primary js_btn_edit" data-id="{{ $role->id }}">
            Xác nhận
        </button>
    </div>
</div>

@endsection @section('page-script')
<script type="text/javascript">
    let data = {
        id: "",
        name: "",
        permission: "",
    };
    $(document).ready(function () {
        $(".form-check-input").each(function (index, element) {
            $(this).attr("checked", $(this).data("id") == 1);
        });
        $(".js_btn_edit").on("click", function () {
            data.permission = "";
            $(".form-check-input").map(function () {
                if ($(this).is(":checked")) {
                    data.permission += $(this).val();
                }
            });
            if ($("#name").val() == "") {
                Swal.fire("Vui lòng nhập tên nhóm quyền");
            }
            data.name = $("#name").val();
            data.id = String($(this).data("id"));
            data.permission = Number(data.permission);
            axios({
                method: "post",
                url: "/role/edit/",
                params: data,
            })
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
        });
        $(".js_btn_delete").on("click", function () {
            let id = $(this).data("id");
            Swal.fire({
                title: "Xác nhận",
                text: "Bạn chắc chắn muốn xóa nhóm quyền này ?",
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
                        .post("/role/delete/" + id)
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
