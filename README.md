# Bài tập 3  : Môn phát triển ứng dụng trên nền web
## Yêu cầu: Lập trình ứng dụng web trên nền linux
1. Cài đặt môi trường linux: SV chọn 1 trong các phương án
 - enable wsl: cài đặt docker desktop
 - enable wsl: cài đặt ubuntu
 - sử dụng Hyper-V: cài đặt ubuntu
 - sử dụng VMware : cài đặt ubuntu
 - sử dụng Virtual Box: cài đặt ubuntu
2. Cài đặt Docker (nếu dùng docker desktop trên windows thì nó có ngay)
3. Sử dụng 1 file docker-compose.yml để cài đặt các docker container sau: 
   mariadb (3306), phpmyadmin (8080), nodered/node-red (1880), influxdb (8086), grafana/grafana (3000), nginx (80,443)
4. Lập trình web frontend+backend:
 SV chọn 1 trong các web sau:
 4.1 Web thương mại điện tử
 - Tạo web dạng Single Page Application (SPA), chỉ gồm 1 file index.html, toàn bộ giao diện do javascript sinh động.
 - Có tính năng login, lưu phiên đăng nhập vào cookie và session
   Thông tin login lưu trong cơ sở dữ liệu của mariadb, được dev quản trị bằng phpmyadmin, yêu cầu sử dụng mã hoá khi gửi login.
   Chỉ cần login 1 lần, bao giờ logout thì mới phải login lại.
 - Có tính năng liệt kê các sản phẩm bán chạy ra trang chủ
 - Có tính năng liệt kê các nhóm sản phẩm
 - Có tính năng liệt kê sản phẩm theo nhóm
 - Có tính năng tìm kiếm sản phẩm
 - Có tính năng chọn sản phẩm (đưa sản phẩm vào giỏ hàng, thay đổi số lượng sản phẩm trong giỏ, cập nhật tổng tiền)
 - Có tính năng đặt hàng, nhập thông tin giao hàng => được 1 đơn hàng.
 - Có tính năng dành cho admin: Thống kê xem có bao nhiêu đơn hàng, call để xác nhận và cập nhật thông tin đơn hàng. chuyển cho bộ phận đóng gói, gửi bưu điện, cập nhật mã COD, tình trạng giao hàng, huỷ hàng,...
 - Có tính năng dành cho admin: biểu đồ thống kê số lượng mặt hàng bán được trong từng ngày. (sử dụng grafana)
 - backend: sử dụng nodered xử lý request gửi lên từ javascript, phản hồi về json.
 4.2 Web IOT: Giám sát dữ liệu IOT.
 - Tạo web dạng Single Page Application (SPA), chỉ gồm 1 file index.html, toàn bộ giao diện do javascript sinh động.
 - Có tính năng login, lưu phiên đăng nhập vào cookie và session
   Thông tin login lưu trong cơ sở dữ liệu của mariadb, được dev quản trị bằng phpmyadmin, yêu cầu sử dụng mã hoá khi gửi login.
   Chỉ cần login 1 lần, bao giờ logout thì mới phải login lại.
 - hiển thị giá trị mới nhất của các thông số đang giám sát, khi click vào thì hiển thị đồ thị lịch sử quá trình thay đổi (gọi grafana iframe để hiển thị)
 - backend: Sử dụng nodered để đọc dữ liệu từ các cảm biến (có thể dùng api online để lấy dữ liệu theo giời gian thực), 
   nodered sẽ lưu dữ liệu mới nhất (dạng update) vào cơ sở dữ liệu mariadb (sử dụng phpmyadmin để tạp table và quản trị lần đầu)
   nodered sẽ lưu dữ liệu (insert) vào influxdb để lưu giá trị lịch sử, để cho grafana dùng để hiển thị biểu đồ.
5. Nginx làm web-server
 - Cấu hình nginx để chạy được website qua url http://fullname.com  (thay fullname bằng chuỗi ko dấu viết liền tên của bạn)
 - Cấu hình nginx để http://fullname.com/nodered truy cập vào nodered qua cổng 80, (dù nodered đang chạy ở port 1880)
 - Cấu hình nginx để http://fullname.com/grafana truy cập vào grafana qua cổng 80, (dù grafana đang chạy ở port 3000)

## Cài đặt môi trường
### 1. Sử dụng VMware: cài đặt ubuntu
1. Bước 1: Đăng nhập vào trang ubuntu.com để tải Ubuntu 24.04.3 LTS về
<img width="1917" height="989" alt="Ảnh chụp màn hình 2025-11-04 095831" src="https://github.com/user-attachments/assets/818c4dd2-eff4-43fb-858d-a8f7182e9f9b" />

<img width="1917" height="984" alt="Ảnh chụp màn hình 2025-11-04 095856" src="https://github.com/user-attachments/assets/1b7a148b-2e1f-44f6-a346-83e56683f0d0" />

<img width="942" height="70" alt="Ảnh chụp màn hình 2025-11-04 103216" src="https://github.com/user-attachments/assets/75271e3e-aaa8-4444-a571-957936c7303c" />

2. Bước 2: Tạo máy ảo trên VMware
<img width="432" height="433" alt="Ảnh chụp màn hình 2025-11-04 103308" src="https://github.com/user-attachments/assets/02df4c1f-f030-47a6-bc3c-cc4dea8bcb31" />

<img width="429" height="426" alt="Ảnh chụp màn hình 2025-11-04 103407" src="https://github.com/user-attachments/assets/d4e65e7e-e384-4012-abba-cd1c8f0e9ef6" />

<img width="433" height="433" alt="Ảnh chụp màn hình 2025-11-04 103439" src="https://github.com/user-attachments/assets/37344a43-af0e-47a2-b8d6-c6cf6ffdb1f4" />

<img width="432" height="432" alt="Ảnh chụp màn hình 2025-11-04 103739" src="https://github.com/user-attachments/assets/24110c0b-dc5f-4d65-aaab-6720f1903e91" />

<img width="427" height="432" alt="Ảnh chụp màn hình 2025-11-04 103936" src="https://github.com/user-attachments/assets/947b4b1e-43c6-4e76-8192-ba2a66db673c" />

<img width="431" height="431" alt="Ảnh chụp màn hình 2025-11-04 103950" src="https://github.com/user-attachments/assets/1fd949fc-84f6-4ec9-931d-2db6447c4b5d" />

Sau khi cài xong ta sẽ thấy hiển thị VM_Ubuntu bên trái màn hình và ta mở lên
<img width="1919" height="1033" alt="Ảnh chụp màn hình 2025-11-04 104004" src="https://github.com/user-attachments/assets/e4e8bc50-b09e-40e0-90b6-61440a3c40ff" /Ta 

Ta click chuột 2 lần vào edit virtual machine settings để chỉnh sửa thiết lập máy ảo

<img width="1684" height="975" alt="Ảnh chụp màn hình 2025-11-04 104213" src="https://github.com/user-attachments/assets/606cb427-fa36-494b-a285-7d1d3cd5b3bc" />

3. Bước 3: Cầu hình cho Ubuntu
<img width="1684" height="981" alt="Ảnh chụp màn hình 2025-11-04 104539" src="https://github.com/user-attachments/assets/ebcfea6b-8f01-4514-a9c7-afdd5220f170" />

Ta sẽ bấm next cho tới khi tới create your account để tạo tài khoản -> next
<img width="1684" height="976" alt="Ảnh chụp màn hình 2025-11-04 105446" src="https://github.com/user-attachments/assets/61d0a76a-6178-43c1-9f02-848ea33daac8" />

Tìm đến địa chỉ mình đang ở rồi chỉnh sửa -> next 
<img width="1683" height="978" alt="Ảnh chụp màn hình 2025-11-04 105556" src="https://github.com/user-attachments/assets/e43a4eca-f09d-47af-89a9-50bbc2652eec" />

Sau đó chờ tải cấu hình về
<img width="1686" height="975" alt="Ảnh chụp màn hình 2025-11-04 105611" src="https://github.com/user-attachments/assets/41a78912-b643-447d-a868-1cec6c15f9b2" />

<img width="1683" height="977" alt="Ảnh chụp màn hình 2025-11-04 110416" src="https://github.com/user-attachments/assets/3defb4f2-e305-41af-a83d-e0520c1ea635" />
