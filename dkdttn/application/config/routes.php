<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "c_home";
$route['404_override'] = 'c_home/page404';
$route['404-page'] = 'c_home/page404';
$route['error-page'] = 'c_error/err';

$route['trang-chu.chn'] = 'c_home';
$route['huong-dan-dang-ky'] = 'c_home/huong_dan';
$route['thong-ke'] = 'c_home/thong_ke';
$route['thong-ke-sinh-vien'] = 'c_home/thong_ke_sinh_vien';
$route['thong-ke-de-tai'] = 'c_home/thong_ke_de_tai';
$route['thong-ke-giang-vien'] = 'c_home/thong_ke_giang_vien';
$route['tin-tu-giao-vu/([a-zA-Z0-9-_]+)'] = 'c_home/chi_tiet_tin_tuc/$1';

$route['user/dang-nhap'] = 'c_user/dang_nhap_form';
$route['xu-ly-dang-nhap'] = 'c_user/xu_ly_dang_nhap';

$route['user/dang-xuat'] = 'c_user/dang_xuat';

$route['danh-sach-de-tai/([a-zA-Z0-9-_/]+)'] = 'c_home/danh_sach_de_tai/$1';
$route['de-tai-chuyen-nganh/([0-9]+)/([a-zA-Z0-9-_/]+)'] = 'c_home/danh_sach_de_tai_chuyen_nganh/$1/$2';
$route['giang-vien-de-tai'] = 'c_home/giangvien_detai';

$route['danh-sach-sinh-vien/([a-zA-Z0-9-/]+)'] = 'c_home/danh_sach_sinh_vien/$1';
/*
$route['sinh-vien/(:num)'] = 'c_timkiem/tim_kiem_sinh_vien/$1';
$route['giang-vien/(:num)'] = 'c_timkiem/tim_kiem_giang_vien_id/$1';
*/
$route['tim-kiem.chn'] = 'c_timkiem/tim_kiem';

//$route['tim-kiem-sinh-vien'] = 'c_home/loc_sinh_vien';
$route['sinh-vien-chuyen-nganh/([a-zA-Z0-9-/]+)'] = 'c_home/loc_sinhvien_chuyenganh/$1';
$route['sinh-vien-nien-khoa/([0-9-/]+)/([a-zA-Z0-9-/]+)'] = 'c_home/loc_sinhvien_nienkhoa/$1/$2';

$route['danh-sach-giang-vien/([a-zA-Z0-9-/]+)'] = 'c_home/danh_sach_giang_vien/$1';

$route['giang-vien-chuyen-nganh/([a-zA-Z0-9-/]+)'] = 'c_home/loc_danh_sach_giang_vien_chuyen_nganh/$1';

$route['danh-sach-loai-de-tai'] = 'c_home/danh_sach_loai_de_tai';
$route['chi-tiet-de-tai/([a-zA-Z0-9-_]+)'] = 'c_home/chi_tiet_de_tai/$1';

$route['quen-mat-khau'] = 'c_user/quen_mat_khau';
$route['xu-ly-quen-mat-khau'] = 'c_user/xu_ly_quen_mat_khau';
$route['xu-ly-xac-nhan-quen-mat-khau'] = 'c_user/xu_ly_xac_nhan_quen_mat_khau';
$route['xu-ly-cap-nhat-mat-khau'] = 'c_user/cap_nhat_mat_khau';

$route['user/doi-avatar'] = 'c_user/doi_avatar';

$route['user/doi-mat-khau'] = 'c_user/doi_mat_khau_form';
$route['user/xu-ly-doi-mat-khau'] = 'c_user/xu_ly_doi_mat_khau';

$route['user/doi-thong-tin-ca-nhan'] = 'c_user/doi_thong_tin_ca_nhan';
$route['user/xu-ly-doi-thong-tin-ca-nhan'] = 'c_user/xu_ly_doi_thong_tin_ca_nhan';

//Dang ky de tai
$route['user/lich-su-nguoi-dung'] = 'c_dangkydetai/xem_lichsu_nguoidung';
$route['user/quan-tri'] = 'c_user/quan_tri';

$route['user/dang-ky-de-tai'] = 'c_dangkydetai/index';
$route['user/de-tai-giang-vien'] = 'c_dangkydetai/giangvien_detai';

$route['user/dang-ky-de-tai/([a-zA-Z0-9-_/]+)'] = 'c_dangkydetai/index/$1';
//Dang ky chuyen nganh
$route['user/dang-ky-chuyen-nganh'] = 'c_dangkychuyennganh/index';
$route['user/xu-ly-dang-ky-chuyen-nganh'] = 'c_dangkychuyennganh/dang_ky_chuyen_nganh';
$route['user/them-cau-hinh-dangky-cn'] = 'c_dangkychuyennganh/them_dang_ky_chuyen_nganh';
$route['user/xuat-ket-qua-dang-ky-cn'] = 'c_dangkychuyennganh/export_result';

//$route['user/dang-ky/(:num)'] = 'c_dangkydetai/dang_ky_nhom_truong/$1';
$route['user/dang-ky'] = 'c_dangkydetai/dang_ky_nhom_truong';

$route['user/quan-ly-nhom'] = 'c_dangkydetai/quan_ly_nhom';
$route['user/xu-ly-them-thanh-vien'] = 'c_dangkydetai/xu_ly_them_thanh_vien';
$route['user/xu-ly-them-thanh-vien/(:num)'] = 'c_dangkydetai/xu_ly_them_thanh_vien/$1';

$route['user/xoa-sinh-vien-xin-vao-nhom/(:num)'] = 'c_dangkydetai/xoa_sv_xin_vaonhom/$1';

$route['user/huy-nhom'] = 'c_dangkydetai/huy_nhom';
$route['user/roi-nhom'] = 'c_dangkydetai/roi_nhom';
$route['user/gui-email-nhom-truong'] = 'c_dangkydetai/gui_email_nhomtruong';
$route['user/xin-vao-nhom'] = 'c_dangkydetai/xin_vao_nhom';
//Dang de tai - giang vien
$route['user/chon-loai-de-tai'] = 'c_dangdetai_gv/danh_sach_loai_de_tai';
$route['user/danh-sach-de-tai-gv/(:num)'] = 'c_dangdetai_gv/danh_sach_de_tai/$1';
$route['user/them-de-tai/(:num)'] = 'c_dangdetai_gv/them_detai/$1';
$route['user/xu-ly-them-de-tai'] = 'c_dangdetai_gv/xu_ly_them_detai';
$route['user/xoa-de-tai/(:any)'] = 'c_dangdetai_gv/xoa_detai/$1';
$route['user/sua-de-tai/(:num)'] = 'c_dangdetai_gv/sua_detai/$1';
$route['user/xu-ly-sua-de-tai'] = 'c_dangdetai_gv/xu_ly_sua_detai';

$route['user/xu-ly-them-nhom-truong-gv'] = 'c_dangdetai_gv/xu_ly_them_nhom_truong';
$route['user/gv-thanh-vien'] = 'c_dangdetai_gv/xu_ly_them_thanh_vien';



/* ---------------admin ---------------------------*/
$route['user/quan-ly-dang-ky-de-tai'] = 'c_dangkychuyennganh/qlydangky';
$route['user/admin'] = 'c_admin/trang_quan_tri';
$route['user/manager-config'] = 'c_admin/quan_tri_cau_hinh';
$route['user/chi-tiet-cau-hinh/(:num)'] = 'c_admin/chi_tiet_cau_hinh/$1';
$route['user/them-cau-hinh'] = 'c_admin/them_cau_hinh';
$route['user/sua-cau-hinh'] = 'c_admin/sua_cau_hinh';
$route['user/sua-cau-hinh/(:num)'] = 'c_admin/sua_cau_hinh/$1';
$route['user/quan-ly-sinh-vien-cau-hinh/(:num)'] = 'c_admin/sinhvien_cauhinh/$1';
$route['user/xoa-sinh-vien-cau-hinh/(:num)/(:num)'] = 'c_admin/xoa_sinhvien_cauhinh/$1/$2';
$route['user/xoa-tat-ca-sinh-vien-cau-hinh/(:num)'] = 'c_admin/xoa_tatca_sinhvien_cauhinh/$1';
$route['user/them-sinh-vien-cau-hinh'] = 'c_admin/them_sinhvien_cauhinh';
$route['user/export-de-tai/(:num)'] = 'c_admin/export_cauhinh_detai/$1';

# Thong bao
$route['user/quan-ly-thong-bao'] = 'c_admin/index_thongbao';
$route['user/them-thong-bao'] = 'c_admin/them_thongbao';
$route['user/xoa-thong-bao/(:num)'] = 'c_admin/xoa_thongbao/$1';
$route['user/cap-nhat-tin-moi/(:num)/(:num)'] = 'c_admin/capnhat_tinmoi/$1/$2';
$route['user/sua-thong-bao'] = 'c_admin/sua_thongbao';
$route['user/sua-thong-bao/(:num)'] = 'c_admin/sua_thongbao/$1';
# người dùng
$route['user/quan-ly-nguoi-dung'] = 'c_admin/index_nguoidung';
$route['user/detail-user'] = 'c_admin/info_nguoidung';
# đề tài
$route['user/danh-sach-de-tai-admin/([a-zA-Z0-9-_/]+)/(:num)'] = 'c_admin/detai_giangvien_admin/$1/$2';
$route['user/quan-ly-de-tai'] = 'c_admin/quan_tri_de_tai';
# chung
$route['user/quan-ly-chung'] = 'c_admin/index_chung';
$route['user/quan-ly-nien-khoa'] = 'c_admin/quantri_nienkhoa';
$route['user/quan-ly-lop'] = 'c_admin/quan_tri_lop';
$route['user/quan-ly-chuyen-nganh'] = 'c_admin/quan_tri_chuyen_nganh';
$route['user/cau-hinh-giang-vien-ajax'] = 'c_admin/detai_giangvien_ajax';
#log 

/* End of file routes.php */
/* Location: ./application/config/routes.php */