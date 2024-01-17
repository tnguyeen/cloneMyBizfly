@extends('layouts.fullPage') @section('title') Login @endsection
@section('content')
<div class="container">
    <div
        class="row d-flex justify-content-center align-items-center"
        style="height: 100%"
    >
        <div class="col-lg-12" id="wrap-login">
            <div class="full-page">
                <div class="full-page-left">
                    <div class="logo text-center m-b-20">
                        <img
                            src="https://mingid.mediacdn.vn/vietid-golang/image/bizfly2020/login_dangky.png"
                            alt=""
                        />
                    </div>
                    <p class="text-center font18 text-83878a">
                        Chào mừng bạn đến với
                    </p>
                    <p
                        class="text-center font-Sarabun-SemiBold font26 text-000000"
                    >
                        Quản lý dự án của Bizfly
                    </p>
                    <div class="line1"></div>
                    <p class="text-center text-424557 m-b-30">
                        Lưu ý: Bizfly sử dụng hệ thống đăng nhập dùng chung
                        ViệtID, do vậy nếu bạn đã từng đăng ký và sử dụng ViệtID
                        trên các hệ thống khác của VCCorp thì có thể sử dụng để
                        đăng nhập luôn mà không cần đăng ký
                    </p>
                    <p class="text-center">
                        Bạn gặp vấn đề khi đăng nhập?<a
                            href="https://help.bizfly.vn/cach-dang-ky-va-dang-nhap-tren-my-bizfly-n20.html"
                            target="_blank"
                            class="xhd"
                        >
                            Xem hướng dẫn</a
                        >
                    </p>
                </div>
                <div class="full-page-right">
                    <div class="logo text-center m-b-10">
                        <img
                            src="https://mingid.mediacdn.vn/vietid-golang/image/bizfly2020/logo2.png"
                            alt=""
                        />
                    </div>
                    <p
                        class="text-center font22 text-21273d font-Sarabun-SemiBold m-b-20"
                    >
                        Đăng nhập hệ thống giải pháp&nbsp;<img
                            src="https://my.bizfly.vn/assets/siteV3/vietid/images/bizfly.png"
                            alt=""
                            style="
                                position: relative;
                                top: -5px;
                                width: 78px;
                                height: 31px;
                            "
                        />&nbsp;bằng tài khoản ViệtID của bạn
                    </p>
                    <div>
                        <div
                            id="userError"
                            class="text-danger m-b-20 font-Sarabun-SemiBold"
                        ></div>
                        <div class="m-b-20" id="loginForm">
                            <label class="m-b-5 d-block" for="usernameInput"
                                >Nhập email hoặc sđt</label
                            ><input
                                placeholder="Nhập Email hoặc SĐT tài khoản VietID của bạn"
                                name="account"
                                type="email"
                                class="form-control m-b-20"
                                id="usernameInput"
                                value=""
                            />
                            <label class="m-b-5 d-block" for="passwordInput"
                                >Nhập mật khẩu</label
                            ><input
                                placeholder="Nhập mật khẩu"
                                name="password"
                                type="password"
                                class="form-control m-b-20"
                                id="passwordInput"
                                value=""
                            />
                        </div>
                        <div class="m-b-20">
                            <button
                                class="btn btn-block btn-primary font-Sarabun-Bold font16"
                                id="btnLogin"
                            >
                                Đăng nhập
                            </button>
                        </div>
                    </div>
                    <p
                        class="text-center font-Sarabun-SemiBold text-0000000 m-b-30"
                        id="belowLink"
                    >
                        Bạn chưa có tài khoản?<a
                            href="/oauth/bizfly2020/register"
                            style="text-decoration: none"
                        >
                            Tạo tài khoản mới</a
                        >
                    </p>
                    <div
                        class="login-by text-center text-000000 opacity-61 m-b-10"
                    >
                        Login by
                        <img
                            src="https://mingid.mediacdn.vn/vietid-golang/image/bizfly2020/logo.png"
                            alt=""
                            class="mob-login-small-logo"
                        />
                    </div>
                    <p
                        class="copyright font12 text-797979 opacity-61 text-center"
                    >
                        Copyright 2019 © VCCorp All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection @section('page-script')
<script type="text/javascript">
    let dataLogin = {
        email: "",
        password: "",
    };

    $(document).ready(function () {
        $(this).on("click", "#btnLogin", function () {
            axios({
                method: "post",
                url: "/api/auth/login",
                params: dataLogin,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            })
                .then(function (response) {
                    const res = response.data;
                    if (res.result) {
                        window.location.assign("/home");
                    } else {
                        $("#userError").html(res.message);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                    $("#userError").html(error.response.data.message);
                });
        });
        $(this).on("change", "#usernameInput", function () {
            dataLogin.email = $(this).val();
        });
        $(this).on("change", "#passwordInput", function () {
            dataLogin.password = $(this).val();
        });
    });
</script>
@endsection
