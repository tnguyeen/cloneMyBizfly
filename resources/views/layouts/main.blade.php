<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=Nunito"
            rel="stylesheet"
        />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <link href="/css/fullPage.css" rel="stylesheet" />
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div
            id="app"
            style="
                height: 100vh;
                background-color: #e7e7e7;
                display: flex;
                flex-direction: column;
                align-items: center;
            "
        >
            <div
                style="
                    height: 70px;
                    width: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 0 120px;
                    /* border-bottom: 1px solid gray; */
                    margin-bottom: 40px;
                    background-color: white;
                "
            >
                <div>
                    <nav
                        class="navbar navbar-expand-lg navbar-light bg-light mr-auto"
                    >
                        <div class="nav-item" style="margin-right: 20px">
                            <a class="nav-link" href="/">Trang chủ</a>
                        </div>
                        <div class="nav-item" style="margin-right: 20px">
                            <a class="nav-link" href="/user">Tài khoản</a>
                        </div>
                        <div
                            class="nav-item dropdown"
                            style="margin-right: 30px"
                        >
                            <span
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="navbarDropdown"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                Phân quyền
                            </span>
                            <div
                                class="dropdown-menu"
                                id="roleDropdown"
                                aria-labelledby="navbarDropdown"
                            >
                                <a
                                    class="d-flex align-items-center menu-item"
                                    href="/role"
                                    target="_self"
                                    style="padding: 10px; cursor: pointer"
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
                                        class="feather feather-circle"
                                    >
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg>
                                    <span
                                        class="text-truncate"
                                        style="margin-left: 10px"
                                        >Nhóm quyền</span
                                    >
                                </a>
                                <a
                                    class="d-flex align-items-center menu-item"
                                    target="_self"
                                    href="/permission"
                                    style="padding: 10px; cursor: pointer"
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
                                        class="feather feather-circle"
                                    >
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg>
                                    <span
                                        class="text-truncate"
                                        style="margin-left: 10px"
                                        >Quyền</span
                                    >
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
                <div style="position: relative" class="dropdown">
                    <button
                        class="dropdown-toggle btn"
                        type="button"
                        id="dropdownMenuButton"
                        data-toggle="dropdown"
                    >
                        <div>{{ auth()->user()->name }}</div>
                    </button>
                    <div
                        class="dropdown-menu"
                        id="userDropdown"
                        aria-labelledby="dropdownMenuButton"
                        style="top: 60px !important; padding: 10px"
                    >
                        <div
                            class="dropdown-item rounded"
                            style="cursor: pointer; padding: 10px"
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
                                class="feather feather-key me-50"
                            >
                                <path
                                    d="m7 9 3.75 3a2 2 0 0 0 2.5 0L17 9m4 8V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2z"
                                ></path>
                            </svg>
                            {{ auth()->user()->email }}
                        </div>
                        <div
                            class="dropdown-item rounded"
                            id="btnChangePassword"
                            data-toggle="modal"
                            data-target="#exampleModal"
                            style="cursor: pointer; padding: 10px"
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
                                class="feather feather-key me-50"
                            >
                                <path
                                    d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"
                                ></path>
                            </svg>
                            Đổi mật khẩu
                        </div>
                        <div
                            class="dropdown-item rounded"
                            id="btnLogout"
                            style="cursor: pointer; padding: 10px"
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
                                class="feather feather-power me-50"
                            >
                                <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                                <line x1="12" y1="2" x2="12" y2="12"></line>
                            </svg>
                            Logout
                        </div>
                    </div>
                </div>
            </div>
            <main
                class="d-flex justify-center align-center"
                style="
                    width: 90%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-direction: column;
                "
            >
                @yield('content')
            </main>
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
                            <input
                                type="text"
                                class="form-control"
                                id="password"
                            />
                        </div>
                        <div class="form-group m-b-20">
                            <label for="password">Nhập mật khẩu mới</label>
                            <input
                                type="text"
                                class="form-control"
                                id="newPassword"
                            />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-primary js_btn_editPassword"
                            data-id="{{ auth()->user()->id }}"
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

        @yield('page-script')
        <script type="text/javascript">
            $(document).ready(function () {
                $(this).on("click", "#btnLogout", function () {
                    axios({
                        method: "post",
                        url: "/api/auth/logout",
                    })
                        .then(function (response) {
                            const res = response.data;
                            if (res.result) {
                                window.location.reload();
                            } else {
                                $("#userError").html(res.data);
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                });
                $(".js_btn_editPassword").on("click", function () {
                    console.log(3);
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
                                console.log(res);
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                });
                $("#navbarDropdown").on("click", function () {
                    $("#roleDropdown").toggleClass("show");
                });
                $("#dropdownMenuButton").on("click", function () {
                    $("#userDropdown").toggleClass("show");
                });
            });
        </script>
    </body>
</html>
