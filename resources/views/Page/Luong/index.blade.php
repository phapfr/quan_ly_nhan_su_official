@extends('Share.master_page')


@section('title')
    QUẢN LÝ LƯƠNG
@endsection

@section('content')
    <div id="app" class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Thêm mới lương
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Bậc lương</label>
                        <input v-model="them_moi.bac_luong" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Lương cơ sở</label>
                        <input v-model="them_moi.luong_co_so" type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Hệ số lương</label>
                        <input v-model="them_moi.he_so_luong" type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Hệ số phụ cấp</label>
                        <input v-model="them_moi.he_so_phu_cap" type="number" class="form-control">
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" v-on:click="createLuong()">Thêm mới</button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Danh Sách Chức Vụ
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-light">
                                <tr class="text-nowrap">
                                    <th>#</th>
                                    <th>Bậc lương</th>
                                    <th>Lương cơ sở</th>
                                    <th>Hệ số lương</th>
                                    <th>Hệ số phụ cấp</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(value, key) in ds_luong">
                                    <th class="align-middle text-center">@{{ key + 1 }}</th>
                                    <td class="align-middle">@{{ value.bac_luong }}</td>
                                    <td class="align-middle">@{{ value.luong_co_so }}</td>
                                    <td class="align-middle">@{{ value.he_so_luong }}</td>
                                    <td class="align-middle">@{{ value.he_so_phu_cap }}</td>
                                    <td class="align-middle text-nowrap text-center">
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
    <script>
        new Vue({
            el: '#app',
            data: {
                them_moi: {},
                ds_luong: [],
                // phim_xoa: {},
                // phim_update: {},
                // slug: '',
            },
            created() {
                this.loadLuong();
            },
            methods: {
                createLuong() {
                    axios
                        .post('/admin/luong/store', this.them_moi)
                        .then((res) => {
                            toastr.success('Đã thêm mới lương thành công!');
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                loadLuong() {
                    axios
                        .get('/admin/luong/data')
                        .then((res) => {
                            this.ds_luong = res.data.luong;
                            this.loadLuong();
                        });
                },
            },
        })
    </script>
@endsection
