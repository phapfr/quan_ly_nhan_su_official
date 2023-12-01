@extends('Share.master_page')

@section('title')
    Quản Lý Nhân Viên
@endsection

@section('content')
    <div id="app" class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Thêm mới nhân viên
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Mã nhân viên</label>
                        <input v-model="create_nhanvien.ma_nhan_vien" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Họ và tên</label>
                        <input v-model="create_nhanvien.ho_va_ten" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input v-model="create_nhanvien.sdt" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Quê quán</label>
                        <input v-model="create_nhanvien.que_quan" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Chức vụ</label>
                        <select v-on:change="updateChucVu()" v-model="create_nhanvien.id_chucvu" class="form-control">
                            <template v-for="(value, key) in ds_chucvu">
                                <option v-bind:value="{ma_chuc_vu : value.id}">
                                    @{{ value.ten_chuc_vu }}</option>
                            </template>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Phòng ban</label>
                        <select v-on:change="updatePhongBan()" v-model="create_nhanvien.id_phongban" class="form-control">
                            <template v-for="(value, key) in ds_phongban">
                                <option v-bind:value="{ma_phong_ban : value.id}">
                                    @{{ value.ten_phong_ban }}</option>
                            </template>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Bậc lương</label>
                        <select v-on:change="updateLuong()" v-model="create_nhanvien.id_bacluong" class="form-control">
                            <template v-for="(value, key) in ds_luong">
                                <option v-bind:value="{bac_luong : value.id}">
                                    @{{ value.bac_luong }}</option>
                            </template>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" v-on:click="themNhanVien()">Thêm mới</button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Danh Sách Nhân Viên
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="">
                            <thead>
                                <tr class="text-center align-middle bg-primary text-white text-nowrap">
                                    <th class="text-center">#</th>
                                    <th class="text-center">Mã nhân viên </th>
                                    <th class="text-center">Họ và tên</th>
                                    <th class="text-center">Số điện thoại</th>
                                    <th class="text-center">Quê quán</th>
                                    <th class="text-center">Chức vụ</th>
                                    <th class="text-center">Phòng ban</th>
                                    <th class="text-center">Bậc lương</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in ds_nhanvien">
                                    <th class="align-middle text-center">@{{ k + 1 }}</th>
                                    <td class="align-middle">@{{ v.ma_nhan_vien }}</td>
                                    <td class="align-middle">@{{ v.ho_va_ten }}</td>
                                    <td class="align-middle">@{{ v.sdt }}</td>
                                    <td class="align-middle">@{{ v.que_quan }}</td>
                                    <td class="align-middle">@{{ v.ten_chuc_vu }}</td>
                                    <td class="align-middle">@{{ v.ten_phong_ban }}</td>
                                    <td class="align-middle">@{{ v.bac_luong }}</td>
                                    <td class="text-center text-nowrap">
                                        <button class="btn btn-primary">Cập nhật</button>
                                        <button class="btn btn-danger">Xóa</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                create_nhanvien: {},
                ds_chucvu: [],
                ds_phongban: [],
                ds_luong: [],
                ds_nhanvien: [],
            },
            created() {
                this.loadChucVu();
                this.loadPhongBan();
                this.loadLuong();
                this.loadNhanVien();
            },
            methods: {
                themNhanVien() {
                    axios
                        .post('/admin/nhan-vien/store', this.create_nhanvien)
                        .then((res) => {
                            toastr.success('Thêm mới thành công');
                            this.loadNhanVien();
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },

                loadNhanVien() {
                    axios
                        .get('/admin/nhan-vien/data')
                        .then((res) => {
                            this.ds_nhanvien = res.data.data;
                        });
                },

                loadChucVu() {
                    axios
                        .get('/admin/chuc-vu/data')
                        .then((res) => {
                            this.ds_chucvu = res.data.chuc_vu;
                        });
                },

                loadPhongBan() {
                    axios
                        .get('/admin/phong-ban/data')
                        .then((res) => {
                            this.ds_phongban = res.data.phong_ban;
                        });
                },

                loadLuong() {
                    axios
                        .get('/admin/luong/data')
                        .then((res) => {
                            this.ds_luong = res.data.luong;
                        });
                },

                updateChucVu() {
                    this.create_nhanvien.ma_chuc_vu = this.create_nhanvien.id_chucvu.ma_chuc_vu;
                },

                updatePhongBan() {
                    this.create_nhanvien.ma_phong_ban = this.create_nhanvien.id_phongban.ma_phong_ban;
                },

                updateLuong() {
                    this.create_nhanvien.bac_luong = this.create_nhanvien.id_bacluong.bac_luong;
                },
            }
        })
    </script>
@endsection
