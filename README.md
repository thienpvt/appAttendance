# Trang web quản lý điểm danh
## _Dự án cá nhân
[![Sơ đồ thực thể](https://app.diagrams.net/images/favicon-32x32.png)](https://drive.google.com/file/d/1CIiWkZ25f-Pu1gYtNiLrdV2dG-IGLmrI/view?usp=sharing)
[![Cơ sở dữ liệu](https://i.ibb.co/S7KTZxP/google-sheets-1.png)](https://docs.google.com/spreadsheets/d/1k0TEgq5_6LldRxVwSTqpFD4Nd6u8_f6bzy8TnV7oOPo/edit?usp=sharing)

### Đối tượng sử dụng
- Quản lí giáo vụ
- Giảng viên

### Chức năng từng đối tượng
A. Quản lí giáo vụ
- Quản lý giảng viên
- Quản lý sinh viên, học viên
- Quản lý lớp
- Quản lý môn học

B. Giảng viên
- Quản lý điểm danh sinh viên
  
### Phân tích chức năng

- Điểm danh

| Các tác nhân | Giảng viên |
| ------ | ------ |
| Mô tả | Điểm danh cho sinh viên các lớp |
| Kích hoạt | Người dùng ấn vào nút “Update” cuối trang |
| Đầu vào | Tên Lớp<br>Tên môn<br>Buổi học thứ mấy<br>Id sinh viên<br>Tình trạng của sinh viên trong buổi học<br>
| Trình tự xử lý | 1. Kết nối CSDL<br>2. Kiểm tra thông tin buổi học đã được lưu trong CSDL chưa (tạo mới nếu chưa)<br>3. Kiểm tra tình trạng điểm danh của sinh viên (nếu chưa thì tạo mới, nếu có thì cập nhật lại tình trạng điểm danh)|
| Đầu ra | Đúng: Hiển thị trang người dùng và thông báo thành công<br>Sai: Hiển thị trang đăng nhập và thông báo thất bại |
| Lưu ý | Kiểm tra ô nhập không được để trống bằng JavaScript |


## License

MIT

**Free Software, Hell Yeah!**
