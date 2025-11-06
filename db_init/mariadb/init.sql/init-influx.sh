#!/bin/bash
# -----------------------------------------------------------
# Khởi tạo InfluxDB v2 tự động cho dự án IoT Monitoring
# -----------------------------------------------------------

set -e  # Dừng script nếu có lỗi

echo "⏳ Đang chờ InfluxDB khởi động..."
sleep 10

# Thông tin khởi tạo
INFLUX_USERNAME="admin"
INFLUX_PASSWORD="admin123"
INFLUX_ORG="iot-org"
INFLUX_BUCKET="iot-bucket"
INFLUX_RETENTION="0"  # 0 = không giới hạn thời gian lưu
INFLUX_TOKEN="iot-super-token"

echo "🚀 Tiến hành khởi tạo InfluxDB..."

# Thiết lập InfluxDB với thông tin ở trên
influx setup \
  --username "${INFLUX_USERNAME}" \
  --password "${INFLUX_PASSWORD}" \
  --org "${INFLUX_ORG}" \
  --bucket "${INFLUX_BUCKET}" \
  --retention "${INFLUX_RETENTION}" \
  --token "${INFLUX_TOKEN}" \
  --force

echo "✅ Khởi tạo hoàn tất!"
echo "------------------------------------------"
echo "User:     ${INFLUX_USERNAME}"
echo "Password: ${INFLUX_PASSWORD}"
echo "Org:      ${INFLUX_ORG}"
echo "Bucket:   ${INFLUX_BUCKET}"
echo "Token:    ${INFLUX_TOKEN}"
echo "------------------------------------------"
