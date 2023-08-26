# Trang web quản lý điểm danh
## _Dự án cá nhân
[![Sơ đồ thực thể](https://app.diagrams.net/images/favicon-32x32.png)](https://drive.google.com/file/d/1kkqHYPu8yPyZ3RgVU3__KhLHFz15uKT1/view?usp=sharing)
[![Cơ sở dữ liệu](https://i.ibb.co/S7KTZxP/google-sheets-1.png)](https://drive.google.com/file/d/1qzB8HY4nveFqOJKE7WbkgE1nbIlfPLnb/view?usp=sharing)

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
| Đầu ra | Hiển thị thông báo tới người dùng |
| Lưu ý | Kiểm tra dữ liệu đầu vào tồn tại trong phạm vi cho phép |


## License

MIT

**Free Software, Hell Yeah!**
