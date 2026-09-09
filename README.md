# BÁO CÁO BÀI TẬP LAB 1 - HỆ QUẢN TRỊ NỘI DUNG (CMS)

## THÔNG TIN SINH VIÊN VÀ DỰ ÁN
* **Họ và tên sinh viên:** Văn Nguyễn Xuân Hoa
* **Học phần:** Hệ Quản Trị Nội Dung (CMS)
* **Nền tảng thực hiện:** WordPress (Docker Container)
* **Kho lưu trữ GitHub:** UMISORA09/VanNguyenXuanHoa_CMS
* **Phiên bản hoàn thành:** Tag v1.0.0

---

## MỤC TIÊU VÀ NỘI DUNG HOÀN THÀNH

### 1. Khởi tạo kho lưu trữ và kết nối Git
* Đăng ký và tạo mới repository theo đúng quy ước đặt tên trên GitHub.
* Thực hiện kết nối repository về máy trạm, tạo file kiểm tra kết nối và đồng bộ thành công giữa máy trạm và GitHub.

### 2. Thiết lập môi trường và cài đặt hệ thống
* Triển khai hệ thống bằng công nghệ container hóa với Docker bao gồm dịch vụ máy chủ web WordPress, hệ quản trị cơ sở dữ liệu MySQL 8.0 và công cụ quản lý cơ sở dữ liệu phpMyAdmin.
* Thiết lập cơ sở dữ liệu chuyên biệt phục vụ bài tập với tên theo quy ước họ và tên sinh viên.
* Thực hiện cài đặt hoàn chỉnh WordPress qua giao diện web với tài khoản quản trị đầu tiên.

### 3. Cấu hình hệ thống WordPress
* Cài đặt và kích hoạt ngôn ngữ hiển thị giao diện mặc định là Tiếng Việt.
* Đặt tên website là Blog Văn Nguyễn Xuân Hoa và thiết lập khẩu hiệu trang.
* Cấu hình múi giờ chuẩn theo khu vực Hồ Chí Minh (UTC+7).
* Điều chỉnh định dạng hiển thị ngày theo chuẩn Việt Nam (ngày/tháng/năm) và định dạng giờ (giờ:phút).

### 4. Xây dựng cấu trúc danh mục và phân quyền người dùng
* **Danh mục bài viết (5 danh mục):**
  * Công Nghệ: Cập nhật xu hướng công nghệ mới, trí tuệ nhân tạo và lập trình.
  * Đời Sống: Chia sẻ phong cách sống, kỹ năng phát triển bản thân và cân bằng cuộc sống.
  * Du Lịch: Cẩm nang khám phá các địa điểm du lịch, văn hóa và trải nghiệm.
  * Ẩm Thực: Giới thiệu các món ăn ngon, công thức nấu nướng và văn hóa ẩm thực.
  * Sức Khỏe: Kiến thức rèn luyện thể chất, yoga, thiền định và dinh dưỡng lành mạnh.
* **Tài khoản người dùng (5 vai trò khác nhau):**
  * Quản trị viên (Administrator): Tài khoản có toàn quyền quản trị cao nhất trên toàn hệ thống.
  * Biên tập viên (Editor): Chịu trách nhiệm quản lý, duyệt và chỉnh sửa toàn bộ bài viết của các tác giả.
  * Tác giả (Author): Được phép viết, chỉnh sửa và trực tiếp đăng tải các bài viết cá nhân.
  * Cộng tác viên (Contributor): Có thể soạn thảo bài viết mới nhưng cần người kiểm duyệt xuất bản.
  * Thành viên đăng ký (Subscriber): Có quyền đọc, xem bài viết và quản lý hồ sơ cá nhân.

### 5. Xuất bản nội dung bài viết
* Xuất bản đầy đủ 10 bài viết hoàn chỉnh với tiêu đề và nội dung phong phú bằng tiếng Việt.
* Phân bổ đều các bài viết vào từng danh mục tương ứng.
* Gắn đầy đủ ảnh đại diện nổi bật và ảnh minh họa cho từng bài viết.
* Bổ sung đoạn trích tóm tắt ngắn gọn và gán các thẻ từ khóa phù hợp cho từng bài viết.

### 6. Sao lưu cơ sở dữ liệu và quản lý phiên bản Git
* Xuất file sao lưu toàn bộ cơ sở dữ liệu hoàn chỉnh lưu trữ trong thư mục db.
* Tạo nhánh chuyên trách lab1 từ nhánh chính để thực hiện cam kết toàn bộ mã nguồn, cấu hình, dữ liệu bài viết và file sao lưu database.
* Phân tách lịch sử commit rõ ràng theo từng giai đoạn thực hiện.
* Kiểm tra tính toàn vẹn và giao diện hiển thị trên trình duyệt.
* Hợp nhất toàn bộ nội dung từ nhánh lab1 vào nhánh main và gắn nhãn phiên bản v1.0.0.

---

## HƯỚNG DẪN TRUY CẬP HỆ THỐNG

* **Trang chủ Website:** Mở trình duyệt web và truy cập địa chỉ localhost qua cổng mạng 8080.
* **Khu vực quản trị WordPress:** Truy cập đường dẫn trang quản trị qua địa chỉ localhost cổng 8080 với thư mục wp-admin.
* **Trang quản lý cơ sở dữ liệu:** Mở công cụ phpMyAdmin qua địa chỉ localhost cổng mạng 8081.
