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

- Web thương mại điện tử
   - Tạo web dạng Single Page Application (SPA), chỉ gồm 1 file index.html, toàn bộ giao diện do javascript sinh động.
   - Có tính năng login, lưu phiên đăng nhập vào cookie và session
     - Thông tin login lưu trong cơ sở dữ liệu của mariadb, được dev quản trị bằng phpmyadmin, yêu cầu sử dụng mã hoá khi gửi login.
     - Chỉ cần login 1 lần, bao giờ logout thì mới phải login lại.
   - Có tính năng liệt kê các sản phẩm bán chạy ra trang chủ
   - Có tính năng liệt kê các nhóm sản phẩm
   - Có tính năng liệt kê sản phẩm theo nhóm
   - Có tính năng tìm kiếm sản phẩm
   - Có tính năng chọn sản phẩm (đưa sản phẩm vào giỏ hàng, thay đổi số lượng sản phẩm trong giỏ, cập nhật tổng tiền)
   - Có tính năng đặt hàng, nhập thông tin giao hàng => được 1 đơn hàng.
   - Có tính năng dành cho admin: Thống kê xem có bao nhiêu đơn hàng, call để xác nhận và cập nhật thông tin đơn hàng. chuyển cho bộ phận đóng gói, gửi bưu điện, cập nhật mã COD, tình trạng giao hàng, huỷ hàng,...
   - Có tính năng dành cho admin: biểu đồ thống kê số lượng mặt hàng bán được trong từng ngày. (sử dụng grafana)
   - backend: sử dụng nodered xử lý request gửi lên từ javascript, phản hồi về json.
   
 - Web IOT: Giám sát dữ liệu IOT
   - Tạo web dạng Single Page Application (SPA), chỉ gồm 1 file index.html, toàn bộ giao diện do javascript sinh động.
   - Có tính năng login, lưu phiên đăng nhập vào cookie và session
     - Thông tin login lưu trong cơ sở dữ liệu của mariadb, được dev quản trị bằng phpmyadmin, yêu cầu sử dụng mã hoá khi gửi login.
     - Chỉ cần login 1 lần, bao giờ logout thì mới phải login lại.
   - hiển thị giá trị mới nhất của các thông số đang giám sát, khi click vào thì hiển thị đồ thị lịch sử quá trình thay đổi (gọi grafana iframe để hiển thị)
   - backend: Sử dụng nodered để đọc dữ liệu từ các cảm biến (có thể dùng api online để lấy dữ liệu theo giời gian thực), 
     - nodered sẽ lưu dữ liệu mới nhất (dạng update) vào cơ sở dữ liệu mariadb (sử dụng phpmyadmin để tạp table và quản trị lần đầu)
     - nodered sẽ lưu dữ liệu (insert) vào influxdb để lưu giá trị lịch sử, để cho grafana dùng để hiển thị biểu đồ.
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
<img width="1919" height="1033" alt="Ảnh chụp màn hình 2025-11-04 104004" src="https://github.com/user-attachments/assets/e4e8bc50-b09e-40e0-90b6-61440a3c40ff" />

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

4. Bước 4: Cài đặt hoàn tất Ubuntu và đăng nhập
<img width="1686" height="975" alt="Ảnh chụp màn hình 2025-11-04 115456" src="https://github.com/user-attachments/assets/1bbd26b1-c526-4a40-a271-668e4b59501e" />

Dùng mật khẩu mà ta đã tạo ở bước trước đó để đăng nhập vào
<img width="1683" height="956" alt="Ảnh chụp màn hình 2025-11-04 115822" src="https://github.com/user-attachments/assets/8d79a1da-e64a-4092-874b-d86a4a81ff4a" />

Đăng nhập thành công
<img width="1686" height="961" alt="Ảnh chụp màn hình 2025-11-04 115941" src="https://github.com/user-attachments/assets/d898c4dc-6289-4385-8869-c9e234c6571f" />

### 2. Cài đặt Docker
1. Bước 1: Cài đặt Docker và Docker Compose
- Mở terminal để chạy các dòng lệnh sau
```
sudo apt update
sudo apt install -y ca-certificates curl gnupg lsb-release
```
2. Bước 2: Thêm repo và cài Docker
```
sudo mkdir -p /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg

echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] \
  https://download.docker.com/linux/ubuntu \
  $(lsb_release -cs) stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

sudo apt update
sudo apt install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
```
3. Bước 3: Cho phép chạy Docker không cần sudo
```
sudo usermod -aG docker $USER
newgrp docker
```
  - Sau lệnh này, nếu thấy lỗi "permission denied", hãy logout/login lại máy ảo
4. Bước 4: Kiểm tra Docker
```
docker --version
 docker compose version
 docker run hello-world
```

<img width="1682" height="965" alt="Ảnh chụp màn hình 2025-11-04 122949" src="https://github.com/user-attachments/assets/2e3157ec-5c47-4058-91ae-6a24b5377ab8" />

### 3. Tạo file docker-compose.yml
1. Bước 1: Tạo thư mục làm việc
```
mkdir ~/do_an_web
cd ~/do_an_web
```
2. Bước 2: Tạo file compose:
```
nano docker-compose.yml
```
```
version: '3.9'

services:
  mariadb:
    image: mariadb:latest
    container_name: mariadb
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: root123
      MYSQL_DATABASE: banhang
      MYSQL_USER: ha
      MYSQL_PASSWORD: 123456
    volumes:
      - mariadb_data:/var/lib/mysql
    ports:
      - "3306:3306"

  phpmyadmin:
    image: phpmyadmin/phpmyadmin:latest
    container_name: phpmyadmin
    restart: always
    depends_on:
      - mariadb
    environment:
      PMA_HOST: mariadb
      PMA_USER: ha
      PMA_PASSWORD: 123456
    ports:
      - "8080:80"

  nodered:
    image: nodered/node-red:latest
    container_name: nodered
    restart: always
    ports:
      - "1880:1880"
    volumes:
      - nodered_data:/data

  influxdb:
    image: influxdb:latest
    container_name: influxdb
    restart: always
    ports:
      - "8086:8086"
    volumes:
      - influxdb_data:/var/lib/influxdb

  grafana:
    image: grafana/grafana:latest
    container_name: grafana
    restart: always
    depends_on:
      - influxdb
    ports:
      - "3000:3000"
    volumes:
      - grafana_data:/var/lib/grafana

  nginx:
    image: nginx:latest
    container_name: nginx
    restart: always
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./nginx/conf.d:/etc/nginx/conf.d
      - ./frontend:/usr/share/nginx/html
    depends_on:
      - nodered
      - grafana

volumes:
  mariadb_data:
  nodered_data:
  influxdb_data:
  grafana_data:
```
Để lưu lại ta ấn Ctrl+O, Enter, Ctrl+X.

3. Bước 3: chạy stack
```
docker compose up -d
```

<img width="1684" height="974" alt="Ảnh chụp màn hình 2025-11-04 125152" src="https://github.com/user-attachments/assets/c5305c57-1eef-44b1-8a1f-91743228507a" />

4. Bước 4: Xem tình trạng
```
docker ps
```

<img width="1686" height="943" alt="image" src="https://github.com/user-attachments/assets/c1d5c60a-de6e-46e2-8c4c-c3581749d13f" />

### 4. Cấu hình nginx
File nginx/default.conf:
```
server {
    listen 80;
    server_name nguydinhtuanha.com www.nguydinhtuanha.com;

    # === Gốc: SPA Frontend ===
    location / {
        root /usr/share/nginx/html;
        index index.html;
        try_files $uri $uri/ /index.html;

        # Cache static assets
        location ~* \.(js|css|png|jpg|jpeg|gif|svg|ico|woff2?|ttf|eot)$ {
            expires 1y;
            add_header Cache-Control "public, immutable";
        }
    }

    # === API Backend (Node-RED) ===
    location /api/ {
        proxy_pass http://nodered:1880/;
        proxy_http_version 1.1;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }

    # === API User Orders (Node-RED) ===
    location /user/ {
        proxy_pass http://nodered:1880/;
        proxy_http_version 1.1;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }

    # === Node-RED UI (Subpath) ===
    location ^~ /nodered/ {
        proxy_pass http://nodered:1880/;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;

        # Fix tài nguyên tĩnh (CSS/JS) cho subpath
        sub_filter_once off;
        sub_filter 'href="/'  'href="/nodered/';
        sub_filter 'src="/'   'src="/nodered/';
        sub_filter 'action="/' 'action="/nodered/';
        sub_filter_types text/css text/javascript text/xml application/javascript;
        proxy_set_header Accept-Encoding "";
    }

    # === Grafana (Subpath) ===
    location /grafana/ {
        proxy_pass http://grafana:3000/;
        proxy_http_version 1.1;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto http;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        
        # Fix redirects từ Grafana
        proxy_redirect http://grafana:3000/ /grafana/;
        proxy_redirect / /grafana/;
        
        # CHỈ thay thế trong HTML (KHÔNG làm hỏng JS/CSS)
        sub_filter_once off;
        sub_filter_types text/html;
        sub_filter 'href="/' 'href="/grafana/';
        sub_filter 'src="/' 'src="/grafana/';
        sub_filter 'href="public/' 'href="/grafana/public/';
        sub_filter 'src="public/' 'src="/grafana/public/';
        
        proxy_set_header Accept-Encoding "";
    }

    # === Bảo mật Header ===
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    # === 404 Fallback cho SPA ===
    error_page 404 /index.html;
}
```
<img width="1919" height="1079" alt="image" src="https://github.com/user-attachments/assets/b7cf02ba-9c1c-4f38-9125-007c89e5cf4a" />

<img width="1919" height="979" alt="Ảnh chụp màn hình 2025-11-05 204148" src="https://github.com/user-attachments/assets/aa19f19c-e9fc-4b51-ab56-ee192db78bfd" />

##### Website chính: 👉 http://nguydinhtuanha.com
##### Node-RED: 👉 http://nguydinhtuanha.com/nodered
##### Grafana: 👉 http://nguydinhtuanha.com/grafana

### 5. Mariadb
<img width="1876" height="950" alt="image" src="https://github.com/user-attachments/assets/a908b8f2-4ac3-440a-add0-2878904258ee" />

Danh sách bảng và vai trò
1. Users (Người dùng)
- Vai trò: Lưu thông tin tài khoản đăng nhập của người dùng hệ thống (bao gồm cả admin và người dùng giám sát IoT).
- Các cột chính:
  - username: Tên đăng nhập duy nhất của người dùng
  - password_hash: Mật khẩu đã được mã hóa bằng bcrypt, đảm bảo an toàn
  - fullname: Họ và tên đầy đủ của người dùng.
  - email: Địa chỉ email của người dùng.
  - created_at: Thời điểm tạo tài khoản.
- Quan hệ:
  - Người dùng có thể đăng nhập để xem, giám sát và thao tác trên dữ liệu cảm biến
  - Người dùng quản trị (admin) có thể thêm, xóa, sửa thông tin cảm biến hoặc tài khoản khác
2. Sensors (Cảm biến)
- Vai trò: Lưu thông tin cấu hình của các cảm biến trong hệ thống (ví dụ: nhiệt độ, độ ẩm, ánh sáng...)
- Các cột chính:
  - sensor_name: Tên của cảm biến (ví dụ: "Nhiệt độ phòng khách")
  - sensor_type: Loại cảm biến (temperature, humidity, light, v.v.).
  - unit: Đơn vị đo (°C, %, Lux,...)
  - location: Vị trí đặt cảm biến (phòng, khu vực...).
  - description: Mô tả chi tiết cảm biến
  - created_at: Ngày giờ cảm biến được thêm vào hệ thống
- Quan hệ:
  - Mỗi cảm biến có một giá trị hiện tại trong bảng latest_values
  - Mỗi cảm biến có nhiều giá trị lịch sử trong InfluxDB (cho Grafana hiển thị đồ thị)
3. Latest_Values (Giá trị mới nhất)
- Vai trò:
  - Lưu giá trị cảm biến mới nhất được cập nhật liên tục từ Node-RED.
  - Mục đích là giúp web hiển thị nhanh giá trị hiện hành mà không phải truy vấn lịch sử dài
- Các cột chính:
  - sensor_id: Khóa chính, đồng thời là khóa ngoại liên kết tới bảng sensors(id)
  - value: Giá trị mới nhất mà cảm biến gửi về
  - updated_at: Thời điểm cập nhật gần nhất (tự động cập nhật khi có giá trị mới).
- Quan hệ:
  - Thuộc về 1 cảm biến (Sensors)
  - Được Node-RED UPDATE mỗi khi có dữ liệu mới từ cảm biến
  - Được web SPA đọc để hiển thị giá trị hiện tại lên giao diện người dùng
4. Logs (Nhật ký hệ thống)
- Vai trò:
  - Ghi lại nhật ký hoạt động của hệ thống: thông báo, cảnh báo, hoặc lỗi.
  - Dùng để kiểm tra và giám sát trạng thái của backend (PHP, Node-RED, sensor...)
- Các cột chính:
  - message: Nội dung log (thông điệp hoặc mô tả lỗi)
  - level: Mức độ log (INFO, WARN, ERROR)
  - created_at: Thời điểm ghi log
- Quan hệ:
  - Có thể được tạo bởi PHP (khi người dùng đăng nhập sai, lỗi DB...) hoặc Node-RED (khi ghi dữ liệu cảm biến, gặp lỗi kết nối...)
  - Dữ liệu log có thể được admin xem để chẩn đoán sự cố hệ thống
