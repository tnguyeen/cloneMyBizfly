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
        </form>
    </div>
    <div
        style="width: 100%; display: flex; justify-content: end; padding: 20px"
    >
        <button class="btn btn-primary js_btn_create">Thêm quyền</button>
    </div>
</div>

@endsection @section('page-script')
<script type="text/javascript">
    let data = {
        name: "",
    };
    $(document).ready(function () {
        $(".js_btn_create").on("click", function () {
            if ($("#name").val() == "") {
                Swal.fire("Vui lòng nhập tên quyền");
            }
            data.name = $("#name").val();
            axios({
                method: "post",
                url: "/permission/create/",
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
    });
</script>
@endsection
